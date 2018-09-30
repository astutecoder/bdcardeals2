<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="{{ Request::is('/') ? 'nav-active' : '' }}">
                        <a href="/">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-parent {{ Request::is('cars/*')? 'nav-expanded nav-active' : '' }}">
                        <a>
                            <i class="fa fa-car" aria-hidden="true"></i>
                            <span>Cars</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::path() === 'cars/all-cars'? 'nav-active' : '' }}">
                                <a href="{{ route('all-cars') }}">
                                    All cars
                                </a>
                            </li>
                            <li class="{{ Request::path() === 'cars/add-car' ? 'nav-active' : '' }}">
                                <a href="{{ route('add-car') }}">
                                    Add car
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-parent {{ Request::is('brands/*') ? 'nav-expanded nav-active' : '' }}">
                        <a>
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span>Brands</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::path() === 'brands/all-brands' ? 'nav-active' : '' }}">
                                <a href="{{ route('all-brands') }}">
                                    All Brands
                                </a>
                            </li>
                            <li class="{{ Request::path() === 'brands/add-brand' ? 'nav-active' : '' }}">
                                <a href="{{ route('add-brand') }}">
                                    Add Brand
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent {{ Request::is('body-types/*') ? 'nav-expanded nav-active' : '' }}">
                        <a>
                            <i class="glyphicon glyphicon-leaf"></i>
                            <span>Body Types</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::path() === 'body-types/all-body-types' ? 'nav-active' : '' }}">
                                <a href="{{ route('all-body-types') }}">
                                    All Body Types
                                </a>
                            </li>
                            <li class="{{ Request::path() === 'body-types/add-body-type' ? 'nav-active' : '' }}">
                                <a href="{{ route('add-body-type') }}">
                                    Add Body Type
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent {{ Request::is('fuel-types/*') ? 'nav-expanded nav-active' : '' }}">
                        <a>
                            <i class="glyphicon glyphicon-fire"></i>
                            <span>Fuel Types</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::path() === 'fuel-types/all-fuel-types' ? 'nav-active' : '' }}">
                                <a href="{{ route('all-fuel-types') }}">
                                    All Fuel Types
                                </a>
                            </li>
                            <li class="{{ Request::path() === 'fuel-types/add-fuel-type' ? 'nav-active' : '' }}">
                                <a href="{{ route('add-fuel-type') }}">
                                    Add Fuel Type
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent {{ Request::is('colors/*') ? 'nav-expanded nav-active' : '' }}">
                        <a>
                            <i class="glyphicon glyphicon-text-color"></i>
                            <span>Colors</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::path() === 'colors/all-colors' ? 'nav-active' : '' }}">
                                <a href="{{ route('all-colors') }}">
                                    All Colors
                                </a>
                            </li>
                            <li class="{{ Request::path() === 'colors/add-color' ? 'nav-active' : '' }}">
                                <a href="{{ route('add-color') }}">
                                    Add Color
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent {{ Request::is('sources/*')? 'nav-expanded nav-active' : '' }}">
                        <a>
                            {{--<i class="glyphicon glyphicon-grain" aria-hidden="true"></i>--}}
                            <span>Source</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ Request::path() === 'sources/all-sources' ? 'nav-active' : '' }}">
                                <a href="{{ route('all-sources') }}">
                                    All Sources
                                </a>
                            </li>
                            <li class="{{ Request::path() === 'sources/add-source' ? 'nav-active' : '' }}">
                                <a href="{{ route('add-source') }}">
                                    Add Source
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-table" aria-hidden="true"></i>
                            <span>Tables</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="tables-basic.html">
                                    Basic
                                </a>
                            </li>
                            <li>
                                <a href="tables-advanced.html">
                                    Advanced
                                </a>
                            </li>
                            <li>
                                <a href="tables-responsive.html">
                                    Responsive
                                </a>
                            </li>
                            <li>
                                <a href="tables-editable.html">
                                    Editable
                                </a>
                            </li>
                            <li>
                                <a href="tables-ajax.html">
                                    Ajax
                                </a>
                            </li>
                            <li>
                                <a href="tables-pricing.html">
                                    Pricing
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>Maps</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="maps-google-maps.html">
                                    Basic
                                </a>
                            </li>
                            <li>
                                <a href="maps-google-maps-builder.html">
                                    Map Builder
                                </a>
                            </li>
                            <li>
                                <a href="maps-vector.html">
                                    Vector
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-columns" aria-hidden="true"></i>
                            <span>Layouts</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="layouts-default.html">
                                    Default
                                </a>
                            </li>
                            <li>
                                <a href="layouts-boxed.html">
                                    Boxed
                                </a>
                            </li>
                            <li>
                                <a href="layouts-menu-collapsed.html">
                                    Menu Collapsed
                                </a>
                            </li>
                            <li>
                                <a href="layouts-scroll.html">
                                    Scroll
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-asterisk" aria-hidden="true"></i>
                            <span>Extra</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="extra-changelog.html">
                                    Changelog
                                </a>
                            </li>
                            <li>
                                <a href="extra-ajax-made-easy.html">
                                    Ajax Made Easy
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="http://themeforest.net/item/porto-responsive-html5-template/4106987?ref=Okler" target="_blank">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            <span>Front-End <em class="not-included">(Not Included)</em></span>
                        </a>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-align-left" aria-hidden="true"></i>
                            <span>Menu Levels</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a>First Level</a>
                            </li>
                            <li class="nav-parent">
                                <a>Second Level</a>
                                <ul class="nav nav-children">
                                    <li class="nav-parent">
                                        <a>Third Level</a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a>Third Level Link #1</a>
                                            </li>
                                            <li>
                                                <a>Third Level Link #2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a>Second Level Link #1</a>
                                    </li>
                                    <li>
                                        <a>Second Level Link #2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <hr class="separator" />

            <div class="sidebar-widget widget-tasks">
                <div class="widget-header">
                    <h6>Projects</h6>
                    <div class="widget-toggle">+</div>
                </div>
                <div class="widget-content">
                    <ul class="list-unstyled m-none">
                        <li><a href="#">Porto HTML5 Template</a></li>
                        <li><a href="#">Tucson Template</a></li>
                        <li><a href="#">Porto Admin</a></li>
                    </ul>
                </div>
            </div>

            <hr class="separator" />

            <div class="sidebar-widget widget-stats">
                <div class="widget-header">
                    <h6>Company Stats</h6>
                    <div class="widget-toggle">+</div>
                </div>
                <div class="widget-content">
                    <ul>
                        <li>
                            <span class="stats-title">Stat 1</span>
                            <span class="stats-complete">85%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
                                    <span class="sr-only">85% Complete</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="stats-title">Stat 2</span>
                            <span class="stats-complete">70%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                                    <span class="sr-only">70% Complete</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <span class="stats-title">Stat 3</span>
                            <span class="stats-complete">2%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                                    <span class="sr-only">2% Complete</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</aside>
