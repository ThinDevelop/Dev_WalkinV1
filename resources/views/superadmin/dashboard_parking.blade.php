@extends('layouts.template')
@section('title-bar') Dashboard Parking @endsection
@section('subheader-title') Dashboard @endsection
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
                <div class="col-xl-12">
                    <!--begin::Mixed Widget 4-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column p-0">
                            <!--begin::Stats-->
                            <div class="card-spacer bg-white card-rounded flex-grow-1">
                                <!--begin::Row-->
                                <div class="row m-0">
                                    <div class="col px-8 py-6 mr-8 text-center">
                                        <div class="font-size-lg text-muted font-weight-bold">จำนวนบริษัทใช้งานฟังก์ชันค่าจอดรถ</div>
                                        <div class="font-size-h4 font-weight-bolder">{{ $vechicle_total }}</div>
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

                <!--begin::Page Head Title-->
                <div class="col-xl-12">
                    <h2 class="text-dark font-weight-bold my-4 mb-0">ข้อมูลบริษัทใช้งานฟังก์ชันค่าจอดรถ</h2>
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
                                            <th class="text-left font-weight-bold text-lg">บริษัท</th>
                                            <th class="text-center font-weight-bold text-lg">สถานะการใช้งาน</th>
                                            <th class="text-center font-weight-bold text-lg">วันเริ่มต้น - วันสิ้นสุด</th>
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
        var table;

        var initTable = function() {
            table = $('#kt_datatable').DataTable({
                paging: true,
                lengthChange: true,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                searching: true,
                ordering: false,
                info: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                oLanguage: {
                    sProcessing: "กำลังดำเนินการ...",
                    sLengthMenu: "Show _MENU_",
                    sZeroRecords: "ไม่เจอข้อมูลที่ค้นหา",
                    sInfo: "Showing _START_ to _END_ of _TOTAL_ entries",
                    sInfoEmpty: "Showing 0 to 0 of 0 entries",
                    sInfoFiltered: "(filtered from _MAX_ total entries)",
                    sSearch: "Search :",
                    aaSorting:[[0,'desc']],
                    oPaginate: {
                        sFirst:    "หน้าแรก",
                        sPrevious: "<",
                        sNext:     ">",
                        sLast:     "หน้าสุดท้าย"
                    },
                },
                ajax: {
                    url: "/superadmin/dashboard-parking/contact",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        columnsDef: [
                            'name',
                            'status_vechicle',
                            'contract_start_end',
                        ],
                    }
                },
                columns: [
                    {data: 'name', class: 'text-left font-weight-bold text-lg', width: '40%'},
                    {data: 'status_vechicle', class: 'text-center', width: '20%'},
                    {data: 'contract_start_end', class: 'text-center', width: '40%'},
                ],
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false,
                }],
            });
        };

        return {
            init: function() {
                initTable();
             },
        };

    }();

    jQuery(document).ready(function() {
        KTDatatablesDataSourceAjaxServer.init();
    });

    </script>
@endsection
