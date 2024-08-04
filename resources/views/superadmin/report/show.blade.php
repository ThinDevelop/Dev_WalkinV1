@extends('layouts.template')
@section('title-bar')
    รายงาน
@endsection
@section('subheader-title')
    รายงาน
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
        <div class="col-xl-12">
            <!--begin::Base Table Widget 6-->
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">
                            @if ($type == 'today')
                                ผู้มาติดต่อทั้งหมด วันนี้
                                <div class="form-inline mt-2">
                                    <label for="type">ข้อมูล: </label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="checkin" selected>รายงานผู้มาติดต่อ</option>
                                        <option value="parking">รายงานค่าจอดรถ</option>
                                    </select>
                                </div>
                            @elseif($type == 'week')
                                ผู้มาติดต่อทั้งหมด สัปดาห์นี้
                                <div class="form-inline mt-2">
                                    <label for="type">ข้อมูล: </label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="checkin" selected>รายงานผู้มาติดต่อ</option>
                                        <option value="parking">รายงานค่าจอดรถ</option>
                                    </select>
                                </div>
                            @elseif($type == 'month')
                                ผู้มาติดต่อทั้งหมด เดือนนี้
                                <div class="form-inline mt-2">
                                    <label for="type">ข้อมูล: </label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="checkin" selected>รายงานผู้มาติดต่อ</option>
                                        <option value="parking">รายงานค่าจอดรถ</option>
                                    </select>
                                </div>
                            @endif
                        </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2 pb-0 mb-5">

                    <!--begin::Table-->
                    <div class="row">
                        <div class="offset-md-10 col-md-2  offset-9 col-3 mb-5">
                            <button type="button" onclick="exportExcel()" class="btn btn-primary">ส่งออก Excel</button>
                        </div>
                    </div>

                    <div class="table-responsive kt_datatablecontact">
                        <table
                            class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline collapsed"
                            id="kt_datatablecontact" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th>บริษัท</th>
                                    <th>Contact Code</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>ต้องการติดต่อ</th>
                                    <th>ทะเบียนรถ</th>
                                    <th>เวลาเข้า</th>
                                    <th>เวลาออก</th>
                                    <th>เวลาที่อยู่</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="table-responsive kt_datatableparking">
                        <!-- เพิ่มตารางสำหรับรายการที่จอดรถ -->
                        <table
                            class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline collapsed"
                            id="kt_datatableparking" style="margin-top: 13px !important">
                            <!-- เพิ่มหัวข้อตารางที่ต้องการ -->
                            <thead>
                                <tr>
                                    <th>บริษัท</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>ทะเบียนรถ</th>
                                    <th>เวลาเข้า</th>
                                    <th>เวลาออก</th>
                                    <th>รวมเวลาจอด</th>
                                    <th>ค่าจอดรถ/ช่องทางชำระเงิน</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- เพิ่มข้อมูลตามที่ต้องการ -->
                            </tbody>
                        </table>
                    </div>

                    <!--end::Table-->
                </div>
                <!--end::Body-->
                <div class="text-center mb-5">
                    <a href="{{ route('superadmin.dashboard') }}" class="btn btn-light">ย้อนกลับ</a>
                </div>
            </div>
            <!--end::Base Table Widget 6-->

            <!-- Button trigger modal-->

            <!-- Modal-->
            <div class="modal fade" id="showContactModal" tabindex="-1" role="dialog"
                aria-labelledby="showContactModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showContactModalLabel">ข้อมูลผู้มาติดต่อ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">Contact Code :</label>
                                <label class="col-md-8 col-sm-9 modal-contact-code"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">ชื่อผู้มาติดต่อ :</label>
                                <label class="col-md-8 col-sm-9 modal-name"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">หมายเลขบัตร :</label>
                                <label class="col-md-8 col-sm-9 modal-idcard"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">ที่อยู่ :</label>
                                <label class="col-md-8 col-sm-9 modal-address"></label>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">วันเกิด :</label>
                                <label class="col-md-8 col-sm-9 modal-birth-date"></label>
                            </div> --}}
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">ทะเบียนรถ :</label>
                                <label class="col-md-8 col-sm-9 modal-vehicel"></label>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">อุณหภูมิ :</label>
                                <label class="col-md-8 col-sm-9 modal-temperature"></label>
                            </div> --}}
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">ต้องการติดต่อ :</label>
                                <label class="col-md-8 col-sm-9 modal-department"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">วัตถุประสงค์ :</label>
                                <label class="col-md-8 col-sm-9 modal-objective"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">มาจาก :</label>
                                <label class="col-md-8 col-sm-9 modal-from"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">เวลาเข้า :</label>
                                <label class="col-md-8 col-sm-9 modal-checkin"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">เวลาออก :</label>
                                <label class="col-md-8 col-sm-9 modal-checkout"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">เวลาที่อยู่ :</label>
                                <label class="col-md-8 col-sm-9 modal-time_in"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1 col-sm-3">สถานะ :</label>
                                <label class="col-md-8 col-sm-9 modal-status"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 offset-md-1">รูปถ่าย :</label>
                                <div class="col-md-8">
                                    <div class="row modal-show-images">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end : modal-->
        </div>
    </div>
    <!--end::Row-->
@endsection
@section('custom_javascript')
    <script type="text/javascript">
        "use strict";
        if (0) {
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
                        dom: "<'row'<'col-sm-5'l><'col-sm-4 ddl'><'col-sm-3'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                        order: [
                            [5, 'desc']
                        ],
                        ajax: {
                            url: "/superadmin/report/list/{{ $date_start }}/{{ $date_from }}",
                            type: 'GET',
                            data: {
                                // parameters for custom backend script demo
                                columnsDef: [
                                    'company',
                                    'contact_code', 'fullname', , 'department', 'vehicel_registration',
                                    'checkin_time', 'checkout_time',
                                    'time_in', 'active'
                                ],
                            },
                        },
                        initComplete: function(settings, json) {
                            this.api().columns([0]).every(function() {
                                var column = this;
                                var valState = column.search();

                                var newlabel = document.createElement("Label");
                                newlabel.setAttribute("for", "ddlCompany");
                                newlabel.setAttribute("id", "label-company");
                                newlabel.innerHTML = "บริษัท : ";
                                $(".ddl").append(
                                    "<div id='ddl-company' class='dataTables_length'></div>"
                                );
                                $("#ddl-company").append(newlabel);

                                var select = $(
                                        '<select id="ddlCompany" class="form-control form-control-sm " style="width:90%"></select>'
                                    )
                                    .appendTo('#label-company');

                                $("#ddlCompany").on('change', function() {
                                    var val = $(this).val();
                                    column.search(val).draw();
                                });
                                select.append(
                                    '<option value="" selected  >== ทั้งหมด ==</option>');
                                $.each(company, function(i, item) {
                                    select.append('<option value="' + item.name +
                                        '" data-id="' + item.id + '">' + item.name +
                                        '</option>');
                                })

                            })

                            $(".ddl2title").append('วันที่ :')

                            this.api().columns([5]).every(function() {

                                var column = this;
                                var valState = column.search();

                                var newlabel = document.createElement("Label");
                                // newlabel.setAttribute("for","ddlBussinessType");
                                // newlabel.setAttribute("id","label-bussiness-type");
                                newlabel.innerHTML = "วันที่ : ";

                                $(".ddl2").append('<div id="ddl-date" class=""></div>');
                                $("#ddl-date").append(
                                    '<input type="text" id="kt_datepicker_4_3" class="form-control form-control-sm">'
                                );

                                $('#kt_datepicker_4_3').datepicker({
                                    format: 'yyyy-mm-dd',
                                    language: 'TH',
                                }).change(function(e) {
                                    var val = $('#kt_datepicker_4_3').val()
                                    column.search(val).draw();
                                });

                            })
                        },
                        columns: [{
                                data: 'company',
                                name: 'getCompany.name'
                            },
                            {
                                data: 'contact_code'
                            },
                            {
                                data: 'fullname'
                            },
                            {
                                data: 'department',
                                name: 'getDepartment.name'
                            },
                            {
                                data: 'vehicel_registration'
                            },
                            {
                                data: 'checkin_time'
                            },
                            {
                                data: 'checkout_time'
                            },
                            {
                                data: 'time_in',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'id'
                            },
                        ],
                        columnDefs: [{
                                targets: 3,
                                render: function(data, type, full, meta) {
                                    return 'ติดต่อ' + full.department + ' /' + full.objective;
                                },
                            },
                            // {
                            //     targets: -2,
                            //     orderable: false,
                            //     render: function(data, type, full, meta) {
                            //         if (data == 0) {
                            //             return '<span class="font-weight-bolder text-success">เข้า</span>';
                            //         } else {
                            //             return '<span class="font-weight-bolder text-danger">ออก</span>';
                            //         }

                            //     },
                            // },
                            {
                                // width: '150px',
                                class: 'pr-0',
                                targets: -1,
                                orderable: false,
                                render: function(data, type, full, meta) {
                                    return '<a href="javascript:showContact(' + data +
                                        ')" class="btn btn-icon btn-light btn-sm mt-2 ml-2">' +
                                        '<span class="svg-icon svg-icon-md svg-icon-success">' +
                                        '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">' +
                                        '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">' +
                                        '<polygon points="0 0 24 0 24 24 0 24" />' +
                                        '<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />' +
                                        '<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />' +
                                        '</g>' +
                                        '</svg>' +
                                        '</span>' +
                                        '</a>';

                                },
                            },

                        ],
                    });
                };

                return {

                    //main function to initiate the module
                    init: function() {
                        initTable1();
                    },

                };

            }();
        }

        // begin first table
        var table = null;
        var table2 = null;
        var company_id;
        var type_checkin;
        var date_now;
        var val;

        function kt_datatablecontact() {
            if (table) {
                table.destroy();
            }
            // begin first table
            table = $('body').find('#kt_datatablecontact').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                rowId: 'id',
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                dom: "<'row'<'col-sm-2'l><'col-sm-4 ddl'><'col-sm-1 ddl2title'><'col-sm-2 ddl2'><'col-sm-3'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                order: [
                    [5, 'desc']
                ],
                ajax: {
                    url: "/superadmin/report/list/{{ $date_start }}/{{ $date_from }}",
                    type: 'GET',
                    data: {
                        type: $('#type').val(),
                        // parameters for custom backend script demo
                        columnsDef: [
                            'company',
                            'contact_code',
                            'fullname', ,
                            'department',
                            'vehicel_registration',
                            'checkin_time',
                            'checkout_time',
                            'time_in',
                            'active'
                        ],
                    },
                },
                initComplete: function(settings, json) {},

                columns: [{
                        data: 'company',
                        name: 'getCompany.name'
                    },
                    {
                        data: 'contact_code'
                    },
                    {
                        data: 'fullname'
                    },
                    {
                        data: 'department',
                        name: 'getDepartment.name'
                    },
                    {
                        data: 'vehicel_registration'
                    },
                    {
                        data: 'checkin_time'
                    },
                    {
                        data: 'checkout_time'
                    },
                    {
                        data: 'time_in',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id'
                    },
                ],
                columnDefs: [

                    {
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return 'ติดต่อ' + full.department + ' /' + full.objective;
                        },
                    },
                    // {
                    //     targets: -2,
                    //     orderable: false,
                    //     render: function(data, type, full, meta) {
                    //         if (data == 0) {
                    //             return '<span class="font-weight-bolder text-success">เข้า</span>';
                    //         } else {
                    //             return '<span class="font-weight-bolder text-danger">ออก</span>';
                    //         }

                    //     },
                    // },
                    {
                        class: 'pr-0',
                        targets: -1,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:showContact(' + data +
                                ')" class="btn btn-icon btn-light btn-sm mt-2 ml-2">' +
                                '<span class="svg-icon svg-icon-md svg-icon-success">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">' +
                                '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">' +
                                '<polygon points="0 0 24 0 24 24 0 24" />' +
                                '<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />' +
                                '<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />' +
                                '</g>' +
                                '</svg>' +
                                '</span>' +
                                '</a>';

                        },
                    },

                ],
            });
        }

        function kt_datatableparking() {
            if (table2) {
                table2.destroy();
            }
            // begin first table
            table2 = $('body').find('#kt_datatableparking').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                rowId: 'id',
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                dom: "<'row'<'col-sm-3'l><'col-sm-1 ddl2title'><'col-sm-3 ddl2'><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                order: [
                    [2, 'desc']
                ],
                ajax: {
                    url: "/superadmin/report/list/{{ $date_start }}/{{ $date_from }}",
                    type: 'GET',
                    data: {
                        type: $('#type').val(),
                        // parameters for custom backend script demo
                        columnsDef: [
                            "company",
                            "fullname",
                            "vehicel_registration",
                            "checkin_time",
                            "checkout_time",
                            "time_in",
                            "price_amount",
                            "id"
                        ],
                    },
                },
                initComplete: function(settings, json) {},
                columns: [{
                        data: 'company',
                        name: 'getCompany.name'
                    },
                    {
                        data: 'fullname'
                    },
                    {
                        data: 'vehicel_registration'
                    },
                    {
                        data: 'checkin_time'
                    },
                    {
                        data: 'checkout_time'
                    },
                    {
                        data: 'time_in',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'price_amount'
                    },
                    {
                        data: 'id'
                    },
                ],
                columnDefs: [

                    // {
                    //     targets: 2,
                    //     render: function(data, type, full, meta) {
                    //         return 'ติดต่อ' + full.department + ' /' + full.objective;
                    //     },
                    // },
                    // {
                    //     targets: -2,
                    //     orderable: false,
                    //     render: function(data, type, full, meta) {
                    //         if (data == 0) {
                    //             return '<span class="font-weight-bolder text-success">เข้า</span>';
                    //         } else {
                    //             return '<span class="font-weight-bolder text-danger">ออก</span>';
                    //         }
                    //     },
                    // },
                    {
                        class: 'pr-0',
                        targets: -1,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:showContact(' + data +
                                ')" class="btn btn-icon btn-light btn-sm mt-2 ml-2">' +
                                '<span class="svg-icon svg-icon-md svg-icon-success">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">' +
                                '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">' +
                                '<polygon points="0 0 24 0 24 24 0 24" />' +
                                '<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />' +
                                '<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />' +
                                '</g>' +
                                '</svg>' +
                                '</span>' +
                                '</a>';

                        },
                    },

                ],
            });
        }

        var type_checkin;
        $('body').on('change', '#type', function(e) {
            type_checkin = $('#type').val();
            switch (type_checkin) {
                case 'checkin':
                    $(".kt_datatablecontact").show();
                    $(".kt_datatableparking").hide();
                    kt_datatablecontact();
                    break;
                case 'parking':
                    $(".kt_datatablecontact").hide();
                    $(".kt_datatableparking").show();
                    kt_datatableparking();
                    break;
                case 'appointment':
                    break;
                default:
                    break;
            }
        });

        function showContact(id) {
            //
            $('#modalaccept').modal('hide');
            var URL = "/superadmin/get/contact";
            $.ajax({
                type: "GET",
                dataType: "json",
                contentType: "x-www-form-urlencoded; charset=utf-8",
                cache: false,
                url: URL,
                data: {
                    'contact': id
                },
                success: function(data) {
                    if (data.status_code == 200) {
                        $("#showContactModal").modal('show')
                        $(".modal-contact-code").html(data.data.contact_code)
                        $(".modal-name").html(data.data.fullname)
                        var show_idcard = formatIdCard(data.data.idcard);
                        $(".modal-idcard").html(show_idcard)
                        $(".modal-address").html(data.data.address)
                        $(".modal-birth-date").html(data.data.birth_date)
                        $(".modal-from").html(data.data.from)

                        $(".modal-vehicel").html(data.data.vehicel_registration)
                        $(".modal-temperature").html(data.data.temperature)
                        $(".modal-department").html(data.data.show_department)
                        $(".modal-objective").html(data.data.show_objective)
                        $(".modal-time_in").html(data.data.time_in)
                        if (data.data.status == 1) {
                            $(".modal-checkin").html(data.data.checkin_time)
                            $(".modal-checkout").html(data.data.checkout_time)
                            $(".modal-status").html(
                                // '<span class="label label-lg font-weight-bold label-light-success label-inline">ออก</span>'
                                '<span class="btn btn-danger font-weight-bolder" style="pointer-events: none;">ออก</span>'
                            )
                        } else {
                            $(".modal-checkin").html(data.data.checkin_time)
                            $(".modal-checkout").html('')
                            $(".modal-status").html(
                                // '<span class="label label-lg font-weight-bold label-light-danger label-inline">เข้า</span>'
                                '<span class="btn btn-success font-weight-bolder" style="pointer-events: none;">เข้า</span>'
                            )
                        }

                        $(".modal-show-images").html('')
                        $.each(data.data.images, function(i, item) {

                            if (item.url) {
                                $(".modal-show-images").append(
                                    '<div class="col-md-4 col-sm-6 text-center mb-5">' +
                                    '<div class="symbol symbol-120 symbol-light mr-2 mt-2">' +
                                    '<span class="">' +
                                    '<img src="/' + item.url +
                                    '" class="align-self-end" style="height: 175px !important;" alt="' +
                                    item.type_name + '">' +
                                    '</span>' +
                                    '<div>' + item.type_name + '</div>' +
                                    '</div>' +
                                    '</div>');
                            } else {
                                $(".modal-show-images").append(
                                    '<div class="col-md-4 col-sm-6 text-center mb-5">' +
                                    '<div class="symbol symbol-120 symbol-light mr-2 mt-2">' +
                                    '<span class="symbol-label">' +
                                    '<p>ไม่มีรูปภาพ</p>' +
                                    '</span>' +
                                    '<div>' + item.type_name + '</div>' +
                                    '</div>' +
                                    '</div>');
                            }
                        });


                    } else {

                    }
                }
            });
        }

        jQuery(document).ready(function() {
            // kt_datatablecontact()
            // kt_datatableparking()
            $('#type').change();
        });

        // $.fn.datepicker.dates['TH'] = {
        //     days: ["อาทิตย์", "จันทร์", "อังคาร", "พุทธ", "พฤหัสบดี", "ศุกร์", "เสาร์"],
        //     daysShort: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
        //     daysMin: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
        //     // daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
        //     months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน",
        //         "ดุลาคม", "พศจิกายน", "ธันวาคม"
        //     ],
        //     monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.",
        //         "ธ.ค."
        //     ],
        //     today: "วันนี้",
        //     clear: "Clear",
        //     titleFormat: "MM yyyy",
        //     /* Leverages same syntax as 'format' */
        //     weekStart: 0
        // };

        // $('body').on('change', '#type', function(e) {
        //     // val = $('body').find('.kt_datepicker_4_3').val()
        //     type_checkin = $('#type').val();
        //     switch (type_checkin) {
        //         case 'checkin':
        //             $(".kt_datatablecontact").show();
        //             $(".kt_datatableparking").hide();
        //             kt_datatablecontact();
        //             break;
        //         case 'parking':
        //             $(".kt_datatablecontact").hide();
        //             $(".kt_datatableparking").show();
        //             kt_datatableparking();
        //             break;
        //         case 'appointment':
        //             break;
        //         default:
        //             break;
        //     }
        // });

        function exportExcel() {

            var company = $("#ddlCompany").val();
            var data_company_id = '';
            var start_date = "{{ $date_start }}";
            var end_date = "{{ $date_from }}";
            if (company == '') {
                alert('กรุณาเลือก บริษัทที่ต้องการส่งออก');
                return false;
            } else {
                data_company_id = $("#ddlCompany").find(':selected').attr('data-id')

                window.location.href = "/superadmin/export/contact-transection?company_id=" + data_company_id +
                    "&type_checkin=" + type_checkin +
                    "&start_date=" + start_date +
                    "&end_date=" + end_date;
            }

        }
    </script>
@endsection
