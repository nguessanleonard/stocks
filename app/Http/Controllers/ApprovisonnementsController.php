<?php

    namespace App\Http\Controllers;

    use App\Models\Approvisionnement;
    use App\Models\Produit;
    use Illuminate\Http\Request;

    class ApprovisonnementsController extends Controller
    {
        public function index()
        {
            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'approvisionnement',
                'title' => 'Gestion des approvisionnements',
                'approvisionnements' => Approvisionnement::approvisionnements(),
            ];

            return view('approvisionnements.index', $data);
        }
    }
