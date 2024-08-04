<!--begin::Aside-->
<div class="aside aside-left d-flex aside-fixed" id="kt_aside">
    <!--begin::Primary-->
    <div class="aside-primary d-flex flex-column align-items-center flex-row-auto">
        <!--begin::Brand-->
        <div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-5 py-lg-12">
            <!--begin::Logo-->
            <a href="{{ route('superadmin.dashboard') }}">
                <img alt="Logo" src="{{asset('images/logo/Walkin-icon-2.png')}}" class="max-h-60px" />
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Brand-->
        <!--begin::Nav Wrapper-->
        <div class="aside-nav d-flex flex-column align-items-center justify-content-between mx-0 flex-column-fluid px-0 scroll scroll-pull">
            <!--begin::Nav-->
            <ul class="nav flex-column" role="tablist" style="height: 100%;">
                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="หน้าแรก">
                    <a href="#" class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('superadmin/dashboard') || Request::is('superadmin/dashboard/*') || Request::is('superadmin/dashboard-visitor') || Request::is('superadmin/dashboard-visitor/*') || Request::is('superadmin/dashboard-parking') ? 'active' : '' }}" data-toggle="tab" data-target="#kt_aside_tab_1" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="จัดการบริษัท">
                    <a href="#" class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('superadmin/company') || Request::is('superadmin/company/*')  ? 'active' : '' }}" data-toggle="tab" data-target="#kt_aside_tab_2" role="tab">
                        <span class="svg-icon svg-icon-xl"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Home\Building.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000"/>
                                <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"/>
                                <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000" opacity="0.3"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    </a>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="จัดการผู้ใช้งานในระบบ">
                    <a href="#" class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('superadmin/user') || Request::is('superadmin/user/*') ? 'active' : '' }}" data-toggle="tab" data-target="#kt_aside_tab_3" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="รายงาน">
                    <a href="#" class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('superadmin/report/*') ? 'active' : '' }}" data-toggle="tab" data-target="#kt_aside_tab_4" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->

                <div class="mb-auto"></div>

                <!--begin::Item-->
                <li class="nav-item" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="ตั้งค่า">
                    <a href="#" class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('superadmin/change-password') ? 'active' : '' }}" data-toggle="tab" data-target="#kt_aside_tab_5" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22" fill="none">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path d="M21.9075 7.88C21.4699 7.81643 21.0522 7.65495 20.6856 7.40759C20.3191 7.16023 20.013 6.83336 19.7903 6.45132C19.5675 6.06928 19.4339 5.64191 19.3992 5.20104C19.3645 4.76017 19.4297 4.31716 19.59 3.905C19.6919 3.63554 19.7069 3.34096 19.6329 3.06254C19.559 2.78413 19.3997 2.53585 19.1775 2.3525C18.1965 1.52875 17.0799 0.881632 15.8775 0.44C15.6037 0.338287 15.3048 0.325579 15.0233 0.403685C14.7419 0.481792 14.4923 0.64673 14.31 0.875C14.0357 1.22574 13.6852 1.50941 13.2849 1.70451C12.8847 1.8996 12.4453 2.001 12 2.001C11.5548 2.001 11.1153 1.8996 10.7151 1.70451C10.3149 1.50941 9.96431 1.22574 9.69002 0.875C9.50778 0.64673 9.25816 0.481792 8.9767 0.403685C8.69525 0.325579 8.39633 0.338287 8.12252 0.44C7.01227 0.847731 5.97421 1.43006 5.04752 2.165C4.81392 2.34992 4.64567 2.60477 4.56739 2.89224C4.48912 3.1797 4.50493 3.48467 4.61252 3.7625C4.78558 4.18557 4.85709 4.64331 4.8213 5.099C4.7855 5.55469 4.64341 5.99565 4.40642 6.38651C4.16942 6.77737 3.84412 7.10725 3.45661 7.34968C3.0691 7.59211 2.63017 7.74035 2.17502 7.7825C1.87952 7.81409 1.60198 7.93973 1.38325 8.14091C1.16452 8.34208 1.01616 8.60817 0.960016 8.9C0.820364 9.59128 0.750016 10.2948 0.750016 11C0.74899 11.5904 0.796651 12.1799 0.892516 12.7625C0.940227 13.0637 1.08583 13.3407 1.3068 13.5509C1.52778 13.761 1.81182 13.8925 2.11502 13.925C2.58016 13.9686 3.02808 14.1231 3.42129 14.3754C3.8145 14.6277 4.14156 14.9705 4.37509 15.3751C4.60862 15.7798 4.74182 16.2344 4.76356 16.7011C4.78529 17.1678 4.69493 17.6329 4.50002 18.0575C4.37246 18.3337 4.34082 18.6446 4.41012 18.9408C4.47942 19.237 4.64568 19.5016 4.88252 19.6925C5.8576 20.5013 6.96345 21.1379 8.15252 21.575C8.30457 21.6277 8.46411 21.6555 8.62502 21.6575C8.84564 21.657 9.06294 21.6036 9.25869 21.5019C9.45443 21.4001 9.62292 21.2528 9.75002 21.0725C10.0173 20.683 10.3757 20.3647 10.7939 20.1451C11.2121 19.9255 11.6776 19.8114 12.15 19.8125C12.6077 19.8131 13.0589 19.9205 13.4678 20.1262C13.8766 20.332 14.2318 20.6303 14.505 20.9975C14.6867 21.2418 14.9442 21.4191 15.2372 21.5019C15.5302 21.5846 15.8423 21.5681 16.125 21.455C17.2123 21.0174 18.2245 20.4126 19.125 19.6625C19.3512 19.4755 19.5123 19.2215 19.5851 18.9372C19.6578 18.6528 19.6386 18.3527 19.53 18.08C19.3536 17.6624 19.2767 17.2095 19.3053 16.757C19.334 16.3046 19.4674 15.865 19.6951 15.473C19.9227 15.0809 20.2384 14.7472 20.6171 14.4981C20.9959 14.249 21.4274 14.0913 21.8775 14.0375C22.1694 13.9971 22.4409 13.8649 22.6526 13.6599C22.8643 13.455 23.0052 13.1879 23.055 12.8975C23.1755 12.2719 23.2407 11.637 23.25 11C23.2502 10.3281 23.1874 9.65768 23.0625 8.9975C23.0119 8.71347 22.873 8.45263 22.6657 8.25202C22.4583 8.05141 22.1931 7.92124 21.9075 7.88ZM15.75 11C15.75 11.7417 15.5301 12.4667 15.118 13.0834C14.706 13.7001 14.1203 14.1807 13.4351 14.4645C12.7499 14.7484 11.9959 14.8226 11.2684 14.6779C10.541 14.5332 9.87281 14.1761 9.34837 13.6516C8.82392 13.1272 8.46677 12.459 8.32207 11.7316C8.17738 11.0042 8.25164 10.2502 8.53547 9.56494C8.8193 8.87971 9.29994 8.29404 9.91663 7.88199C10.5333 7.46993 11.2583 7.25 12 7.25C12.9946 7.25 13.9484 7.64509 14.6517 8.34835C15.3549 9.05161 15.75 10.0054 15.75 11Z" fill="#000000"/>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->
            </ul>
            <!--end::Nav-->
        </div>
        <!--end::Nav Wrapper-->
        <!--begin::Footer-->
        <div class="aside-footer d-flex flex-column align-items-center flex-column-auto mb-3">

            <!--begin::Aside Toggle-->
            <span class="aside-toggle btn btn-icon btn-primary btn-hover-primary shadow-sm" id="kt_aside_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Toggle Aside">
                <i class="ki ki-bold-arrow-back icon-sm"></i>
            </span>
            <!--end::Aside Toggle-->
            
            <!--begin::Logout-->
            <a href="{{ route('logout') }}" class="btn btn-icon btn-clean btn-lg w-40px h-40px"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-placement="right" data-container="body" data-boundary="window" title="ออกจากระบบ">
                <span class="symbol symbol-30 symbol-lg-40">
                    <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Sign-out.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/>
                                <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/>
                                <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/>
                            </g>
                        </svg><!--end::Svg Icon-->
                    </span>
                    <!--<span class="symbol-label font-size-h5 font-weight-bold">S</span>-->
                </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <!--end::Logout-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Primary-->
    <!--begin::Secondary-->
    <div class="aside-secondary d-flex flex-row-fluid">
        <!--begin::Workspace-->
        <div class="aside-workspace scroll scroll-push my-2">
            <!--begin::Tab Content-->
            <div class="tab-content">
                @include('layouts.superadmin.__tabmenu_content_1')
                @include('layouts.superadmin.__tabmenu_content_2')
                @include('layouts.superadmin.__tabmenu_content_3')
                @include('layouts.superadmin.__tabmenu_content_4')
                @include('layouts.superadmin.__tabmenu_content_5')
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Workspace-->
    </div>
    <!--end::Secondary-->
</div>
<!--end::Aside-->
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
                        <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">@yield('subheader-title')</h2>
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
                <!--begin::Content-->
                    @yield('content')
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
