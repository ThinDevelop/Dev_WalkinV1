<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>สร้างนัดหมายด้วยตนเอง</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel = "icon" href = "{{ asset('images/logo/Walkin-Win-Icon.png') }}" type = "image/x-icon"> 
    <!-- Styles -->
    @yield('page-style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
    <body id="kt_body">
        <div id="app">
            
            <!--begin::Main-->

            <div class="d-flex flex-column flex-root">
                <!--begin::Page-->
                <div class="d-flex flex-row flex-column-fluid page">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                        <!--begin::Content-->
                        <div class="d-flex flex-column flex-column-fluid mx-3" id="kt_content">
                            <!--begin::Subheader-->
                            <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
                                <div class="container p-0 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center flex-wrap mr-1">
                                        <!--begin::Page Heading-->
                                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                                            <!--begin::Page Title-->
                                            <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">
                                                สร้างนัดหมายด้วยตนเอง
                                            </h2>
                                            <!--end::Page Title-->
                                        </div>
                                        <!--end::Page Heading-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Button-->
                                        @yield('button-header')
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                            </div>
                            <!--end::Subheader-->
                            <!--begin::Entry-->
                            <div class="d-flex flex-column-fluid">
                                <!--begin::Container-->
                                <div class="container p-0">
                                    <div class="d-flex flex-column-fluid">
                                        <!--begin::Container-->
                                        <div class="container p-0">
                                            <div class="card card-custom card-shadowless rounded-top-0">
                                                <!--begin::Body-->
                                                <div class="card-body p-0">
                                                    <admin-appointment-create-external
                                                        :server-url="'{{ url('/') }}'"
                                                        :company="{{ json_encode($company) }}"
                                                        :departments="{{ json_encode($departments) }}"
                                                        :objective-types="{{ json_encode($objectiveTypes) }}"
                                                    ></admin-appointment-create-external>
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                        </div>
                                        <!--end::Container-->
                                    </div>
                                    <!--end::Entry-->
                                    <!--end::Content-->
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Entry-->
                        </div>
                        <!--end::Content-->
                        @include('layouts._footer')
                    </div>
                    <!--end::Wrapper-->
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
        
        </script>
        @yield('custom_javascript')
</body>
</html>
