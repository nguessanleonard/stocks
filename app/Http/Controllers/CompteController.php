<?php

    namespace App\Http\Controllers;


    use Illuminate\Support\Facades\Hash;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;

    class CompteController extends Controller
    {
        public function index()
        {

            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'Login page',
                'title' => 'Gestion des comptes',

            ];
            return view('compte.index', $data);
        }



        public function update(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'oldpass' => 'required|string',
                'password' => 'required|string|min:6',
                'confirpass' => 'required|string|min:6',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            ], [
                'oldpass.required' => 'Le mot de passe actuel est obligatoire.',
                'password.required' => 'Le nouveau mot de passe est obligatoire.',
                'confirpass.required' => 'La confirmation est obligatoire.',
                'image.image' => 'Le fichier doit être une image.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();


            if (!Hash::check($data['oldpass'], Auth::user()->password)) {
                return response()->json([
                    'errors' => ['oldpass' => ['Mot de passe actuel incorrect']]
                ], 422);
            }

            if ($data['password'] !== $data['confirpass']) {
                return response()->json([
                    'errors' => ['confirpass' => ['Les mots de passe ne correspondent pas']]
                ], 422);
            }

            $user = Auth::user();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $mimeType = $image->getMimeType();
                $imageContent = file_get_contents($image->getRealPath());

                $user->photo = 'data:' . $mimeType . ';base64,' . base64_encode($imageContent);
            }


            $user->password = bcrypt($data['password']);

            $user->save();

            return response()->json([
                'success' => 'Compte mis à jour avec succès'
            ]);
        }
    }
