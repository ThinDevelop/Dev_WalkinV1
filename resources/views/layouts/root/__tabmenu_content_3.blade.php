<!--begin::Tab Pane-->
<div class="tab-pane fade {{ (Request::is('root/device*') || Request::is('root/company*') || Request::is('root/account*')  )? 'show active' : '' }}" id="kt_aside_tab_3">
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid px-10 py-5" id="kt_aside_menu_wrapper_3">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu_3" class="aside-menu" data-menu-vertical="1" data-menu-scroll="1">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item {{ Request::is('root/users*')  ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{route('root.dashboard')}}" class="menu-link">
                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Home\Home.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h4 class="menu-text">ตั้งค่า</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                <li class="menu-item {{ Request::is('root/company*')  ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('root.company.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">                            
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24" width="512">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path d="m13.03 1.87-10.99-1.67c-.51-.08-1.03.06-1.42.39-.39.34-.62.83-.62 1.34v21.07c0 .55.45 1 1 1h3.25v-5.25c0-.97.78-1.75 1.75-1.75h2.5c.97 0 1.75.78 1.75 1.75v5.25h4.25v-20.4c0-.86-.62-1.59-1.47-1.73zm-7.53 12.88h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm0-3h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm0-3h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm0-3h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm5 9h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm0-3h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm0-3h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm0-3h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75z" fill="#B5B5C3" fill-rule="nonzero" />
                                    <path d="m22.62 10.842-7.12-1.491v14.649h6.75c.965 0 1.75-.785 1.75-1.75v-9.698c0-.826-.563-1.529-1.38-1.71zm-2.37 10.158h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm0-3h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75zm0-3h-1.5c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.5c.414 0 .75.336.75.75s-.336.75-.75.75z" fill="#B5B5C3" fill-rule="nonzero" /></svg>
                                </g>
                            </svg>                            
                        </span>
                    <span class="menu-text">บริษัท</span>
                    </a>
                </li>

                <li class="menu-item {{ Request::is('root/account*')  ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('root.account.index') }}" class="menu-link">
                     
                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\General\User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                        <span class="menu-text">ผู้ใช้งาน</span>
                    </a>
                </li>

                <li class="menu-item {{ Request::is('root/device*')  ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('root.device.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Devices\Android.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M7.5,4 L7.5,19 L16.5,19 L16.5,4 L7.5,4 Z M7.71428571,2 L16.2857143,2 C17.2324881,2 18,2.8954305 18,4 L18,20 C18,21.1045695 17.2324881,22 16.2857143,22 L7.71428571,22 C6.76751186,22 6,21.1045695 6,20 L6,4 C6,2.8954305 6.76751186,2 7.71428571,2 Z" fill="#000000" fill-rule="nonzero"/>
                                    <polygon fill="#000000" opacity="0.3" points="7.5 4 7.5 19 16.5 19 16.5 4"/>
                                </g>
                            </svg><!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">เครื่อง EDC</span>
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
