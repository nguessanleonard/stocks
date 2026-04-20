<?php

    namespace App\Http\Controllers;

    use App\Models\Fournisseur;
    use App\Models\Produit;
    use Carbon\Carbon;
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\Rule;

    class FournisseursController extends Controller
    {
        public function index()
        {
            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'Login page',
                'title' => 'Gestion des Produits',
                'fournisseurs' => Fournisseur::fournisseurs(),
            ];

            return view('fournisseurs.index', $data);
        }

        public function ajouter(Request $request)
        {
            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
                    'libelle' => 'required|string|unique:fournisseurs,libelle',

                ],
                [
                    'libelle.required' => 'Le champ libellé est obligatoire.',
                    'libelle.unique' => 'Ce nom existe déjà pour un autre fournisseur.',

                    'image.image' => 'Le fichier doit être une image.',
                    'image.mimes' => 'L’image doit être au format jpg, jpeg, png, gif ou webp.',
                    'image.max' => 'L’image ne doit pas dépasser 2 Mo.',
                ]
            );
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            $imageBase64 = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $mimeType = $image->getMimeType();
                $imageContent = file_get_contents($image->getRealPath());
                $imageBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($imageContent);
            }

            $dataFournisseur = [
                'libelle' => mb_strtoupper($data['libelle']),
                'logo' => $imageBase64,
                'userAdd' => Auth::id(),
            ];

            Fournisseur::query()->create($dataFournisseur);

            return response()->json([
                'success' => 'Le fournisseur a été ajouté avec succès.',
            ]);
        }

        public function update(Request $request, $id)
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',

                    'libelle' => [
                        'required',
                        'string',
                        Rule::unique('fournisseurs', 'libelle')->ignore($id),
                    ],

                ],
                [
                    'libelle.required' => 'Le champ libellé est obligatoire.',
                    'image.image' => 'Le fichier doit être une image.',
                    'image.mimes' => 'L’image doit être au format jpg, jpeg, png, gif ou webp.',
                    'image.max' => 'L’image ne doit pas dépasser 2 Mo.',
                ]
            );
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            $imageBase64 = null;


            $fournisseurs = Fournisseur::find($id);

            if (!$fournisseurs) {
                return response()->json([
                    'error' => 'Produit introuvable'
                ], 404);
            }

            $dataFournisseur = [
                'libelle' => mb_strtoupper($data['libelle']),
                'userUpdate' => Auth::id(),
                'updated_at' => Carbon::now(),
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $mimeType = $image->getMimeType();
                $imageContent = file_get_contents($image->getRealPath());

                $dataFournisseur['logo'] = 'data:' . $mimeType . ';base64,' . base64_encode($imageContent);

            }

            Fournisseur::where('id', $id)->update($dataFournisseur);

            return response()->json([
                'success' => "Les informations du fourniseur ont été mises à jour avec succès"
            ]);

        }

        public function confirmersuppression(Request $request)
        {
            if (isset($request->id) && is_numeric($request->id) && !is_null($request->id)) {

                $verif = Fournisseur::existe($request->id);
                if ($verif) {
                    return response()->json([
                        'errors' => [
                            'produit' => ['Ce fournisseur a déjà livré des produits, suppression impossible']
                        ]
                    ], 422);
                } else {
                    $dataFournisseur = [
                        'supprimer' => 1,
                        'userDelete' => Auth::id(),
                        'deleted_at' => Carbon::now()
                    ];

                    Fournisseur::query()->where('id', '=', $request->id)->update($dataFournisseur);

                    return response()->json(['success' => "la suppression a été effectuée avec succès"]);
                }

            } else {

                return response()->json(['error' => "impossible d'effectuer cette suppression"]);
            }

        }

        public function liste()
        {

            $liste = Fournisseur::fournisseurs();

            return response($liste);
        }
    }
