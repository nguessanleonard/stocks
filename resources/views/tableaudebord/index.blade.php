<!DOCTYPE html>

<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <title>Tableau de bord</title>
    <meta name="description" content="Analytics Dashboard - Application Intel - SmartAdmin v4.0.3">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tableau de bord</a></li>

                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-chart-area'></i> Statistique <span class='fw-300'>Tableau de bord</span>
                        <small>
                        </small>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>Les statistique du mois</h2>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <h5>Vente/ du mois en cours</h5>
                                    <div id="flotBar1" style="width: 100%; height: 160px;"></div>
                                </div>
                            </div>
                        </div>
                        <div id="panel-6" class="panel">
                            <div class="panel-hdr">
                                <h2>statistique des produits vendus/js </h2>
                            </div>
                            <div class="panel-container show">

                                <div class="panel-content">
                                    <div class="row  mb-g">
                                        <div class="col-md-6 d-flex align-items-center">
                                            <div id="flotPie" class="w-100" style="height:250px"></div>
                                        </div>
                                        <div class="col-md-6 col-lg-5 mr-lg-auto">
                                            <div class="d-flex mt-2 mb-1 fs-xs text-primary">
                                                Current Usage
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar" role="progressbar" style="width: 70%;"
                                                     aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex mt-2 mb-1 fs-xs text-info">
                                                Net Usage
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-info-500" role="progressbar"
                                                     style="width: 30%;" aria-valuenow="30" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex mt-2 mb-1 fs-xs text-warning">
                                                Users blocked
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-warning-500" role="progressbar"
                                                     style="width: 40%;" aria-valuenow="40" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex mt-2 mb-1 fs-xs text-danger">
                                                Custom cases
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-danger-500" role="progressbar"
                                                     style="width: 15%;" aria-valuenow="15" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex mt-2 mb-1 fs-xs text-success">
                                                Test logs
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-success-500" role="progressbar"
                                                     style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex mt-2 mb-1 fs-xs text-dark">
                                                Uptime records
                                            </div>
                                            <div class="progress progress-xs mb-3">
                                                <div class="progress-bar bg-fusion-500" role="progressbar"
                                                     style="width: 10%;" aria-valuenow="10" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
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

@include('layouts.js')
@include('layouts.calendar')
<script>
    let dataFromLaravel = @json($chartData);

    $(function () {

        $.plot("#flotBar1", [
                {
                    data: dataFromLaravel,
                    bars: {
                        show: true,
                        lineWidth: 0,
                        fillColor: myapp_get_color.fusion_50,
                        barWidth: 0.6,
                        align: "center"
                    }
                }
            ],
            {
                grid: {
                    hoverable: true,
                    clickable: true,
                    borderWidth: 1,
                    borderColor: "#eee"
                },

                xaxis: {
                    tickDecimals: 0,
                    tickSize: 1
                },

                yaxis: {
                    min: 0,
                    tickFormatter: function (v) {
                        return v.toLocaleString() + " FCFA";
                    }
                }
            });
        // tooltip
        let tooltip = $("<div id='tooltip'></div>").css({
            position: "absolute",
            display: "none",
            padding: "6px 10px",
            background: "#111",
            color: "#fff",
            borderRadius: "4px",
            fontSize: "12px",
            zIndex: 9999
        }).appendTo("body");

// hover
        $("#flotBar1").bind("plothover", function (event, pos, item) {

            if (item) {
                let value = item.datapoint[1];

                tooltip.html(value.toLocaleString() + " FCFA")
                    .css({
                        top: item.pageY - 40,
                        left: item.pageX + 10
                    })
                    .fadeIn(150);

            } else {
                tooltip.hide();
            }
        });

    });
</script>

</body>

<!-- Mirrored from smartadmin.lodev09.com/intel_analytics_dashboard.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 03 Apr 2020 17:46:23 GMT -->
</html>
