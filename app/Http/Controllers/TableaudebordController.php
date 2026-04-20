<?php

    namespace App\Http\Controllers;

    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    use Illuminate\Support\Facades\Session;

    use Illuminate\Support\Facades\Validator;

    class TableaudebordController extends Controller
    {

        public function index()
        {
            $data = [
                'name' => 'Gestion',
                'classe' => 'Connexion',
                'vue' => 'Login page',
                'title' => 'Gestion des Login',
            ];

            return view('tableaudebord.index', $data);

        }




    }
