<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
           data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{asset("assets/img/logo.png")}}" alt="SmartAdmin for PHP" aria-roledescription="logo">
            <span class="page-logo-text mr-1">SmartAdmin for PHP</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->

    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                   data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{{asset("assets/img/demo/avatars/avatar-admin.png")}}" class="profile-image rounded-circle"
                 alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        Dr. Codex Lantern
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Toronto, Canada</span>
            </div>
            <img src="{{asset("assets/img/card-backgrounds/cover-4-lg.png")}}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
               data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>

        <ul class="nav-menu" id="js-nav-menu">

            <li class="active open">

                <a href="#" title="Application Intel" class=" " data-filter-tags="application intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">Application Intel</span>
                </a>

                <ul>

                    <li class="active">

                        <a href="#" title="Analytics Dashboard" class=" "
                           data-filter-tags="application intel analytics dashboard">

                            <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">Analytics Dashboard</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Marketing Dashboard" class=" "
                           data-filter-tags="application intel marketing dashboard">

                            <span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard">Marketing Dashboard</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Introduction" class=" " data-filter-tags="application intel introduction">

                            <span class="nav-link-text"
                                  data-i18n="nav.application_intel_introduction">Introduction</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Privacy" class=" " data-filter-tags="application intel privacy">

                            <span class="nav-link-text" data-i18n="nav.application_intel_privacy">Privacy</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Build Notes" class=" " data-filter-tags="application intel build notes">

                            <span class="nav-link-text" data-i18n="nav.application_intel_build_notes">Build Notes</span><span
                                class="">v4.0.3</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Theme Settings" class=" " data-filter-tags="theme settings">
                    <i class="fal fa-cog"></i>
                    <span class="nav-link-text" data-i18n="nav.theme_settings">Theme Settings</span>
                </a>

                <ul>

                    <li>

                        <a href="" title="How it works" class=" " data-filter-tags="theme settings how it works">

                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">How it works</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Layout Options" class=" " data-filter-tags="theme settings layout options">

                            <span class="nav-link-text"
                                  data-i18n="nav.theme_settings_layout_options">Layout Options</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Skin Options" class=" " data-filter-tags="theme settings skin options">

                            <span class="nav-link-text" data-i18n="nav.theme_settings_skin_options">Skin Options</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Saving to Database" class=" "
                           data-filter-tags="theme settings saving to database">

                            <span class="nav-link-text" data-i18n="nav.theme_settings_saving_to_database">Saving to Database</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Package Info" class=" " data-filter-tags="package info">
                    <i class="fal fa-tag"></i>
                    <span class="nav-link-text" data-i18n="nav.package_info">Package Info</span>
                </a>

                <ul>

                    <li>

                        <a href="#" title="Documentation" class=" " data-filter-tags="package info documentation">

                            <span class="nav-link-text" data-i18n="nav.package_info_documentation">Documentation</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Product Licensing" class=" "
                           data-filter-tags="package info product licensing">

                            <span class="nav-link-text"
                                  data-i18n="nav.package_info_product_licensing">Product Licensing</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Different Flavors" class=" "
                           data-filter-tags="package info different flavors">

                            <span class="nav-link-text"
                                  data-i18n="nav.package_info_different_flavors">Different Flavors</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li class="nav-title">
                PHP Features
            </li>
            <li>

                <a href="#" title="Components" class=" " data-filter-tags="components">
                    <i class="fal fa-wrench"></i>
                    <span class="nav-link-text" data-i18n="nav.components">Components</span>
                </a>

                <ul>

                    <li>

                        <a href="#" title="Utilities" class=" " data-filter-tags="components utilities">

                            <span class="nav-link-text" data-i18n="nav.components_utilities">Utilities</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Navigation" class=" " data-filter-tags="components navigation">

                            <span class="nav-link-text" data-i18n="nav.components_navigation">Navigation</span>
                        </a>


                    </li>
                    <li>

                        <a href="php_tables.html" title="Tables" class=" " data-filter-tags="components tables">

                            <span class="nav-link-text" data-i18n="nav.components_tables">Tables</span>
                        </a>


                    </li>
                    <li>

                        <a href="php_panels.html" title="Panels" class=" " data-filter-tags="components panels">

                            <span class="nav-link-text" data-i18n="nav.components_panels">Panels</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Authentication" class=" " data-filter-tags="authentication">
                    <i class="fal fa-lock"></i>
                    <span class="nav-link-text" data-i18n="nav.authentication">Authentication</span>
                </a>

                <ul>

                    <li>

                        <a href="php_auth_docs.html" title="Documentation" class=" "
                           data-filter-tags="authentication documentation">

                            <span class="nav-link-text"
                                  data-i18n="nav.authentication_documentation">Documentation</span>
                        </a>


                    </li>
                    <li>

                        <a href="php_auth_page.html" title="Authenticate Page" class=" "
                           data-filter-tags="authentication authenticate page">

                            <span class="nav-link-text" data-i18n="nav.authentication_authenticate_page">Authenticate Page</span>
                        </a>


                    </li>
                    <li>

                        <a href="php_auth_login.html" title="Login" class=" " data-filter-tags="authentication login">

                            <span class="nav-link-text" data-i18n="nav.authentication_login">Login</span>
                        </a>


                    </li>
                    <li>

                        <a href="php_auth_login26ca.html" title="Logout" class=" "
                           data-filter-tags="authentication logout">

                            <span class="nav-link-text" data-i18n="nav.authentication_logout">Logout</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="REST API" class=" " data-filter-tags="rest api">
                    <i class="fal fa-cloud"></i>
                    <span class="nav-link-text" data-i18n="nav.rest_api">REST API</span>
                </a>

                <ul>

                    <li>

                        <a href="php_api_docs.html" title="Documentation" class=" "
                           data-filter-tags="rest api documentation">

                            <span class="nav-link-text" data-i18n="nav.rest_api_documentation">Documentation</span>
                        </a>


                    </li>
                    <li>

                        <a href="php_api_playground.html" title="Playground" class=" "
                           data-filter-tags="rest api playground">

                            <span class="nav-link-text" data-i18n="nav.rest_api_playground">Playground</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Database" class=" " data-filter-tags="database">
                    <i class="fal fa-database"></i>
                    <span class="nav-link-text" data-i18n="nav.database">Database</span>
                </a>

                <ul>

                    <li>

                        <a href="php_db_intro.html" title="Introduction" class=" "
                           data-filter-tags="database introduction">

                            <span class="nav-link-text" data-i18n="nav.database_introduction">Introduction</span>
                        </a>


                    </li>
                    <li>

                        <a href="php_db_users.html" title="Users" class=" " data-filter-tags="database users">

                            <span class="nav-link-text" data-i18n="nav.database_users">Users</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li class="nav-title">
                Tools & Components
            </li>
            <li>

                <a href="#" title="UI Components" class=" " data-filter-tags="ui components">
                    <i class="fal fa-window"></i>
                    <span class="nav-link-text" data-i18n="nav.ui_components">UI Components</span>
                </a>

                <ul>

                    <li>

                        <a href="ui_alerts.html" title="Alerts" class=" " data-filter-tags="ui components alerts">

                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Alerts</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_accordion.html" title="Accordions" class=" "
                           data-filter-tags="ui components accordions">

                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">Accordions</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_badges.html" title="Badges" class=" " data-filter-tags="ui components badges">

                            <span class="nav-link-text" data-i18n="nav.ui_components_badges">Badges</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_breadcrumbs.html" title="Breadcrumbs" class=" "
                           data-filter-tags="ui components breadcrumbs">

                            <span class="nav-link-text" data-i18n="nav.ui_components_breadcrumbs">Breadcrumbs</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_buttons.html" title="Buttons" class=" " data-filter-tags="ui components buttons">

                            <span class="nav-link-text" data-i18n="nav.ui_components_buttons">Buttons</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_button_group.html" title="Button Group" class=" "
                           data-filter-tags="ui components button group">

                            <span class="nav-link-text" data-i18n="nav.ui_components_button_group">Button Group</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_cards.html" title="Cards" class=" " data-filter-tags="ui components cards">

                            <span class="nav-link-text" data-i18n="nav.ui_components_cards">Cards</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_carousel.html" title="Carousel" class=" " data-filter-tags="ui components carousel">

                            <span class="nav-link-text" data-i18n="nav.ui_components_carousel">Carousel</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_collapse.html" title="Collapse" class=" " data-filter-tags="ui components collapse">

                            <span class="nav-link-text" data-i18n="nav.ui_components_collapse">Collapse</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_dropdowns.html" title="Dropdowns" class=" "
                           data-filter-tags="ui components dropdowns">

                            <span class="nav-link-text" data-i18n="nav.ui_components_dropdowns">Dropdowns</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_list_filter.html" title="List Filter" class=" "
                           data-filter-tags="ui components list filter">

                            <span class="nav-link-text" data-i18n="nav.ui_components_list_filter">List Filter</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_modal.html" title="Modal" class=" " data-filter-tags="ui components modal">

                            <span class="nav-link-text" data-i18n="nav.ui_components_modal">Modal</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_navbars.html" title="Navbars" class=" " data-filter-tags="ui components navbars">

                            <span class="nav-link-text" data-i18n="nav.ui_components_navbars">Navbars</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_panels.html" title="Panels" class=" " data-filter-tags="ui components panels">

                            <span class="nav-link-text" data-i18n="nav.ui_components_panels">Panels</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_pagination.html" title="Pagination" class=" "
                           data-filter-tags="ui components pagination">

                            <span class="nav-link-text" data-i18n="nav.ui_components_pagination">Pagination</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_popovers.html" title="Popovers" class=" " data-filter-tags="ui components popovers">

                            <span class="nav-link-text" data-i18n="nav.ui_components_popovers">Popovers</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_progress_bars.html" title="Progress Bars" class=" "
                           data-filter-tags="ui components progress bars">

                            <span class="nav-link-text" data-i18n="nav.ui_components_progress_bars">Progress Bars</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_scrollspy.html" title="ScrollSpy" class=" "
                           data-filter-tags="ui components scrollspy">

                            <span class="nav-link-text" data-i18n="nav.ui_components_scrollspy">ScrollSpy</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_side_panel.html" title="Side Panel" class=" "
                           data-filter-tags="ui components side panel">

                            <span class="nav-link-text" data-i18n="nav.ui_components_side_panel">Side Panel</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_spinners.html" title="Spinners" class=" " data-filter-tags="ui components spinners">

                            <span class="nav-link-text" data-i18n="nav.ui_components_spinners">Spinners</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_tabs_pills.html" title="Tabs & Pills" class=" "
                           data-filter-tags="ui components tabs &amp; pills">

                            <span class="nav-link-text" data-i18n="nav.ui_components_tabs_&_pills">Tabs & Pills</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_toasts.html" title="Toasts" class=" " data-filter-tags="ui components toasts">

                            <span class="nav-link-text" data-i18n="nav.ui_components_toasts">Toasts</span>
                        </a>


                    </li>
                    <li>

                        <a href="ui_tooltips.html" title="Tooltips" class=" " data-filter-tags="ui components tooltips">

                            <span class="nav-link-text" data-i18n="nav.ui_components_tooltips">Tooltips</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Utilities" class=" " data-filter-tags="utilities">
                    <i class="fal fa-bolt"></i>
                    <span class="nav-link-text" data-i18n="nav.utilities">Utilities</span>
                </a>

                <ul>

                    <li>

                        <a href="utilities_borders.html" title="Borders" class=" " data-filter-tags="utilities borders">

                            <span class="nav-link-text" data-i18n="nav.utilities_borders">Borders</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_clearfix.html" title="Clearfix" class=" "
                           data-filter-tags="utilities clearfix">

                            <span class="nav-link-text" data-i18n="nav.utilities_clearfix">Clearfix</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_color_pallet.html" title="Color Pallet" class=" "
                           data-filter-tags="utilities color pallet">

                            <span class="nav-link-text" data-i18n="nav.utilities_color_pallet">Color Pallet</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_display_property.html" title="Display Property" class=" "
                           data-filter-tags="utilities display property">

                            <span class="nav-link-text"
                                  data-i18n="nav.utilities_display_property">Display Property</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_fonts.html" title="Fonts" class=" " data-filter-tags="utilities fonts">

                            <span class="nav-link-text" data-i18n="nav.utilities_fonts">Fonts</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_flexbox.html" title="Flexbox" class=" " data-filter-tags="utilities flexbox">

                            <span class="nav-link-text" data-i18n="nav.utilities_flexbox">Flexbox</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_helpers.html" title="Helpers" class=" " data-filter-tags="utilities helpers">

                            <span class="nav-link-text" data-i18n="nav.utilities_helpers">Helpers</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_position.html" title="Position" class=" "
                           data-filter-tags="utilities position">

                            <span class="nav-link-text" data-i18n="nav.utilities_position">Position</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_responsive_grid.html" title="Responsive Grid" class=" "
                           data-filter-tags="utilities responsive grid">

                            <span class="nav-link-text" data-i18n="nav.utilities_responsive_grid">Responsive Grid</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_sizing.html" title="Sizing" class=" " data-filter-tags="utilities sizing">

                            <span class="nav-link-text" data-i18n="nav.utilities_sizing">Sizing</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_spacing.html" title="Spacing" class=" " data-filter-tags="utilities spacing">

                            <span class="nav-link-text" data-i18n="nav.utilities_spacing">Spacing</span>
                        </a>


                    </li>
                    <li>

                        <a href="utilities_typography.html" title="Typography" class=" "
                           data-filter-tags="utilities typography fonts headings bold lead colors sizes link text states list styles truncate alignment">

                            <span class="nav-link-text" data-i18n="nav.utilities_typography">Typography</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Menu child" class=" " data-filter-tags="utilities menu child">

                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Menu child</span>
                        </a>

                        <ul>

                            <li>

                                <a href="#" title="Sublevel Item" class=" "
                                   data-filter-tags="utilities menu child sublevel item">

                                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Sublevel Item</span>
                                </a>


                            </li>
                            <li>

                                <a href="#" title="Another Item" class=" "
                                   data-filter-tags="utilities menu child another item">

                                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child_another_item">Another Item</span>
                                </a>


                            </li>
                        </ul>


                    </li>
                    <li>

                        <a href="#" title="Disabled item" class=" " data-filter-tags="utilities disabled item">

                            <span class="nav-link-text" data-i18n="nav.utilities_disabled_item">Disabled item</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Font Icons" class=" " data-filter-tags="font icons">
                    <i class="fal fa-map-marker-alt"></i>
                    <span class="nav-link-text" data-i18n="nav.font_icons">Font Icons</span><span
                        class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">2,500+</span>
                </a>

                <ul>

                    <li>

                        <a href="#" title="FontAwesome" class=" " data-filter-tags="font icons fontawesome">

                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">FontAwesome</span>
                        </a>

                        <ul>

                            <li>

                                <a href="icons_fontawesome_light.html" title="Light" class=" "
                                   data-filter-tags="font icons fontawesome light">

                                    <span class="nav-link-text"
                                          data-i18n="nav.font_icons_fontawesome_light">Light</span>
                                </a>


                            </li>
                            <li>

                                <a href="icons_fontawesome_regular.html" title="Regular" class=" "
                                   data-filter-tags="font icons fontawesome regular">

                                    <span class="nav-link-text"
                                          data-i18n="nav.font_icons_fontawesome_regular">Regular</span>
                                </a>


                            </li>
                            <li>

                                <a href="icons_fontawesome_solid.html" title="Solid" class=" "
                                   data-filter-tags="font icons fontawesome solid">

                                    <span class="nav-link-text"
                                          data-i18n="nav.font_icons_fontawesome_solid">Solid</span>
                                </a>


                            </li>
                            <li>

                                <a href="icons_fontawesome_brand.html" title="Brand" class=" "
                                   data-filter-tags="font icons fontawesome brand">

                                    <span class="nav-link-text"
                                          data-i18n="nav.font_icons_fontawesome_brand">Brand</span>
                                </a>


                            </li>
                        </ul>


                    </li>
                    <li>

                        <a href="#" title="NextGen Icons" class=" " data-filter-tags="font icons nextgen icons">

                            <span class="nav-link-text" data-i18n="nav.font_icons_nextgen_icons">NextGen Icons</span>
                        </a>

                        <ul>

                            <li>

                                <a href="icons_nextgen_general.html" title="General" class=" "
                                   data-filter-tags="font icons nextgen icons general">

                                    <span class="nav-link-text"
                                          data-i18n="nav.font_icons_nextgen_icons_general">General</span>
                                </a>


                            </li>
                            <li>

                                <a href="icons_nextgen_base.html" title="Base" class=" "
                                   data-filter-tags="font icons nextgen icons base">

                                    <span class="nav-link-text"
                                          data-i18n="nav.font_icons_nextgen_icons_base">Base</span>
                                </a>


                            </li>
                        </ul>


                    </li>
                    <li>

                        <a href="#" title="Stack Icons" class=" " data-filter-tags="font icons stack icons">

                            <span class="nav-link-text" data-i18n="nav.font_icons_stack_icons">Stack Icons</span>
                        </a>

                        <ul>

                            <li>

                                <a href="icons_stack_showcase.html" title="Showcase" class=" "
                                   data-filter-tags="font icons stack icons showcase">

                                    <span class="nav-link-text"
                                          data-i18n="nav.font_icons_stack_icons_showcase">Showcase</span>
                                </a>


                            </li>
                            <li>

                                <a href="icons_stack_generate7cd4.html?layers=3" title="Generate Stack" class=" "
                                   data-filter-tags="font icons stack icons generate stack">

                                    <span class="nav-link-text" data-i18n="nav.font_icons_stack_icons_generate_stack">Generate Stack</span>
                                </a>


                            </li>
                        </ul>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Tables" class=" " data-filter-tags="tables">
                    <i class="fal fa-th-list"></i>
                    <span class="nav-link-text" data-i18n="nav.tables">Tables</span>
                </a>

                <ul>

                    <li>

                        <a href="tables_basic.html" title="Basic Tables" class=" "
                           data-filter-tags="tables basic tables">

                            <span class="nav-link-text" data-i18n="nav.tables_basic_tables">Basic Tables</span>
                        </a>


                    </li>
                    <li>

                        <a href="tables_generate_style.html" title="Generate Table Style" class=" "
                           data-filter-tags="tables generate table style">

                            <span class="nav-link-text"
                                  data-i18n="nav.tables_generate_table_style">Generate Table Style</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Form Stuff" class=" " data-filter-tags="form stuff">
                    <i class="fal fa-edit"></i>
                    <span class="nav-link-text" data-i18n="nav.form_stuff">Form Stuff</span>
                </a>

                <ul>

                    <li>

                        <a href="form_basic_inputs.html" title="Basic Inputs" class=" "
                           data-filter-tags="form stuff basic inputs">

                            <span class="nav-link-text" data-i18n="nav.form_stuff_basic_inputs">Basic Inputs</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_checkbox_radio.html" title="Checkbox & Radio" class=" "
                           data-filter-tags="form stuff checkbox &amp; radio">

                            <span class="nav-link-text"
                                  data-i18n="nav.form_stuff_checkbox_&_radio">Checkbox & Radio</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_input_groups.html" title="Input Groups" class=" "
                           data-filter-tags="form stuff input groups">

                            <span class="nav-link-text" data-i18n="nav.form_stuff_input_groups">Input Groups</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_validation.html" title="Validation" class=" "
                           data-filter-tags="form stuff validation">

                            <span class="nav-link-text" data-i18n="nav.form_stuff_validation">Validation</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li class="nav-title">
                Plugins & Addons
            </li>
            <li>

                <a href="#" title="Plugins" class=" " data-filter-tags="plugins">
                    <i class="fal fa-shield-alt"></i>
                    <span class="nav-link-text" data-i18n="nav.plugins">Plugins</span>
                </a>

                <ul>

                    <li>

                        <a href="plugin_faq.html" title="Plugins FAQ" class=" " data-filter-tags="plugins plugins faq">

                            <span class="nav-link-text" data-i18n="nav.plugins_plugins_faq">Plugins FAQ</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_waves.html" title="Waves" class=" " data-filter-tags="plugins waves">

                            <span class="nav-link-text" data-i18n="nav.plugins_waves">Waves</span><span
                                class="dl-ref label bg-primary-400 ml-2">9 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_pacejs.html" title="PaceJS" class=" " data-filter-tags="plugins pacejs">

                            <span class="nav-link-text" data-i18n="nav.plugins_pacejs">PaceJS</span><span
                                class="dl-ref label bg-primary-500 ml-2">13 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_smartpanels.html" title="SmartPanels" class=" "
                           data-filter-tags="plugins smartpanels">

                            <span class="nav-link-text" data-i18n="nav.plugins_smartpanels">SmartPanels</span><span
                                class="dl-ref label bg-primary-600 ml-2">9 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_bootbox.html" title="BootBox" class=" "
                           data-filter-tags="plugins bootbox alert sound">

                            <span class="nav-link-text" data-i18n="nav.plugins_bootbox">BootBox</span><span
                                class="dl-ref label bg-primary-600 ml-2">15 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_slimscroll.html" title="Slimscroll" class=" "
                           data-filter-tags="plugins slimscroll">

                            <span class="nav-link-text" data-i18n="nav.plugins_slimscroll">Slimscroll</span><span
                                class="dl-ref label bg-primary-700 ml-2">5 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_throttle.html" title="Throttle" class=" " data-filter-tags="plugins throttle">

                            <span class="nav-link-text" data-i18n="nav.plugins_throttle">Throttle</span><span
                                class="dl-ref label bg-primary-700 ml-2">1 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_navigation.html" title="Navigation" class=" "
                           data-filter-tags="plugins navigation">

                            <span class="nav-link-text" data-i18n="nav.plugins_navigation">Navigation</span><span
                                class="dl-ref label bg-primary-700 ml-2">2 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_i18next.html" title="i18next" class=" " data-filter-tags="plugins i18next">

                            <span class="nav-link-text" data-i18n="nav.plugins_i18next">i18next</span><span
                                class="dl-ref label bg-primary-700 ml-2">10 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="plugin_appcore.html" title="App.Core" class=" " data-filter-tags="plugins app.core">

                            <span class="nav-link-text" data-i18n="nav.plugins_app.core">App.Core</span><span
                                class="dl-ref label bg-success-700 ml-2">14 KB</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Datatables" class=" " data-filter-tags="datatables datagrid">
                    <i class="fal fa-table"></i>
                    <span class="nav-link-text" data-i18n="nav.datatables">Datatables</span><span
                        class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top">235 KB</span>
                </a>

                <ul>

                    <li>

                        <a href="datatables_basic.html" title="Basic" class=" "
                           data-filter-tags="datatables datagrid basic">

                            <span class="nav-link-text" data-i18n="nav.datatables_basic">Basic</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_autofill.html" title="Autofill" class=" "
                           data-filter-tags="datatables datagrid autofill">

                            <span class="nav-link-text" data-i18n="nav.datatables_autofill">Autofill</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_buttons.html" title="Buttons" class=" "
                           data-filter-tags="datatables datagrid buttons">

                            <span class="nav-link-text" data-i18n="nav.datatables_buttons">Buttons</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_export.html" title="Export" class=" "
                           data-filter-tags="datatables datagrid export tables pdf excel print csv">

                            <span class="nav-link-text" data-i18n="nav.datatables_export">Export</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_colreorder.html" title="ColReorder" class=" "
                           data-filter-tags="datatables datagrid colreorder">

                            <span class="nav-link-text" data-i18n="nav.datatables_colreorder">ColReorder</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_columnfilter.html" title="ColumnFilter" class=" "
                           data-filter-tags="datatables datagrid columnfilter">

                            <span class="nav-link-text" data-i18n="nav.datatables_columnfilter">ColumnFilter</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_fixedcolumns.html" title="FixedColumns" class=" "
                           data-filter-tags="datatables datagrid fixedcolumns">

                            <span class="nav-link-text" data-i18n="nav.datatables_fixedcolumns">FixedColumns</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_fixedheader.html" title="FixedHeader" class=" "
                           data-filter-tags="datatables datagrid fixedheader">

                            <span class="nav-link-text" data-i18n="nav.datatables_fixedheader">FixedHeader</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_keytable.html" title="KeyTable" class=" "
                           data-filter-tags="datatables datagrid keytable">

                            <span class="nav-link-text" data-i18n="nav.datatables_keytable">KeyTable</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_responsive.html" title="Responsive" class=" "
                           data-filter-tags="datatables datagrid responsive">

                            <span class="nav-link-text" data-i18n="nav.datatables_responsive">Responsive</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_responsive_alt.html" title="Responsive Alt" class=" "
                           data-filter-tags="datatables datagrid responsive alt">

                            <span class="nav-link-text" data-i18n="nav.datatables_responsive_alt">Responsive Alt</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_rowgroup.html" title="RowGroup" class=" "
                           data-filter-tags="datatables datagrid rowgroup">

                            <span class="nav-link-text" data-i18n="nav.datatables_rowgroup">RowGroup</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_rowreorder.html" title="RowReorder" class=" "
                           data-filter-tags="datatables datagrid rowreorder">

                            <span class="nav-link-text" data-i18n="nav.datatables_rowreorder">RowReorder</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_scroller.html" title="Scroller" class=" "
                           data-filter-tags="datatables datagrid scroller">

                            <span class="nav-link-text" data-i18n="nav.datatables_scroller">Scroller</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_select.html" title="Select" class=" "
                           data-filter-tags="datatables datagrid select">

                            <span class="nav-link-text" data-i18n="nav.datatables_select">Select</span>
                        </a>


                    </li>
                    <li>

                        <a href="datatables_alteditor.html" title="AltEditor" class=" "
                           data-filter-tags="datatables datagrid alteditor">

                            <span class="nav-link-text" data-i18n="nav.datatables_alteditor">AltEditor</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Statistics" class=" " data-filter-tags="statistics chart, graphs">
                    <i class="fal fa-chart-pie"></i>
                    <span class="nav-link-text" data-i18n="nav.statistics">Statistics</span>
                </a>

                <ul>

                    <li>

                        <a href="statistics_flot.html" title="Flot" class=" "
                           data-filter-tags="statistics chart, graphs flot bar pie">

                            <span class="nav-link-text" data-i18n="nav.statistics_flot">Flot</span><span
                                class="dl-ref label bg-primary-500 ml-2">36 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="statistics_chartjs.html" title="Chart.js" class=" "
                           data-filter-tags="statistics chart, graphs chart.js bar pie">

                            <span class="nav-link-text" data-i18n="nav.statistics_chart.html">Chart.js</span><span
                                class="dl-ref label bg-primary-500 ml-2">205 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="statistics_chartist.html" title="Chartist.js" class=" "
                           data-filter-tags="statistics chart, graphs chartist.js">

                            <span class="nav-link-text" data-i18n="nav.statistics_chartist.html">Chartist.js</span><span
                                class="dl-ref label bg-primary-600 ml-2">39 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="statistics_c3.html" title="C3 Charts" class=" "
                           data-filter-tags="statistics chart, graphs c3 charts">

                            <span class="nav-link-text" data-i18n="nav.statistics_c3_charts">C3 Charts</span><span
                                class="dl-ref label bg-primary-600 ml-2">197 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="statistics_peity.html" title="Peity" class=" "
                           data-filter-tags="statistics chart, graphs peity small">

                            <span class="nav-link-text" data-i18n="nav.statistics_peity">Peity</span><span
                                class="dl-ref label bg-primary-700 ml-2">4 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="statistics_sparkline.html" title="Sparkline" class=" "
                           data-filter-tags="statistics chart, graphs sparkline small tiny">

                            <span class="nav-link-text" data-i18n="nav.statistics_sparkline">Sparkline</span><span
                                class="dl-ref label bg-primary-700 ml-2">42 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="statistics_easypiechart.html" title="Easy Pie Chart" class=" "
                           data-filter-tags="statistics chart, graphs easy pie chart">

                            <span class="nav-link-text"
                                  data-i18n="nav.statistics_easy_pie_chart">Easy Pie Chart</span><span
                                class="dl-ref label bg-primary-700 ml-2">4 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="statistics_dygraph.html" title="Dygraph" class=" "
                           data-filter-tags="statistics chart, graphs dygraph complex">

                            <span class="nav-link-text" data-i18n="nav.statistics_dygraph">Dygraph</span><span
                                class="dl-ref label bg-primary-700 ml-2">120 KB</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Notifications" class=" " data-filter-tags="notifications">
                    <i class="fal fa-exclamation-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.notifications">Notifications</span>
                </a>

                <ul>

                    <li>

                        <a href="notifications_sweetalert2.html" title="SweetAlert2" class=" "
                           data-filter-tags="notifications sweetalert2">

                            <span class="nav-link-text"
                                  data-i18n="nav.notifications_sweetalert2">SweetAlert2</span><span
                                class="dl-ref label bg-primary-500 ml-2">40 KB</span>
                        </a>


                    </li>
                    <li>

                        <a href="notifications_toastr.html" title="Toastr" class=" "
                           data-filter-tags="notifications toastr">

                            <span class="nav-link-text" data-i18n="nav.notifications_toastr">Toastr</span><span
                                class="dl-ref label bg-primary-600 ml-2">5 KB</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Form Plugins" class=" " data-filter-tags="form plugins">
                    <i class="fal fa-credit-card-front"></i>
                    <span class="nav-link-text" data-i18n="nav.form_plugins">Form Plugins</span>
                </a>

                <ul>

                    <li>

                        <a href="form_plugins_colorpicker.html" title="Color Picker" class=" "
                           data-filter-tags="form plugins color picker">

                            <span class="nav-link-text" data-i18n="nav.form_plugins_color_picker">Color Picker</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_plugins_datepicker.html" title="Date Picker" class=" "
                           data-filter-tags="form plugins date picker">

                            <span class="nav-link-text" data-i18n="nav.form_plugins_date_picker">Date Picker</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_plugins_daterange_picker.html" title="Date Range Picker" class=" "
                           data-filter-tags="form plugins date range picker">

                            <span class="nav-link-text"
                                  data-i18n="nav.form_plugins_date_range_picker">Date Range Picker</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_plugins_dropzone.html" title="Dropzone" class=" "
                           data-filter-tags="form plugins dropzone">

                            <span class="nav-link-text" data-i18n="nav.form_plugins_dropzone">Dropzone</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_plugins_ionrangeslider.html" title="Ion.RangeSlider" class=" "
                           data-filter-tags="form plugins ion.rangeslider">

                            <span class="nav-link-text"
                                  data-i18n="nav.form_plugins_ion.rangeslider">Ion.RangeSlider</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_plugins_inputmask.html" title="Inputmask" class=" "
                           data-filter-tags="form plugins inputmask">

                            <span class="nav-link-text" data-i18n="nav.form_plugins_inputmask">Inputmask</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_plugin_imagecropper.html" title="Image Cropper" class=" "
                           data-filter-tags="form plugins image cropper">

                            <span class="nav-link-text" data-i18n="nav.form_plugins_image_cropper">Image Cropper</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_plugin_select2.html" title="Select2" class=" "
                           data-filter-tags="form plugins select2">

                            <span class="nav-link-text" data-i18n="nav.form_plugins_select2">Select2</span>
                        </a>


                    </li>
                    <li>

                        <a href="form_plugin_summernote.html" title="Summernote" class=" "
                           data-filter-tags="form plugins summernote texteditor editor">

                            <span class="nav-link-text" data-i18n="nav.form_plugins_summernote">Summernote</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li>

                <a href="#" title="Miscellaneous" class=" " data-filter-tags="miscellaneous">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.miscellaneous">Miscellaneous</span>
                </a>

                <ul>

                    <li>

                        <a href="miscellaneous_fullcalendar.html" title="FullCalendar" class=" "
                           data-filter-tags="miscellaneous fullcalendar">

                            <span class="nav-link-text" data-i18n="nav.miscellaneous_fullcalendar">FullCalendar</span>
                        </a>


                    </li>
                    <li>

                        <a href="miscellaneous_lightgallery.html" title="Light Gallery" class=" "
                           data-filter-tags="miscellaneous light gallery">

                            <span class="nav-link-text" data-i18n="nav.miscellaneous_light_gallery">Light Gallery</span><span
                                class="dl-ref label bg-primary-500 ml-2">61 KB</span>
                        </a>


                    </li>
                </ul>


            </li>
            <li class="nav-title">
                Layouts & Apps
            </li>
            <li>

                <a href="#" title="Pages" class=" " data-filter-tags="pages">
                    <i class="fal fa-plus-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.pages">Pages</span>
                </a>

                <ul>

                    <li>

                        <a href="page_chat.html" title="Chat" class=" " data-filter-tags="pages chat">

                            <span class="nav-link-text" data-i18n="nav.pages_chat">Chat</span>
                        </a>


                    </li>
                    <li>

                        <a href="page_contacts.html" title="Contacts" class=" " data-filter-tags="pages contacts">

                            <span class="nav-link-text" data-i18n="nav.pages_contacts">Contacts</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Forum" class=" " data-filter-tags="pages forum">

                            <span class="nav-link-text" data-i18n="nav.pages_forum">Forum</span>
                        </a>

                        <ul>

                            <li>

                                <a href="page_forum_list.html" title="List" class=" "
                                   data-filter-tags="pages forum list">

                                    <span class="nav-link-text" data-i18n="nav.pages_forum_list">List</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_forum_threads.html" title="Threads" class=" "
                                   data-filter-tags="pages forum threads">

                                    <span class="nav-link-text" data-i18n="nav.pages_forum_threads">Threads</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_forum_discussion.html" title="Discussion" class=" "
                                   data-filter-tags="pages forum discussion">

                                    <span class="nav-link-text" data-i18n="nav.pages_forum_discussion">Discussion</span>
                                </a>


                            </li>
                        </ul>


                    </li>
                    <li>

                        <a href="#" title="Inbox" class=" " data-filter-tags="pages inbox">

                            <span class="nav-link-text" data-i18n="nav.pages_inbox">Inbox</span>
                        </a>

                        <ul>

                            <li>

                                <a href="page_inbox_general.html" title="General" class=" "
                                   data-filter-tags="pages inbox general">

                                    <span class="nav-link-text" data-i18n="nav.pages_inbox_general">General</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_inbox_read.html" title="Read" class=" "
                                   data-filter-tags="pages inbox read">

                                    <span class="nav-link-text" data-i18n="nav.pages_inbox_read">Read</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_inbox_write.html" title="Write" class=" "
                                   data-filter-tags="pages inbox write">

                                    <span class="nav-link-text" data-i18n="nav.pages_inbox_write">Write</span>
                                </a>


                            </li>
                        </ul>


                    </li>
                    <li>

                        <a href="page_invoice.html" title="Invoice (printable)" class=" "
                           data-filter-tags="pages invoice (printable)">

                            <span class="nav-link-text"
                                  data-i18n="nav.pages_invoice_(printable)">Invoice (printable)</span>
                        </a>


                    </li>
                    <li>

                        <a href="#" title="Authentication" class=" " data-filter-tags="pages authentication">

                            <span class="nav-link-text" data-i18n="nav.pages_authentication">Authentication</span>
                        </a>

                        <ul>

                            <li>

                                <a href="page_forget.html" title="Forget Password" class=" "
                                   data-filter-tags="pages authentication forget password">

                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_forget_password">Forget Password</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_locked.html" title="Locked Screen" class=" "
                                   data-filter-tags="pages authentication locked screen">

                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_locked_screen">Locked Screen</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_login.html" title="Login" class=" "
                                   data-filter-tags="pages authentication login">

                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_login">Login</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_login-alt.html" title="Login Alt" class=" "
                                   data-filter-tags="pages authentication login alt">

                                    <span class="nav-link-text"
                                          data-i18n="nav.pages_authentication_login_alt">Login Alt</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_register.html" title="Register" class=" "
                                   data-filter-tags="pages authentication register">

                                    <span class="nav-link-text"
                                          data-i18n="nav.pages_authentication_register">Register</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_confirmation.html" title="Confirmation" class=" "
                                   data-filter-tags="pages authentication confirmation">

                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_confirmation">Confirmation</span>
                                </a>


                            </li>
                        </ul>


                    </li>
                    <li>

                        <a href="#" title="Error Pages" class=" " data-filter-tags="pages error pages">

                            <span class="nav-link-text" data-i18n="nav.pages_error_pages">Error Pages</span>
                        </a>

                        <ul>

                            <li>

                                <a href="page_error.html" title="General Error" class=" "
                                   data-filter-tags="pages error pages general error">

                                    <span class="nav-link-text" data-i18n="nav.pages_error_pages_general_error">General Error</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_error_404.html" title="Server Error" class=" "
                                   data-filter-tags="pages error pages server error">

                                    <span class="nav-link-text" data-i18n="nav.pages_error_pages_server_error">Server Error</span>
                                </a>


                            </li>
                            <li>

                                <a href="page_error_announced.html" title="Announced Error" class=" "
                                   data-filter-tags="pages error pages announced error">

                                    <span class="nav-link-text" data-i18n="nav.pages_error_pages_announced_error">Announced Error</span>
                                </a>


                            </li>
                        </ul>


                    </li>
                    <li>

                        <a href="page_profile.html" title="Profile" class=" " data-filter-tags="pages profile">

                            <span class="nav-link-text" data-i18n="nav.pages_profile">Profile</span>
                        </a>


                    </li>
                    <li>

                        <a href="page_search.html" title="Search Results" class=" "
                           data-filter-tags="pages search results">

                            <span class="nav-link-text" data-i18n="nav.pages_search_results">Search Results</span>
                        </a>


                    </li>
                </ul>


            </li>
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>

    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
           class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- END NAV FOOTER -->
</aside>
