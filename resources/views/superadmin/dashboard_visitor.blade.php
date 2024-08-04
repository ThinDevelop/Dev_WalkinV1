@extends('layouts.template')
@section('title-bar')
    {{-- Dashboard Visitor --}}
@endsection
@section('subheader-title')
    {{-- Dashboard Visitor --}}
@endsection
@section('subheader-title-2')
    {{-- <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">#XRS-45670</span> --}}
@endsection

@section('button-header')
    {{-- <!--begin::Button-->
    <a href="#" class="btn btn-fixed-height btn-white btn-hover-primary font-weight-bold px-2 px-lg-5 mr-2">
    <span class="svg-icon svg-icon-success svg-icon-lg">
        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
            </g>
        </svg>
        <!--end::Svg Icon-->
    </span>New Member</a>
    <!--end::Button--> --}}
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        {{-- <div class="col-xl-12"> --}}
        <!--begin::Mixed Widget 4-->
        {{-- <div class="card card-custom card-stretch"> --}}
        <!--begin::Body-->
        {{-- <div class="card-body d-flex flex-column p-0"> --}}
        <!--begin::Stats-->
        {{-- <div class="card-spacer bg-white card-rounded flex-grow-1"> --}}
        <!--begin::Row-->
        {{-- <div class="row m-0">
                            <div class="col px-8 py-6 mr-8 text-center">
                                <div class="font-size-lg text-muted font-weight-bold">จำนวนบริษัททั้งหมด</div>
                                <div class="font-size-h4 font-weight-bolder">{{ $company_total }}</div>
                            </div>
                            <div class="col px-8 py-6 mr-8 text-center">
                                <div class="font-size-lg text-muted font-weight-bold">จำนวนบริษัทใช้งาน</div>
                                <div class="font-size-h4 font-weight-bolder">{{ $company_disabled }}</div>
                            </div>
                            <div class="col px-8 py-6 text-center">
                                <div class="font-size-lg text-muted font-weight-bold">จำนวนบริษัทเลิกใช้งาน</div>
                                <div class="font-size-h4 font-weight-bolder">{{ $company_enabled }}</div>
                            </div>
                        </div> --}}
        <!--end::Row-->
        <!--begin::Row-->
        {{-- <div class="row m-0">
                            <div class="col px-8 py-6 mr-8 text-center">
                                <div class="font-size-lg text-muted font-weight-bold">จำนวนบัญชีผู้ใช้งาน</div>
                                <div class="font-size-h4 font-weight-bolder">{{ $user_total }}</div>
                            </div>
                            <div class="col px-8 py-6 text-center">
                                <div class="font-size-lg text-muted font-weight-bold">จำนวนบริษัทที่ใช้งานฟังก์ชันค่าจอดรถ
                                </div>
                                <div class="font-size-h4 font-weight-bolder">{{ $vechicle_total }}</div>
                            </div>
                        </div> --}}
        <!--end::Row-->
        {{-- </div> --}}
        <!--end::Stats-->
        {{-- </div> --}}
        <!--end::Body-->
        {{-- </div> --}}
        <!--end::Mixed Widget 4-->
        {{-- </div> --}}

        <!--begin::Page Head Title-->
        <div class="col-xl-12">
            <h2 class="text-dark font-weight-bold my-4 mb-0">ข้อมูลผู้มาติดต่อล่าสุด</h2>
        </div>
        <!--end::Page Heading Title-->

        <div class="col-xl-12">
            <!--begin::Base Table Widget 6-->
            <div class="card card-custom gutter-b">
                <!--begin::Body-->
                <div class="card-body pt-2 pb-0 pt-5 mb-5">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table id="kt_datatable" class="table table-hover table-borderless table-vertical-center">
                            <thead>
                                <tr>
                                    <th class="text-center">รหัส</th>
                                    <th class="text-left">บริษัท</th>
                                    <th class="text-center">จำนวนผู้มาติดต่อ วันนี้</th>
                                    <th class="text-center">จำนวนผู้ที่ออกไปแล้ว วันนี้</th>
                                    <th class="text-center">จำนวนผู้กำลังติดต่อ วันนี้</th>
                                    <th class="text-center">จำนวนผู้ที่อยู่เกิน 1 วัน</th>
                                </tr>
                            </thead>
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
@endsection
@section('custom_javascript')
    <script type="text/javascript">
        "use strict";
        var KTDatatablesDataSourceAjaxServer = function() {

            var initTable1 = function() {
                var table = $('#kt_datatable');

                // begin first table
                table.DataTable({
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    rowId: 'id',
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                    },
                    ajax: {
                        url: "/superadmin/dashboard-visitor/contact",
                        type: 'GET',
                        data: {
                            columnsDef: [
                                'id',
                                'name',
                                'in',
                                'out',
                                'not_out',
                                'over',
                            ],
                        },
                    },
                    initComplete: function(settings, json) {

                    },
                    columns: [{
                            data: 'id',
                            width: '0%',
                            class: 'text-center'
                        },
                        {
                            data: 'name',
                            width: '28%',
                            class: 'text-left'
                        },
                        {
                            data: 'in',
                            width: '18%',
                            class: 'text-center'
                        },
                        {
                            data: 'out',
                            width: '18%',
                            class: 'text-center'
                        },
                        {
                            data: 'not_out',
                            width: '18%',
                            class: 'text-center'
                        },
                        {
                            data: 'over',
                            width: '18%',
                            class: 'text-center'
                        },
                    ],
                    columnDefs: [{
                            targets: 0,
                            visible: false,
                        },
                        {
                            targets: 1,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                if (data != 0) {
                                    return "<p>" + data + "</p>";
                                } else {
                                    return '-';
                                }
                            },
                        },
                        {
                            targets: 2,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                if (data != 0) {
                                    return '<a href="/superadmin/dashboard-visitor/detail/out/' +
                                        full.id + '">' + data + '</a>';
                                } else {
                                    return '-';
                                }
                            },
                        },
                        {
                            targets: 3,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                if (data != 0) {
                                    return '<a href="/superadmin/dashboard-visitor/detail/out/' +
                                        full.id + '">' + data + '</a>';
                                } else {
                                    return '-';
                                }
                            },
                        },
                        {
                            targets: 4,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                if (data != 0) {
                                    return '<a href="/superadmin/dashboard-visitor/detail/stay/' +
                                        full.id + '">' + data + '</a>';
                                } else {
                                    return '-';
                                }
                            },
                        },
                        {
                            targets: 5,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                if (data != 0) {
                                    return '<a href="/superadmin/dashboard-visitor/detail/over/' +
                                        full.id + '">' + data + '</a>';
                                } else {
                                    return '-';
                                }
                            },
                        },
                    ],
                });
            };

            return {
                init: function() {
                    initTable1();
                },
            };

        }();

        jQuery(document).ready(function() {
            KTDatatablesDataSourceAjaxServer.init();
        });
    </script>
@endsection