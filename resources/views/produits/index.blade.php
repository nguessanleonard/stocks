<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="utf-8">
    <title>Produits</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.headermeta')
    <!-- base css -->
    @include('layouts.css')
    <style>
        .image-preview-box {
            width: 200px;
            height: 200px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .image-preview-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .zoom-click {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .zoom-click:hover {
            transform: scale(1.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }
    </style>

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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Produits</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Produits

                    </h1>
                </div>

                <div class="row">

                    <div class="col-xl-12">

                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Produits <span class="fw-300"><i>Ajout</i></span>
                                </h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                            data-offset="0,10" data-original-title="Collapse">

                                    </button>

                                </div>
                            </div>
                            @can('Ajouter un produit')
                            <div class="panel-container show">
                                <div class="panel-content p-0">
                                    <form class="needs-validation" id="formAjoutProduit">
                                        <div class="panel-content">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-6">
                                                    <label class="form-label" for="validationTooltip01">Libelle <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" id="libelle" name="libelle"
                                                           placeholder="Entrez le libelle du produit" required>

                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    <label class="form-label" for="validationTooltip02">Code <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="code" name="code"
                                                           placeholder="Entrez le code du produit" required>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-12">
                                                    <label class="form-label"
                                                           for="validationTooltip04">Description </label>
                                                    <input type="text" name="description" id="description"
                                                           class="form-control"
                                                           placeholder="décrivez le produit ici">

                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file"
                                                               class="form-control"
                                                               name="image"
                                                               id="imageInput"
                                                               accept="image/*"
                                                               required>
                                                    </div>
                                                </div>

                                                <!-- Preview -->
                                                <div class="col-md-6">
                                                    <div class="form-group d-flex justify-content-center">
                                                        <div class="image-preview-box">
                                                            <span id="placeholderText">Aperçu</span>
                                                            <img id="previewImage" style="display:none;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div
                                            class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row justify-content-center align-items-center">
                                            <button class="btn btn-primary" type="submit">Valider</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                            @endcan
                            @can('Liste des produits')
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div id="panel-1" class="panel">
                                            <div class="panel-hdr">
                                                <h2>
                                                    Liste <span class="fw-300"><i>des Fournisseurs</i></span>
                                                </h2>
                                                <div class="panel-toolbar">


                                                    <button class="btn btn-panel" data-action="panel-close"
                                                            data-toggle="tooltip" data-offset="0,10"
                                                            data-original-title="Close"></button>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">

                                                    <!-- datatable start -->
                                                    <table id="dt-basic-example"
                                                           class="table table-bordered table-hover table-striped w-100">
                                                        <thead class="bg-primary-600">
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>Libelle</th>
                                                            <th>quantité en stock</th>
                                                            <th class="d-none d-sm-table-cell">codeqr</th>

                                                            <th class="d-none d-sm-table-cell">description</th>
                                                            <th>image</th>
                                                            @canany(['Modification du produit','Suppression du produit'])
                                                                <th>Actions</th>
                                                            @endcanany

                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @php $i = 1 @endphp

                                                        @foreach($produits as $produit)
                                                            <tr class="gradeA" style="font-size: 10px;">
                                                                <td>{{ $i++  }}</td>

                                                                <td>{{ $produit->libelle }}</td>
                                                                <td>{{ $produit->quantite }}</td>
                                                                <td class="d-none d-sm-table-cell">
                                                                    <img
                                                                        src="data:image/png;base64,{{ $produit->qrcode }}"
                                                                        class="img-fluid img-thumbnail zoom-click"
                                                                        style="max-width:35px; max-height:35px; cursor: zoom-in;">

                                                                </td>

                                                                <td class="d-none d-sm-table-cell">{{ $produit->description }}</td>
                                                                <td class="text-center">
                                                                    <img src="{{ $produit->photo }}"
                                                                         class="img-fluid img-thumbnail zoom-click"
                                                                         style="max-width:35px; max-height:35px; cursor: zoom-in;">
                                                                </td>
                                                                @canany(['Modification du produit','Suppression du produit'])
                                                                    <td class="text-center">
                                                                        @can('Modification du produit')
                                                                            <a href="#" class="btnModifierProduit"
                                                                               data-id="{{ $produit->id }}"
                                                                               data-libelle="{{ $produit->libelle }}"
                                                                               data-description="{{ $produit->description }}"
                                                                               data-code="{{ $produit->code }}"
                                                                               data-qrcode="{{ $produit->qrcode }}"
                                                                               data-photo="{{ $produit->photo }}"
                                                                            >
                                                                                <div class="badge badge-default">
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </div>
                                                                            </a>
                                                                        @endcan
                                                                        @can('Suppression du produit')

                                                                            <a href="#"
                                                                               data-id="{{ $produit->id }}"
                                                                               data-libelle="{{ $produit->libelle }}"
                                                                               class="SuppressionProduit">
                                                                                <div class=" badge badge-default"
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="Supprimez  {{$produit->libelle}}">
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
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="imageZoom" src="" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalModifierProduit" tabindex="-1" role="dialog"
     aria-labelledby="modalModifierProduitLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formModifierProduit" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="produits_id" id="produits_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModifierProduitLabel">Modifier le Produit</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Libelle</label>
                        <input type="text" id="libelle_modif" name="libelle"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Montant</label>
                        <input type="text" id="code_modif" name="code"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" id="description_modif" name="description"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file"
                               class="form-control"
                               name="image"
                               id="imageInput-edit"
                               accept="image/*"
                        >
                    </div>

                    <div class="form-group d-flex justify-content-center">
                        <div class="image-preview-box">
                            <img id="Produits_previewImage">
                        </div>
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
            timer: 1500,
            timerProgressBar: true
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.zoom-click', function () {
            let src = $(this).attr('src');

            console.log(src);

            $('#imageZoom').attr('src', src);
            $('#imageModal').modal('show');
        });


        $('#imageZoom').on('click', function () {
            $('#imageModal').modal('hide');
        });

        $('#imageInput').on('change', function () {

            const file = this.files[0];
            const preview = $('#previewImage');

            if (!file) {
                preview.hide();
                return;
            }

            if (!file.type.startsWith('image/')) {
                alert('Veuillez sélectionner une image valide.');
                $(this).val('');
                preview.hide();
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                preview
                    .attr('src', e.target.result)
                    .show();
            };

            reader.readAsDataURL(file);
        });
        $('#imageInput-edit').on('change', function () {

            const file = this.files[0];
            const preview = $('#Produits_previewImage');

            if (!file) {
                preview.hide();
                return;
            }

            if (!file.type.startsWith('image/')) {
                alert('Veuillez sélectionner une image valide.');
                $(this).val('');
                preview.hide();
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                preview
                    .attr('src', e.target.result)
                    .show();
            };

            reader.readAsDataURL(file);
        });

        $("#formAjoutProduit").on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('produits.ajouter') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    Toast.fire({
                        icon: 'success',
                        text: response.success
                    }).then(() => {
                        window.location = "{{ route('produits.index') }}";
                    });
                },

                error: function (xhr) {

                    // Erreurs de validation
                    if (xhr.status === 422) {
                        let message = '';
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            message += value[0] + '<br>';
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur de validation',
                            html: message
                        });
                    }

                    // Autres erreurs
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Une erreur est survenue.'
                        });
                    }
                }
            });
        });

        $(document).on('click', '.btnModifierProduit', function (e) {
            e.preventDefault();

            let id = $(this).data('id');
            let description = $(this).data('description');
            let libelle = $(this).data('libelle');
            let code = $(this).data('code');
            let image = $(this).data('photo');

            $('#produits_id').val(id);
            $('#libelle_modif').val(libelle);
            $('#code_modif').val(code);
            $('#description_modif').val(description);

            if (image) {
                $('#Produits_previewImage').attr('src', image).show();
            } else {
                $('#Produits_previewImage').hide();
            }

            $('#imageInput-edit').val('');

            $('#modalModifierProduit').modal('show');
        });
        $('#formModifierProduit').on('submit', function (e) {
            e.preventDefault();

            let id = $('#produits_id').val();

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: 'produits/modification/' + id,
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

        $(document).on('click', '.SuppressionProduit', function (e) {
            e.preventDefault();

            let produits_id = $(this).data('id');
            let libelle = $(this).data('libelle');

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
                        url: "{{ route('produits.confirmer-suppression') }}",
                        type: "POST",
                        data: {id: produits_id},
                        success: function (response) {

                            Toast.fire({
                                icon: 'success',
                                text: response.success
                            }).then(() => {
                                window.location = "{{ route('produits.index') }}";
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
    $('#imageInput').on('click', function () {
        $(this).val('');
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
