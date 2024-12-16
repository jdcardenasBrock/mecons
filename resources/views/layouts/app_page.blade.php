<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MECONS') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css')}}" />

    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css')}}" />

    <link rel="stylesheet" href="{{asset('font/iconsmind-s/css/iconsminds.css')}}">
    <link rel="stylesheet" href="{{asset('font/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.rtl.only.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/perfect-scrollbar.css')}}">

    <link rel="stylesheet" href="{{ asset('css/vendor/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/glide.core.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-stars.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/nouislider.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-datepicker3.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/component-custom-switch.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/jquery.contextMenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/component-custom-switch.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/vendor/nouislider.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/main.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/dore.light.bluenavy.min.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('styles')
    @livewireStyles
</head>



<body id="app-container" class="menu-default show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>


        </div>


        <a class="navbar-logo" href="{{route('home')}}">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">


                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">{{ Auth::user()->name }}</span>
                    <span>
                        <img alt="Profile Picture" src="{{asset('img/profiles/l-1.jpg')}}" />
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    {{-- <a class="dropdown-item" href="#">Maestro de ...</a>  --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li class="active">
                        <a href="{{route('home')}}">
                            <i class="iconsminds-tablet-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @can('visualizar_referencia')
                    <li>
                        <a href="{{route('references.index')}}" style="text-align: center">
                            <i class="iconsminds-box-with-folders"></i> Maestro de Referencias
                        </a>
                    </li>
                    @endcan
                    @can('visualizar_cotizacion')
                    <li>
                        <a href="{{route('cotizacion.index')}}">
                            <i class="iconsminds-calculator"></i> Modulo Cotizador
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a href="{{route('project_Managment')}}" style="text-align: center">
                            <i class="iconsminds-engineering"></i> Gestion de Proyectos
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{route('crm')}}" style="text-align: center">
                            <i class="iconsminds-optimization"></i> CRM
                        </a>
                    </li> -->
                    @can('visualizar_cliente')
                    <li>
                        <a href="{{route('clients.index')}}" style="text-align: center">
                            <i class="iconsminds-business-mens"></i> Maestro Clientes
                        </a>
                    </li>
                    @endcan
                    @can('visualizar_proveedor')
                    <li>
                        <a href="{{route('proveedores.index')}}" style="text-align: center">
                            <i class="iconsminds-engineering"></i> Maestro Proveedores
                        </a>
                    </li>
                    @endcan
                    @can('crear_usuarios')
                    <li>
                        <a href="#permissions">
                            <i class="simple-icon-wrench"></i> Permisos y<br> Usuarios
                        </a>
                    </li>
                    @endcan


                </ul>
            </div>
        </div>

        <div class="sub-menu">
            <div class="scroll">


                <ul class="list-unstyled" data-link="permissions">


                    <li>
                        <a href="#" data-toggle="collapse" data-target="#collapseForms" aria-expanded="true"
                            aria-controls="collapseForms" class="rotate-arrow-icon opacity-50">
                            <i class="simple-icon-arrow-down"></i> <span class="d-inline-block">Permisos y Usuarios</span>
                        </a>
                        <div id="collapseForms" class="collapse show">
                            <ul class="list-unstyled inner-level-menu">
                                @can('crear_permisos')
                                <li>
                                    <a href="{{route('permissions.index')}}">
                                        <i class="simple-icon-event"></i> <span class="d-inline-block">Permisos</span>
                                    </a>
                                </li>
                                @endcan
                                @can('crear_roles')
                                <li>
                                    <a href="{{route('roles.index')}}">
                                        <i class="simple-icon-doc"></i> <span class="d-inline-block">Roles</span>
                                    </a>
                                </li>
                                @endcan
                                @can('crear_usuarios')
                                <li>
                                    <a href="{{route('users.index')}}">
                                        <i class="simple-icon-check"></i> <span class="d-inline-block">Usuarios</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                    </li>


                </ul>

            </div>
        </div>
    </div>

    <main>

        @yield('content')

    </main>

    <footer class="page-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <p class="mb-0 text-muted">MECONS 2022</p>
                    </div>
                    <div class="col-sm-6 d-none d-sm-block">
                        <ul class="breadcrumb pt-0 pr-0 float-right">
                            <li class="breadcrumb-item mb-0">
                                <a href="https://www.mcardi.com" class="btn-link" target="_blank">Develop By Mcardi</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <script src="{{asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/vendor/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/vendor/select2.full.js')}}"></script>
    <script src="{{asset('js/vendor/mousetrap.min.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.contextMenu.min.js')}}"></script>
    <script src="{{asset('js/dore.script.js')}}"></script>
    <script src="{{asset('js/script_double.js')}}"></script>

    <script src="{{asset('js/vendor/progressbar.min.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('js/vendor/nouislider.min.js')}}"></script>
    <script src="{{asset('js/vendor/Sortable.js')}}"></script>
    <script src="{{asset('js/vendor/mousetrap.min.js')}}"></script>
    <script src="{{asset('js/vendor/glide.min.js')}}"></script>
    <script>
        $('#value-input').on({
            "focus": function(event) {
                $(event.target).select();
            },
            "keyup": function(event) {
                $(event.target).val(function(index, value) {
                    return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                });
            }
        });
    </script>
    @stack('scripts')
    @livewireScripts
</body>

</html>