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
                        <form id="myForm" action="/your/target/url" method="get">
                            <div class="form-inline">
                                <label for="type">ข้อมูล: </label>
                                <select id="type" name="type" class="form-control">
                                    <option value="checkin" selected>รายงานผู้มาติดต่อ</option>
                                    <option value="parking">รายงานค่าจอดรถ</option>
                                </select>
                            </div>
                        </form>
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

                    <div class="kt_datatablecontact">
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

                    <div class="kt_datatableparking">
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
                            <button type="button" class="close d-flex justify-content-end mr-3" data-dismiss="modal"
                                aria-label="Close" style="width: 100px">
                                {{-- <i aria-hidden="true" class="ki ki-close"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M19.5459 17.954C19.7572 18.1653 19.876 18.452 19.876 18.7509C19.876 19.0497 19.7572 19.3364 19.5459 19.5477C19.3346 19.7591 19.0479 19.8778 18.749 19.8778C18.4501 19.8778 18.1635 19.7591 17.9521 19.5477L12 13.5937L6.0459 19.5459C5.83455 19.7572 5.54791 19.8759 5.24902 19.8759C4.95014 19.8759 4.66349 19.7572 4.45215 19.5459C4.2408 19.3345 4.12207 19.0479 4.12207 18.749C4.12207 18.4501 4.2408 18.1635 4.45215 17.9521L10.4062 11.9999L4.45402 6.04586C4.24268 5.83451 4.12395 5.54787 4.12395 5.24898C4.12395 4.9501 4.24268 4.66345 4.45402 4.45211C4.66537 4.24076 4.95201 4.12203 5.2509 4.12203C5.54978 4.12203 5.83643 4.24076 6.04777 4.45211L12 10.4062L17.954 4.45117C18.1654 4.23983 18.452 4.12109 18.7509 4.12109C19.0498 4.12109 19.3364 4.23983 19.5478 4.45117C19.7591 4.66251 19.8778 4.94916 19.8778 5.24804C19.8778 5.54693 19.7591 5.83358 19.5478 6.04492L13.5937 11.9999L19.5459 17.954Z"
                                        fill="#3F4254" />
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- <div class="col-12 position-absolute text-right px-5 py-3" onclick="openBlacklistModal()">
                                <button class="btn btn-danger py-2" style="width: 120px">แบล็กลิสต์</button>
                            </div> --}}
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">Contact ID :</label>
                                <label class="col-4 text-left my-auto modal-contact-id"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">Contact Code :</label>
                                <label class="col-4 text-left my-auto modal-contact-code"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">ชื่อผู้มาติดต่อ :</label>
                                <label class="col-4 text-left my-auto modal-name"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">หมายเลขบัตร :</label>
                                <label class="col-4 text-left my-auto modal-idcard"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">ที่อยู่ :</label>
                                <label class="col-4 text-left my-auto modal-address"></label>
                            </div>
                            {{-- <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">วันเกิด :</label>
                                <label class="col-4 text-left my-auto modal-birth-date"></label>
                            </div> --}}
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">ทะเบียนรถ :</label>
                                <label class="col-4 text-left my-auto modal-vehicel"></label>
                            </div>
                            {{-- <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">อุณหภูมิ :</label>
                                <label class="col-4 text-left my-auto modal-temperature"></label>
                            </div> --}}
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">ติดต่อ :</label>
                                <label class="col-4 text-left my-auto modal-department"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">ต้องการติดต่อ :</label>
                                <label class="col-4 text-left my-auto modal-person-contact"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">วัตถุประสงค์ :</label>
                                <label class="col-4 text-left my-auto modal-objective"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">หมายเหตุ :</label>
                                <label class="col-4 text-left my-auto modal-objective-name"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">มาจาก :</label>
                                <label class="col-4 text-left my-auto modal-from"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">เวลาเข้า :</label>
                                <label class="col-4 text-left my-auto modal-checkin"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">เวลาออก :</label>
                                <label class="col-4 text-left my-auto modal-checkout"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">เวลาที่อยู่ :</label>
                                <label class="col-4 text-left my-auto modal-time_in"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">สถานะ :</label>
                                <label class="col-4 text-left my-auto modal-status"></label>
                            </div>
                            <div class="form-group row ml-5 my-3">
                                <label class="col-3 text-left my-auto">รูปถ่าย :</label>
                                <div class="col-md-8">
                                    <div class="row modal-show-images">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mx-3">
                            <button type="button" class="btn btn-primary font-weight-bold py-2" data-dismiss="modal"
                                style="width: 120px">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end : modal-->

            <!-- Blacklist-->
            {{-- <div class="modal fade" id="showBlacklist" tabindex="-1" role="dialog"
                aria-labelledby="showBlacklistLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" style="padding-right: 0px" role="document">
                    <div class="modal-content mx-auto" style="width:550px">
                        <div class="modal-body">
                            <h2 class="modal-title text-center">คุณต้องการติดแบล็กลิสต์</h2>
                            <h2 class="modal-title text-center">น.ส. ธนาภรณ์ ชัมพาลี หรือไม่ ?</h2>
                            <div class="w-100 mx-auto my-3">
                                <textarea class="flex-grow-1 border-0 w-100 resize-none" placeholder="ระบุสาเหตุ (ถ้ามี)"
                                    style="height:150px; font-size:18px; padding: 8px; overflow: hidden; color:##7E8299; background: #F3F6F9;"></textarea>
                            </div>

                            <div class="w-100 row mx-auto">
                                <div class="w-50 text-left">
                                    <button class="btn btn-danger" data-toggle="modal" data-dismiss="modal"
                                        onclick="closeBlacklistModal()"
                                        style="width:95%; font-size:18px;">ย้อนกลับ</button>
                                </div>
                                <div class="w-50 text-right">
                                    <button class="btn btn-primary" data-toggle="modal" data-dismiss="modal"
                                        onclick="closeBlacklistModal()"
                                        style="width:95%; font-size:18px;">บันทึกข้อมูล</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end : Blacklist-->

        </div>
    </div>
    <!--end::Row-->
@endsection
@section('custom_javascript')
    <script type="text/javascript">
        "use strict";

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
                    url: "/superadmin/report/list/{{ $date_now }}/custom",
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
                initComplete: function(settings, json) {
                    $(".ddl2title").append('วันที่ :')
                    this.api().columns([5]).every(function() {

                        var column = this;
                        var valState = column.search();

                        var newlabel = document.createElement("Label");
                        // newlabel.setAttribute("for", "ddlBussinessType");
                        // newlabel.setAttribute("id", "label-bussiness-type");
                        newlabel.innerHTML = "วันที่ : ";

                        $(".ddl2").append('<div class="ddl-date"></div>');
                        $(".ddl-date").append(
                            '<input type="text" class="form-control form-control-sm kt_datepicker_4_3">'
                        );

                        $('body').find('.kt_datepicker_4_3').datepicker({
                            format: 'yyyy-mm-dd',
                            language: 'TH',
                        }).on('changeDate', function(e) {
                            var val = $(this).val();
                            // console.log(val);
                            column.search(val).draw();
                            // ทำการค้นหาและแสดงผลลัพธ์ตามที่ต้องการ
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
                dom: "<'row'<'col-sm-2'l><'col-sm-4 ddl'><'col-sm-1 ddl2title'><'col-sm-2 ddl2'><'col-sm-3'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                order: [
                    [5, 'desc']
                ],
                ajax: {
                    url: "/superadmin/report/list/{{ $date_now }}/custom",
                    type: 'GET',
                    data: {
                        type: $('#type').val(),
                        // parameters for custom backend script demo
                        columnsDef: [
                            "company",
                            "fullname", ,
                            "vehicel_registration",
                            "checkin_time",
                            "checkout_time",
                            "time_in",
                            "price_amount",
                            "id"
                        ],
                    },
                },
                initComplete: function(settings, json) {
                    $(".ddl2title").append('วันที่ :')
                    this.api().columns([5]).every(function() {

                        var column = this;
                        var valState = column.search();

                        var newlabel = document.createElement("Label");
                        // newlabel.setAttribute("for","ddlBussinessType");
                        // newlabel.setAttribute("id","label-bussiness-type");
                        newlabel.innerHTML = "วันที่ : ";

                        $(".ddl2").append('<div class="ddl-date"></div>');
                        $(".ddl-date").append(
                            '<input type="text" class="form-control form-control-sm kt_datepicker_4_3">'
                        );

                        $('body').find('.kt_datepicker_4_3').datepicker({
                            format: 'yyyy-mm-dd',
                            language: 'TH',
                        }).on('changeDate', function(e) {
                            var val = $(this).val();
                            // console.log(val);
                            column.search(val).draw();
                            // ทำการค้นหาและแสดงผลลัพธ์ตามที่ต้องการ
                        });

                    })

                    // $(".ddl2title").append('วันที่ :')

                    // this.api().columns([5]).every(function() {

                    //     var column = this;
                    //     var valState = column.search();

                    //     var newlabel = document.createElement("Label");
                    //     newlabel.setAttribute("for", "ddlBussinessType");
                    //     newlabel.setAttribute("id", "label-bussiness-type");
                    //     // newlabel.innerHTML = "วันที่ : ";

                    //     $(".ddl2").append('<div id="ddl-date" class=""></div>');
                    //     $("#ddl-date").append(
                    //         '<input type="text" id="kt_datepicker_4_3" class="form-control form-control-sm">'
                    //     );

                    //     $('body').find('.kt_datepicker_4_3').datepicker({
                    //         format: 'yyyy-mm-dd',
                    //         language: 'TH',
                    //     }).on('changeDate', function(e) {
                    //         var val = $(this).val();
                    //         // console.log(val);
                    //         column.search(val).draw();
                    //         // ทำการค้นหาและแสดงผลลัพธ์ตามที่ต้องการ
                    //     });

                    // })
                },
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
                    //     targets: 3,
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
        };

        jQuery(document).ready(function() {
            // kt_datatablecontact()
            // kt_datatableparking()
            $('#type').change();
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

        $.fn.datepicker.dates['TH'] = {
            days: ["อาทิตย์", "จันทร์", "อังคาร", "พุทธ", "พฤหัสบดี", "ศุกร์", "เสาร์"],
            daysShort: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
            daysMin: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
            // daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน",
                "ดุลาคม", "พศจิกายน", "ธันวาคม"
            ],
            monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.",
                "ธ.ค."
            ],
            today: "วันนี้",
            clear: "Clear",
            titleFormat: "MM yyyy",
            /* Leverages same syntax as 'format' */
            weekStart: 0
        };

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


        function exportExcel() {
            company_id = "{{ $company }}";
            date_now = $('body').find('.kt_datepicker_4_3').val();;
            type_checkin = $('#type').val();

            if (date_now == '') {
                alert('กรุณาเลือก วันที่ที่ต้องการส่งออก');
                return false;
            }

            var start_date = date_now + ' 00-00-00';
            var end_date = date_now + ' 23-59-59';

            window.location.href = "/superadmin/export/contact-transection?company_id=" + company_id +
                "&type_checkin=" + type_checkin +
                "&start_date=" + start_date +
                "&end_date=" + end_date;

        }

        function openBlacklistModal() {
            $("#showContactModal").modal('hide');
            setTimeout(function() {
                $("#showBlacklist").modal('show');
            }, 1000);
        }

        function closeBlacklistModal() {
            $("#showBlacklist").modal('hide');
            setTimeout(function() {
                $("#showContactModal").modal('show');
            }, 1000);
        }
    </script>
@endsection
