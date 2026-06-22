<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <title>Tableau de bord articles</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.headermeta')
    @include('layouts.css')
</head>
<body class="mod-bg-1 ">
@include('layouts.jsparametres')
<div class="page-wrapper">
    <div class="page-inner">
        @include('layouts.menu')
        <div class="page-content-wrapper">
            @include('layouts.header')
            <main id="js-page-content" role="main" class="page-content">
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tableau de bord articles</a></li>
                    @include('layouts.heurelocale')
                </ol>

                <section class="stock-screen">
                    <div class="stock-page-title">
                        <div>
                            <h1>Tableau de bord articles</h1>
                            <p>{{ \Carbon\Carbon::parse($periode['date_debut'])->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($periode['date_fin'])->format('d/m/Y') }} · Vue dédiée aux stocks articles</p>
                        </div>
                        <div class="stock-action-group">
                            <a href="{{ route('articles.index') }}" class="stock-action-btn" title="Articles">
                                <i class="fas fa-box"></i>
                            </a>
                            <a href="{{ route('mouvementsarticles.index') }}" class="stock-action-btn" title="Mouvements">
                                <i class="fas fa-exchange-alt"></i>
                            </a>
                        </div>
                    </div>

                    <section class="stock-modern-panel mb-3">
                        <form method="GET" action="{{ route('tableaudebord.articles') }}">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Date début</label>
                                    <input type="date" name="date_debut" value="{{ $periode['date_debut'] }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Date fin</label>
                                    <input type="date" name="date_fin" value="{{ $periode['date_fin'] }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                                </div>
                            </div>
                        </form>
                    </section>

                    <div class="stock-stat-grid">
                        <article class="stock-stat-card" style="--accent:#2563eb">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Articles</p>
                                <span class="stock-stat-icon"><i class="fal fa-box"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ number_format($statistiques['totalArticles'], 0, ',', ' ') }}</p>
                            <span class="stock-stat-note">Références magasin</span>
                        </article>
                        <article class="stock-stat-card" style="--accent:#0f766e">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Stock articles</p>
                                <span class="stock-stat-icon"><i class="fal fa-warehouse"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ number_format($statistiques['stockDisponible'], 0, ',', ' ') }}</p>
                            <span class="stock-stat-note">Unités disponibles</span>
                        </article>
                        <article class="stock-stat-card" style="--accent:#d97706">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Alertes</p>
                                <span class="stock-stat-icon"><i class="fal fa-exclamation-triangle"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ number_format($statistiques['articlesAlerte'], 0, ',', ' ') }}</p>
                            <span class="stock-stat-note">Stock minimum atteint</span>
                        </article>
                        <article class="stock-stat-card" style="--accent:#b91c1c">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Ruptures</p>
                                <span class="stock-stat-icon"><i class="fal fa-times-circle"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ number_format($statistiques['articlesRupture'], 0, ',', ' ') }}</p>
                            <span class="stock-stat-note">Stock nul ou négatif</span>
                        </article>
                    </div>

                    <div class="stock-stat-grid">
                        <article class="stock-stat-card" style="--accent:#16a34a">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Entrées</p>
                                <span class="stock-stat-icon"><i class="fal fa-arrow-down"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ number_format($statistiques['entreesPeriode'], 0, ',', ' ') }}</p>
                            <span class="stock-stat-note">Unités entrées sur la période</span>
                        </article>
                        <article class="stock-stat-card" style="--accent:#ea580c">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Sorties</p>
                                <span class="stock-stat-icon"><i class="fal fa-arrow-up"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ number_format($statistiques['sortiesPeriode'], 0, ',', ' ') }}</p>
                            <span class="stock-stat-note">Unités sorties sur la période</span>
                        </article>
                        <article class="stock-stat-card" style="--accent:#7c3aed">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Mouvements</p>
                                <span class="stock-stat-icon"><i class="fal fa-exchange"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ number_format($statistiques['mouvementsPeriode'], 0, ',', ' ') }}</p>
                            <span class="stock-stat-note">Opérations enregistrées</span>
                        </article>
                        <article class="stock-stat-card" style="--accent:#0891b2">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Solde période</p>
                                <span class="stock-stat-icon"><i class="fal fa-balance-scale"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ number_format($statistiques['entreesPeriode'] - $statistiques['sortiesPeriode'], 0, ',', ' ') }}</p>
                            <span class="stock-stat-note">Entrées moins sorties</span>
                        </article>
                    </div>

                    <div class="stock-dashboard-grid">
                        <section class="stock-modern-panel">
                            <div class="stock-panel-header">
                                <div>
                                    <h2>Entrées et sorties</h2>
                                    <span>Évolution journalière des articles</span>
                                </div>
                            </div>
                            <div id="articlesFlowChart" class="stock-chart"></div>
                        </section>

                        <section class="stock-modern-panel">
                            <div class="stock-panel-header">
                                <div>
                                    <h2>Articles à suivre</h2>
                                    <span>Stock proche du minimum</span>
                                </div>
                            </div>
                            <div class="stock-activity-list">
                                @forelse($articlesCritiques as $article)
                                    <div class="stock-list-card">
                                        <div class="stock-list-title">
                                            <strong>{{ $article->libelle }}</strong>
                                            @if($article->stock <= 0)
                                                <span class="stock-badge stock-badge-danger">Rupture</span>
                                            @elseif($article->stock <= $article->stock_minimum)
                                                <span class="stock-badge stock-badge-warning">Alerte</span>
                                            @else
                                                <span class="stock-badge stock-badge-success">Disponible</span>
                                            @endif
                                        </div>
                                        <div class="stock-meta">{{ $article->code }} · Minimum {{ number_format($article->stock_minimum, 0, ',', ' ') }}</div>
                                        <div class="stock-list-amount">{{ number_format($article->stock, 0, ',', ' ') }} unité(s)</div>
                                    </div>
                                @empty
                                    <div class="text-muted">Aucun article enregistré.</div>
                                @endforelse
                            </div>
                        </section>
                    </div>

                    <div class="stock-dashboard-grid">
                        <section class="stock-modern-panel">
                            <div class="stock-panel-header">
                                <div>
                                    <h2>Stock le plus élevé</h2>
                                    <span>Répartition actuelle des articles</span>
                                </div>
                            </div>
                            <div id="stockProgressContainer"></div>
                        </section>

                        <section class="stock-modern-panel">
                            <div class="stock-panel-header">
                                <div>
                                    <h2>Articles les plus mouvementés</h2>
                                    <span>Entrées et sorties sur la période</span>
                                </div>
                            </div>
                            <div class="stock-activity-list">
                                <div class="stock-list-card">
                                    <div class="stock-list-title">
                                        <strong>Sorties</strong>
                                        <span>{{ $topSorties->count() }} article(s)</span>
                                    </div>
                                    @forelse($topSorties as $sortie)
                                        <div class="stock-meta">{{ $sortie->article }} · {{ number_format($sortie->quantite, 0, ',', ' ') }}</div>
                                    @empty
                                        <div class="text-muted">Aucune sortie sur cette période.</div>
                                    @endforelse
                                </div>
                                <div class="stock-list-card">
                                    <div class="stock-list-title">
                                        <strong>Entrées</strong>
                                        <span>{{ $topEntrees->count() }} article(s)</span>
                                    </div>
                                    @forelse($topEntrees as $entree)
                                        <div class="stock-meta">{{ $entree->article }} · {{ number_format($entree->quantite, 0, ',', ' ') }}</div>
                                    @empty
                                        <div class="text-muted">Aucune entrée sur cette période.</div>
                                    @endforelse
                                </div>
                            </div>
                        </section>
                    </div>

                    <section class="stock-modern-panel">
                        <div class="stock-panel-header">
                            <div>
                                <h2>Dernières opérations articles</h2>
                                <span>Avec identifiant de l'opérateur</span>
                            </div>
                        </div>
                        <div class="stock-table-wrap">
                            <table class="table stock-table table-hover w-100">
                                <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Article</th>
                                    <th>Quantité</th>
                                    <th>Opérateur</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($dernieresOperations as $operation)
                                    <tr>
                                        <td><span class="stock-ref">{{ $operation->reference }}</span></td>
                                        <td>
                                            @if($operation->type === 'entree')
                                                <span class="stock-badge stock-badge-success">Entrée</span>
                                            @else
                                                <span class="stock-badge stock-badge-warning">Sortie</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($operation->date_mouvement)->format('d/m/Y') }}</td>
                                        <td>{{ $operation->article }} <span class="stock-meta">({{ $operation->code }})</span></td>
                                        <td><strong>{{ number_format($operation->quantite, 0, ',', ' ') }}</strong></td>
                                        <td>#{{ $operation->userAdd }} · {{ $operation->operateur }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-muted">Aucune opération sur cette période.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="stock-mobile-list">
                            @forelse($dernieresOperations as $operation)
                                <article class="stock-mobile-card">
                                    <div class="stock-mobile-card-head">
                                        <div>
                                            <p class="stock-mobile-card-title">{{ $operation->article }}</p>
                                            <span class="stock-meta">{{ $operation->reference }} · {{ \Carbon\Carbon::parse($operation->date_mouvement)->format('d/m/Y') }}</span>
                                        </div>
                                        @if($operation->type === 'entree')
                                            <span class="stock-badge stock-badge-success">Entrée</span>
                                        @else
                                            <span class="stock-badge stock-badge-warning">Sortie</span>
                                        @endif
                                    </div>
                                    <div class="stock-mobile-fields">
                                        <div class="stock-mobile-field"><span>Quantité</span><strong>{{ number_format($operation->quantite, 0, ',', ' ') }}</strong></div>
                                        <div class="stock-mobile-field"><span>Opérateur</span><strong>#{{ $operation->userAdd }} · {{ $operation->operateur }}</strong></div>
                                    </div>
                                </article>
                            @empty
                                <div class="text-muted">Aucune opération sur cette période.</div>
                            @endforelse
                        </div>
                    </section>
                </section>
            </main>
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
            @include('layouts.footer')
            @include('layouts.opacite')
        </div>
    </div>
</div>

@include('layouts.menuimpression')
@include('layouts.messages')
@include('layouts.parametres')
@include('layouts.js')
@include('layouts.calendar')

<script>
    var chartEntrees = @json($chartEntrees);
    var chartSorties = @json($chartSorties);
    var chartLabels = @json($chartLabels);
    var repartitionStock = @json($repartitionStock);

    $(function () {
        if (chartEntrees.length > 0 || chartSorties.length > 0) {
            $.plot('#articlesFlowChart', [
                {
                    label: 'Entrées',
                    data: chartEntrees,
                    lines: {show: true, lineWidth: 2},
                    points: {show: true},
                    color: '#16a34a'
                },
                {
                    label: 'Sorties',
                    data: chartSorties,
                    lines: {show: true, lineWidth: 2},
                    points: {show: true},
                    color: '#ea580c'
                }
            ], {
                grid: {
                    hoverable: true,
                    clickable: true,
                    borderWidth: 1,
                    borderColor: '#eee'
                },
                legend: {
                    position: 'nw'
                },
                xaxis: {
                    tickDecimals: 0,
                    tickFormatter: function (value) {
                        return chartLabels[Math.round(value)] || '';
                    }
                },
                yaxis: {
                    min: 0,
                    tickDecimals: 0
                }
            });
        } else {
            $('#articlesFlowChart').html("<div class='text-muted'>Aucune donnée disponible</div>");
        }

        var maxStock = 0;
        var html = '';

        repartitionStock.forEach(function (item) {
            maxStock = Math.max(maxStock, parseInt(item.stock || 0));
        });

        if (!repartitionStock.length) {
            html = "<div class='text-muted'>Aucun stock disponible</div>";
        } else {
            repartitionStock.forEach(function (item, index) {
                var stock = parseInt(item.stock || 0);
                var pourcentage = maxStock > 0 ? (stock / maxStock) * 100 : 0;
                var colors = ['bg-primary', 'bg-success-500', 'bg-info-500', 'bg-warning-500', 'bg-danger-500', 'bg-fusion-500'];

                html += `
                    <div class="d-flex mt-2 mb-1 fs-xs text-primary">
                        ${item.article} (${stock.toLocaleString()} unité(s))
                    </div>
                    <div class="progress progress-xs mb-3">
                        <div class="progress-bar ${colors[index % colors.length]}"
                             role="progressbar"
                             style="width: ${pourcentage.toFixed(2)}%;">
                        </div>
                    </div>
                `;
            });
        }

        $('#stockProgressContainer').html(html);
    });
</script>
</body>
</html>
