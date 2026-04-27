<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="utf-8">
    <title>Clients</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Attribution de rôle</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Rôle

                    </h1>
                </div>
                @can('Attribution de rôle')
                    <div class="row">

                        <div class="col-xl-12">

                            <form id="formAttributionRole">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Libelle du rôle</label>
                                    <input type="text"
                                           name="libelle"
                                           class="form-control"
                                           value="{{ $admin->nom.' '.$admin->prenoms }}"
                                           required disabled>
                                </div>
                                <hr>
                                <h5 class="mb-3">Attribution ou retrait de rôle </h5>

                                <div class="row">
                                    @foreach($roles as $index => $role)
                                        <div class="col-md-3">
                                            @error('permission')

                                            @enderror
                                            <label for="radio-{{ $index }}" class="form-check-label"
                                                   style="font-size: 20px">
                                                <input
                                                    type="radio"
                                                    name="role"
                                                    value="{{$role->name}}"
                                                    id="radio-{{ $index }}"
                                                    @if($admin->hasRole($role->name)) checked @endif
                                                >
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        Enregistrer
                                    </button>

                                </div>

                            </form>

                        </div>
                    </div>
                @endcan
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

        $('#formAttributionRole').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('admins.attributionrole', $admin->id) }}",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    Toast.fire({
                        icon: 'success',
                        title: response.success
                    });

                    setTimeout(() => {
                        window.location.href = "{{ route('admins.index') }}";
                    }, 1500);
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        html: errors.join('<br>')
                    });
                }
            });
        });


    });


</script>
<!-- jQuery -->


</body>

<!-- Mirrored from smartadmin.lodev09.com/form_validation.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Apr 2020 17:47:02 GMT -->
</html>
