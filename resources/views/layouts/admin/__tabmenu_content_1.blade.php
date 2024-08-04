<!--begin::Tab Pane-->
<div class="tab-pane fade {{ Request::is('admin/dashboard') || Request::is('admin/dashboard-visitor') || Request::is('admin/dashboard-appointment') || Request::is('admin/contact/*') ? 'show active' : '' }}" id="kt_aside_tab_1">
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid px-10 py-5" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu_1" class="aside-menu" data-menu-vertical="1" data-menu-scroll="1">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">

                <li class="menu-item {{ Request::is('admin/dashboard') ? 'menu-item-active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <span
                            class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Home\Home.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z"
                                        fill="#000000" />
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        {{-- <span class="menu-text">หน้าแรก ({{Auth::user()->company->name}})</span> --}}
                        <span class="menu-text">หน้าแรก</span>
                    </a>
                </li>

                <li class="menu-section px-0">
                    <span class="my-auto font-weight-bold">Dashboard</span>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                <li class="menu-item {{ Request::is('admin/dashboard-visitor') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.dashboardVisitor') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <g clip-path="url(#clip0_393_17124)">
                                    <path opacity="0.3"
                                        d="M8.25 15.75C9.07843 15.75 9.75 15.0784 9.75 14.25C9.75 13.4216 9.07843 12.75 8.25 12.75C7.42157 12.75 6.75 13.4216 6.75 14.25C6.75 15.0784 7.42157 15.75 8.25 15.75Z"
                                        fill="#1BC5BD" />
                                    <path opacity="0.3"
                                        d="M15 4.5V2.25C15 1.425 14.325 0.75 13.5 0.75H10.5C9.675 0.75 9 1.425 9 2.25V4.5H8.25V7.5C8.25 7.9125 8.5875 8.25 9 8.25H15C15.4125 8.25 15.75 7.9125 15.75 7.5V4.5H15ZM13.5 5.25H10.5V2.25H13.5V5.25Z"
                                        fill="#1BC5BD" />
                                    <path
                                        d="M21 4.5H17.25V7.5C17.25 8.7375 16.2375 9.75 15 9.75H9C7.7625 9.75 6.75 8.7375 6.75 7.5V4.5H3C1.7625 4.5 0.75 5.5125 0.75 6.75V21C0.75 22.2375 1.7625 23.25 3 23.25H21C22.2375 23.25 23.25 22.2375 23.25 21V6.75C23.25 5.5125 22.2375 4.5 21 4.5ZM12.3675 20.1525C12.0184 20.3416 11.5488 20.2365 11.3475 19.8675C10.7025 18.7125 9.5175 18 8.25 18C6.9825 18 5.7975 18.7125 5.1525 19.8675C4.9575 20.2275 4.5 20.355 4.1325 20.1525C3.7725 19.9575 3.645 19.5 3.8475 19.1325C4.4775 18.0075 5.49 17.1825 6.6525 16.7775C5.8125 16.245 5.25 15.315 5.25 14.25C5.25 12.5925 6.5925 11.25 8.25 11.25C9.9075 11.25 11.25 12.5925 11.25 14.25C11.25 15.315 10.6875 16.245 9.8475 16.7775C11.01 17.1825 12.0225 18.0075 12.6525 19.1325C12.855 19.5 12.7275 19.9575 12.3675 20.1525ZM19.5 19.5H15.75C15.3375 19.5 15 19.1625 15 18.75C15 18.3375 15.3375 18 15.75 18H19.5C19.9125 18 20.25 18.3375 20.25 18.75C20.25 19.1625 19.9125 19.5 19.5 19.5ZM19.5 16.5H15C14.5875 16.5 14.25 16.1625 14.25 15.75C14.25 15.3375 14.5875 15 15 15H19.5C19.9125 15 20.25 15.3375 20.25 15.75C20.25 16.1625 19.9125 16.5 19.5 16.5ZM19.5 13.5H14.25C13.8375 13.5 13.5 13.1625 13.5 12.75C13.5 12.3375 13.8375 12 14.25 12H19.5C19.9125 12 20.25 12.3375 20.25 12.75C20.25 13.1625 19.9125 13.5 19.5 13.5Z"
                                        fill="#1BC5BD" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_393_17124">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">สรุปข้อมูลผู้มาติดต่อ</span>
                    </a>
                </li>

                <li class="menu-item {{ Request::is('admin/dashboard-appointment') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.dashboardAppointment') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <g clip-path="url(#clip0_500_13261)">
                                    <path d="M2.625 14.625H4.875V16.875H2.625V14.625Z" fill="#B5B5C3" />
                                    <path d="M6.375 14.625H8.625V16.875H6.375V14.625Z" fill="#B5B5C3" />
                                    <path d="M13.875 14.625H16.125V16.875H13.875V14.625Z" fill="#B5B5C3" />
                                    <path d="M2.625 18.375H4.875V20.625H2.625V18.375Z" fill="#B5B5C3" />
                                    <path d="M6.375 18.375H8.625V20.625H6.375V18.375Z" fill="#B5B5C3" />
                                    <path d="M10.125 18.375H12.375V20.625H10.125V18.375Z" fill="#B5B5C3" />
                                    <path d="M13.875 18.375H16.125V20.625H13.875V18.375Z" fill="#B5B5C3" />
                                    <path opacity="0.3"
                                        d="M18 11.25C19.3372 11.25 20.6096 10.7464 21.5816 9.83362C22.6417 8.84812 23.25 7.45087 23.25 6C23.25 3.105 20.895 0.75 18 0.75C15.105 0.75 12.75 3.105 12.75 6C12.75 6.97013 13.0275 7.91325 13.524 8.72812L11.8391 14.625H10.125V16.875H12.375V14.7915L17.0426 11.1611C17.3557 11.2192 17.676 11.25 18 11.25ZM14.7791 9.12975C13.9665 8.29725 13.5 7.17112 13.5 6C13.5 3.51863 15.5186 1.5 18 1.5C20.4814 1.5 22.5 3.51863 22.5 6C22.5 7.1715 22.0331 8.298 21.2186 9.13163C21.0544 8.59912 20.7683 8.12025 20.385 7.74C19.7775 7.12875 18.93 6.75 18 6.75C16.485 6.75 15.2051 7.75275 14.7791 9.12975Z"
                                        fill="#B5B5C3" />
                                    <path opacity="0.3"
                                        d="M18 6.75C19.0355 6.75 19.875 5.91053 19.875 4.875C19.875 3.83947 19.0355 3 18 3C16.9645 3 16.125 3.83947 16.125 4.875C16.125 5.91053 16.9645 6.75 18 6.75Z"
                                        fill="#B5B5C3" />
                                    <path
                                        d="M2.25 23.25H16.5C17.3284 23.25 18 22.5784 18 21.75V12C17.7367 12 17.4784 11.9798 17.2245 11.9453L16.6751 12.375H16.875V21.75C16.875 21.957 16.707 22.125 16.5 22.125H2.25C2.043 22.125 1.875 21.957 1.875 21.75V12.375H11.7022L12.7736 8.625H10.875V7.5C10.875 7.08562 10.5394 6.75 10.125 6.75C9.71062 6.75 9.375 7.08562 9.375 7.5V8.625H7.5V7.5C7.5 7.08562 7.16437 6.75 6.75 6.75C6.33563 6.75 6 7.08562 6 7.5V8.625H4.125V7.5C4.125 7.08562 3.78938 6.75 3.375 6.75C2.96062 6.75 2.625 7.08562 2.625 7.5V8.625H2.25C1.42162 8.625 0.75 9.29662 0.75 10.125V21.75C0.75 22.5784 1.42162 23.25 2.25 23.25Z"
                                        fill="#B5B5C3" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_500_13261">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">สรุปข้อมูลนัดหมายล่วงหน้า</span>
                    </a>
                </li>

                <li class="menu-section px-0">
                    <span class="my-auto font-weight-bold">ผู้มาติดต่อ</span>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                <li class="menu-item {{ Request::is('admin/contact/in') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="/admin/contact/in" class="menu-link">
                        <span
                            class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Arrow-to-right.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(10.000000, 12.000000) rotate(-90.000000) translate(-10.000000, -12.000000) "
                                        x="9" y="5" width="2" height="14" rx="1" />
                                    <rect fill="#000000" opacity="0.3" x="19" y="3" width="2" height="18"
                                        rx="1" />
                                    <path
                                        d="M7.70710318,15.7071045 C7.31657888,16.0976288 6.68341391,16.0976288 6.29288961,15.7071045 C5.90236532,15.3165802 5.90236532,14.6834152 6.29288961,14.2928909 L12.2928896,8.29289093 C12.6714686,7.914312 13.281055,7.90106637 13.675721,8.26284357 L19.675721,13.7628436 C20.08284,14.136036 20.1103429,14.7686034 19.7371505,15.1757223 C19.3639581,15.5828413 18.7313908,15.6103443 18.3242718,15.2371519 L13.0300721,10.3841355 L7.70710318,15.7071045 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(12.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-12.999999, -11.999997) " />
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">ผู้มาติดต่อ วันนี้</span>
                    </a>
                </li>

                <li class="menu-item {{ Request::is('admin/contact/out') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="/admin/contact/out" class="menu-link">
                        <span
                            class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Arrow-to-left.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <rect fill="#000000" opacity="0.3"
                                        transform="translate(14.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-14.000000, -12.000000) "
                                        x="13" y="5" width="2" height="14" rx="1" />
                                    <rect fill="#000000" opacity="0.3" x="3" y="3" width="2" height="18"
                                        rx="1" />
                                    <path
                                        d="M5.7071045,15.7071045 C5.3165802,16.0976288 4.68341522,16.0976288 4.29289093,15.7071045 C3.90236664,15.3165802 3.90236664,14.6834152 4.29289093,14.2928909 L10.2928909,8.29289093 C10.6714699,7.914312 11.2810563,7.90106637 11.6757223,8.26284357 L17.6757223,13.7628436 C18.0828413,14.136036 18.1103443,14.7686034 17.7371519,15.1757223 C17.3639594,15.5828413 16.7313921,15.6103443 16.3242731,15.2371519 L11.0300735,10.3841355 L5.7071045,15.7071045 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(11.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-11.000001, -11.999997) " />
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">ผู้ที่ออกไปแล้ว วันนี้</span>
                    </a>
                </li>

                <li class="menu-item {{ Request::is('admin/contact/stay') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="/admin/contact/stay" class="menu-link">
                        <span
                            class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Arrow-to-bottom.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <rect fill="#000000" opacity="0.3" x="11" y="3" width="2" height="14"
                                        rx="1" />
                                    <path
                                        d="M6.70710678,16.7071068 C6.31658249,17.0976311 5.68341751,17.0976311 5.29289322,16.7071068 C4.90236893,16.3165825 4.90236893,15.6834175 5.29289322,15.2928932 L11.2928932,9.29289322 C11.6714722,8.91431428 12.2810586,8.90106866 12.6757246,9.26284586 L18.6757246,14.7628459 C19.0828436,15.1360383 19.1103465,15.7686056 18.7371541,16.1757246 C18.3639617,16.5828436 17.7313944,16.6103465 17.3242754,16.2371541 L12.0300757,11.3841378 L6.70710678,16.7071068 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(12.000003, 12.999999) scale(1, -1) translate(-12.000003, -12.999999) " />
                                    <rect fill="#000000" opacity="0.3" x="3" y="19" width="18" height="2"
                                        rx="1" />
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">ผู้กำลังติดต่อ วันนี้</span>
                    </a>
                </li>

                <li class="menu-item {{ Request::is('admin/contact/over') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="/admin/contact/over" class="menu-link">
                        <span
                            class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Code\Time-schedule.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z"
                                        fill="#000000" />
                                    <path
                                        d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">ผู้ที่อยู่เกิน 1 วัน</span>
                    </a>
                </li>

            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->

</div>
<!--end::Tab Pane-->
