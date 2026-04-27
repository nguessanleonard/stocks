<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="utf-8">
    <title>Permissions</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Permissions</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Permissions

                    </h1>
                </div>

                <div class="row">

                    <div class="col-xl-12">

                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Permissions <span class="fw-300"><i>Ajout</i></span>
                                </h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                            data-offset="0,10" data-original-title="Collapse">

                                    </button>

                                </div>
                            </div>
                            @can('Ajouter une permission')
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form id="ajoutPermission">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                                    <h4>Création d'une permission</h4>
                                                    <div class="form-group">
                                                        <label for="titre">Titre</label>
                                                        <input type="text" id="titre" class="form-control" name="titre"
                                                               placeholder="Entrez le nom de la permission">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Enrégistrer
                                                </button>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            @endcan
                            @can('Liste des permissions')
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div id="panel-1" class="panel">
                                            <div class="panel-hdr">
                                                <h2>
                                                    Liste <span class="fw-300"><i>des Permissions</i></span>
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
                                                            <th>Titre</th>

                                                            @canany(['Modification de la permission'])
                                                                <th>Actions</th>
                                                            @endcanany


                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @php $i = 1 @endphp

                                                        @foreach($permissions as $permission)
                                                            <tr class="gradeA">
                                                                <td>{{ $i++  }}</td>
                                                                <td>{{ $permission->name }}</td>
                                                                @canany(['Modification de la permission'])
                                                                    <td class="text-center">
                                                                        @can('Modification de la permission')
                                                                            <a href="#" class="btnModifierPermission"
                                                                               data-id="{{ $permission->id }}"
                                                                               data-name="{{ $permission->name }}"
                                                                            >
                                                                                <div class="badge badge-default"
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="Modifier la permission {{$permission->name}}">
                                                                                    <i class="fas fa-pencil-alt"></i>
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
<div class="modal fade" id="modalModifierPermission" tabindex="-1" role="dialog"
     aria-labelledby="modalModifierPermissionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formModifierPermission" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="permissions_id" id="permissions_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModifierPermissionLabel">Modifier le Permission</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Libelle</label>
                        <input type="text" id="noms_modif" name="name"
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

        $("#ajoutPermission").on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("permissions.ajouter") }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {

                    Toast.fire({
                        icon: 'success',
                        text: response.success
                    }).then(() => {
                        window.location = "{{ route('permissions.index') }}";
                    });

                    $('#ajoutPermission')[0].reset();
                },
                error: function (xhr) {

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
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Une erreur est survenue.'
                        });
                    }
                }
            });
        });


        $(document).on('click', '.btnModifierPermission', function (e) {
            e.preventDefault();

            let id = $(this).data('id');
            let noms = $(this).data('name');

            $('#permissions_id').val(id);
            $('#noms_modif').val(noms);


            $('#modalModifierPermission').modal('show');
        });
        $('#formModifierPermission').on('submit', function (e) {
            e.preventDefault();

            let id = $('#permissions_id').val();

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: 'permissions/modification/' + id,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    $('#modalModifierPermission').modal('hide');

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
                        target: '#modalModifierPermission', // ✅ clé ici
                        icon: 'error',
                        title: 'Erreur',
                        html: message
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
