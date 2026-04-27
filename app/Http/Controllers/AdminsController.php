<?php

    namespace App\Http\Controllers;


    use App\Models\User;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Spatie\Permission\Models\Role;

    class AdminsController extends Controller
    {
        public function index()
        {
            $data = array(
                'name' => 'Admins',
                'classe' => 'Admins',
                'vue' => 'admin',
                'admins' => User::users(),
                'title' => 'Gestion Admins',
            );
            return view('admins.index', $data);

        }

        public function edit(string $id)
        {

            $admin = User::query()->findOrFail($id);

            $roles = Role::query()->get();

            $data = [
                "admin" => $admin,
                "roles" => $roles
            ];


            return view('admins.edit', $data);

        }

        public function attributionrole(Request $request, string $id)
        {
            $admin = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'role' => 'required|string|exists:roles,name',
            ], [
                'role.required' => "Veuillez sélectionner un rôle pour l'Admin.",
                'role.exists' => "Le rôle sélectionné n'existe pas.",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            // Attribution (remplace les anciens rôles)
            $admin->syncRoles([$request->role]);

            return response()->json([
                'success' => "Le rôle a été attribué avec succès"
            ]);
        }

        public function ajouter(Request $request)
        {
           // dd($request->input());
            $validator = Validator::make($request->all(), [

                'nom' => 'required|string|max:255',
                'prenoms' => 'required|string|max:255',
                'telephone' => 'nullable|string|max:20',
                'email' => 'required|email|max:255|unique:users,email',
            ], [
                'nom.required' => "Veuillez saisir le nom de l'utilisateur.",
                'prenoms.required' => "Veuillez saisir les prénoms de l'utilisateur.",
                'telephone.string' => "Veuillez saisir un numéro de téléphone valide.",
                'email.required' => "Veuillez saisir un email.",
                'email.email' => "Veuillez saisir un email valide.",
                'email.unique' => "Cet email est déjà utilisé par un autre utilisateur.",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                ], 422);
            }
            $data = $validator->validated();

            $dataadmin = [
                'nom' => mb_strtoupper($data['nom']),
                'prenoms' => mb_strtoupper($data['prenoms']),
                'telephone' => $data['telephone'],
                'email' => mb_strtolower($data['email']),
                'password' => bcrypt(mb_strtolower($data['email'])),
                'userAdd' => Auth::id(),
            ];

            User::query()->create($dataadmin);

            return response()->json([
                'success' => "L'utilisateur a été ajouté avec succès.",
            ]);
        }

        public function modificationsinfospersonne(Request $request,$id)
        {

            $validator = Validator::make($request->all(), [
                'admins_id' => 'required|exists:users,id',
                'nom' => 'required|string|max:255',
                'prenoms' => 'required|string|max:255',
                'telephone' => 'nullable|string|max:20',
                'email' => 'required|email|max:255|unique:users,email,' . $request->admins_id,
            ], [
                'admins_id.exists' => "L'utilisateur n'existe pas.",
                'nom.required' => "Veuillez saisir le nom de l'utilisateur.",
                'prenoms.required' => "Veuillez saisir les prénoms de l'utilisateur.",
                'telephone.string' => "Veuillez saisir un numéro de téléphone valide.",
                'email.required' => "Veuillez saisir un email.",
                'email.email' => "Veuillez saisir un email valide.",
                'email.unique' => "Cet email est déjà utilisé par un autre utilisateur.",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                ], 422);
            }
            $data = $validator->validated();

            $dataadmin = [
                'nom' => mb_strtoupper($data['nom']),
                'prenoms' => mb_strtoupper($data['prenoms']),
                'telephone' => $data['telephone'],
                'email' => mb_strtolower($data['email']),
                'updated_at' => Carbon::now(),
                'userUpdate' => Auth::id(),
            ];

            User::query()->where('id', $data['admins_id'])->update($dataadmin);

            return response()->json([
                'success' => "Les informations ont été mises à jour avec succès.",
            ]);
        }

        public function passwordreset(Request $request)
        {

            if (isset($request->id) && is_numeric($request->id)) {

                $admin = User::query()->where('id', $request->id)->first();

                if (!is_null($admin)) {

                    $dataadmin = [
                        'userUpdate' => Auth::id(),
                        'password' => bcrypt(mb_strtolower($admin->email)),
                    ];

                    User::where('id', $request->id)->update($dataadmin);

                    return response()->json([
                        'success' => "Le compte de l'utilisateur".$admin->nom.' '.$admin->prenoms." "
                    ]);


                } else {
                    return response()->json([
                        'error' => "Impossible d'effectuer cette suppression "
                    ], 400);

                }


            } else {
                return response()->json([
                    'error' => "Impossible d'effectuer cette suppression"
                ], 400);
            }
        }

        public function confirmersuppression(Request $request)
        {

            if (isset($request->id) && is_numeric($request->id)) {

                $verifadminrole = User::getinfosadminrole($request->id);

                // 👉 S'il a déjà un rôle
                if (!is_null($verifadminrole)) {

                    return response()->json([
                        'error' => "Impossible d'effectuer cette suppression : cet utilisateur a déjà un rôle."
                    ], 400);

                } else {

                    $dataadmin = [
                        'supprimer' => 1,
                        'userDelete' => Auth::id(),
                        'deleted_at' => Carbon::now(),
                    ];

                    User::where('id', $request->id)->update($dataadmin);

                    return response()->json([
                        'success' => "La suppression a été effectuée avec succès."
                    ]);
                }

            } else {

                return response()->json([
                    'error' => "Impossible d'effectuer cette suppression."
                ], 400);
            }

        }
    }
