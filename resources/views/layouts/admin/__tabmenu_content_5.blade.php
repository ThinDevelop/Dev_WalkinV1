<!--begin::Tab Pane-->
<div class="tab-pane fade {{ Request::is('admin/blacklist') || Request::is('admin/blacklist/*') ? 'show active' : '' }}"
    id="kt_aside_tab_5">
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
                    <span class="my-auto font-weight-bold">แบล็กลิสต์</span>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                <li class="menu-item {{ Request::is('admin/blacklist') || Request::is('admin/blacklist/*') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('admin.blacklist.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                                fill="none">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path opacity="0.3"
                                        d="M10.5 11.2439C13.5376 11.2439 16 8.78146 16 5.7439C16 2.70633 13.5376 0.243896 10.5 0.243896C7.46243 0.243896 5 2.70633 5 5.7439C5 8.78146 7.46243 11.2439 10.5 11.2439Z"
                                        fill="#1BC5BD" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M19.1521 12.7879L12.7881 19.1519C12.4951 19.4439 12.4951 19.9199 12.7881 20.2119C13.0801 20.5049 13.5561 20.5049 13.8481 20.2119L20.2121 13.8479C20.5051 13.5559 20.5051 13.0799 20.2121 12.7879C19.9201 12.4949 19.4441 12.4949 19.1521 12.7879Z"
                                        fill="#1BC5BD" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.5 11.25C13.602 11.25 11.25 13.602 11.25 16.5C11.25 19.398 13.602 21.75 16.5 21.75C19.398 21.75 21.75 19.398 21.75 16.5C21.75 13.602 19.398 11.25 16.5 11.25ZM16.5 12.75C18.57 12.75 20.25 14.43 20.25 16.5C20.25 18.57 18.57 20.25 16.5 20.25C14.43 20.25 12.75 18.57 12.75 16.5C12.75 14.43 14.43 12.75 16.5 12.75Z"
                                        fill="#1BC5BD" />
                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.925 20.756C10.886 19.64 10.25 18.144 10.25 16.5C10.25 14.817 10.917 13.288 12.001 12.164C11.511 12.126 11.01 12.106 10.5 12.106C7.178 12.106 4.237 12.937 2.411 14.182C1.018 15.132 0.25 16.339 0.25 17.606V19.056C0.25 19.507 0.429 19.94 0.748 20.258C1.067 20.577 1.499 20.756 1.95 20.756H11.925Z"
                                        fill="#1BC5BD" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">แบล็กลิสต์</span>
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
