<!--begin::Tab Pane-->
<div class="tab-pane fade {{ Request::is('admin/appointment') || Request::is('admin/appointment/create') || Request::is('admin/appointment/*/edit') ? 'show active' : '' }}"
    id="kt_aside_tab_3">
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid px-10 py-5" id="kt_aside_menu_wrapper_3">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu_3" class="aside-menu" data-menu-vertical="1" data-menu-scroll="1">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item" aria-haspopup="true">
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
                        <span class="menu-text">หน้าแรก</span>
                    </a>
                </li>

                <li class="menu-section px-0">
                    <span class="my-auto font-weight-bold">นัดหมายล่วงหน้า</span>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                <li class="menu-item {{ Request::is('admin/appointment') || Request::is('admin/appointment/create') || Request::is('admin/appointment/*/edit') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.appointment.index') }}" class="menu-link">
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
                        <span class="menu-text">รายการนัดหมาย</span>
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
