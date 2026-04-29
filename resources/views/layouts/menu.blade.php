<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
           data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{asset("assets/img/logo.png")}}" alt="SmartAdmin for PHP" aria-roledescription="logo">
            <span class="page-logo-text mr-1">Gestion</span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>

    <nav id="js-primary-nav" class="primary-nav" role="navigation">

        <!-- INFO USER -->
        <div class="info-card">
            <img src="{{ Auth::user()->photo }}" class="profile-image rounded-circle">
            <div class="info-card-text">
                @auth
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{ Auth::user()->nom }} {{ Auth::user()->prenoms }}
                    </span>
                    <span class="d-inline-block text-truncate text-truncate-sm">
                        {{ Auth::user()->roles->pluck('name')->join(', ') ?: 'Aucun rôle' }}
                    </span>
                @endauth
            </div>
        </div>

        <ul class="nav-menu" id="js-nav-menu">

            {{-- ================= COMPTES ================= --}}
            @php
                $comptesActive = request()->routeIs(['admins.*','roles.*','permissions.*']);
            @endphp

            @canany(['Modification du mot de passe','Utilisateurs','Rôles','Permissions'])
                <li class="{{ $comptesActive ? 'active open' : '' }}">
                    <a href="#">
                        <i class="fal fa-cog"></i>
                        <span>Comptes et permissions</span>
                    </a>

                    <ul>
                        @can('Utilisateurs')
                            <li class="{{ request()->routeIs('admins.*') ? 'active' : '' }}">
                                <a href="{{route('admins.index')}}">Utilisateurs</a>
                            </li>
                        @endcan

                        @can('Rôles')
                            <li class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                                <a href="{{route('roles.index')}}">Rôles</a>
                            </li>
                        @endcan

                        @can('Permissions')
                            <li class="{{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                                <a href="{{route('permissions.index')}}">Permissions</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany


            {{-- ================= ARTICLES ================= --}}
            @php
                $articlesActive = request()->routeIs([
                    'produits.*',
                    'approvisionnements.*',
                    'fournisseurs.*',
                    'produitsprixachats.*'
                ]);
            @endphp

            @canany(['Articles/achats','Produits','Approvisionnements','Fournisseurs','Prix d achat produit'])
                <li class="{{ $articlesActive ? 'active open' : '' }}">
                    <a href="#">
                        <i class="fal fa-info-circle"></i>
                        <span>Articles/achats</span>
                    </a>

                    <ul>
                        @can('Produits')
                            <li class="{{ request()->routeIs('produits.*') ? 'active' : '' }}">
                                <a href="{{route('produits.index')}}">Produits</a>
                            </li>
                        @endcan

                        @can('Approvisionnements')
                            <li class="{{ request()->routeIs('approvisionnements.*') ? 'active' : '' }}">
                                <a href="{{route('approvisionnements.index')}}">Approvisionnements</a>
                            </li>
                        @endcan

                        @can('Fournisseurs')
                            <li class="{{ request()->routeIs('fournisseurs.*') ? 'active' : '' }}">
                                <a href="{{route('fournisseurs.index')}}">Fournisseurs</a>
                            </li>
                        @endcan

                        @can('Prix d achat produit')
                            <li class="{{ request()->routeIs('produitsprixachats.*') ? 'active' : '' }}">
                                <a href="{{route('produitsprixachats.index')}}">Prix d'achat produit</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany


            {{-- ================= VENTES ================= --}}
            @php
                $ventesActive = request()->routeIs([
                    'clients.*',
                    'produitsprixaventes.*',
                    'commandes.*'
                ]);
            @endphp

            @canany(['Commandes/ventes','Clients','Prix de vente produit','Commandes produits'])
                <li class="{{ $ventesActive ? 'active open' : '' }}">
                    <a href="#">
                        <i class="fal fa-tag"></i>
                        <span>Commandes/ventes</span>
                    </a>

                    <ul>
                        @can('Clients')
                            <li class="{{ request()->routeIs('clients.*') ? 'active' : '' }}">
                                <a href="{{route('clients.index')}}">Clients</a>
                            </li>
                        @endcan

                        @can('Prix de vente produit')
                            <li class="{{ request()->routeIs('produitsprixaventes.*') ? 'active' : '' }}">
                                <a href="{{route('produitsprixaventes.index')}}">Prix de vente produit</a>
                            </li>
                        @endcan

                        @can('Commandes produits')
                            <li class="{{ request()->routeIs('commandes.*') ? 'active' : '' }}">
                                <a href="{{route('commandes.index')}}">Commandes produits</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

        </ul>
    </nav>
</aside>
