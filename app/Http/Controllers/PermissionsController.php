<?php

    namespace App\Http\Controllers;

    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    class PermissionsController extends Controller
    {
        public function index()
        {
            $data = array(
                'name' => 'ESSY-LAND',
                'classe' => 'Permissions',
                'vue' => 'Permissions',
                'title' => 'Permissions',
                'permissions' => Permission::where('supprimer', 0)->get(),
            );
            return view('permissions.index', $data);
        }

        public function ajouter(Request $request)
        {
            $request->validate([
                'titre' => 'required|string|max:255',
            ], [
                'titre.required' => 'Veiller saisir le titre de la permission'
            ]);

            Permission::create(['name' => $request->titre]);

            return response()->json([
                'success' => 'Permission ajoutée avec succès',
            ]);

        }


        public function update(Request $request, $id)
        {

            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'unique:permissions,name,' . $id],

            ], [
                'name.required' => 'Le champ nom de la permission est obligatoire.',
                'name.unique' => 'Le champ nom de la permission doit être unique. La valeur que vous avez saisie existe déjà.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'error',
                    'content' => $validator->errors()->all(),
                ], 400);
            }
            $data = $validator->validate();

            $datapermission = [
                'name' => $data['name'],
                'userUpdate' => Auth::id(),
                'updated_at' => Carbon::now()
            ];
            Permission::query()->where('id', '=', $id)->update($datapermission);

            return response()->json(['success' => "Permission mise à jour avec succès"]);

        }



    }
