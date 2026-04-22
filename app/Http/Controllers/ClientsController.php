<?php

    namespace App\Http\Controllers;

    use App\Models\Client;
    use App\Models\Fournisseur;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\Rule;

    class ClientsController extends Controller
    {
        public function index()
        {
            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'Login page',
                'title' => 'Gestion des Produits',
                'clients' => Client::clients(),
            ];

            return view('clients.index', $data);
        }

        public function ajouter(Request $request)
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'noms' => 'nullable|string|max:255',
                    'telephone' => 'nullable|string|max:20',
                    'email' => 'nullable|email|max:255',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            // 🔥 Vérification globale
            if (
                empty($data['noms']) &&
                empty($data['telephone']) &&
                empty($data['email'])
            ) {
                return response()->json([
                    'errors' => ['message' => ['Veuillez renseigner au moins une information.']]
                ], 422);
            }

            $dataClient = [
                'noms' => !empty($data['noms']) ? mb_strtoupper($data['noms']) : null,
                'telephone' => $data['telephone'] ?? null,
                'email' => !empty($data['email']) ? mb_strtolower($data['email']) : null,
                'userAdd' => Auth::id(),
            ];

            Client::create($dataClient);

            return response()->json([
                'success' => 'Le client a été ajouté avec succès.',
            ]);
        }

        public function update(Request $request, $id)
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'noms' => 'nullable|string',
                    'telephone' => 'nullable|string',
                    'email' => 'nullable|string',
                ],

            );
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();


            $client = Client::find($id);

            if (!$client) {
                return response()->json([
                    'error' => 'Client introuvable'
                ], 404);
            }

            $dataclient = [
                'noms' => mb_strtoupper($data['noms']),
                'telephone' => $data['telephone'],
                'email' => mb_strtolower($data['email']),
                'userUpdate' => Auth::id(),
                'updated_at' => Carbon::now(),
            ];

            Client::where('id', $id)->update($dataclient);

            return response()->json([
                'success' => "Les informations du client ont été mises à jour avec succès"
            ]);

        }

        public function confirmersuppression(Request $request)
        {
            if (isset($request->id) && is_numeric($request->id) && !is_null($request->id)) {

                $verif = Client::existe($request->id);
                if ($verif) {
                    return response()->json([
                        'errors' => [
                            'produit' => ['Ce client a déjà commandé des produits, suppression impossible']
                        ]
                    ], 422);
                } else {
                    $dataClient = [
                        'supprimer' => 1,
                        'userDelete' => Auth::id(),
                        'deleted_at' => Carbon::now()
                    ];

                    Client::query()->where('id', '=', $request->id)->update($dataClient);

                    return response()->json(['success' => "la suppression a été effectuée avec succès"]);
                }

            } else {

                return response()->json(['error' => "impossible d'effectuer cette suppression"]);
            }

        }

        public function liste()
        {

            $liste = Client::clients();

            return response($liste);
        }
    }
