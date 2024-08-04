<!--begin::Aside-->
<div class="aside aside-left d-flex aside-fixed" id="kt_aside">
    <!--begin::Primary-->
    <div class="aside-primary d-flex flex-column align-items-center flex-row-auto">
        <!--begin::Brand-->
        <div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-5 py-lg-12">
            <!--begin::Logo-->
            <a href="/admin/dashboard">
                {{-- @if (!empty(Auth::user()->company->logo))
                    <img alt="Logo" src="{{asset(Auth::user()->company->logo)}}" class="max-h-50px" style="max-width: 60px;"/>
                @else
                <img alt="Logo" src="{{asset('images/logo/Walkin-Win-Icon.png')}}" class="max-h-50px" />
                @endif --}}
                <img alt="Logo" src="{{ asset('images/logo/Walkin-icon-2.png') }}" class="max-h-60px" />
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Brand-->
        <!--begin::Nav Wrapper-->
        <div
            class="aside-nav d-flex flex-column align-items-center justify-content-between mx-0 flex-column-fluid px-0 scroll scroll-pull">
            <!--begin::Nav-->
            <ul class="nav flex-column" role="tablist" style="height: 100%;">
                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
                    data-boundary="window" title="หน้าแรก">
                    <a href="#"
                        class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('admin/dashboard') || Request::is('admin/dashboard-visitor') || Request::is('admin/dashboard-appointment') || Request::is('admin/contact/*') ? 'active' : '' }}"
                        data-toggle="tab" data-target="#kt_aside_tab_1" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                    <path
                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
                    data-boundary="window" title="จัดการผู้ใช้งานในระบบ">
                    <a href="#"
                        class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('admin/users/admin') || Request::is('admin/users/device') ? 'active' : '' }}"
                        data-toggle="tab" data-target="#kt_aside_tab_2" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path
                                        d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
                    data-boundary="window" title="การนัดหมาย">
                    <a href="#"
                        class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('admin/appointment') || Request::is('admin/appointment/create') || Request::is('admin/appointment/*/edit') ? 'active' : '' }}"
                        data-toggle="tab" data-target="#kt_aside_tab_3" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                                fill="none">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5 1.75H4C1.929 1.75 0.25 3.429 0.25 5.5V17.5C0.25 19.571 1.929 21.25 4 21.25H11.876C11.53 20.572 11.478 19.775 11.745 19.05C12.214 17.77 13.123 16.699 14.288 16.023C13.596 15.304 13.17 14.326 13.17 13.25C13.17 11.042 14.962 9.25 17.17 9.25C18.153 9.25 19.053 9.605 19.75 10.194V5.5C19.75 3.429 18.071 1.75 16 1.75H15V4C15 4.414 14.664 4.75 14.25 4.75C13.836 4.75 13.5 4.414 13.5 4V1.75H6.5V4C6.5 4.414 6.164 4.75 5.75 4.75C5.336 4.75 5 4.414 5 4V1.75ZM5 13.75H10C10.414 13.75 10.75 13.414 10.75 13C10.75 12.586 10.414 12.25 10 12.25H5C4.586 12.25 4.25 12.586 4.25 13C4.25 13.414 4.586 13.75 5 13.75ZM5 9.75H8.1C8.514 9.75 8.85 9.414 8.85 9C8.85 8.586 8.514 8.25 8.1 8.25H5C4.586 8.25 4.25 8.586 4.25 9C4.25 9.414 4.586 9.75 5 9.75Z"
                                        fill="#B5B5C3" />
                                    <path opacity="0.3"
                                        d="M17.1699 16.25C18.8268 16.25 20.1699 14.9069 20.1699 13.25C20.1699 11.5931 18.8268 10.25 17.1699 10.25C15.5131 10.25 14.1699 11.5931 14.1699 13.25C14.1699 14.9069 15.5131 16.25 17.1699 16.25Z"
                                        fill="#B5B5C3" />
                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.327 21.75L20.02 21.737C20.581 21.737 21.113 21.459 21.438 20.993C21.763 20.527 21.839 19.932 21.643 19.399C20.99 17.568 19.233 16.25 17.17 16.25C15.11 16.25 13.354 17.564 12.684 19.395C12.486 19.932 12.563 20.532 12.891 21.001C13.218 21.471 13.755 21.75 14.327 21.75Z"
                                        fill="#B5B5C3" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5 1.75H6.5V1C6.5 0.586 6.164 0.25 5.75 0.25C5.336 0.25 5 0.586 5 1V1.75Z"
                                        fill="#B5B5C3" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M13.5 1.75H15V1C15 0.586 14.664 0.25 14.25 0.25C13.836 0.25 13.5 0.586 13.5 1V1.75Z"
                                        fill="#B5B5C3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
                    data-boundary="window" title="ที่จอดรถ">
                    @php
                        $contractVehicle = false;
                        $date = date('Y-m-d');
                        $contractVehicleInstance = App\Models\ContractVechicle::where(
                            'company_id',
                            Auth::user()->company->id
                        )
                            ->where('status', 1)
                            ->where(function ($where) use ($date) {
                                $where
                                    ->where(function ($where2) use ($date) {
                                        $where2->where('vechicle_function_id', 2);
                                        $where2->where('end_date', '>=', $date);
                                        $where2->where('start_date', '<=', $date);
                                    })
                                    ->orWhere('vechicle_function_id', 1);
                            })
                            ->orderBy('id', 'desc')
                            ->first();
                    @endphp

                    @if (!empty($contractVehicleInstance) && Auth::user()->company->status_vechicle == 1)
                        @php $contractVehicle = true; @endphp
                    @endif
                    <a href="#"
                        class="nav-link btn btn-icon btn-clean btn-lg {{ !$contractVehicle ? 'disabled' : '' }} {{ Request::is('admin/parking') || Request::is('admin/parking/create') ? 'active' : '' }}"
                        data-toggle="tab" data-target="#kt_aside_tab_4" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"fill="none">
                                <g clip-path="url(#clip0_629_20586)">
                                    <path opacity="0.3"
                                        d="M18.8438 4.21875H18.1406V5.625H18.8438C19.2314 5.625 19.5469 5.30951 19.5469 4.92188C19.5469 4.53424 19.2314 4.21875 18.8438 4.21875Z"
                                        fill="#1BC5BD" />
                                    <path
                                        d="M15.2344 24C14.0713 24 13.125 23.0537 13.125 21.8906C13.125 20.7275 14.0713 19.7812 15.2344 19.7812C16.3975 19.7812 17.3438 20.7275 17.3438 21.8906C17.3438 23.0537 16.3975 24 15.2344 24Z"
                                        fill="#1BC5BD" />
                                    <path
                                        d="M5.15625 24C3.99316 24 3.04688 23.0537 3.04688 21.8906C3.04688 20.7275 3.99316 19.7812 5.15625 19.7812C6.31934 19.7812 7.26562 20.7275 7.26562 21.8906C7.26562 23.0537 6.31934 24 5.15625 24Z"
                                        fill="#1BC5BD" />
                                    <path
                                        d="M15.5579 12.6844C15.0694 11.5853 13.9766 10.875 12.7738 10.875H10.7812V15.0938H16.6287L15.5579 12.6844Z"
                                        fill="#1BC5BD" />
                                    <path
                                        d="M9.37482 10.875H7.14789C5.94507 10.875 4.85229 11.5853 4.36377 12.6844L3.29297 15.0938H9.37482V10.875Z"
                                        fill="#1BC5BD" />
                                    <path opacity="0.3"
                                        d="M18.375 0C15.2734 0 12.75 2.52338 12.75 5.625C12.75 8.48859 14.9009 10.8591 17.6719 11.2061V15.1932C18.1681 15.2897 18.6403 15.4543 19.0781 15.6771V11.2061C21.8491 10.8591 24 8.48859 24 5.625C24 2.52338 21.4766 0 18.375 0ZM18.8438 7.03125H18.1406V7.73438C18.1406 8.12274 17.8259 8.4375 17.4375 8.4375C17.0491 8.4375 16.7344 8.12274 16.7344 7.73438V3.51562C16.7344 3.12726 17.0491 2.8125 17.4375 2.8125H18.8438C20.0068 2.8125 20.9531 3.75879 20.9531 4.92188C20.9531 6.08496 20.0068 7.03125 18.8438 7.03125Z"
                                        fill="#1BC5BD" />
                                    <path
                                        d="M18.9844 18.8438C18.596 18.8438 18.2812 18.529 18.2812 18.1406C18.2812 17.7523 18.596 17.4375 18.9844 17.4375H19.207C18.5136 16.8528 17.6186 16.5 16.6406 16.5H2.57812C1.1543 16.5 0 17.6543 0 19.0781V21.4219C0 21.8102 0.314758 22.125 0.703125 22.125H1.64923C1.6441 22.0474 1.64062 21.9695 1.64062 21.8906C1.64062 19.9521 3.21771 18.375 5.15625 18.375C7.09479 18.375 8.67188 19.9521 8.67188 21.8906C8.67188 21.9695 8.6684 22.0474 8.66327 22.125H11.7274C11.7222 22.0474 11.7188 21.9695 11.7188 21.8906C11.7188 19.9521 13.2958 18.375 15.2344 18.375C17.1729 18.375 18.75 19.9521 18.75 21.8906C18.75 21.9695 18.7465 22.0474 18.7414 22.125H19.9219C20.3102 22.125 20.625 21.8102 20.625 21.4219V20.4844C20.625 19.8994 20.4977 19.3442 20.2712 18.8438H18.9844Z"
                                        fill="#1BC5BD" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_629_20586">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
                    data-boundary="window" title="แบล็คลิสต์">
                    <a href="#"
                        class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('admin/blacklist') || Request::is('admin/blacklist/*') ? 'active' : '' }}"
                        data-toggle="tab" data-target="#kt_aside_tab_5" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                viewBox="0 0 22 22" fill="none">
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
                    </a>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body"
                    data-boundary="window" title="รายงาน">
                    <a href="#"
                        class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('admin/report/*') ? 'active' : '' }}"
                        data-toggle="tab" data-target="#kt_aside_tab_6" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16"
                                        rx="1.5" />
                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                    <rect fill="#000000" x="18" y="11" width="3" height="9"
                                        rx="1.5" />
                                    <rect fill="#000000" x="3" y="13" width="3" height="7"
                                        rx="1.5" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                </li>
                <!--end::Item-->

                <div class="mb-auto"></div>

                <!--begin::Item-->
                <li class="nav-item" data-toggle="tooltip" data-placement="right" data-container="body"
                    data-boundary="window" title="ตั้งค่า">
                    <a href="#"
                        class="nav-link btn btn-icon btn-clean btn-lg {{ Request::is('admin/change-password') ? 'active' : '' }}"
                        data-toggle="tab" data-target="#kt_aside_tab_7" role="tab">
                        <span class="svg-icon svg-icon-xl">
                            <!--begin::Svg Icon-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22"
                                viewBox="0 0 24 22" fill="none">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path
                                        d="M21.9075 7.88C21.4699 7.81643 21.0522 7.65495 20.6856 7.40759C20.3191 7.16023 20.013 6.83336 19.7903 6.45132C19.5675 6.06928 19.4339 5.64191 19.3992 5.20104C19.3645 4.76017 19.4297 4.31716 19.59 3.905C19.6919 3.63554 19.7069 3.34096 19.6329 3.06254C19.559 2.78413 19.3997 2.53585 19.1775 2.3525C18.1965 1.52875 17.0799 0.881632 15.8775 0.44C15.6037 0.338287 15.3048 0.325579 15.0233 0.403685C14.7419 0.481792 14.4923 0.64673 14.31 0.875C14.0357 1.22574 13.6852 1.50941 13.2849 1.70451C12.8847 1.8996 12.4453 2.001 12 2.001C11.5548 2.001 11.1153 1.8996 10.7151 1.70451C10.3149 1.50941 9.96431 1.22574 9.69002 0.875C9.50778 0.64673 9.25816 0.481792 8.9767 0.403685C8.69525 0.325579 8.39633 0.338287 8.12252 0.44C7.01227 0.847731 5.97421 1.43006 5.04752 2.165C4.81392 2.34992 4.64567 2.60477 4.56739 2.89224C4.48912 3.1797 4.50493 3.48467 4.61252 3.7625C4.78558 4.18557 4.85709 4.64331 4.8213 5.099C4.7855 5.55469 4.64341 5.99565 4.40642 6.38651C4.16942 6.77737 3.84412 7.10725 3.45661 7.34968C3.0691 7.59211 2.63017 7.74035 2.17502 7.7825C1.87952 7.81409 1.60198 7.93973 1.38325 8.14091C1.16452 8.34208 1.01616 8.60817 0.960016 8.9C0.820364 9.59128 0.750016 10.2948 0.750016 11C0.74899 11.5904 0.796651 12.1799 0.892516 12.7625C0.940227 13.0637 1.08583 13.3407 1.3068 13.5509C1.52778 13.761 1.81182 13.8925 2.11502 13.925C2.58016 13.9686 3.02808 14.1231 3.42129 14.3754C3.8145 14.6277 4.14156 14.9705 4.37509 15.3751C4.60862 15.7798 4.74182 16.2344 4.76356 16.7011C4.78529 17.1678 4.69493 17.6329 4.50002 18.0575C4.37246 18.3337 4.34082 18.6446 4.41012 18.9408C4.47942 19.237 4.64568 19.5016 4.88252 19.6925C5.8576 20.5013 6.96345 21.1379 8.15252 21.575C8.30457 21.6277 8.46411 21.6555 8.62502 21.6575C8.84564 21.657 9.06294 21.6036 9.25869 21.5019C9.45443 21.4001 9.62292 21.2528 9.75002 21.0725C10.0173 20.683 10.3757 20.3647 10.7939 20.1451C11.2121 19.9255 11.6776 19.8114 12.15 19.8125C12.6077 19.8131 13.0589 19.9205 13.4678 20.1262C13.8766 20.332 14.2318 20.6303 14.505 20.9975C14.6867 21.2418 14.9442 21.4191 15.2372 21.5019C15.5302 21.5846 15.8423 21.5681 16.125 21.455C17.2123 21.0174 18.2245 20.4126 19.125 19.6625C19.3512 19.4755 19.5123 19.2215 19.5851 18.9372C19.6578 18.6528 19.6386 18.3527 19.53 18.08C19.3536 17.6624 19.2767 17.2095 19.3053 16.757C19.334 16.3046 19.4674 15.865 19.6951 15.473C19.9227 15.0809 20.2384 14.7472 20.6171 14.4981C20.9959 14.249 21.4274 14.0913 21.8775 14.0375C22.1694 13.9971 22.4409 13.8649 22.6526 13.6599C22.8643 13.455 23.0052 13.1879 23.055 12.8975C23.1755 12.2719 23.2407 11.637 23.25 11C23.2502 10.3281 23.1874 9.65768 23.0625 8.9975C23.0119 8.71347 22.873 8.45263 22.6657 8.25202C22.4583 8.05141 22.1931 7.92124 21.9075 7.88ZM15.75 11C15.75 11.7417 15.5301 12.4667 15.118 13.0834C14.706 13.7001 14.1203 14.1807 13.4351 14.4645C12.7499 14.7484 11.9959 14.8226 11.2684 14.6779C10.541 14.5332 9.87281 14.1761 9.34837 13.6516C8.82392 13.1272 8.46677 12.459 8.32207 11.7316C8.17738 11.0042 8.25164 10.2502 8.53547 9.56494C8.8193 8.87971 9.29994 8.29404 9.91663 7.88199C10.5333 7.46993 11.2583 7.25 12 7.25C12.9946 7.25 13.9484 7.64509 14.6517 8.34835C15.3549 9.05161 15.75 10.0054 15.75 11Z"
                                        fill="#000000" />
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
            <span class="aside-toggle btn btn-icon btn-primary btn-hover-primary shadow-sm" id="kt_aside_toggle"
                data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window"
                title="Toggle Aside">
                <i class="ki ki-bold-arrow-back icon-sm"></i>
            </span>
            <!--end::Aside Toggle-->

            <!--begin::Logout-->
            <a href="{{ route('logout') }}" class="btn btn-icon btn-clean btn-lg w-40px h-40px"
                onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"
                data-placement="right" data-container="body" data-boundary="window" title="ออกจากระบบ">
                <span class="symbol symbol-30 symbol-lg-40">
                    <span
                        class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Navigation\Sign-out.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path
                                    d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"
                                    transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) " />
                                <rect fill="#000000" opacity="0.3"
                                    transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) "
                                    x="13" y="6" width="2" height="12" rx="1" />
                                <path
                                    d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z"
                                    fill="#000000" fill-rule="nonzero"
                                    transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) " />
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
                @include('layouts.admin.__tabmenu_content_1')
                {{-- @include('layouts.admin.__tabmenu_content_1_sub') --}}
                @include('layouts.admin.__tabmenu_content_2')
                @include('layouts.admin.__tabmenu_content_3')
                @include('layouts.admin.__tabmenu_content_4')
                @include('layouts.admin.__tabmenu_content_5')
                @include('layouts.admin.__tabmenu_content_6')
                @include('layouts.admin.__tabmenu_content_7')
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
