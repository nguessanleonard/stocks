<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <title>Détail mouvement</title>
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
                    <li class="breadcrumb-item"><a href="{{ route('mouvementsarticles.index') }}">Mouvements articles</a></li>
                    <li class="breadcrumb-item active">Détail</li>
                    @include('layouts.heurelocale')
                </ol>

                <section class="stock-screen">
                    <div class="stock-page-title">
                        <div>
                            <h1>{{ $mouvement->reference }}</h1>
                            <p>{{ \Carbon\Carbon::parse($mouvement->date_mouvement)->format('d/m/Y') }} · {{ $mouvement->type === 'entree' ? 'Entrée' : 'Sortie' }} · #{{ $mouvement->userAdd }} {{ $mouvement->operateur }}</p>
                        </div>
                        <a href="{{ route('mouvementsarticles.index') }}" class="btn btn-secondary">Retour</a>
                    </div>

                    <div class="stock-stat-grid">
                        <article class="stock-stat-card" style="--accent:#2563eb">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Type</p>
                                <span class="stock-stat-icon"><i class="fal fa-exchange"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ $mouvement->type === 'entree' ? 'Entrée' : 'Sortie' }}</p>
                            <span class="stock-stat-note">Nature du mouvement</span>
                        </article>
                        <article class="stock-stat-card" style="--accent:#0f766e">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Lignes</p>
                                <span class="stock-stat-icon"><i class="fal fa-list"></i></span>
                            </div>
                            <p class="stock-stat-value">{{ $details->count() }}</p>
                            <span class="stock-stat-note">Articles concernés</span>
                        </article>
                        <article class="stock-stat-card" style="--accent:#7c3aed">
                            <div class="stock-stat-head">
                                <p class="stock-stat-label">Opérateur</p>
                                <span class="stock-stat-icon"><i class="fal fa-user"></i></span>
                            </div>
                            <p class="stock-stat-value" style="font-size:1.25rem;">#{{ $mouvement->userAdd }}</p>
                            <span class="stock-stat-note">{{ $mouvement->operateur }}</span>
                        </article>
                    </div>

                    <section class="stock-modern-panel">
                        <div class="stock-panel-header">
                            <div>
                                <h2>Détail des articles</h2>
                                <span>{{ $mouvement->observation ?? 'Aucune observation' }}</span>
                            </div>
                        </div>
                        <div class="stock-table-wrap">
                            <table class="table stock-table table-hover w-100">
                                <thead>
                                <tr>
                                    <th>Article</th>
                                    <th>Code</th>
                                    <th>Unité</th>
                                    <th>Quantité enregistrée</th>
                                    <th>Opérateur</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($details as $detail)
                                    <tr>
                                        <td><span class="stock-ref">{{ $detail->article }}</span></td>
                                        <td>{{ $detail->code }}</td>
                                        <td>{{ $detail->unite ?? '-' }}</td>
                                        <td>
                                            <strong class="{{ $detail->quantite > 0 ? 'text-success' : 'text-danger' }}">
                                                {{ number_format($detail->quantite, 0, ',', ' ') }}
                                            </strong>
                                        </td>
                                        <td>#{{ $detail->userAdd }} · {{ $detail->operateur }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="stock-mobile-list">
                            @foreach($details as $detail)
                                <article class="stock-mobile-card">
                                    <div class="stock-mobile-card-head">
                                        <div>
                                            <p class="stock-mobile-card-title">{{ $detail->article }}</p>
                                            <span class="stock-meta">{{ $detail->code }}</span>
                                        </div>
                                        <span class="stock-badge {{ $detail->quantite > 0 ? 'stock-badge-success' : 'stock-badge-warning' }}">
                                            {{ number_format($detail->quantite, 0, ',', ' ') }}
                                        </span>
                                    </div>
                                    <div class="stock-mobile-fields">
                                        <div class="stock-mobile-field"><span>Unité</span><strong>{{ $detail->unite ?? '-' }}</strong></div>
                                        <div class="stock-mobile-field"><span>Quantité</span><strong>{{ number_format($detail->quantite, 0, ',', ' ') }}</strong></div>
                                        <div class="stock-mobile-field"><span>Opérateur</span><strong>#{{ $detail->userAdd }} · {{ $detail->operateur }}</strong></div>
                                    </div>
                                </article>
                            @endforeach
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
</body>
</html>
