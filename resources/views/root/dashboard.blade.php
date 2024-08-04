@extends('layouts.template')
@section('title-bar') Dashboards @endsection
@section('subheader-title') Dashboards @endsection
@section('button-header')

    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
        
@endsection
@section('content')

    @if ($message = Session::get('success'))
    <div class="alert alert-custom alert-light-primary fade show m-3" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ $message }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-custom alert-light-danger fade show m-3" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">{{ $message }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
    @endif
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Mixed Widget 4-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column p-0">
                            <!--begin::Stats-->
                            <div class="card-spacer bg-white card-rounded flex-grow-1">
                                <!--begin::Row-->
                                <div class="row m-0">
                                    <div class="col px-8 py-6 mr-8 text-center">
                                        <div class="font-size-lg text-muted font-weight-bold">บริษัท รปภ.</div>
                                        <div class="font-size-h4 font-weight-bolder">{{ number_format($company_parent, 0) }}</div>
                                    </div>
                                    <div class="col px-8 py-6 text-center">
                                        <div class="font-size-lg text-muted font-weight-bold">เครื่อง EDC</div>
                                        <div class="font-size-h4 font-weight-bolder">{{ number_format($edc, 0) }}</div>
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row m-0">
                                    <div class="col px-8 py-6 mr-8 text-center">
                                        <div class="font-size-lg text-muted font-weight-bold">ผู้ใช้งาน</div>
                                        <div class="font-size-h4 font-weight-bolder">{{ number_format($users, 0) }}</div>
                                    </div>
                                    <div class="col px-8 py-6 text-center">
                                        <div class="font-size-lg text-muted font-weight-bold">ผู้ดูแลระบบ</div>
                                        <div class="font-size-h4 font-weight-bolder">{{ number_format($admin, 0) }}</div>
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 4-->
                </div>
                <div class="col-xl-12">
                    <!--begin::Base Table Widget 6-->
                    <div class="card card-custom gutter-b" style="display:none;">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">ผู้มาติดต่อล่าสุด</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                            </h3>
                            {{-- <div class="card-toolbar">
                                <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                                    <li class="nav-item">
                                        <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_3_1">Month</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_3_2">Week</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_3_3">Day</a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr>
                                            <th class="pl-0 text-left" style="width: 50px"><span class="text-dark font-weight-bolder d-block font-size-lg">รูปภาพ</span></th>
                                            <th class="pl-0 text-left" style="min-width: 150px"><span class="text-dark font-weight-bolder d-block font-size-lg">ชื่อ / วัตถุประสงค์</span></th>
                                            <th class="pl-0 text-right" style="min-width: 120px"></th>
                                            <th class="pl-0 text-right" style="min-width: 70px"><span class="text-dark font-weight-bolder d-block font-size-lg">วันที่ / เวลา</span></th>
                                            <th class="pl-0 text-right" style="min-width: 70px">    <span class="text-dark font-weight-bolder d-block font-size-lg">สถานะ</span></th>
                                            <th class="pl-0 text-right" style="min-width: 50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td class="pl-0">
                                                <span class="text-dark font-weight-bolder d-block font-size-lg">รูปภาพ</span>
                                            </td>
                                            <td class="pl-0">
                                                <span class="text-dark font-weight-bolder d-block font-size-lg">ชื่อ / วัตถุประสงค์</span>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <span class="text-dark font-weight-bolder d-block font-size-lg">วันที่ / เวลา</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-dark font-weight-bolder d-block font-size-lg">สถานะ</span>
                                            </td>
                                            <td class="text-right pr-0">

                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td class="pl-0">
                                                <div class="symbol symbol-50 symbol-light mr-2 mt-2">
                                                    <span class="symbol-label">
                                                        <img src="{{asset('assets/media/svg/avatars/001-boy.svg')}}" class="h-75 align-self-end" alt="" />
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Brad Simmons</a>
                                                <span class="text-muted font-weight-bold d-block">ส่งของ</span>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-sm">17-05-2020 15:30:26</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="font-weight-bolder text-danger">check out</span>
                                            </td>
                                            <td class="text-right pr-0">
                                                <a href="#" class="btn btn-icon btn-light btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0">
                                                <div class="symbol symbol-50 symbol-light mr-2 mt-2">
                                                    <span class="symbol-label">
                                                        <img src="{{asset('assets/media/svg/avatars/018-girl-9.svg')}}" class="h-75 align-self-end" alt="" />
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Jessie Clarcson</a>
                                                <span class="text-muted font-weight-bold d-block">วางบิล</span>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-sm">{{date('d-m-Y H:i:s')}}</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="font-weight-bolder text-success">check in</span>
                                            </td>
                                            <td class="text-right pr-0">
                                                <a href="#" class="btn btn-icon btn-light btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0">
                                                <div class="symbol symbol-50 symbol-light mr-2 mt-2">
                                                    <span class="symbol-label">
                                                        <img src="{{asset('assets/media/svg/avatars/047-girl-25.svg')}}" class="h-75 align-self-end" alt="" />
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Lebron Wayde</a>
                                                <span class="text-muted font-weight-bold d-block">ส่งของ</span>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-sm">01-05-2020 12:30:06</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="font-weight-bolder text-danger">check out</span>
                                            </td>
                                            <td class="text-right pr-0">
                                                <a href="#" class="btn btn-icon btn-light btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0">
                                                <div class="symbol symbol-50 symbol-light mr-2 mt-2">
                                                    <span class="symbol-label">
                                                        <img src="{{asset('assets/media/svg/avatars/014-girl-7.svg')}}" class="h-75 align-self-end" alt="" />
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Natali Trump</a>
                                                <span class="text-muted font-weight-bold d-block">ส่งของ</span>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                {{-- <span class="text-muted font-weight-bold d-block font-size-sm">Paid</span> --}}
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-sm">27-04-2020 13:37:42</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="font-weight-bolder text-danger">check out</span>
                                            </td>
                                            <td class="text-right pr-0">
                                                <a href="#" class="btn btn-icon btn-light btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0">
                                                <div class="symbol symbol-50 symbol-light mr-2 mt-2">
                                                    <span class="symbol-label">
                                                        <img src="{{asset('assets/media/svg/avatars/043-boy-18.svg')}}" class="h-75 align-self-end" alt="" />
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="pl-0">
                                                <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">Kevin Leonard</a>
                                                <span class="text-muted font-weight-bold d-block">Art Director</span>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                {{-- <span class="text-muted font-weight-bold d-block font-size-sm">Paid</span> --}}
                                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">07-04-2020 10:18:29</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="font-weight-bolder text-danger">check out</span>
                                            </td>
                                            <td class="text-right pr-0">
                                                <a href="#" class="btn btn-icon btn-light btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                                                <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Base Table Widget 6-->
                </div>
            </div>
            <!--end::Row-->

            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
