<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<head>
    <meta charset="utf-8">
    <title>Commandes</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.headermeta')
    <!-- base css -->
    @include('layouts.css')


</head>
<body class="mod-bg-1 ">
<!-- DOC: script to save and load page settings -->
@include('layouts.jsparametres')
<!-- BEGIN Page Wrapper -->
<div class="page-wrapper">
    <div class="page-inner">
        <!-- BEGIN Left Aside -->
        @include('layouts.menu')
        <!-- END Left Aside -->
        <div class="page-content-wrapper">
            <!-- BEGIN Page Header -->
            @include('layouts.header')
            <!-- END Page Header -->
            <!-- BEGIN Page Content -->
            <!-- the #js-page-content id is needed for some plugins to initialize -->
            <main id="js-page-content" role="main" class="page-content">
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Commandes</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Commandes

                    </h1>
                </div>

                <div class="row">

                    <div class="col-xl-12">

                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Commandes <span class="fw-300"><i>Ajout</i></span>
                                </h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                            data-offset="0,10" data-original-title="Collapse">

                                    </button>

                                </div>
                            </div>
                            @can('Ajouter une commande')
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form class="needs-validation" id="formAjoutClient">
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-12 mb-2">
                                                        <label class="form-label" for="validationTooltip01">Le nom du
                                                            Client <span
                                                                class="text-danger"></span> </label>
                                                        <select id="clients_id" name="clients_id"
                                                                class="form-control select2-4">

                                                        </select>

                                                    </div>

                                                </div>

                                                <div class="col-12 mt-3 text-center">
                                                    <button type="button" id="btnScanQR" class="btn btn-primary">Scannez
                                                        le
                                                        code produit
                                                    </button>
                                                </div>

                                                <!-- Bouton pour afficher le champ matricule -->
                                                <div class="col-12 mt-3 text-center">
                                                    <button type="button" id="toggleCode"
                                                            class="btn btn-outline-primary">
                                                        Saisir
                                                        le code produit
                                                    </button>
                                                </div>
                                                <div id="produit" style="display:none;" class="mt-3">

                                                    <div class="form-group">
                                                        <label>Code produit</label>
                                                        <input type="text" id="inputCode" class="form-control"
                                                               placeholder="Entrez le code">
                                                    </div>

                                                    <div class="text-center mt-2">
                                                        <button type="button" id="btnRechercherCode"
                                                                class="btn btn-success">
                                                            Rechercher
                                                        </button>
                                                    </div>

                                                </div>
                                                <div id="infosproduit" class="mt-3"></div>

                                            </div>

                                            <div class="col-12 mt-4 mb-2 text-center">
                                                <button type="button" id="btnValider" class="btn btn-success">
                                                    Valider la commande
                                                </button>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            @endcan
                            @can('Liste des commandes')
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div id="panel-1" class="panel">
                                            <div class="panel-hdr">
                                                <h2>
                                                    Liste <span class="fw-300"><i>des Clients</i></span>
                                                </h2>
                                                <form method="POST" action="{{ route('commandes.filtrer') }}">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Date début</label>
                                                            <input type="date" name="date_debut" id="date_debut"
                                                                   value="{{ $date_debut ?? '' }}" class="form-control"
                                                                   required>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Date fin</label>
                                                            <input type="date" name="date_fin" id="date_fin"
                                                                   value="{{ $date_fin ?? '' }}" class="form-control"
                                                                   required>
                                                        </div>

                                                        <div class="col-md-4 d-flex align-items-end">
                                                            <button type="submit" class="btn btn-primary">
                                                                Rechercher
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                                                <div class="panel-toolbar">

                                                    <button class="btn btn-panel" data-action="panel-close"
                                                            data-toggle="tooltip" data-offset="0,10"
                                                            data-original-title="Close"></button>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content table-responsive">
                                                    <!-- datatable start -->
                                                    <table id="dt-basic-example"
                                                           class="table table-bordered  table-hover table-striped w-100">
                                                        <thead class="bg-primary-600">
                                                        <tr>
                                                            <th class="d-none d-sm-table-cell">N°</th>
                                                            <th class="d-none d-sm-table-cell">Produit</th>
                                                            <th>code</th>
                                                            <th class="d-none d-sm-table-cell">photo</th>
                                                            <th>Prix</th>
                                                            <th>quantité</th>
                                                            <th class="d-none d-sm-table-cell">Montant</th>
                                                            <th class="d-none d-sm-table-cell">Client</th>
                                                            <th class="d-none d-sm-table-cell">mois|année</th>
                                                            @canany(['Modification de la commande','Suppression de la commande'])
                                                                <th>Actions</th>
                                                            @endcanany
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @php
                                                            $i = 1;
                                                            $montanttatal = 0;
                                                            $nbreproduit = 0;
                                                        @endphp

                                                        @foreach($commandes as $key)

                                                            @php
                                                                $montantLigne = $key->quantiteproduitcommande * $key->montant;
                                                                $montanttatal += $montantLigne;
                                                                $nbreproduit += $key->quantiteproduitcommande;
                                                            @endphp

                                                            <tr class="gradeA" style="font-size: 10px;">

                                                                <td class="d-none d-sm-table-cell">{{ $i++ }}</td>

                                                                <td class="d-none d-sm-table-cell">{{ $key->produit }}</td>
                                                                <td>{{ $key->code }}</td>

                                                                <td class="text-center d-none d-sm-table-cell">
                                                                    <img src="{{ $key->photo }}"
                                                                         class="img-fluid img-thumbnail zoom-click"
                                                                         style="max-width:35px; max-height:35px; cursor: zoom-in;">
                                                                </td>

                                                                <td>{{ $key->montant }}</td>
                                                                <td>{{ $key->quantiteproduitcommande }}</td>

                                                                <td class="d-none d-sm-table-cell">{{ $key->quantiteproduitcommande*$key->montant }}</td>

                                                                <td class="d-none d-sm-table-cell">{{ $key->client }}</td>
                                                                <td class="d-none d-sm-table-cell">{{ $key->mois.'|'.$key->annee }}</td>

                                                                @canany(['Modification de la commande','Suppression de la commande'])
                                                                    <td class="text-center">
                                                                        @can('Modification de la commande')
                                                                            <a href="#"
                                                                               class="btnModifierCommandesproduit"
                                                                               data-id="{{ $key->commandesproduits_id }}">
                                                                                <div class="badge badge-default">
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </div>
                                                                            </a>
                                                                        @endcan

                                                                        @can('Suppression de la commande')
                                                                            <a href="#"
                                                                               data-id="{{ $key->commandesproduits_id }}"
                                                                               class="SuppressionCommandesproduits">
                                                                                <div class="badge badge-default">
                                                                                    <i class="fas fa-trash-alt"
                                                                                       style="color: crimson"></i>
                                                                                </div>
                                                                            </a>
                                                                        @endcan
                                                                    </td>
                                                                @endcanany

                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th class="d-none d-sm-table-cell" colspan="5">Total</th>
                                                            <th>{{ $nbreproduit }}</th>
                                                            <th>{{ $montanttatal }}</th>
                                                            <th  class="d-none d-sm-table-cell" colspan="3"></th>
                                                        </tr>
                                                        </tfoot>

                                                    </table>
                                                    <!-- datatable end -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>

                    </div>
                </div>
            </main>
            <!-- END Page Content -->
            <!-- this overlay is activated only when mobile menu is triggered -->
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
            <!-- BEGIN Page Footer -->
            @include('layouts.footer')
            <!-- END Page Footer -->
            <!-- BEGIN Shortcuts -->
            <!-- modal shortcut -->
            @include('layouts.opacite')
            <!-- END Shortcuts -->
        </div>
    </div>
</div>
<div class="modal fade" id="modalScan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">

            <h5 class="text-center mb-3">Scanner le code</h5>

            <!-- 🔥 ZONE CAMÉRA -->
            <div id="reader" style="width:100%"></div>

        </div>
    </div>
</div>
<div class="modal fade" id="modalModifierCommandesproduit" tabindex="-1" role="dialog"
     aria-labelledby="modalModifierCommandesproduitLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formModifierCommandesproduit" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="commandesproduit_id" id="commandesproduit_id">
                <input type="hidden" name="produits_id" id="produits_id">
                <input type="hidden" name="quantiteold" id="quantiteold">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModifierCommandesproduitLabel">Modifier le Produit de
                        l'approvisionnement</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Client</label>
                        <input type="text" id="client" name="client" disabled class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Produit</label>
                        <input type="text" id="libelle_modif" name="libelle" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Quantité</label>
                        <input type="text" id="quantite_modif" name="quantite" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- END Page Wrapper -->
<!-- BEGIN Quick Menu -->
<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
@include('layouts.menuimpression')
<!-- END Quick Menu -->
<!-- BEGIN Messenger -->
@include('layouts.messages')
<!-- END Messenger -->
<!-- BEGIN Page Settings -->
@include('layouts.parametres')
<!-- END Page Settings -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143247136-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-143247136-2');


</script>
<script src="https://unpkg.com/html5-qrcode"></script>

@include('layouts.js')
@include('layouts.calendar')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    $('#placeholderText').hide();
    $(document).ready(function () {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


// VARIABLE GLOBALE
// ===============================
        let html5QrCode = null;

// ===============================
// TOGGLE SAISIE MANUELLE
// ===============================
        $('#toggleCode').on('click', function () {
            $('#produit').toggle();
            $('#inputCode').focus();
        });


// ===============================
// RECHERCHE MANUELLE
// ===============================
        $('#btnRechercherCode').on('click', function () {

            let code = $('#inputCode').val().trim();

            if (code === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Veuillez saisir un code'
                });
                return;
            }

            // ✅ CORRECTION
            rechercherProduit({code: code});
        });


// ===============================
// SCAN QR + CODE BARRE
// ===============================
        $('#btnScanQR').on('click', function () {

            $('#modalScan').modal('show');

            // 🔥 attendre que le modal soit visible
            $('#modalScan').off('shown.bs.modal').on('shown.bs.modal', function () {

                html5QrCode = new Html5Qrcode("reader");

                html5QrCode.start(
                    {facingMode: "environment"},
                    {
                        fps: 100,
                        qrbox: 250
                    },

                    // ✅ SUCCÈS SCAN
                    (decodedText) => {

                        html5QrCode.stop().then(() => {
                            $('#modalScan').modal('hide');

                            // 🔥 UNIFIÉ (QR + BARCODE)
                            rechercherProduit({code: decodedText});

                        }).catch(err => console.error(err));
                    },

                    // ignore erreurs scan
                    (errorMessage) => {
                    }
                ).catch(err => {

                    console.error(err);

                    Swal.fire({
                        icon: 'error',
                        title: 'Caméra inaccessible',
                        text: 'Vérifiez les permissions ou utilisez HTTPS'
                    });
                });

            });

        });


// ===============================
// STOP CAMÉRA SI MODAL FERMÉ
// ===============================
        $('#modalScan').on('hidden.bs.modal', function () {

            if (html5QrCode) {
                html5QrCode.stop().catch(() => {
                });
                html5QrCode.clear();
                html5QrCode = null;
            }

        });


// ===============================
// FONCTION RECHERCHE PRODUIT
// ===============================
        function rechercherProduit(data) {

            $.post("{{ route('produits.rechercheCodeorqrcodevente') }}", data)

                .done(function (response) {

                    if (response.success) {

                        // créer tableau si inexistant
                        if ($('#produitTable').length === 0) {

                            const html = `
                        <table class="table table-bordered text-center">
                           <thead>
                                <tr>
                                    <th class="d-none d-md-table-cell">Image</th>
                                    <th>Code</th>
                                    <th class="d-none d-md-table-cell">Libellé</th>
                                    <th class="d-none d-md-table-cell">Prix</th>
                                    <th>Quantité</th>
                                    <th class="d-none d-md-table-cell">Montant</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="produitTable"></tbody>
                        </table>
                    `;

                            $('#infosproduit').html(html);
                        }

                        let produitExiste = false;

                        // 🔥 COMPARER PAR ID (important)
                        $('#produitTable tr').each(function () {

                            let id = $(this).data('id');

                            if (id == response.produit_id) {

                                produitExiste = true;

                                let inputQte = $(this).find('.quantite');
                                let prix = parseFloat($(this).find('.prix').text());

                                let nouvelleQte = parseInt(inputQte.val()) + 1;

                                inputQte.val(nouvelleQte);

                                $(this).find('.montant').text((prix * nouvelleQte).toFixed(2));
                            }
                        });

                        // nouveau produit
                        if (!produitExiste) {
                            const newRow = `
                            <tr data-id="${response.produit_id}" data-code="${response.code}" data-stock="${response.stock}">
                                    <td class="d-none d-md-table-cell">
                                        <img src="${response.photo}" style="max-height:80px;">
                                    </td>

                                    <td>
                                        ${response.code}
                                        <input type="hidden" name="produitsprixventes_id[]" value="${response.produitsprixventes_id}">
                                        <input type="hidden" name="code[]" value="${response.code}">
                                        <input type="hidden" name="produits_id[]" value="${response.produit_id}">
                                    </td>

                                    <td class="d-none d-md-table-cell">
                                        ${response.libelle}
                                    </td>

                                    <td class="d-none d-md-table-cell prix">
                                        ${response.prix}
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-sm btn-danger btn-moins">-</button>

                                            <input type="text" name="quantite[]" value="1"
                                                   class="form-control mx-2 text-center quantite"
                                                   style="width:60px;" readonly>

                                            <button type="button" class="btn btn-sm btn-success btn-plus">+</button>
                                        </div>
                                    </td>

                                    <td class="d-none d-md-table-cell montant">
                                        ${parseFloat(response.prix).toFixed(2)}
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger btn-supprimer">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                `;

                            $('#produitTable').append(newRow);
                        }

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Aucun résultat trouvé'
                        });
                    }
                })

                .fail(function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur serveur'
                    });
                });
        }

        $(document).off('click', '.btn-plus').on('click', '.btn-plus', function () {

            let row = $(this).closest('tr');
            let input = row.find('.quantite');
            let prix = parseFloat(row.find('.prix').text().replace(/\s/g, ''));

            let qte = parseInt(input.val() || 0) + 1;

            input.val(qte);
            row.find('.montant').text((prix * qte).toFixed(2));
        });

        $(document).off('click', '.btn-moins').on('click', '.btn-moins', function () {

            let row = $(this).closest('tr');
            let input = row.find('.quantite');
            let prix = parseFloat(row.find('.prix').text().replace(/\s/g, ''));

            let qte = parseInt(input.val() || 0);

            if (qte > 1) {
                qte--;
                input.val(qte);
                row.find('.montant').text((prix * qte).toFixed(2));
            }
        });
        $(document).on('click', '.btn-supprimer', function () {

            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Supprimer ce produit ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    row.remove();
                }
            });

        });


        $('#btnValider').on('click', function () {

            let fournisseur = $('#fournisseurs_id').val();

            if (!fournisseur) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Veuillez sélectionner un fournisseur'
                });
                return;
            }

            let produits = [];

            $('#produitTable tr').each(function () {

                let id = $(this).find('input[name="produitsprixachats_id[]"]').val();
                let code = $(this).find('input[name="code[]"]').val();
                let produits_id = $(this).find('input[name="produits_id[]"]').val();
                let quantite = $(this).find('.quantite').val();
                let prix = $(this).find('.prix').text();

                produits.push({
                    produitsprixachats_id: id,
                    code: code,
                    quantite: quantite,
                    produits_id: produits_id,
                    prix: prix
                });
            });

            if (produits.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aucun produit ajouté'
                });
                return;
            }

            // Envoi AJAX
            $.ajax({
                url: "{{ route('approvisionnements.ajouter') }}", // à adapter
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    fournisseurs_id: fournisseur,
                    produits: produits
                },
                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Enregistré avec succès'
                    }).then(() => {

                        // Reset
                        $('#produitTable').html('');
                        $('#infosproduit').html('');
                        $('#fournisseurs_id').val(null).trigger('change');

                        location.reload();
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur lors de l\'enregistrement'
                    });
                }
            });

        });


        $(document).on('click', '.btn-plus', function (e) {

            e.preventDefault();
            e.stopPropagation();

            let row = $(this).closest('tr');

            let input = row.find('.quantite');
            let prix = parseFloat(row.find('.prix').text());
            let stock = parseInt(row.data('stock'));

            let value = parseInt(input.val());
            let nouvelleQte = value + 1;
            if (value >= stock) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stock insuffisant',
                    text: 'Le stock actuel est ' + stock
                });

                input.val(value - 1);

                return;
            }


            input.val(nouvelleQte);
            row.find('.montant').text((prix * nouvelleQte).toFixed(2));
        });


        $(document).on('click', '.btn-supprimer', function () {

            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Supprimer ce produit ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    row.remove();
                }
            });

        });
        $(document).off('click', '.btn-plus');
        $(document).on('click', '.btn-plus', function () {

            let row = $(this).closest('tr');
            let input = row.find('.quantite');
            let prix = parseFloat(row.find('.prix').text());

            let qte = parseInt(input.val()) + 1;
            input.val(qte);

            row.find('.montant').text((prix * qte).toFixed(2));
        });

        $(document).off('click', '.btn-moins');
        $(document).on('click', '.btn-moins', function () {

            let row = $(this).closest('tr');
            let input = row.find('.quantite');
            let prix = parseFloat(row.find('.prix').text());

            let qte = parseInt(input.val());

            if (qte > 1) {
                qte--;
                input.val(qte);
                row.find('.montant').text((prix * qte).toFixed(2));
            }
        });

        $('#btnValider').on('click', function () {

            let Client = $('#clients_id').val();

            if (!Client) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Veuillez sélectionner un Client'
                });
                return;
            }

            let produits = [];

            $('#produitTable tr').each(function () {

                let id = $(this).find('input[name="produitsprixventes_id[]"]').val();
                let code = $(this).find('input[name="code[]"]').val();
                let produits_id = $(this).find('input[name="produits_id[]"]').val();
                let quantite = $(this).find('.quantite').val();
                let prix = $(this).find('.prix').text();

                produits.push({
                    produitsprixventes_id: id,
                    code: code,
                    quantite: quantite,
                    produits_id: produits_id,
                    prix: prix
                });
            });

            if (produits.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aucun produit ajouté'
                });
                return;
            }

            // Envoi AJAX
            $.ajax({
                url: "{{ route('commandes.ajouter') }}", // à adapter
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    Clients_id: Client,
                    produits: produits
                },
                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Enregistré avec succès'
                    }).then(() => {

                        // Reset
                        $('#produitTable').html('');
                        $('#infosproduit').html('');
                        $('#clients_id').val(null).trigger('change');

                        location.reload();
                    });

                },
                error: function (xhr) {

                    let message = "Une erreur est survenue";

                    if (xhr.status === 422) {

                        let errors = xhr.responseJSON.errors;

                        if (typeof errors === 'object') {

                            message = Object.values(errors)
                                .map(err => Array.isArray(err) ? err.join('<br>') : err)
                                .join('<br><br>');

                        } else {
                            message = errors;
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        html: message
                    });
                }
            });

        });

        $.ajax({
            url: "{{ route('clients.liste') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let selectAjout = $('#clients_id');

                selectAjout.empty().append('<option value="">Sélectionnez le Client</option>');

                $.each(data, function (key, value) {
                    selectAjout.append('<option value="' + value.id + '">' + value.noms + '</option>');

                });
            },
            error: function () {
                console.error("Erreur lors du chargement des Clients.");
            }
        });

        $(document).on('click', '.btnModifierCommandesproduit', function (e) {
            e.preventDefault();


            let commandesproduit_id = $(this).data('id');

            let produits_id = $(this).data('idproduits');
            let libelle = $(this).data('libelle');
            let quantiteold = $(this).data('quantite');
            let quantite_modif = $(this).data('quantite');
            let client = $(this).data('client');
            let commande = $(this).data('commande');

            $('#commandesproduit_id').val(commandesproduit_id);
            $('#produits_id').val(produits_id);
            $('#libelle_modif').val(libelle);
            $('#quantiteold').val(quantiteold);
            $('#quantite_modif').val(quantite_modif);

            $('#client').val(`${client} (${commande})`);


            $('#modalModifierCommandesproduit').modal('show');
        });
        $('#formModifierCommandesproduit').on('submit', function (e) {
            e.preventDefault();

            let id = $('#commandesproduit_id').val();

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: 'commandes/modification/' + id,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    $('#modalModifierProduit').modal('hide');

                    Toast.fire({
                        icon: 'success',
                        text: response.success
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {

                    let message = 'Une erreur est survenue';

                    if (xhr.status === 422) {
                        message = '';
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            message += value[0] + '<br>';
                        });
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        html: message
                    });
                }
            });
        });


        $(document).on('click', '.SuppressionCommandesproduits ', function (e) {
            e.preventDefault();

            let commandesproduit_id = $(this).data('id');
            let libelle = $(this).data('libelle');
            let produits_id = $(this).data('idproduits');
            let quantite = $(this).data('quantite');

            Swal.fire({
                title: "Voulez-vous supprimer ",
                text: " " + libelle + " ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, confirmer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('commandes.confirmer-suppression') }}",
                        type: "POST",
                        data: {id: commandesproduit_id, quantite: quantite, produits_id: produits_id},
                        success: function (response) {

                            Toast.fire({
                                icon: 'success',
                                text: response.success
                            }).then(() => {
                                window.location = "{{ route('commandes.index') }}";
                            });
                        },
                        error: function (response) {

                            let errors = response.responseJSON?.errors;
                            let message = '';

                            if (errors) {
                                $.each(errors, function (key, value) {
                                    message += value[0] + '\n';
                                });
                            } else {
                                message = "Une erreur est survenue";
                            }

                            Swal.fire({
                                icon: "error",
                                title: "Erreur!",
                                text: message
                            });
                        }
                    });
                }
            });
        });

    });


</script>
<!-- jQuery -->


<script>
    $(document).ready(function () {

        // initialize datatable
        $('#dt-basic-example').dataTable(
            {
                responsive: true,
                lengthChange: false,
                dom:

                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {
                        extend: 'colvis',
                        text: 'Colonne visible',
                        titleAttr: 'Col visibility',
                        className: 'mr-sm-3'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        titleAttr: 'Generate PDF',
                        className: 'btn-outline-danger btn-sm mr-1'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        titleAttr: 'Generate Excel',
                        className: 'btn-outline-success btn-sm mr-1'
                    },

                    {
                        extend: 'copyHtml5',
                        text: 'Copy',
                        titleAttr: 'Copy to clipboard',
                        className: 'btn-outline-primary btn-sm mr-1'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        titleAttr: 'Print Table',
                        className: 'btn-outline-primary btn-sm'
                    }
                ]
            });

    });

</script>
</body>

<!-- Mirrored from smartadmin.lodev09.com/form_validation.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Apr 2020 17:47:02 GMT -->
</html>
