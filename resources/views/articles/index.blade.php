<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <title>Articles</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Articles</a></li>
                    @include('layouts.heurelocale')
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-box'></i> Articles magasin
                    </h1>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div id="panel-5" class="panel">
                            <div class="panel-hdr">
                                <h2>Articles <span class="fw-300"><i>Ajout</i></span></h2>
                                <div class="panel-toolbar">
                                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                </div>
                            </div>
                            @can('Ajouter un article')
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form class="needs-validation" id="formAjoutArticle">
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Libellé <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Entrez le libellé de l'article" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Code <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="code" name="code" placeholder="Entrez le code de l'article" required>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" id="description" name="description" rows="2" placeholder="Description de l'article"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row justify-content-center align-items-center">
                                                <button class="btn btn-primary" type="submit">Valider</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endcan

                            @can('Voir la liste des articles')
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div id="panel-1" class="panel stock-table-panel">
                                            <div class="panel-hdr">
                                                <h2>Liste <span class="fw-300"><i>des articles</i></span></h2>
                                                <div class="panel-toolbar">
                                                    <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                                </div>
                                            </div>
                                            <div class="panel-container show">
                                                <div class="panel-content">
                                                    <div class="stock-table-wrap">
                                                        <table id="dt-basic-example" class="table stock-table table-hover w-100">
                                                            <thead>
                                                            <tr>
                                                                <th>N°</th>
                                                                <th>Article</th>
                                                                <th>Code</th>
                                                                <th>Unité</th>
                                                                <th>Stock</th>
                                                                <th>Statut</th>
                                                                <th>Description</th>
                                                                @canany(['Modifier un article','Supprimer un article'])
                                                                    <th>Actions</th>
                                                                @endcanany
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php $i = 1; @endphp
                                                            @foreach($articles as $article)
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    <td><span class="stock-ref">{{ $article->libelle }}</span></td>
                                                                    <td>{{ $article->code }}</td>
                                                                    <td>{{ $article->unite ?? '-' }}</td>
                                                                    <td><strong>{{ number_format($article->stock, 0, ',', ' ') }}</strong></td>
                                                                    <td>
                                                                        @if($article->stock <= 0)
                                                                            <span class="stock-badge stock-badge-danger"><i class="fas fa-times-circle"></i> Rupture</span>
                                                                        @elseif($article->stock <= $article->stock_minimum)
                                                                            <span class="stock-badge stock-badge-warning"><i class="fas fa-exclamation-triangle"></i> Alerte</span>
                                                                        @else
                                                                            <span class="stock-badge stock-badge-success"><i class="fas fa-check-circle"></i> Disponible</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $article->description }}</td>
                                                                    @canany(['Modifier un article','Supprimer un article'])
                                                                        <td>
                                                                            <div class="stock-action-group">
                                                                                @can('Modifier un article')
                                                                                    <a href="#" class="stock-action-btn btnModifierArticle"
                                                                                       data-id="{{ $article->id }}"
                                                                                       data-libelle="{{ $article->libelle }}"
                                                                                       data-code="{{ $article->code }}"

                                                                                       data-description="{{ $article->description }}"
                                                                                       title="Modifier">
                                                                                        <i class="fas fa-pencil-alt"></i>
                                                                                    </a>
                                                                                @endcan
                                                                                @can('Supprimer un article')
                                                                                    <a href="#" class="stock-action-btn stock-action-danger SuppressionArticle"
                                                                                       data-id="{{ $article->id }}"
                                                                                       data-libelle="{{ $article->libelle }}"
                                                                                       title="Supprimer">
                                                                                        <i class="fas fa-trash-alt"></i>
                                                                                    </a>
                                                                                @endcan
                                                                            </div>
                                                                        </td>
                                                                    @endcanany
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="stock-mobile-list">
                                                        @forelse($articles as $article)
                                                            <article class="stock-mobile-card">
                                                                <div class="stock-mobile-card-head">
                                                                    <div>
                                                                        <p class="stock-mobile-card-title">{{ $article->libelle }}</p>
                                                                        <span class="stock-meta">{{ $article->code }}</span>
                                                                    </div>
                                                                    @if($article->stock <= 0)
                                                                        <span class="stock-badge stock-badge-danger"><i class="fas fa-times-circle"></i> Rupture</span>
                                                                    @elseif($article->stock <= $article->stock_minimum)
                                                                        <span class="stock-badge stock-badge-warning"><i class="fas fa-exclamation-triangle"></i> Alerte</span>
                                                                    @else
                                                                        <span class="stock-badge stock-badge-success"><i class="fas fa-check-circle"></i> Disponible</span>
                                                                    @endif
                                                                </div>
                                                                <div class="stock-mobile-fields">
                                                                    <div class="stock-mobile-field"><span>Stock</span><strong>{{ number_format($article->stock, 0, ',', ' ') }}</strong></div>
                                                                    <div class="stock-mobile-field"><span>Unité</span><strong>{{ $article->unite ?? '-' }}</strong></div>
                                                                    <div class="stock-mobile-field"><span>Stock minimum</span><strong>{{ number_format($article->stock_minimum, 0, ',', ' ') }}</strong></div>
                                                                    <div class="stock-mobile-field"><span>Description</span><strong>{{ $article->description ?? '-' }}</strong></div>
                                                                </div>
                                                                @canany(['Modifier un article','Supprimer un article'])
                                                                    <div class="stock-mobile-actions">
                                                                        @can('Modifier un article')
                                                                            <a href="#" class="stock-action-btn btnModifierArticle"
                                                                               data-id="{{ $article->id }}"
                                                                               data-libelle="{{ $article->libelle }}"
                                                                               data-code="{{ $article->code }}"

                                                                               data-description="{{ $article->description }}"
                                                                               title="Modifier">
                                                                                <i class="fas fa-pencil-alt"></i>
                                                                            </a>
                                                                        @endcan
                                                                        @can('Supprimer un article')
                                                                            <a href="#" class="stock-action-btn stock-action-danger SuppressionArticle"
                                                                               data-id="{{ $article->id }}"
                                                                               data-libelle="{{ $article->libelle }}"
                                                                               title="Supprimer">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                @endcanany
                                                            </article>
                                                        @empty
                                                            <div class="text-muted">Aucun article trouvé.</div>
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

<div class="modal fade" id="modalModifierArticle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formModifierArticle">
                @csrf
                <input type="hidden" name="articles_id" id="articles_id">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier l'article</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" id="libelle_modif" name="libelle" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" id="code_modif" name="code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Unité</label>
                        <input type="text" id="unite_modif" name="unite" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Stock minimum</label>
                        <input type="number" min="0" id="stock_minimum_modif" name="stock_minimum" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="description_modif" name="description" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.menuimpression')
@include('layouts.messages')
@include('layouts.parametres')
@include('layouts.js')
@include('layouts.calendar')

<script>
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

        $("#formAjoutArticle").on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('articles.ajouter') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    Toast.fire({icon: 'success', text: response.success}).then(() => {
                        window.location = "{{ route('articles.index') }}";
                    });
                },
                error: function (xhr) {
                    afficherErreur(xhr);
                }
            });
        });

        $(document).on('click', '.btnModifierArticle', function (e) {
            e.preventDefault();

            $('#articles_id').val($(this).data('id'));
            $('#libelle_modif').val($(this).data('libelle'));
            $('#code_modif').val($(this).data('code'));
            $('#unite_modif').val($(this).data('unite'));
            $('#stock_minimum_modif').val($(this).data('stock-minimum'));
            $('#description_modif').val($(this).data('description'));
            $('#modalModifierArticle').modal('show');
        });

        $('#formModifierArticle').on('submit', function (e) {
            e.preventDefault();

            let id = $('#articles_id').val();
            let formData = $(this).serialize() + '&_method=PUT';

            $.ajax({
                url: 'articles/modification/' + id,
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#modalModifierArticle').modal('hide');
                    Toast.fire({icon: 'success', text: response.success}).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    afficherErreur(xhr);
                }
            });
        });

        $(document).on('click', '.SuppressionArticle', function (e) {
            e.preventDefault();

            let id = $(this).data('id');
            let libelle = $(this).data('libelle');

            Swal.fire({
                title: "Voulez-vous supprimer",
                text: libelle + " ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, confirmer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: "{{ route('articles.confirmer-suppression') }}",
                    type: "POST",
                    data: {id: id},
                    success: function (response) {
                        Toast.fire({icon: 'success', text: response.success}).then(() => {
                            window.location = "{{ route('articles.index') }}";
                        });
                    },
                    error: function (xhr) {
                        afficherErreur(xhr);
                    }
                });
            });
        });

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
