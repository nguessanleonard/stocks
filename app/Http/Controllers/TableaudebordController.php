<?php

    namespace App\Http\Controllers;

    use App\Models\Anneesmois;
    use App\Models\Commande;
    use App\Models\Mois;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

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
            if (auth()->user()->hasAnyRole(['admin', 'Super Admin'])) {

                $commandes = Commande::commandesanneemois($anneemois_id);

                $repartitionproduit = Commande::repartionproduit($anneemois_id);

            } else {
                $commandes = Commande::commandesanneemoisgestionnaire($anneemois_id, Auth::id());

                $repartitionproduit = Commande::repartionproduitgestionnaire($anneemois_id,Auth::id());
            }

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
            return view('tableaudebord.index', compact('chartData', 'data','repartitionproduit'));
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
