<!DOCTYPE html>

<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<head>
    <meta charset="utf-8">
    <title>Approvisionnements</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Approvisionnements</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-edit'></i> Approvisionnements

                    </h1>
                </div>

                <div class="row">

                    <div class="col-xl-12">

                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Approvisionnements <span class="fw-300"><i>Ajout</i></span>
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
                                                    <select id="fournisseurs_id" name="fournisseurs_id"
                                                            class="form-control select2-4">

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-12 mt-3 text-center">
                                                <button type="button" id="btnScanQR" class="btn btn-primary">Scannez le code produit</button>
                                            </div>

                                            <!-- Bouton pour afficher le champ matricule -->
                                            <div class="col-12 mt-3 text-center">
                                                <button type="button" id="toggleCode" class="btn btn-outline-primary">Saisir
                                                    le code produit
                                                </button>
                                            </div>
                                            <div id="produit" style="display:none;" class="mt-3">

                                                <div class="form-group">
                                                    <label>Code produit</label>
                                                    <input type="text" id="inputCode" class="form-control" placeholder="Entrez le code">
                                                </div>

                                                <div class="text-center mt-2">
                                                    <button type="button" id="btnRechercherCode" class="btn btn-success">
                                                        Rechercher
                                                    </button>
                                                </div>

                                                <div id="infosproduit" class="mt-3"></div>

                                            </div>

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

                                                    @foreach($approvisionnements as $approvisionnement)

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
<div class="modal fade" id="modalScan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">
            <h5>Scanner le code QR</h5>
            <video id="qr-video" style="width:100%; border-radius:10px;"></video>
            <canvas id="qr-canvas" style="display:none;"></canvas>
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
<script src="https://unpkg.com/jsqr@1.4.0/dist/jsQR.js"></script>
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

        // ===============================
        // TOGGLE CHAMP SAISIE
        // ===============================
        $('#toggleCode').on('click', function () {
            $('#produit').toggle();
        });

        // ===============================
        // RECHERCHE PAR CODE MANUEL
        // ===============================
        $('#btnRechercherCode').on('click', function () {

            let code = $('#inputCode').val();

            if (code === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Veuillez saisir un code'
                });
                return;
            }

            rechercherProduit({qr_code: code});
        });

        // ===============================
        // SCAN QR CODE
        // ===============================
        $('#btnScanQR').on('click', async function () {

            $('#modalScan').modal('show');

            const video = document.getElementById('qr-video');

            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {facingMode: "environment"}
                });

                video.srcObject = stream;
                video.setAttribute("playsinline", true);
                video.play();

                const canvas = document.getElementById('qr-canvas');
                const context = canvas.getContext('2d');

                const scan = () => {
                    if (video.readyState === video.HAVE_ENOUGH_DATA) {

                        canvas.height = video.videoHeight;
                        canvas.width = video.videoWidth;

                        context.drawImage(video, 0, 0);

                        const code = jsQR(
                            context.getImageData(0, 0, canvas.width, canvas.height).data,
                            canvas.width,
                            canvas.height
                        );

                        if (code) {
                            stream.getTracks().forEach(track => track.stop());
                            $('#modalScan').modal('hide');

                            rechercherProduit({qr_code: code.data});
                            return;
                        }
                    }
                    requestAnimationFrame(scan);
                };

                scan();

            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Caméra inaccessible'
                });
            }
        });

        // ===============================
        // FONCTION UNIQUE RECHERCHE
        // ===============================
        function rechercherProduit(data) {


            $.post("{{ route('produits.rechercheCodeorqrcode') }}", data)
                .done(function (response) {

                    if (response.success) {

                        const html = `
                     <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Libellé</th>
                                <th>Quantité</th>
                            </tr>
                        </thead>
                        <tbody id="produitTable">
                            <tr>
                                <td>
                                    <img src="${response.photo}" class="img-fluid rounded" style="max-height:80px;">
                                </td>
                                <td>
                                    ${response.code}
                                    <input type="hidden" name="produits_id[]" value="${response.id}">
                                    <input type="hidden" name="code[]" value="${response.code}">
                                </td>
                                <td>${response.libelle}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-sm btn-danger btn-moins">-</button>

                                        <input type="text" name="quantite[]" value="1"
                                               class="form-control mx-2 text-center quantite"
                                               style="width:60px;" readonly>

                                        <button type="button" class="btn btn-sm btn-success btn-plus">+</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    `;

                        $('#infosproduit').html(html).fadeIn();

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

        // Incrementer
        $(document).on('click', '.btn-plus', function () {
            let input = $(this).siblings('.quantite');
            let value = parseInt(input.val());
            input.val(value + 1);
        });

        // Decrementer
        $(document).on('click', '.btn-moins', function () {
            let input = $(this).siblings('.quantite');
            let value = parseInt(input.val());

            if (value > 1) {
                input.val(value - 1);
            }
        });
        $.ajax({
            url: "{{ route('fournisseurs.liste') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let selectAjout = $('#fournisseurs_id');

                selectAjout.empty().append('<option value="">Sélectionnez le fournisseur</option>');

                $.each(data, function (key, value) {
                    selectAjout.append('<option value="' + value.id + '">' + value.libelle + '</option>');

                });
            },
            error: function () {
                console.error("Erreur lors du chargement des fournisseurs.");
            }
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
