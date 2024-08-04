<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title-bar')</title>

    <!-- Scripts -->
    @yield('page-script')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel = "icon" href = "{{ asset('images/logo/Walkin-Win-Icon.png') }}" type = "image/x-icon"> 
    <!-- Styles -->
    @yield('page-style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
    <body id="kt_body" class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-secondary-enabled page-loading">
        <div id="app">
            
            <!--begin::Main-->
            <!--begin::Header Mobile-->
            <div id="kt_header_mobile" class="header-mobile">
                <!--begin::Logo-->
                <a href="/">
                    <img alt="Logo" src="{{asset('images/logo/Walkin_Logo.png')}}" class="logo-default max-h-30px" />
                </a>
                <!--end::Logo-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                        <span></span>
                    </button>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header Mobile-->
            <div class="d-flex flex-column flex-root">
                <!--begin::Page-->
                <div class="d-flex flex-row flex-column-fluid page">
                    @if(Auth::user()->hasRole('root'))
                        @include('layouts.root._menu_root')
                    @elseif(Auth::user()->hasRole('super-admin'))
                        @include('layouts.superadmin._menu_superadmin')
                    @elseif(Auth::user()->hasRole('admin'))
                        @include('layouts.admin._menu_admin')
                    @endif
                </div>
                <!--end::Page-->
            </div>
            <!--end::Main-->

            <!--begin::Scrolltop-->
            <div id="kt_scrolltop" class="scrolltop mb-4">
                <span class="svg-icon">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                            <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </div>
            <!--end::Scrolltop-->
        </div>
        <script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 },
            "colors": {
                "theme": {
                    "base": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" },
                    "light": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" },
                    "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" }
                    }, 
                "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121", "gray-1000": "#7E8299" } 
                }, "font-family": "Poppins" };</script>

        <script src="{{ asset('js/app.js') }}" ></script>
        <script src="{{ asset('js/template.js') }}" ></script>
        <script>

        function formatIdCard(idcard) {
            // ตรวจสอบว่าค่า idcard เป็นตัวเลขทั้งหมดและมีความยาว 13 หลัก
            if (/^\d{13}$/.test(idcard)) {
                return idcard.substr(0, 1) + '-' + idcard.substr(1, 2) + 'XX-XXXXX-' + idcard.substr(10, 2) + '-' + idcard.substr(12, 1);
            } else {
                return '-----';
            }
        }
        
        </script>
        @yield('custom_javascript')
</body>
</html>
