<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="utf-8">
    <title>Fournisseurs</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Fournisseurs</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Fournisseurs

                    </h1>
                </div>

                <div class="row">

                    <div class="col-xl-12">

                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Fournisseurs <span class="fw-300"><i>Ajout</i></span>
                                </h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                            data-offset="0,10" data-original-title="Collapse">

                                    </button>

                                </div>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content p-0">
                                    <form class="needs-validation" id="formAjoutFournisseur">
                                        <div class="panel-content">
                                            <div class="form-row">
                                                <div class="col-md-12 mb-12 mb-2">
                                                    <label class="form-label" for="validationTooltip01">Le nom du
                                                        Fournisseur <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" id="libelle" name="libelle"
                                                           placeholder="Entrez le nom du Fournisseur" required>

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
                                                        >
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
                                                        <th>Logo</th>
                                                        <th>#</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @php $i = 1 @endphp

                                                    @foreach($fournisseurs as $fournisseur)
                                                        <tr class="gradeA" style="font-size: 10px;">
                                                            <td>{{ $i++  }}</td>

                                                            <td>{{ $fournisseur->libelle }}</td>
                                                            <td class="text-center">
                                                                <img src="{{ $fournisseur->logo }}"
                                                                     class="img-fluid img-thumbnail zoom-click"
                                                                     style="max-width:35px; max-height:35px; cursor: zoom-in;">
                                                            </td>

                                                            <td class="text-center">

                                                                <a href="#" class="btnModifierFournisseur"
                                                                   data-id="{{ $fournisseur->id }}"
                                                                   data-libelle="{{ $fournisseur->libelle }}"

                                                                   data-logo="{{ $fournisseur->logo }}"
                                                                >
                                                                    <div class="badge badge-default">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </div>
                                                                </a>

                                                                <a href="#"
                                                                   data-id="{{ $fournisseur->id }}"
                                                                   data-libelle="{{ $fournisseur->libelle }}"
                                                                   class="SuppressionFournisseur">
                                                                    <div class=" badge badge-default"
                                                                         data-toggle="tooltip"
                                                                         data-placement="top"
                                                                         title="Supprimez  {{$fournisseur->libelle}}">
                                                                        <i class="fas fa-trash-alt"
                                                                           style="color: crimson"></i>
                                                                    </div>
                                                                </a>

                                                            </td>

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
<div class="modal fade" id="modalModifierFournisseur" tabindex="-1" role="dialog"
     aria-labelledby="modalModifierFournisseurLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formModifierFournisseur" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="fournisseurs_id" id="fournisseurs_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModifierFournisseurLabel">Modifier le Fournisseur</h5>
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
                            <img id="fournisseurs_previewImage">
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
            const preview = $('#fournisseurs_previewImage');

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

        $("#formAjoutFournisseur").on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('fournisseurs.ajouter') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    Toast.fire({
                        icon: 'success',
                        text: response.success
                    }).then(() => {
                        window.location = "{{ route('fournisseurs.index') }}";
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

        $(document).on('click', '.btnModifierFournisseur', function (e) {
            e.preventDefault();

            let id = $(this).data('id');
            let libelle = $(this).data('libelle');
            let image = $(this).data('logo');

            $('#fournisseurs_id').val(id);
            $('#libelle_modif').val(libelle);


            if (image) {
                $('#fournisseurs_previewImage').attr('src', image).show();
            } else {
                $('#fournisseurs_previewImage').hide();
            }

            $('#imageInput-edit').val('');

            $('#modalModifierFournisseur').modal('show');
        });
        $('#formModifierFournisseur').on('submit', function (e) {
            e.preventDefault();

            let id = $('#fournisseurs_id').val();

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: 'fournisseurs/modification/' + id,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    $('#modalModifierFournisseur').modal('hide');

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
                        target: '#modalModifierFournisseur', // ✅ clé ici
                        icon: 'error',
                        title: 'Erreur',
                        html: message
                    });
                }
            });
        });

        $(document).on('click', '.SuppressionFournisseur', function (e) {
            e.preventDefault();

            let Fournisseurs_id = $(this).data('id');
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
                        url: "{{ route('fournisseurs.confirmer-suppression') }}",
                        type: "POST",
                        data: {id: Fournisseurs_id},
                        success: function (response) {

                            Toast.fire({
                                icon: 'success',
                                text: response.success
                            }).then(() => {
                                window.location = "{{ route('fournisseurs.index') }}";
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
