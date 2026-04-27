<?php

    namespace App\Http\Controllers;

    use App\Models\Admin;
    use Carbon\Carbon;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Validator;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class RolesController extends Controller
    {
        public function index()
        {

            $data = array(
                'name' => 'Stock',
                'classe' => 'Roles',
                'vue' => 'Roles',
                'title' => 'Roles',
                'permissions' => Permission::query()->where('supprimer', 0)->get(),
                'roles' => Role::query()->where('supprimer', 0)->get(),
            );
            return view('roles.index',$data);
        }


        public function ajouter(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'libelle' => 'required|string|max:255|unique:roles,name',
            ], [
                'libelle.required' => 'Le champ libellé est obligatoire.',
                'libelle.unique' => 'Le champ libellé doit être unique. La valeur que vous avez saisie existe déjà.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            $data = $validator->validated();

            Role::create([
                'name' => $data['libelle']
            ]);

            return response()->json([
                'success' => 'Le rôle "' . $data['libelle'] . '" a été ajouté avec succès',
            ], 200);
        }

        public function edit($id)
        {

            $permissions = Permission::query()->where('supprimer',0)->get();

            $role = Role::query()->findOrFail($id);

            $rolePermissions = $role->permissions->pluck('id')->toArray();

            $data = array(
                'name' => 'Stocks',
                'classe' => 'Roles',
                'vue' => 'editRole',
                'title' => 'Editer ajouter des permission au role',
                "permissions" => $permissions,
                "role" => $role,
                "rolePermissions" => $rolePermissions
            );
            return view('roles.edit',$data);


        }

        public function update(Request $request, $id)
        {
            $validator = Validator::make($request->all(), [
                'libelle' => 'required|string|max:255|unique:roles,name,' . $id,
                'permissions' => 'array'
            ], [
                'libelle.required' => 'Le nom du rôle est obligatoire.',
                'libelle.unique' => 'Ce rôle existe déjà.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            $role = Role::findOrFail($id);


            $role->update([
                'name' => $request->libelle,
                'userUpdate' => Auth::id(),
            ]);


            $role->syncPermissions($request->permissions ?? []);

            return response()->json([
                'success' => 'Rôle modifié avec succès'
            ]);
        }

        public function confirmersuppression(Request $request)
        {
            if (!isset($request->id) || !is_numeric($request->id)) {
                return response()->json([
                    'error' => "Impossible d'effectuer cette opération."
                ], 400);
            }

            // Vérifier si le rôle est déjà utilisé
            $roleUtilise = DB::table('model_has_roles')
                ->where('role_id', $request->id)
                ->exists();

            if ($roleUtilise) {
                return response()->json([
                    'error' => "Impossible d'effectuer cette suppression : ce rôle est déjà attribué à un utilisateur."
                ], 400);
            }

            Role::where('id', $request->id)->update([
                'supprimer'   => 1,
                'userDelete'  => Auth::id(),
                'deleted_at'  => Carbon::now(),
            ]);

            return response()->json([
                'success' => "L'opération a été effectuée avec succès."
            ]);
        }


    }
