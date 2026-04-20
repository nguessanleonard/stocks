<?php

    use App\Http\Controllers\ApprovisonnementsController;
    use App\Http\Controllers\ConnexionController;
    use App\Http\Controllers\FournisseursController;
    use App\Http\Controllers\ProduitsController;
    use App\Http\Controllers\ProduitsprixachatsController;
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


        //Route Produits
        Route::get('/produitsprixachats', [ProduitsprixachatsController::class, 'index'])->name('produitsprixachats.index');
        Route::post('/produitsprixachats/ajouter', [ProduitsprixachatsController::class, 'ajouter'])->name('produitsprixachats.ajouter');

        //Route Fournisseurs
        Route::get('/fournisseurs', [FournisseursController::class, 'index'])->name('fournisseurs.index');
        Route::post('/fournisseurs/ajouter', [FournisseursController::class, 'ajouter'])->name('fournisseurs.ajouter');
        Route::PUT('/fournisseurs/modification/{id}', [FournisseursController::class, 'update'])->name('fournisseurs.modification');
        Route::post('/fournisseurs/confirmer-suppression', [FournisseursController::class, 'confirmersuppression'])->name('fournisseurs.confirmer-suppression');
        Route::get('/fournisseurs/liste', [FournisseursController::class, 'liste'])->name('fournisseurs.liste');

        //Route Approvisonnements
        Route::get('/approvisonnements', [ApprovisonnementsController::class, 'index'])->name('approvisonnements.index');
        Route::post('/approvisonnements/ajouter', [ProduitsController::class, 'ajouter'])->name('approvisonnements.ajouter');
        Route::PUT('/approvisonnements/modification/{id}', [ProduitsController::class, 'update'])->name('approvisonnements.modification');
        Route::post('/approvisonnements/confirmer-suppression', [ProduitsController::class, 'confirmersuppression'])->name('approvisonnements.confirmer-suppression');

        Route::get('se-déconnecter', [ConnexionController::class, 'logout'])->name('logout');
    });
