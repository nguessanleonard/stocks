<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{{asset("assets/css/vendors.bundle.css")}}">
    <link rel="stylesheet" media="screen, print" href="{{asset("assets/css/app.bundle.css")}}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset("assets/img/favicon/apple-touch-icon.png")}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset("assets/img/favicon/favicon-32x32.png")}}">
    <link rel="mask-icon" href="{{asset("assets/img/favicon/safari-pinned-tab.svg")}}" color="#5bbad5">
    <meta name="hostname" content="smartadmin.lodev09.com">
    <meta name="app-url" content="index.html">
    <meta name="assets-url" content="assets/index.html">
    <meta name="environment" content="dev">
    <!-- Optional: page related CSS -->
    <!-- PHP docs -->
    <link rel="stylesheet" media="screen, print" href="{{asset("assets/css/markdown.css")}}">
    <link rel="stylesheet" media="screen, print" href="{{asset("assets/css/page-login.css")}}">
</head>
<body>
<div class="blankpage-form-field">
    <div
        class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
            <img src="{{asset("")}}assets/img/logo.png" alt="SmartAdmin for PHP" aria-roledescription="logo">
            <span class="page-logo-text mr-1">GESTION</span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
        <form id="loginForm">
            @csrf
            <div class="form-group">
                <label class="form-label" for="login">Login</label>
                <input type="email" id="login" name="email" class="form-control" placeholder="Entrez votre login"
                >
                <span class="help-block">
                           Votre login
                        </span>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="Entrez votre mot de passe">
                <span class="help-block">
                            Votre mot de passe
                        </span>
            </div>
            <div class="form-group text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="rememberme" id="rememberme">
                    <label class="custom-control-label" for="rememberme">Se souvenir de moi</label>
                </div>
            </div>
            <div class="col-12 mt-4 mb-2 text-center">
                <button type="submit" class="btn btn-primary float-center">Connexion</button>
            </div>
        </form>
    </div>

</div>

<video poster="{{asset("assets/img/backgrounds/clouds.png")}}" id="bgvid" playsinline autoplay muted loop>
    <source src="{{asset("assets/media/video/cc.webm")}}" type="video/webm">
    <source src="{{asset("assets/media/video/cc.mp4")}}" type="video/mp4">
</video>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src=""></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-143247136-2');

</script>

<script src="{{asset("assets/js/vendors.bundle.js")}}"></script>
<script src="{{asset("assets/js/app.bundle.js")}}"></script>
<!-- Page related scripts -->
<script>
    $(function () {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: "success",
            showConfirmButton: false,
            timer: 3000
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#loginForm').on('submit', function (e) {
            e.preventDefault(); // 🔥 bloque le GET

            console.log("submit intercepté OK"); // test

            let btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true);

            $.ajax({
                url: "{{ route('login.loguser') }}",
                type: "POST",
                data: $(this).serialize(),

                success: function (res) {
                    Toast.fire({
                        icon: 'success',
                        text: res.success,
                        timer: 1500
                    }).then(() => {
                        window.location.href = res.route;
                    });
                },

                error: function (xhr) {
                    let message = 'Erreur de connexion';

                    if (xhr.status === 422) {
                        message = Object.values(xhr.responseJSON.errors).join('\n');
                    }

                    if (xhr.status === 401) {
                        message = xhr.responseJSON.message;
                    }

                    Swal.fire({icon: 'error', title: 'Erreur', text: message});

                    btn.prop('disabled', false);
                }
            });
        });
    });
</script>
</body>
</html>
