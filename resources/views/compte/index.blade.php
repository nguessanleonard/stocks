<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="utf-8">
    <title>Compte</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Compte</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Compte
                    </h1>
                </div>

                <div class="row">

                    <div class="col-xl-12">

                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Compte <span class="fw-300"><i>Modification</i></span>
                                </h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"
                                            data-offset="0,10" data-original-title="Collapse">

                                    </button>

                                </div>
                            </div>
                            @can('Ajouter un fournisseur')
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form class="needs-validation" id="formModifcompte">
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-12 mb-2">
                                                        <label class="form-label" for="validationTooltip01">Mot de passe
                                                            actuel <span
                                                                class="text-danger">*</span> </label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" id="oldpass"
                                                                   name="oldpass"
                                                                   placeholder="Entrez votre mot de passe actuel"
                                                                   required>
                                                            <div class="input-group-append">
                                                                <button type="button"
                                                                        class="btn btn-outline-secondary toggle-pass">
                                                                    👁️
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="validationTooltip02">Nouveau mot
                                                            de passe <span
                                                                class="text-danger"></span> </label>
                                                        <div class="input-group">
                                                            <input type="password" id="password" name="password"
                                                                   class="form-control"
                                                                   placeholder="Entrez votre nouveau mot de passe">
                                                            <div class="input-group-append">
                                                                <button type="button"
                                                                        class="btn btn-outline-secondary toggle-pass">
                                                                    👁️
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="validationTooltip03">Confirmation
                                                            du mot de passe <span
                                                                class="text-danger"></span> </label>
                                                        <div class="input-group">
                                                            <input type="password" id="confirpass" name="confirpass"
                                                                   class="form-control"
                                                                   placeholder="Confirmer votre nouveau mot de passe">
                                                            <div class="input-group-append">
                                                                <button type="button"
                                                                        class="btn btn-outline-secondary toggle-pass">
                                                                    👁️
                                                                </button>
                                                            </div>
                                                        </div>
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


        $('#formModifcompte').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('compte.update') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        text: response.success
                    });

                },
                error: function (xhr) {

                    let message = '';

                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (k, v) {
                            message += v[0] + '<br>';
                        });
                    } else {
                        message = "Erreur serveur";
                    }

                    Swal.fire({
                        icon: 'error',
                        html: message
                    });
                }
            });
        });
        $(document).on('click', '.toggle-pass', function () {
            let input = $(this).closest('.input-group').find('input');

            let type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
        });

        function checkPasswords() {
            let pass = $('#password').val();
            let conf = $('#confirpass').val();

            if (conf.length > 0) {
                if (pass === conf) {
                    $('#confirpass').css('border', '2px solid green');
                } else {
                    $('#confirpass').css('border', '2px solid red');
                }
            } else {
                $('#confirpass').css('border', '');
            }
        }

        $('#password, #confirpass').on('keyup', function () {
            checkPasswords();
        });


    });
    $('#imageInput').on('click', function () {
        $(this).val('');
    });

</script>
<!-- jQuery -->


</body>

<!-- Mirrored from smartadmin.lodev09.com/form_validation.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Apr 2020 17:47:02 GMT -->
</html>
