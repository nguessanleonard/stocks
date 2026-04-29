<?php

    namespace App\Http\Controllers;

    use App\Models\Anneesmois;
    use App\Models\Commande;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    use Illuminate\Support\Facades\Session;

    use Illuminate\Support\Facades\Validator;

    class TableaudebordController extends Controller
    {

        public function index()
        {
            $m = $this->moisAnneeEnLettre();
            $resultat = explode(' ', $m);

            $mois = mb_strtoupper($resultat[0]);
            $annee = (int) $resultat[1];

            $anneemois = Anneesmois::getannesmois_id($mois, $annee);
            $anneemois_id = $anneemois->id ?? 0;

            if (auth()->user()->hasAnyRole(['admin', 'Super Admin'])) {
                $commandes = Commande::commandesanneemois($anneemois_id);

            } else {
                $commandes = Commande::commandesanneemoisgestionnaire($anneemois_id, Auth::id());
            }


            $moisMap = [
                'JANVIER'=>1,'FEVRIER'=>2,'MARS'=>3,'AVRIL'=>4,
                'MAI'=>5,'JUIN'=>6,'JUILLET'=>7,'AOUT'=>8,
                'SEPTEMBRE'=>9,'OCTOBRE'=>10,'NOVEMBRE'=>11,'DECEMBRE'=>12,
            ];

            $moisNum = $moisMap[$mois] ?? Carbon::now()->month;

            $joursDuMois = Carbon::create($annee, $moisNum, 1)->daysInMonth;


            $dataParJour = array_fill(1, $joursDuMois, 0);


            foreach ($commandes as $cmd) {

                if (!$cmd->jour) continue;

                $jour = Carbon::parse($cmd->jour)->day;

                if (isset($dataParJour[$jour])) {
                    $dataParJour[$jour] += (float) $cmd->total;
                }
            }

            $chartData = [];

            foreach ($dataParJour as $jour => $total) {
                $chartData[] = [$jour, $total];
            }

            return view('tableaudebord.index', compact('chartData'));
        }

        function moisAnneeEnLettre($date = null)
        {
            Carbon::setLocale('fr');

            $date = $date ? Carbon::parse($date) : Carbon::now();

            return $date->translatedFormat('F Y');
        }



    }
