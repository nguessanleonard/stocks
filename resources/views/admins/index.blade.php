<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="utf-8">
    <title>Utiisateurs</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Utiisateurs</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Utiisateurs

                    </h1>
                </div>

                <div class="row">

                    <div class="col-xl-12">

                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Utiisateurs <span class="fw-300"><i>Ajout</i></span>
                                </h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                            data-offset="0,10" data-original-title="Collapse">

                                    </button>

                                </div>
                            </div>
                            @can('Ajouter un utilisateur')
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form class="needs-validation" id="formAjoutAdmin">
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="validationTooltip01">Le nom
                                                            <span
                                                                class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" id="nom" name="nom"
                                                               placeholder="Entrez le nom  l'utilisateur" required>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="validationTooltip02">Le prénoms
                                                            <span
                                                                class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" id="prenoms"
                                                               name="prenoms"
                                                               placeholder="Entrez le nom et premons l'utilisateur"
                                                               required>

                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="validationTooltip03">Téléphone
                                                            <span
                                                                class="text-danger"></span> </label>
                                                        <input type="text" class="form-control" id="telephone"
                                                               name="telephone"
                                                               placeholder="Entrez le numéro de téléphone l'utilisateur">

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="validationTooltip04">L'adresse
                                                            électronique <span
                                                                class="text-danger"></span> </label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                               placeholder="Entrez L'adresse électronique de l'utilisateur">

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
                            @can('La liste des utilisateurs')
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div id="panel-1" class="panel">
                                            <div class="panel-hdr">
                                                <h2>
                                                    Liste <span class="fw-300"><i>des Utiisateurs</i></span>
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
                                                            <th>Noms</th>
                                                            <th>Téléphone</th>
                                                            <th>Email</th>
                                                            @canany(['Attribution de rôle','Modification infos pers','Reinitialisation du mot de passe','Suppression de l utilisateur'])
                                                                <th>Actions</th>
                                                            @endcanany
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @php $i = 1 @endphp
                                                        @foreach($admins as $key)
                                                            <tr class="gradeA" style="font-size: 10px;">
                                                                <td>{{ $i++  }}</td>

                                                                <td>{{ $key->nom.' '.$key->prenoms }}</td>
                                                                <td>{{ $key->telephone }}</td>
                                                                <td>{{ $key->email}}</td>
                                                                @canany(['Attribution de rôle','Modification infos pers','Reinitialisation du mot de passe','Suppression de l utilisateur'])
                                                                    <td class="text-center">
                                                                        @can('Attribution de rôle')
                                                                            <a href="{{route('admins.edit', $key->id)}}"
                                                                               class="">
                                                                                <div class="badge badge-default"
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="Attribuer un rôle à  {{$key->nom.' '.$key->prenoms}}">
                                                                                    <i class="fas fa-hand-holding-box"></i>
                                                                                </div>
                                                                            </a>
                                                                        @endcan
                                                                        @can('Modification infos pers')
                                                                            <a href="#" class="btnModifierUtilisateur"
                                                                               data-id="{{ $key->id }}"
                                                                               data-nom="{{ $key->nom }}"
                                                                               data-prenoms="{{ $key->prenoms }}"
                                                                               data-telephone="{{ $key->telephone }}"
                                                                               data-email="{{ $key->email }}"

                                                                            >
                                                                                <div class="badge badge-default">
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </div>
                                                                            </a>
                                                                        @endcan
                                                                        @can('Reinitialisation du mot de passe')

                                                                            <a href="#"
                                                                               data-id="{{ $key->id }}"
                                                                               data-noms="{{ $key->nom.' '.$key->prenoms }}"
                                                                               class="Reinitialisationpassword">
                                                                                <div class=" badge badge-default"
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="Réinitialiser le mot de passe de l'utilisateur {{$key->nom.' '.$key->prenoms}}">
                                                                                    <i class="fas fa-key"></i>
                                                                                </div>
                                                                            </a>
                                                                        @endcan
                                                                        @can('Suppression de l utilisateur')
                                                                            <a href="#"
                                                                               data-id="{{ $key->id }}"
                                                                               data-noms="{{ $key->nom.' '.$key->prenoms }}"
                                                                               class="SuppressionUtilisateur">
                                                                                <div class=" badge badge-default"
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="Supprimez  {{$key->nom}}">
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
<div class="modal fade" id="modalModifierUtilisateur" tabindex="-1" role="dialog"
     aria-labelledby="modalModifierUtilisateurLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formModifierUtilisateur" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="admins_id" id="admins_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModifierUtilisateurLabel">Modifier l' Utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" id="nom_modif" name="nom"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Prénoms</label>
                        <input type="text" id="prenoms_modif" name="prenoms"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" id="telephone_modif" name="telephone"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Adresse électronique</label>
                        <input type="text" id="email_modif" name="email"
                               class="form-control">
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


        $("#formAjoutAdmin").on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('admins.ajouter') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    Toast.fire({
                        icon: 'success',
                        text: response.success
                    }).then(() => {
                        window.location = "{{ route('admins.index') }}";
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

        $(document).on('click', '.btnModifierUtilisateur', function (e) {
            e.preventDefault();

            let id = $(this).data('id');
            let nom = $(this).data('nom');
            let prenoms = $(this).data('prenoms');
            let telephone = $(this).data('telephone');
            let email = $(this).data('email');
            $('#admins_id').val(id);
            $('#nom_modif').val(nom);
            $('#prenoms_modif').val(prenoms);
            $('#telephone_modif').val(telephone);
            $('#email_modif').val(email);

            $('#modalModifierUtilisateur').modal('show');
        });
        $('#formModifierUtilisateur').on('submit', function (e) {
            e.preventDefault();

            let id = $('#admins_id').val();

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: 'admins/modifications-infos-personne/' + id,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    $('#modalModifierUtilisateur').modal('hide');

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
                        target: '#modalModifierUtilisateur', // ✅ clé ici
                        icon: 'error',
                        title: 'Erreur',
                        html: message
                    });
                }
            });
        });
        $(document).on('click', '.Reinitialisationpassword', function (e) {

            e.preventDefault();

            let admins_id = $(this).data('id');
            let noms = $(this).data('noms');

            Swal.fire({
                title: "Voulez-vous réinitialiser le mot de passe de",
                text: "l'utilisateur " + noms + " ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, confirmer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {

                    showLoader();

                    $.ajax({
                        url: "{{ route('admins.pwdreset') }}",
                        type: "POST",
                        data: {
                            id: admins_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            hideLoader();
                            Toast.fire({
                                icon: 'success',
                                text: response.success
                            }).then(() => {
                                window.location = "{{ route('admins.index') }}";
                            });
                        },
                        error: function (xhr) {
                            hideLoader();

                            let message = xhr.responseJSON?.error ?? "Une erreur est survenue.";

                            Swal.fire({
                                icon: "error",
                                title: "Erreur",
                                text: message
                            });
                        }
                    });
                }
            });
        });
        $(document).on('click', '.SuppressionUtilisateur', function (e) {
            e.preventDefault();

            let admins_id = $(this).data('id');
            let noms = $(this).data('noms');

            Swal.fire({
                title: "Voulez-vous supprimer ",
                text: " le client " + noms + " ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, confirmer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admins.confirmer-suppression') }}",
                        type: "POST",
                        data: {id: admins_id},
                        success: function (response) {

                            Toast.fire({
                                icon: 'success',
                                text: response.success
                            }).then(() => {
                                window.location = "{{ route('admins.index') }}";
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
