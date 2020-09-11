<!DOCTYPE html>
<html>

    <head>
        <!--begin::Base Path (base relative path for assets of this page) -->
        <base href="/">

        <!--end::Base Path -->
        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Login page example">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        {{-- favicons --}}
        <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/32×32px.png') }}" sizes="32x32" />
        <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/128×128px.png') }}" sizes="128x128" />
        <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/152×152px.png') }}" sizes="128x128" />
        <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/167×167px.png') }}" sizes="128x128" />
        <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/180×180px.png') }}" sizes="128x128" />
        <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/192×192px.png') }}" sizes="128x128" />
        <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/196×196px.png') }}" sizes="128x128" />

        <!--begin::Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
                google: {
                    "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
                },
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

        <!--end::Fonts -->

        <!--begin::Page Custom Styles(used by this page) -->
        <link href="{{ url('assets/admin/css/demo1/pages/general/login/login-2.css') }}" rel="stylesheet" type="text/css" />

        <!--end::Page Custom Styles -->

        <!--begin:: Global Mandatory Vendors -->
        <link href="{{ url('assets/admin/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />

        <!--end:: Global Mandatory Vendors -->

        <!--begin:: Global Optional Vendors -->
        <link href="{{ url('assets/admin/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />

        <!--end:: Global Optional Vendors -->

        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{ url('assets/admin/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />

        <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->
        <link href="{{ url('assets/admin/css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/admin/css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/admin/css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/admin/css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />

        <!--end::Layout Skins -->
        <link rel="shortcut icon" href="{{ url('assets/admin/media/logos/favicon.ico') }}" />

        <style>
            .kt-login.kt-login--v2 .kt-login__wrapper .kt-login__container .kt-form .form-control {
                color:#fff;
            }
        </style>
        @yield('css')
    </head>

    

    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

        <!-- begin:: Page -->
         @yield('content')

        <!-- end:: Page -->

        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            // locale
            window.default_locale = "{{ config('app.locale') }}";
            window.fallback_locale = "{{ config('app.fallback_locale') }}";

            // domain
            window.app_name = "{{ config('app.name') }}";
            window.app_url= "{{ config('app.url') }}";
            window.app_domain= <?php echo json_encode(parse_url(config("app.url"))); ?>;

            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#5d78ff",
                        "dark": "#282a3c",
                        "light": "#ffffff",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };
        </script>

        <!-- end::Global Config -->

        <!--begin:: Global Mandatory Vendors -->
        <script src="{{ asset('assets/admin/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/admin/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>

        <!--end:: Global Mandatory Vendors -->

        <!--begin:: Global Optional Vendors -->
        <!--end:: Global Optional Vendors -->

        <!--begin::Global Theme Bundle(used by all pages) -->

        <!--end::Global Theme Bundle -->

        
        @yield('js')
        <!--end::Page Scripts -->
    </body>
</html>