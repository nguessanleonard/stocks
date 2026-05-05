<?php

    namespace App\Http\Controllers;

    use App\Models\Produit;
    use Carbon\Carbon;
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\Rule;


    class ProduitsController extends Controller
    {
        public function index()
        {
            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'Login page',
                'title' => 'Gestion des Produits',
                'produits' => Produit::produits(),
            ];

            return view('produits.index', $data);
        }

        public function ajouter(Request $request)
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:9048',
                    'description' => 'nullable|string',
                    'libelle' => 'required|string',
                    'code' => 'required|string|unique:produits,code',
                    'codebarre' => 'nullable|string|unique:produits,codebarre',
                ],
                [
                    'libelle.required' => 'Le champ libellé est obligatoire.',
                    'code.required' => 'Le champ code est obligatoire.',
                    'code.unique' => 'Ce code existe déjà pour un autre produit.',
                    'codebarre.unique' => 'Ce code barre existe déjà.',
                    'image.required' => 'L’image est obligatoire.',
                    'image.image' => 'Le fichier doit être une image.',
                    'image.mimes' => 'L’image doit être au format jpg, jpeg, png, gif ou webp.',
                    'image.max' => 'L’image ne doit pas dépasser 9 Mo.',
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

            $codeBarre = !empty($data['codebarre'])
                ? mb_strtoupper($data['codebarre'])
                : null;

            $qrCode = new QrCode(mb_strtoupper($data['code']));
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            $qr = base64_encode($result->getString());

            $dataProduit = [
                'libelle' => mb_strtoupper($data['libelle']),
                'code' => mb_strtoupper($data['code']),
                'description' => ucfirst($data['description']) ?? null,
                'codebarre' => $codeBarre,
                'qrcode' => $qr,
                'photo' => $imageBase64,
                'userAdd' => Auth::id(),
            ];

            Produit::query()->create($dataProduit);

            return response()->json([
                'success' => 'Le produit a été ajouté avec succès.',
            ]);
        }

        public function update(Request $request, $id)
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:9048',
                    'description' => 'nullable|string',
                    'libelle' => 'required|string',
                    'code' => [
                        'required',
                        'string',
                        Rule::unique('produits', 'code')->ignore($id),
                    ],
                ],
                [
                    'libelle.required' => 'Le champ libellé est obligatoire.',
                    'code.required' => 'Le champ code est obligatoire.',
                    'image.image' => 'Le fichier doit être une image.',
                    'image.mimes' => 'L’image doit être au format jpg, jpeg, png, gif ou webp.',
                    'image.max' => 'L’image ne doit pas dépasser 9 Mo.',
                ]
            );
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            $imageBase64 = null;

            $qrCode = new QrCode(mb_strtoupper($data['code']));
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            $qr = base64_encode($result->getString());

            $produit = Produit::find($id);

            if (!$produit) {
                return response()->json([
                    'error' => 'Produit introuvable'
                ], 404);
            }

            $dataProduit = [
                'libelle' => mb_strtoupper($data['libelle']),
                'code' => mb_strtoupper($data['code']),
                'description' => !empty($data['description']) ? ucfirst($data['description']) : null,
                'qrcode' => $qr,
                'userUpdate' => Auth::id(),
                'updated_at' => Carbon::now(),
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $mimeType = $image->getMimeType();
                $imageContent = file_get_contents($image->getRealPath());

                $dataProduit['photo'] = 'data:' . $mimeType . ';base64,' . base64_encode($imageContent);

            }

            Produit::where('id', $id)->update($dataProduit);

            return response()->json([
                'success' => "Le produit a été mis à jour avec succès"
            ]);

        }

        public function confirmersuppression(Request $request)
        {
            if (isset($request->id) && is_numeric($request->id) && !is_null($request->id)) {

                $verif = Produit::existe($request->id);
                if ($verif) {
                    return response()->json([
                        'errors' => [
                            'produit' => ['Ce produit est déjà utilisé, suppression impossible']
                        ]
                    ], 422);
                } else {
                    $dataProduit = [
                        'supprimer' => 1,
                        'userDelete' => Auth::id(),
                        'deleted_at' => Carbon::now()
                    ];

                    Produit::query()->where('id', '=', $request->id)->update($dataProduit);

                    return response()->json(['success' => "la suppression a été effectuée avec succès"]);
                }

            } else {

                return response()->json(['error' => "impossible d'effectuer cette suppression"]);
            }

        }

        public function rechercheCodeorqrcode(Request $request)
        {
            //  dd($request->input());
            $infosproduit = null;


            if ($request->code) {

                $infosproduit = Produit::infosproduit($request->code);


            } else {

                $infosproduit = null;
            }
       // dd($infosproduit);
            if ($infosproduit) {
                return response()->json([
                    'success' => true,
                    'produit_id' => $infosproduit->produit_id,
                    'produitsprixachats_id' => $infosproduit->produitsprixachats_id,
                    'libelle' => $infosproduit->libelle,
                    'code' => $infosproduit->code,
                    'prix' => $infosproduit->montant,
                    'photo' => $infosproduit->photo,
                ]);
            }

            return response()->json([
                'success' => false
            ]);
        }

        public function rechercheCodeorqrcodevente(Request $request)
        {
            $infosproduit = null;

            if ($request->code) {

                $infosproduit = Produit::infosproduitvente($request->code);

            } else {

                $infosproduit = null;
            }

            if ($infosproduit) {

                return response()->json([
                    'success' => true,
                    'produit_id' => $infosproduit->produit_id,
                    'libelle' => $infosproduit->libelle,
                    'code' => $infosproduit->code,
                    'prix' => $infosproduit->montant,
                    'stock' => $infosproduit->stock,
                    'prixventes_id' => $infosproduit->prixventes_id,
                    'produitsprixventes_id' => $infosproduit->produitsprixventes_id,
                    'photo' => $infosproduit->photo,
                ]);
            }
            return response()->json([
                'success' => false
            ]);
        }
    }
