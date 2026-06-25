<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Connexion">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/vendors.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/app.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/fa-solid.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#2f9b8f">

    <style>
        :root {
            --login-ink: #17202a;
            --login-muted: #6b7583;
            --login-line: #dce4ec;
            --login-paper: #ffffff;
            --login-soft: #f4f7fa;
            --login-green: #2f9b8f;
            --login-blue: #2c6fbb;
            --login-amber: #f2a93b;
            --login-coral: #de5b57;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;
            color: var(--login-ink);
            background: linear-gradient(135deg, #eef3f6 0%, #f8fafb 48%, #edf2f5 100%);
            font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
        }

        .login-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(420px, .95fr);
            padding: 32px;
            gap: 24px;
        }

        .login-visual,
        .login-panel {
            min-height: calc(100vh - 64px);
        }

        .login-visual {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 36px;
            border-radius: 8px;
            color: #ffffff;
            background:
                linear-gradient(145deg, rgba(23, 32, 42, .92), rgba(29, 72, 84, .88)),
                url("{{ asset('assets/img/backgrounds/clouds.png') }}") center / cover;
            box-shadow: 0 24px 60px rgba(23, 32, 42, .22);
        }

        .brand-lockup {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            width: max-content;
            max-width: 100%;
        }

        .brand-lockup img {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .96);
            padding: 7px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .18);
        }

        .brand-lockup strong {
            display: block;
            font-size: 1.15rem;
            letter-spacing: 0;
        }

        .brand-lockup span {
            display: block;
            color: rgba(255, 255, 255, .7);
            font-size: .8rem;
        }

        .login-hero-copy {
            position: relative;
            z-index: 1;
            max-width: 620px;
            margin: 40px 0;
        }

        .login-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            color: #d8fff8;
            font-weight: 700;
            text-transform: uppercase;
            font-size: .75rem;
            letter-spacing: 0;
        }

        .login-kicker::before {
            content: "";
            width: 28px;
            height: 2px;
            background: var(--login-amber);
        }

        .login-hero-copy h1 {
            margin: 0;
            color: #ffffff;
            font-size: 3rem;
            line-height: 1.05;
            font-weight: 800;
            letter-spacing: 0;
        }

        .login-hero-copy p {
            max-width: 520px;
            margin: 20px 0 0;
            color: rgba(255, 255, 255, .78);
            font-size: 1rem;
            line-height: 1.65;
        }

        .stock-visual {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, .9fr) minmax(220px, .55fr);
            gap: 18px;
            align-items: stretch;
        }

        .stock-board,
        .stock-side {
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 8px;
            background: rgba(255, 255, 255, .1);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .12);
            backdrop-filter: blur(12px);
        }

        .stock-board {
            padding: 18px;
        }

        .stock-board-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .stock-board-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .stock-board-title i {
            color: var(--login-amber);
        }

        .stock-dots {
            display: flex;
            gap: 6px;
        }

        .stock-dots span {
            width: 16px;
            height: 4px;
            border-radius: 2px;
            background: rgba(255, 255, 255, .32);
        }

        .stock-shelves {
            display: grid;
            gap: 12px;
        }

        .stock-shelf {
            display: grid;
            grid-template-columns: 84px 1fr;
            gap: 12px;
            align-items: center;
        }

        .stock-shelf label {
            margin: 0;
            color: rgba(255, 255, 255, .7);
            font-size: .75rem;
        }

        .stock-lane {
            display: grid;
            grid-template-columns: repeat(5, minmax(26px, 1fr));
            gap: 8px;
        }

        .stock-box {
            height: 34px;
            border-radius: 6px;
            background: rgba(255, 255, 255, .18);
            border: 1px solid rgba(255, 255, 255, .14);
        }

        .stock-box.is-green {
            background: rgba(47, 155, 143, .9);
        }

        .stock-box.is-amber {
            background: rgba(242, 169, 59, .92);
        }

        .stock-box.is-blue {
            background: rgba(44, 111, 187, .92);
        }

        .stock-side {
            padding: 18px;
            display: grid;
            gap: 12px;
        }

        .stock-mini-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .12);
        }

        .stock-mini-card i {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: #ffffff;
        }

        .stock-mini-card:nth-child(1) i {
            background: var(--login-green);
        }

        .stock-mini-card:nth-child(2) i {
            background: var(--login-blue);
        }

        .stock-mini-card:nth-child(3) i {
            background: var(--login-coral);
        }

        .stock-mini-card strong,
        .stock-mini-card span {
            display: block;
        }

        .stock-mini-card strong {
            font-size: .9rem;
        }

        .stock-mini-card span {
            color: rgba(255, 255, 255, .65);
            font-size: .75rem;
        }

        .login-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 34px;
            border-radius: 8px;
            background: var(--login-paper);
            box-shadow: 0 24px 70px rgba(23, 32, 42, .14);
            border: 1px solid rgba(220, 228, 236, .9);
        }

        .login-card .brand-lockup {
            display: none;
            margin-bottom: 28px;
            color: var(--login-ink);
        }

        .login-card .brand-lockup span {
            color: var(--login-muted);
        }

        .login-card h2 {
            margin: 0;
            color: var(--login-ink);
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 0;
        }

        .login-card > p {
            margin: 10px 0 28px;
            color: var(--login-muted);
            line-height: 1.6;
        }

        .login-field {
            margin-bottom: 18px;
        }

        .login-field label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            color: var(--login-ink);
            font-weight: 700;
        }

        .login-input {
            position: relative;
        }

        .login-input i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--login-muted);
            pointer-events: none;
        }

        .login-input .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid var(--login-line);
            background: var(--login-soft);
            padding: 0 48px;
            color: var(--login-ink);
            box-shadow: none;
        }

        .login-input .form-control:focus {
            border-color: var(--login-green);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(47, 155, 143, .12);
        }

        .password-toggle {
            position: absolute;
            right: 8px;
            top: 8px;
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: var(--login-muted);
            cursor: pointer;
        }

        .password-toggle:hover,
        .password-toggle:focus {
            background: #e8eef3;
            color: var(--login-ink);
            outline: 0;
        }

        .password-toggle i {
            position: static;
            transform: none;
            pointer-events: auto;
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 6px 0 24px;
        }

        .custom-control-label {
            color: var(--login-muted);
        }

        .login-submit {
            width: 100%;
            min-height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 0;
            border-radius: 8px;
            background: var(--login-ink);
            color: #ffffff;
            font-weight: 800;
            letter-spacing: 0;
            box-shadow: 0 14px 32px rgba(23, 32, 42, .2);
        }

        .login-submit:hover,
        .login-submit:focus {
            color: #ffffff;
            background: #243241;
            box-shadow: 0 16px 36px rgba(23, 32, 42, .25);
        }

        .login-submit:disabled {
            cursor: wait;
            opacity: .78;
        }

        .login-footnote {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid var(--login-line);
            color: var(--login-muted);
            font-size: .8rem;
            text-align: center;
        }

        @media (max-width: 1080px) {
            .login-page {
                grid-template-columns: 1fr;
                padding: 20px;
            }

            .login-visual {
                min-height: auto;
                padding: 28px;
            }

            .login-panel {
                min-height: auto;
                padding: 0 0 18px;
            }

            .login-card .brand-lockup {
                display: inline-flex;
            }
        }

        @media (max-width: 760px) {
            .login-page {
                padding: 14px;
            }

            .login-visual {
                display: none;
            }

            .login-card {
                padding: 26px 20px;
            }

            .login-card h2 {
                font-size: 1.75rem;
            }

            .login-panel {
                min-height: calc(100vh - 28px);
            }
        }

        @media (max-width: 520px) {
            .login-options {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<main class="login-page">
    <section class="login-visual" aria-label="Aperçu de gestion">
        <div class="brand-lockup">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            <div>
                <strong>Gestion Stock</strong>
                <span>Espace sécurisé</span>
            </div>
        </div>

        <div class="login-hero-copy">
            <div class="login-kicker">Suivi magasin</div>
            <h1>Une entrée simple pour piloter vos stocks.</h1>
            <p>Retrouvez vos articles, mouvements, commandes et approvisionnements dans un espace clair, rapide et sécurisé.</p>
        </div>

        <div class="stock-visual" aria-hidden="true">
            <div class="stock-board">
                <div class="stock-board-head">
                    <div class="stock-board-title">
                        <i class="fas fa-warehouse"></i>
                        <span>Magasin</span>
                    </div>
                    <div class="stock-dots"><span></span><span></span><span></span></div>
                </div>
                <div class="stock-shelves">
                    <div class="stock-shelf">
                        <label>Rayon A</label>
                        <div class="stock-lane">
                            <span class="stock-box is-green"></span>
                            <span class="stock-box is-green"></span>
                            <span class="stock-box is-blue"></span>
                            <span class="stock-box"></span>
                            <span class="stock-box is-amber"></span>
                        </div>
                    </div>
                    <div class="stock-shelf">
                        <label>Rayon B</label>
                        <div class="stock-lane">
                            <span class="stock-box is-blue"></span>
                            <span class="stock-box is-green"></span>
                            <span class="stock-box is-amber"></span>
                            <span class="stock-box is-green"></span>
                            <span class="stock-box"></span>
                        </div>
                    </div>
                    <div class="stock-shelf">
                        <label>Rayon C</label>
                        <div class="stock-lane">
                            <span class="stock-box is-amber"></span>
                            <span class="stock-box"></span>
                            <span class="stock-box is-green"></span>
                            <span class="stock-box is-blue"></span>
                            <span class="stock-box is-green"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="stock-side">
                <div class="stock-mini-card">
                    <i class="fas fa-boxes"></i>
                    <div><strong>Articles</strong><span>Catalogue</span></div>
                </div>
                <div class="stock-mini-card">
                    <i class="fas fa-exchange-alt"></i>
                    <div><strong>Mouvements</strong><span>Entrées et sorties</span></div>
                </div>
                <div class="stock-mini-card">
                    <i class="fas fa-bell"></i>
                    <div><strong>Alertes</strong><span>Points à suivre</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="login-panel">
        <div class="login-card">
            <div class="brand-lockup">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                <div>
                    <strong>Gestion Stock</strong>
                    <span>Espace sécurisé</span>
                </div>
            </div>

            <h2>Connexion</h2>
            <p>Renseignez vos accès pour continuer.</p>

            <form id="loginForm" autocomplete="on">
                @csrf
                <div class="login-field">
                    <label class="form-label" for="login">Email</label>
                    <div class="login-input">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="login" name="email" class="form-control" placeholder="exemple@domaine.com" autocomplete="email" required>
                    </div>
                </div>

                <div class="login-field">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="login-input">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Votre mot de passe" autocomplete="current-password" required>
                        <button type="button" class="password-toggle" id="togglePassword" title="Afficher le mot de passe" aria-label="Afficher le mot de passe">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="login-options">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                        <label class="custom-control-label" for="remember">Se souvenir de moi</label>
                    </div>
                </div>

                <button type="submit" class="btn login-submit">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Se connecter</span>
                </button>
            </form>

            <div class="login-footnote">
                {{ date('Y') }} · Gestion des stocks
            </div>
        </div>
    </section>
</main>

<script src="{{ asset('assets/js/vendors.bundle.js') }}"></script>
<script src="{{ asset('assets/js/app.bundle.js') }}"></script>
<script src="{{ asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script>
    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 1800,
            timerProgressBar: true
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#togglePassword').on('click', function () {
            const password = $('#password');
            const isHidden = password.attr('type') === 'password';

            password.attr('type', isHidden ? 'text' : 'password');
            $(this)
                .attr('title', isHidden ? 'Masquer le mot de passe' : 'Afficher le mot de passe')
                .attr('aria-label', isHidden ? 'Masquer le mot de passe' : 'Afficher le mot de passe')
                .find('i')
                .toggleClass('fa-eye', !isHidden)
                .toggleClass('fa-eye-slash', isHidden);
        });

        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const btn = form.find('button[type="submit"]');
            const btnLabel = btn.find('span');
            const defaultLabel = btnLabel.text();

            btn.prop('disabled', true);
            btnLabel.text('Connexion...');

            $.ajax({
                url: "{{ route('login.loguser') }}",
                type: "POST",
                data: form.serialize(),
                success: function (res) {
                    Toast.fire({
                        icon: 'success',
                        text: res.success
                    }).then(() => {
                        window.location.href = res.route;
                    });
                },
                error: function (xhr) {
                    let message = 'Erreur de connexion';

                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        message = Object.values(xhr.responseJSON.errors)
                            .map(function (error) {
                                return Array.isArray(error) ? error.join('\n') : error;
                            })
                            .join('\n');
                    }

                    if (xhr.status === 401 && xhr.responseJSON?.message) {
                        message = xhr.responseJSON.message;
                    }

                    Swal.fire({icon: 'error', title: 'Connexion impossible', text: message});

                    btn.prop('disabled', false);
                    btnLabel.text(defaultLabel);
                }
            });
        });
    });
</script>
</body>
</html>
