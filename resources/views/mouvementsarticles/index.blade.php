<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <title>Mouvements articles</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Mouvements articles</a></li>
                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-exchange'></i> Mouvements des articles
                    </h1>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>Mouvement <span class="fw-300"><i>Ajout</i></span></h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                </div>
                            </div>
                            @canany(['Ajouter une entrée d articles','Ajouter une sortie d articles'])
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form id="formAjoutMouvement">
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Type <span class="text-danger">*</span></label>
                                                        <select id="type" name="type" class="form-control select2-4" required>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                                        <input type="date" id="date_mouvement" name="date_mouvement" value="{{ date('Y-m-d') }}" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Référence</label>
                                                        <input type="text" id="reference" name="reference" class="form-control" placeholder="Référence automatique si vide">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Opérateur</label>
                                                        <input type="text" class="form-control" value="#{{ Auth::id() }} - {{ trim((Auth::user()->nom ?? '').' '.(Auth::user()->prenoms ?? '')) ?: Auth::user()->email }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Observation</label>
                                                        <textarea id="observation" name="observation" rows="2" class="form-control" placeholder="Commentaire ou motif du mouvement"></textarea>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h5 class="mb-0">Articles du mouvement</h5>
                                                    <button type="button" id="btnAjouterLigne" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-plus"></i> Ajouter
                                                    </button>
                                                </div>

                                                <div class="table-responsive d-none d-md-block">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Article</th>
                                                            <th>Stock</th>
                                                            <th>Quantité</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="lignesMouvement"></tbody>
                                                    </table>
                                                </div>
                                                <div id="lignesMouvementMobile" class="stock-mobile-list d-md-none" style="display:block; padding:0; background:transparent;"></div>
                                            </div>
                                            <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row justify-content-center align-items-center">
                                                <button class="btn btn-success" type="submit">Enregistrer le mouvement</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endcanany

                            @can('Voir la liste des mouvements d articles')
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div id="panel-1" class="panel stock-table-panel">
                                            <div class="panel-hdr">
                                                <h2>Liste <span class="fw-300"><i>des mouvements</i></span></h2>
                                                <div class="panel-toolbar">
                                                    <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <div class="stock-toolbar">
                                                        <form method="GET" action="{{ route('mouvementsarticles.index') }}">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Type</label>
                                                                    <select name="type" class="form-control">
                                                                        <option value="">Tous</option>
                                                                        <option value="entree" {{ ($filters['type'] ?? '') === 'entree' ? 'selected' : '' }}>Entrée</option>
                                                                        <option value="sortie" {{ ($filters['type'] ?? '') === 'sortie' ? 'selected' : '' }}>Sortie</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label>Date début</label>
                                                                    <input type="date" name="date_debut" value="{{ $filters['date_debut'] ?? '' }}" class="form-control">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label>Date fin</label>
                                                                    <input type="date" name="date_fin" value="{{ $filters['date_fin'] ?? '' }}" class="form-control">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Article</label>
                                                                    <select name="articles_id" class="form-control select2-4">
                                                                        <option value="">Tous les articles</option>
                                                                        @foreach($articles as $article)
                                                                            <option value="{{ $article->id }}" {{ (string)($filters['articles_id'] ?? '') === (string)$article->id ? 'selected' : '' }}>
                                                                                {{ $article->libelle }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label>Référence</label>
                                                                    <input type="text" name="reference" value="{{ $filters['reference'] ?? '' }}" class="form-control" placeholder="Référence">
                                                                </div>
                                                                <div class="col-md-1 d-flex align-items-end">
                                                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="stock-table-wrap">
                                                        <table id="dt-basic-example" class="table stock-table table-hover w-100">
                                                            <thead>
                                                            <tr>
                                                                <th>Référence</th>
                                                                <th>Type</th>
                                                                <th>Date</th>
                                                                <th>Articles</th>
                                                                <th>Lignes</th>
                                                                <th>Quantité</th>
                                                                <th>Opérateur</th>
                                                                <th>Observation</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($mouvements as $mouvement)
                                                                <tr>
                                                                    <td><span class="stock-ref">{{ $mouvement->reference }}</span></td>
                                                                    <td>
                                                                        @if($mouvement->type === 'entree')
                                                                            <span class="stock-badge stock-badge-success"><i class="fas fa-arrow-down"></i> Entrée</span>
                                                                        @else
                                                                            <span class="stock-badge stock-badge-warning"><i class="fas fa-arrow-up"></i> Sortie</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ \Carbon\Carbon::parse($mouvement->date_mouvement)->format('d/m/Y') }}</td>
                                                                    <td>{{ $mouvement->articles }}</td>
                                                                    <td>{{ $mouvement->nombre_lignes }}</td>
                                                                    <td><strong>{{ number_format($mouvement->quantite_totale, 0, ',', ' ') }}</strong></td>
                                                                    <td>#{{ $mouvement->userAdd }} · {{ $mouvement->operateur }}</td>
                                                                    <td>{{ $mouvement->observation }}</td>
                                                                    <td>
                                                                        <div class="stock-action-group">
                                                                            @can('Voir le détail d un mouvement')
                                                                                <a href="{{ route('mouvementsarticles.show', $mouvement->id) }}" class="stock-action-btn" title="Voir">
                                                                                    <i class="fas fa-eye"></i>
                                                                                </a>
                                                                            @endcan
                                                                            @can('Supprimer ou annuler un mouvement')
                                                                                <a href="#" class="stock-action-btn stock-action-danger SuppressionMouvement"
                                                                                   data-id="{{ $mouvement->id }}"
                                                                                   data-reference="{{ $mouvement->reference }}"
                                                                                   title="Annuler">
                                                                                    <i class="fas fa-ban"></i>
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="stock-mobile-list">
                                                        @forelse($mouvements as $mouvement)
                                                            <article class="stock-mobile-card">
                                                                <div class="stock-mobile-card-head">
                                                                    <div>
                                                                        <p class="stock-mobile-card-title">{{ $mouvement->reference }}</p>
                                                                        <span class="stock-meta">{{ \Carbon\Carbon::parse($mouvement->date_mouvement)->format('d/m/Y') }}</span>
                                                                    </div>
                                                                    @if($mouvement->type === 'entree')
                                                                        <span class="stock-badge stock-badge-success"><i class="fas fa-arrow-down"></i> Entrée</span>
                                                                    @else
                                                                        <span class="stock-badge stock-badge-warning"><i class="fas fa-arrow-up"></i> Sortie</span>
                                                                    @endif
                                                                </div>
                                                                <div class="stock-mobile-fields">
                                                                    <div class="stock-mobile-field"><span>Articles</span><strong>{{ $mouvement->articles }}</strong></div>
                                                                    <div class="stock-mobile-field"><span>Lignes</span><strong>{{ $mouvement->nombre_lignes }}</strong></div>
                                                                    <div class="stock-mobile-field"><span>Quantité</span><strong>{{ number_format($mouvement->quantite_totale, 0, ',', ' ') }}</strong></div>
                                                                    <div class="stock-mobile-field"><span>Opérateur</span><strong>#{{ $mouvement->userAdd }} · {{ $mouvement->operateur }}</strong></div>
                                                                    <div class="stock-mobile-field"><span>Observation</span><strong>{{ $mouvement->observation ?? '-' }}</strong></div>
                                                                </div>
                                                                <div class="stock-mobile-actions">
                                                                    @can('Voir le détail d un mouvement')
                                                                        <a href="{{ route('mouvementsarticles.show', $mouvement->id) }}" class="stock-action-btn" title="Voir">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    @endcan
                                                                    @can('Supprimer ou annuler un mouvement')
                                                                        <a href="#" class="stock-action-btn stock-action-danger SuppressionMouvement"
                                                                           data-id="{{ $mouvement->id }}"
                                                                           data-reference="{{ $mouvement->reference }}"
                                                                           title="Annuler">
                                                                            <i class="fas fa-ban"></i>
                                                                        </a>
                                                                    @endcan
                                                                </div>
                                                            </article>
                                                        @empty
                                                            <div class="text-muted">Aucun mouvement trouvé.</div>
                                                        @endforelse
                                                    </div>
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
    const articlesDisponibles = @json($articles);

    $(document).ready(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        let synchronisationArticle = false;

        initSelect2(document);
        ajouterLigne();

        $('#btnAjouterLigne').on('click', function () {
            ajouterLigne();
        });

        $(document).on('click', '.btnRetirerLigne', function () {
            const uid = $(this).data('uid');
            $('[data-row="' + uid + '"]').remove();
            updateArticleSelectOptions();
        });

        $(document).on('change', '.article-select', function () {
            if (synchronisationArticle) {
                return;
            }

            const uid = $(this).data('uid');
            let stock = $(this).find(':selected').data('stock') || 0;
            const value = $(this).val();

            if (value && getSelectedArticles(uid).includes(value)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Article déjà sélectionné',
                    text: 'Cet article est déjà présent sur une autre ligne du mouvement.'
                });

                stock = 0;
                synchronisationArticle = true;
                $('.article-select[data-uid="' + uid + '"]').val('').trigger('change.select2');
                synchronisationArticle = false;
                $('.stock-ligne[data-uid="' + uid + '"]').text(stock);
                updateArticleSelectOptions();
                return;
            }

            synchronisationArticle = true;
            $('.article-select[data-uid="' + uid + '"]').val(value).trigger('change.select2');
            synchronisationArticle = false;
            $('.stock-ligne[data-uid="' + uid + '"]').text(stock);
            updateArticleSelectOptions();
        });

        $(document).on('input', '.quantite-ligne', function () {
            const uid = $(this).data('uid');
            $('.quantite-ligne[data-uid="' + uid + '"]').val($(this).val());
        });

        $('#formAjoutMouvement').on('submit', function (e) {
            e.preventDefault();

            let produits = [];
            let valide = true;
            let type = $('#type').val();
            let articlesSelectionnes = [];

            $('.ligne-form:visible').each(function () {
                let article = $(this).find('.article-select').val();
                let quantite = parseInt($(this).find('.quantite-ligne').val() || 0);
                let stock = parseInt($(this).find('.article-select option:selected').data('stock') || 0);

                if (!article || quantite <= 0) {
                    valide = false;
                }

                if (article && articlesSelectionnes.includes(article)) {
                    valide = false;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Article en double',
                        text: 'Un même article ne peut pas être présent sur plusieurs lignes.'
                    });
                    return false;
                }

                if (type === 'sortie' && quantite > stock) {
                    valide = false;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Stock insuffisant',
                        text: 'Une quantité demandée dépasse le stock disponible.'
                    });
                    return false;
                }

                if (article) {
                    articlesSelectionnes.push(article);
                }

                produits.push({
                    articles_id: article,
                    quantite: quantite
                });
            });

            if (!type) {
                Swal.fire({icon: 'warning', title: 'Veuillez sélectionner le type de mouvement'});
                return;
            }

            if (!valide || produits.length === 0) {
                Swal.fire({icon: 'warning', title: 'Veuillez renseigner correctement les articles'});
                return;
            }

            $.ajax({
                url: "{{ route('mouvementsarticles.ajouter') }}",
                type: "POST",
                data: {
                    type: type,
                    date_mouvement: $('#date_mouvement').val(),
                    reference: $('#reference').val(),
                    observation: $('#observation').val(),
                    articles: produits
                },
                success: function () {
                    Swal.fire({icon: 'success', title: 'Enregistré avec succès'}).then(() => {
                        window.location = "{{ route('mouvementsarticles.index') }}";
                    });
                },
                error: function (xhr) {
                    afficherErreur(xhr);
                }
            });
        });

        $.ajax({
            url: "{{ route('mouvement.liste') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let selectAjout = $('#type');

                selectAjout.empty().append('<option value="">Sélectionnez le type d opération</option>');

                $.each(data, function (key, value) {
                    selectAjout.append('<option value="' + value.id + '">' + value.libelle + '</option>');

                });

                selectAjout.trigger('change.select2');
            },
            error: function () {
                console.error("Erreur lors du chargement des Clients.");
            }
        });

        $(document).on('click', '.SuppressionMouvement', function (e) {
            e.preventDefault();

            let id = $(this).data('id');
            let reference = $(this).data('reference');

            Swal.fire({
                title: "Voulez-vous annuler ce mouvement ?",
                text: reference,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, confirmer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: "{{ route('mouvementsarticles.confirmer-suppression') }}",
                    type: "POST",
                    data: {id: id},
                    success: function (response) {
                        Toast.fire({icon: 'success', text: response.success}).then(() => {
                            window.location = "{{ route('mouvementsarticles.index') }}";
                        });
                    },
                    error: function (xhr) {
                        afficherErreur(xhr);
                    }
                });
            });
        });

        function ajouterLigne() {
            const uid = Date.now() + Math.floor(Math.random() * 1000);
            const options = articlesDisponibles.map(function (article) {
                return `<option value="${article.id}" data-stock="${article.stock}">${article.libelle} (${article.code})</option>`;
            }).join('');

            const desktop = `
                <tr class="ligne-form" data-row="${uid}">
                    <td>
                        <select class="form-control select2-4 article-select" data-uid="${uid}" required>
                            <option value="">Sélectionnez l'article</option>
                            ${options}
                        </select>
                    </td>
                    <td><span class="stock-ligne" data-uid="${uid}">0</span></td>
                    <td><input type="number" min="1" value="1" class="form-control quantite-ligne" data-uid="${uid}" required></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger btnRetirerLigne" data-uid="${uid}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            const mobile = `
                <article class="stock-mobile-card ligne-form" data-row="${uid}">
                    <div class="stock-mobile-fields">
                        <div class="stock-mobile-field">
                            <span>Article</span>
                            <select class="form-control select2-4 article-select" data-uid="${uid}" required>
                                <option value="">Sélectionnez l'article</option>
                                ${options}
                            </select>
                        </div>
                        <div class="stock-mobile-field"><span>Stock</span><strong class="stock-ligne" data-uid="${uid}">0</strong></div>
                        <div class="stock-mobile-field">
                            <span>Quantité</span>
                            <input type="number" min="1" value="1" class="form-control quantite-ligne" data-uid="${uid}" required>
                        </div>
                    </div>
                    <div class="stock-mobile-actions">
                        <button type="button" class="stock-action-btn stock-action-danger btnRetirerLigne" data-uid="${uid}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </article>
            `;

            $('#lignesMouvement').append(desktop);
            $('#lignesMouvementMobile').append(mobile);
            initSelect2($('[data-row="' + uid + '"] .article-select'));
            updateArticleSelectOptions();
        }

        function initSelect2(scope) {
            if (!$.fn.select2) {
                return;
            }

            const $scope = scope && scope.jquery ? scope : $(scope);
            const $selects = $scope.is('select') ? $scope : $scope.find('select.select2-4');

            $selects.each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    return;
                }

                $(this).select2({
                    width: '100%',
                    placeholder: $(this).find('option:first').text(),
                    allowClear: true
                });
            });
        }

        function getSelectedArticles(uidIgnore) {
            const selected = [];
            const lignesTraitees = {};
            const uidIgnoreText = uidIgnore ? String(uidIgnore) : null;

            $('.article-select').each(function () {
                const uid = String($(this).data('uid'));

                if (lignesTraitees[uid] || uid === uidIgnoreText) {
                    return;
                }

                const value = $(this).val();

                if (value) {
                    selected.push(value);
                }

                lignesTraitees[uid] = true;
            });

            return selected;
        }

        function updateArticleSelectOptions() {
            $('.article-select').each(function () {
                const $select = $(this);
                const uid = String($select.data('uid'));
                const selected = getSelectedArticles(uid);

                $select.find('option').prop('disabled', false);

                selected.forEach(function (value) {
                    $select.find('option[value="' + value + '"]').prop('disabled', true);
                });

                $select.trigger('change.select2');
            });
        }

        function afficherErreur(xhr) {
            let message = "Une erreur est survenue";

            if (xhr.status === 422 && xhr.responseJSON?.errors) {
                if (typeof xhr.responseJSON.errors === 'object') {
                    message = Object.values(xhr.responseJSON.errors)
                        .map(err => Array.isArray(err) ? err.join('<br>') : err)
                        .join('<br>');
                } else {
                    message = xhr.responseJSON.errors;
                }
            } else if (xhr.responseJSON?.error) {
                message = xhr.responseJSON.error;
            }

            Swal.fire({icon: 'error', title: 'Erreur', html: message});
        }

        $('#dt-basic-example').dataTable({
            responsive: true,
            lengthChange: false,
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {extend: 'colvis', text: 'Colonne visible', titleAttr: 'Col visibility', className: 'mr-sm-3'},
                {extend: 'pdfHtml5', text: 'PDF', titleAttr: 'Generate PDF', className: 'btn-outline-danger btn-sm mr-1'},
                {extend: 'excelHtml5', text: 'Excel', titleAttr: 'Generate Excel', className: 'btn-outline-success btn-sm mr-1'},
                {extend: 'copyHtml5', text: 'Copy', titleAttr: 'Copy to clipboard', className: 'btn-outline-primary btn-sm mr-1'},
                {extend: 'print', text: 'Print', titleAttr: 'Print Table', className: 'btn-outline-primary btn-sm'}
            ]
        });
    });
</script>
</body>
</html>
