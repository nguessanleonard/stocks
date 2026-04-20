<?php

    namespace App\Http\Controllers;

    use App\Models\Annee;
    use App\Models\Anneesmois;
    use App\Models\Loginimages;
    use App\Models\Logintextes;
    use App\Models\Mois;
    use Illuminate\Http\Request;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    use Illuminate\Support\Facades\Redirect;


    class ConnexionController extends Controller
    {

        public function login()
        {
            $data = array(
                'name' => 'Gestion ',
                'classe' => 'Connexion',
                'vue' => 'Login page',
                'title' => 'Gestion des Login',

            );

            return view('login.index', $data);
        }

        public function loguser(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6'
            ], [
                'email.required' => 'Le champ email est obligatoire.',
                'email.email' => 'Email invalide.',
                'password.required' => 'Le mot de passe est obligatoire.',
                'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.'
            ]);

            $year = now()->year;

            $data = [

                'updated_at' => now(),
            ];

            $mois = Mois::getmois();

            foreach ([$year - 1, $year, $year + 1] as $y) {

                $annee = Annee::updateOrCreate(
                    ['libelle' => $y],
                    [

                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );


                foreach ($mois as $m) {

                    Anneesmois::updateOrCreate(
                        [
                            'mois_id'   => $m->id,
                            'annees_id' => $annee->id
                        ],
                        $data
                    );
                }
            }

            // 1️⃣ Authentification d'abord
            if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
                return response()->json([
                    'errors' => ['email' => ['Identifiants incorrects']]
                ], 422);
            }

            $request->session()->regenerate();

            return response()->json([
                'success' => 'Connexion réussie',
                'route' => route('tableaudebord.index')
            ]);
        }
        public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route("login.login");
        }

    }
