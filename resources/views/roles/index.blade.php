<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="utf-8">
    <title>Rôles</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Rôles</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Rôles

                    </h1>
                </div>

                <div class="row">

                    <div class="col-xl-12">

                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Rôle <span class="fw-300"><i>Ajout</i></span>
                                </h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                            data-offset="0,10" data-original-title="Collapse">

                                    </button>

                                </div>
                            </div>
                            @can('Ajouter un rôle')
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form class="needs-validation" id="formAjoutRole">
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-12 mb-2">
                                                        <label class="form-label" for="validationTooltip01">Libelle <span
                                                                class="text-danger">*</span> </label>
                                                        <input type="text" class="form-control" id="libelle" name="libelle"
                                                               placeholder="Entrez le libelle du rôle" required>

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
                            @can('Liste des rôles')
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div id="panel-1" class="panel">
                                            <div class="panel-hdr">
                                                <h2>
                                                    Liste <span class="fw-300"><i>des rôles</i></span>
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
                                                            <th>Libelle rôle</th>
                                                            @canany(['Modification du rôle','Suppression du rôle'])
                                                                <th>Actions</th>
                                                            @endcanany


                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @php $i = 1 @endphp

                                                        @foreach($roles as $role)
                                                            <tr class="gradeA">
                                                                <td>{{ $i++  }}</td>
                                                                <td>{{ $role->name }}</td>
                                                                @canany(['Modification du rôle','Suppression du rôle'])
                                                                    <td class="text-center">
                                                                        @can('Modification du rôle')
                                                                            <a href="{{route('roles.edit', $role->id)}}"
                                                                               class="">
                                                                                <div class="badge badge-default"
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="Modifier le rôle {{$role->name}}">
                                                                                    <i class="fas fa-pencil-alt"></i>
                                                                                </div>
                                                                            </a>
                                                                        @endcan
                                                                        @can('Suppression du rôle')

                                                                            <a href="#"
                                                                               class="SuppressionRole"
                                                                               data-id="{{ $role->id }}"
                                                                               data-libelle="{{ $role->name }}">
                                                                                <div class=" badge badge-default"
                                                                                     data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="Supprimez le rôle {{$role->name}}">
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


        $("#formAjoutRole").on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("roles.ajouter") }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {

                    Toast.fire({
                        icon: 'success',
                        text: response.success
                    }).then(() => {
                        window.location = "{{ route('roles.index') }}";
                    });

                    $('#ajoutRole')[0].reset();
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

        $(document).on('click', '.SuppressionRole', function (e) {
            e.preventDefault();

            let roles_id = $(this).data('id');
            let libelle = $(this).data('libelle');

            Swal.fire({
                title: "Voulez-vous supprimer",
                text: "le rôle " + libelle + " ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, confirmer",
                cancelButtonText: "Annuler"
            }).then((result) => {

                if (!result.isConfirmed) return;


                $.ajax({
                    url: "{{ route('roles.confirmer-suppression') }}",
                    type: "POST",
                    data: {
                        id: roles_id,
                        _token: "{{ csrf_token() }}"
                    },

                    success: function (response) {

                        if (response.success) {

                            Toast.fire({
                                icon: 'success',
                                text: response.success
                            });

                            // 🔥 supprimer la ligne sans reload
                            $('a[data-id="' + roles_id + '"]').closest('tr').fadeOut(300, function () {
                                $(this).remove();
                            });

                        } else if (response.error) {

                            Swal.fire({
                                icon: "error",
                                title: "Erreur",
                                text: response.error
                            });
                        }
                    },

                    error: function (xhr) {

                        let message = "Une erreur est survenue";

                        if (xhr.responseJSON) {

                            if (xhr.responseJSON.error) {
                                message = xhr.responseJSON.error;
                            }

                            if (xhr.responseJSON.errors) {
                                message = Object.values(xhr.responseJSON.errors)
                                    .map(e => e[0])
                                    .join("\n");
                            }
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Erreur",
                            text: message
                        });
                    }
                });
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
