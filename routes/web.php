<?php

    use App\Http\Controllers\ApprovisionnementsController;
    use App\Http\Controllers\ClientsController;
    use App\Http\Controllers\CommandesController;
    use App\Http\Controllers\ConnexionController;
    use App\Http\Controllers\FournisseursController;
    use App\Http\Controllers\ProduitsController;
    use App\Http\Controllers\ProduitsprixachatsController;
    use App\Http\Controllers\ProduitsprixventesController;
    use App\Http\Controllers\TableaudebordController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return Auth::check()
            ? redirect()->route('tableaudebord.index')
            : redirect()->route('login.login');
    });

    Route::get('/', [ConnexionController::class, 'login'])->name('login.login');
    Route::post('/loguser', [ConnexionController::class, 'loguser'])->name('login.loguser');

    Route::middleware('auth')->group(function () {


        Route::match(['get', 'post'], '/tableau-de-bord/', [TableaudebordController::class, 'index'])->name('tableaudebord.index');

        //Route Produits
        Route::get('/produits', [ProduitsController::class, 'index'])->name('produits.index');
        Route::post('/produits/ajouter', [ProduitsController::class, 'ajouter'])->name('produits.ajouter');
        Route::PUT('/produits/modification/{id}', [ProduitsController::class, 'update'])->name('produits.modification');
        Route::post('/produits/confirmer-suppression', [ProduitsController::class, 'confirmersuppression'])->name('produits.confirmer-suppression');
        Route::post('/produits/rechercheCodeorqrcode', [ProduitsController::class, 'rechercheCodeorqrcode'])->name('produits.rechercheCodeorqrcode');
        Route::post('/produits/rechercheCodeorqrcodevente', [ProduitsController::class, 'rechercheCodeorqrcodevente'])->name('produits.rechercheCodeorqrcodevente');


        //Route Produits prix d'achat
        Route::get('/produitsprixachats', [ProduitsprixachatsController::class, 'index'])->name('produitsprixachats.index');
        Route::post('/produitsprixachats/ajouter', [ProduitsprixachatsController::class, 'ajouter'])->name('produitsprixachats.ajouter');

        //Route Produits prix d'achat
        Route::get('/produitsprixaventes', [ProduitsprixventesController::class, 'index'])->name('produitsprixaventes.index');
        Route::post('/produitsprixaventes/ajouter', [ProduitsprixventesController::class, 'ajouter'])->name('produitsprixaventes.ajouter');

        //Route Fournisseurs
        Route::get('/fournisseurs', [FournisseursController::class, 'index'])->name('fournisseurs.index');
        Route::post('/fournisseurs/ajouter', [FournisseursController::class, 'ajouter'])->name('fournisseurs.ajouter');
        Route::PUT('/fournisseurs/modification/{id}', [FournisseursController::class, 'update'])->name('fournisseurs.modification');
        Route::post('/fournisseurs/confirmer-suppression', [FournisseursController::class, 'confirmersuppression'])->name('fournisseurs.confirmer-suppression');
        Route::get('/fournisseurs/liste', [FournisseursController::class, 'liste'])->name('fournisseurs.liste');

        //Route Approvisonnements
        Route::get('/approvisionnements', [ApprovisionnementsController::class, 'index'])->name('approvisionnements.index');
        Route::post('/approvisionnements/ajouter', [ApprovisionnementsController::class, 'ajouter'])->name('approvisionnements.ajouter');
        Route::PUT('/approvisionnements/modification/{id}', [ApprovisionnementsController::class, 'update'])->name('approvisionnements.modification');
        Route::post('/approvisionnements/confirmer-suppression', [ApprovisionnementsController::class, 'confirmersuppression'])->name('approvisionnements.confirmer-suppression');

        //Route Commande
        Route::get('/commandes', [CommandesController::class, 'index'])->name('commandes.index');
        Route::post('/commandes/ajouter', [CommandesController::class, 'ajouter'])->name('commandes.ajouter');
        Route::PUT('/commandes/modification/{id}', [CommandesController::class, 'update'])->name('commandes.modification');
        Route::post('/commandes/confirmer-suppression', [CommandesController::class, 'confirmersuppression'])->name('commandes.confirmer-suppression');


        //Route Fournisseurs
        Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
        Route::post('/clients/ajouter', [ClientsController::class, 'ajouter'])->name('clients.ajouter');
        Route::PUT('/clients/modification/{id}', [ClientsController::class, 'update'])->name('clients.modification');
        Route::post('/clients/confirmer-suppression', [ClientsController::class, 'confirmersuppression'])->name('clients.confirmer-suppression');
        Route::get('/clients/liste', [ClientsController::class, 'liste'])->name('clients.liste');

        Route::get('se-déconnecter', [ConnexionController::class, 'logout'])->name('logout');
    });
