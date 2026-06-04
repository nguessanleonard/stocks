<?php

    namespace App\Http\Controllers;

    use App\Models\Anneesmois;
    use App\Models\Approvisionnement;
    use App\Models\Commande;
    use App\Models\Mois;
    use App\Models\Produit;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    use Illuminate\Support\Facades\Session;

    use Illuminate\Support\Facades\Validator;

    class TableaudebordController extends Controller
    {

        public function index($anneesmois_id = 0)
        {

            if (!empty($anneesmois_id) && $anneesmois_id != 0) {

                $anneesmois = Anneesmois::moisannes($anneesmois_id);

                $anneemois_id = $anneesmois->id;

                $mois = $anneesmois->mois;
                $annee = (int)$anneesmois->annee;

            } else {

                $m = $this->moisAnneeEnLettre();
                $resultat = explode(' ', $m);

                $mois = mb_strtoupper($resultat[0]);
                $annee = (int)$resultat[1];

                $anneemois = Anneesmois::getannesmois_id($mois, $annee);

                $anneemois_id = $anneemois->id ?? 0;
            }

            // dd($anneemois_id,$mois,$annee);
            $isAdmin = auth()->user()->hasAnyRole(['admin', 'Super Admin']);

            if ($isAdmin) {

                $commandes = Commande::commandesanneemois($anneemois_id);

                $repartitionproduit = Commande::repartionproduit($anneemois_id);

            } else {
                $commandes = Commande::commandesanneemoisgestionnaire($anneemois_id, Auth::id());

                $repartitionproduit = Commande::repartionproduitgestionnaire($anneemois_id,Auth::id());
            }

            $venteBase = DB::table('commandes as c')
                ->join('commandesproduits as cp', 'cp.commandes_id', '=', 'c.id')
                ->join('produitsprixventes as ppv', 'cp.produitsprixventes_id', '=', 'ppv.id')
                ->join('prixventes as pv', 'ppv.prixventes_id', '=', 'pv.id')
                ->where('c.supprimer', 0)
                ->where('cp.supprimer', 0)
                ->when(!$isAdmin, function ($query) {
                    $query->where('c.userAdd', Auth::id());
                });

            $approBase = DB::table('approvisionnements as a')
                ->join('approvisionnementsproduits as ap', 'ap.approvisionnements_id', '=', 'a.id')
                ->join('produitsprixachats as ppa', 'ap.produitsprixachats_id', '=', 'ppa.id')
                ->join('prixachats as pa', 'ppa.prixachats_id', '=', 'pa.id')
                ->where('a.supprimer', 0)
                ->where('ap.supprimer', 0)
                ->when(!$isAdmin, function ($query) {
                    $query->where('a.userAdd', Auth::id());
                });

            $statistiques = [
                'totalProduits' => Produit::where('supprimer', 0)->count(),
                'stockDisponible' => (int) Produit::where('supprimer', 0)->sum('quantite'),
                'produitsAlerte' => Produit::where('supprimer', 0)->where('quantite', '<=', 5)->count(),
                'ventesJour' => (clone $venteBase)->whereDate('c.created_at', Carbon::today())->sum(DB::raw('cp.quantite * pv.montant')),
                'ventesSemaine' => (clone $venteBase)->whereBetween('c.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum(DB::raw('cp.quantite * pv.montant')),
                'ventesMois' => (clone $venteBase)->whereMonth('c.created_at', Carbon::now()->month)->whereYear('c.created_at', Carbon::now()->year)->sum(DB::raw('cp.quantite * pv.montant')),
                'ventesPeriode' => (clone $venteBase)->where('c.anneesmois_id', $anneemois_id)->sum(DB::raw('cp.quantite * pv.montant')),
                'approvisionnementsPeriode' => (clone $approBase)->where('a.anneesmois_id', $anneemois_id)->sum(DB::raw('ap.quantite * pa.montant')),
            ];

            $meilleursProduits = (clone $venteBase)
                ->join('produits as p', 'ppv.produits_id', '=', 'p.id')
                ->where('c.anneesmois_id', $anneemois_id)
                ->selectRaw('p.libelle as produit, SUM(cp.quantite) as quantite, SUM(cp.quantite * pv.montant) as montant')
                ->groupBy('p.id', 'p.libelle')
                ->orderByDesc('montant')
                ->limit(5)
                ->get();

            $dernieresCommandes = (clone $venteBase)
                ->join('clients as cl', 'c.clients_id', '=', 'cl.id')
                ->join('produits as p', 'ppv.produits_id', '=', 'p.id')
                ->selectRaw('c.libelle as reference, cl.noms as client, p.libelle as produit, cp.quantite, (cp.quantite * pv.montant) as montant, c.created_at')
                ->orderByDesc('c.created_at')
                ->limit(5)
                ->get();

            $derniersApprovisionnements = (clone $approBase)
                ->join('fournisseurs as f', 'a.fournisseurs_id', '=', 'f.id')
                ->join('produits as p', 'ppa.produits_id', '=', 'p.id')
                ->selectRaw('a.libelle as reference, f.libelle as fournisseur, p.libelle as produit, ap.quantite, (ap.quantite * pa.montant) as montant, a.created_at')
                ->orderByDesc('a.created_at')
                ->limit(5)
                ->get();

            $moisMap = Mois::getmois();

            $moisNum = $moisMap[$mois] ?? Carbon::now()->month;

            $joursDuMois = Carbon::create($annee, $moisNum, 1)->daysInMonth;


            $dataParJour = array_fill(1, $joursDuMois, 0);


            foreach ($commandes as $cmd) {

                if (!$cmd->jour) continue;

                $jour = Carbon::parse($cmd->jour)->day;

                if (isset($dataParJour[$jour])) {
                    $dataParJour[$jour] += (float)$cmd->total;
                }
            }

            $chartData = [];

            foreach ($dataParJour as $jour => $total) {
                $chartData[] = [$jour, $total];
            }
            $data = [
                'mois' => $mois,
                'annee' => $annee
            ];
            return view('tableaudebord.index', compact('chartData', 'data', 'repartitionproduit', 'statistiques', 'meilleursProduits', 'dernieresCommandes', 'derniersApprovisionnements'));
        }

        function moisAnneeEnLettre($date = null)
        {
            Carbon::setLocale('fr');

            $date = $date ? Carbon::parse($date) : Carbon::now();

            return $date->translatedFormat('F Y');
        }

        public function listeanneesmois()
        {

            $mois = Anneesmois::annesmois();

            return response()->json($mois);
        }


    }
