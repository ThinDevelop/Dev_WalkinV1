@extends('layouts.template')
@section('title-bar')
    ผู้ที่มาติดต่อ
@endsection
@section('subheader-title')
    @if ($type == 'in')
        ผู้มาติดต่อ วันนี้
    @elseif($type == 'out')
        ผู้ที่ออกไปแล้ว วันนี้
    @elseif($type == 'stay')
        ผู้กำลังติดต่อ วันนี้
    @elseif($type == 'over')
        ผู้ที่อยู่เกิน 1 วัน
    @endif
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
                        <span class="card-label font-weight-bolder text-dark"></span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-2 pb-0 mb-5">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    {{-- <th>Order ID</th> --}}
                                    <th>รูปหน้าบัตร</th>
                                    <th>Contact Code</th>
                                    <th>ชื่อผู้มาติดต่อ</th>
                                    <th>ต้องการติดต่อ</th>
                                    <th>ทะเบียนรถ</th>
                                    <th>เวลาเข้า</th>
                                    <th>เวลาออก</th>
                                    <th>เวลาที่อยู่</th>
                                    <th>สถานะ</th>
                                    <th>จัดการ</th>
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

    <!-- Modal Contact -->
    <div class="modal fade" id="showContactModal" tabindex="-1" role="dialog" aria-labelledby="showContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showContactModalLabel">ข้อมูลผู้มาติดต่อ</h5>
                    <button type="button" class="close d-flex justify-content-end mr-3" data-dismiss="modal"
                        aria-label="Close" style="width: 100px">
                        {{-- <i aria-hidden="true" class="ki ki-close"></i> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none">
                            <path d="M19.5459 17.954C19.7572 18.1653 19.876 18.452 19.876 18.7509C19.876 19.0497 19.7572 19.3364 19.5459 19.5477C19.3346 19.7591 19.0479 19.8778 18.749 19.8778C18.4501 19.8778 18.1635 19.7591 17.9521 19.5477L12 13.5937L6.0459 19.5459C5.83455 19.7572 5.54791 19.8759 5.24902 19.8759C4.95014 19.8759 4.66349 19.7572 4.45215 19.5459C4.2408 19.3345 4.12207 19.0479 4.12207 18.749C4.12207 18.4501 4.2408 18.1635 4.45215 17.9521L10.4062 11.9999L4.45402 6.04586C4.24268 5.83451 4.12395 5.54787 4.12395 5.24898C4.12395 4.9501 4.24268 4.66345 4.45402 4.45211C4.66537 4.24076 4.95201 4.12203 5.2509 4.12203C5.54978 4.12203 5.83643 4.24076 6.04777 4.45211L12 10.4062L17.954 4.45117C18.1654 4.23983 18.452 4.12109 18.7509 4.12109C19.0498 4.12109 19.3364 4.23983 19.5478 4.45117C19.7591 4.66251 19.8778 4.94916 19.8778 5.24804C19.8778 5.54693 19.7591 5.83358 19.5478 6.04492L13.5937 11.9999L19.5459 17.954Z" fill="#3F4254" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 position-absolute text-right px-5 py-3">
                        <button id="modal-select-func" class="btn btn-outline-danger py-2 modal-btn-text modal-btn-css" style="width: 120px"></button>
                    </div>

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
                        <label class="col-md-3 offset-md-1 col-sm-3">ติดต่อ :</label>
                        <label class="col-md-8 col-sm-9 modal-department"></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 offset-md-1 col-sm-3">ต้องการติดต่อ :</label>
                        <label class="col-md-8 col-sm-9 modal-person-contact"></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 offset-md-1 col-sm-3">วัตถุประสงค์ :</label>
                        <label class="col-md-8 col-sm-9 modal-objective"></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 offset-md-1 col-sm-3">หมายเหตุ :</label>
                        <label class="col-md-8 col-sm-9 modal-objective-name"></label>
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
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" style="width: 120px">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end :  Modal Contact -->

    <!-- Modal Blacklist-->
    <div class="modal fade" id="showBlacklist" tabindex="-1" role="dialog" aria-labelledby="showBlacklistLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="padding-right: 0px" role="document">
            <div class="modal-content mx-auto" style="width:550px">
                <div class="modal-body">
                    <h2 class="modal-title text-center">คุณต้องการติดแบล็กลิสต์</h2>
                    <h2 class="modal-title text-center">
                        <span class="modal-name" style="color: red;"></span>
                        <span style="color: black;">หรือไม่ ?</span>
                    </h2>
                    <div class="w-100 mx-auto my-3">
                        <textarea id="modal-note-text" class="flex-grow-1 border-0 w-100 resize-none" placeholder="ระบุสาเหตุ" style="height:150px; font-size:18px; padding: 8px; overflow: hidden; color:##7E8299; background: #F3F6F9;"></textarea>
                    </div>

                    <div class="w-100 row mx-auto">
                        <div class="w-50 text-left">
                            <button class="btn btn-danger" data-toggle="modal" data-dismiss="modal" onclick="closeBlacklistModal()" style="width:95%; font-size:18px;">ย้อนกลับ</button>
                        </div>
                        <div class="w-50 text-right">
                            <button class="btn btn-primary" id="create-blacklist" data-toggle="modal" data-dismiss="modal" style="width:95%; font-size:18px;">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end : Modal Blacklist -->

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">เกิดข้อผิดพลาด</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <h3 style="color: red;">พบปัญหา</h3>
                        <h3 style="color: red;">กรุณาติดต่อเจ้าหน้าที่</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" style="width: 120px">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end : Error Modal -->

    <!-- Alert Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">แจ้งเตือน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <h3>กรุณาระบุข้อความในช่องระบุสาเหตุ</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" onclick="closeAlertModal()" data-dismiss="modal" style="width: 120px">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end : Alert Modal -->

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
                    order: [
                        [5, 'desc']
                    ],
                    ajax: {
                        url: "/admin/contact/{{ $type }}",
                        type: 'GET',
                        data: {
                            // parameters for custom backend script demo
                            columnsDef: [
                                'image_url',
                                'contact_code',
                                'fullname',
                                'department',
                                'vehicel_registration',
                                'checkin_time',
                                'checkout_time',
                                'time_in',
                                'status',
                                'id',
                            ],
                        },
                    },
                    initComplete: function(settings, json) {
                    },
                    columns: [
                        {
                            data: 'image_url'
                        },
                        {
                            data: 'contact_code'
                        },
                        {
                            data: 'fullname'
                        },
                        {
                            data: 'department'
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
                            data: 'time_in'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'id'
                        },
                    ],
                    columnDefs: [
                        {
                            // width: '150px',
                            targets: 0,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                if (data == '') {
                                    return '<div class="symbol symbol-60 symbol-light mt-2 pl-2">' +
                                            '<span class="symbol-label">' +
                                                '<img src="/images/default.jpg" class="h-100 align-self-end" alt="" />' +
                                            '</span>' +
                                        '</div>';
                                } else {
                                    return '<div class="symbol symbol-60 symbol-light mt-2 pl-2">' +
                                            '<span class="symbol-label">' +
                                                '<img src="/' + data + '" class="h-100 align-self-end" alt="" />' +
                                            '</span>' +
                                        '</div>';
                                }
                            },
                        },
                        {
                            // width: '150px',
                            targets: 3,
                            render: function(data, type, full, meta) {
                                return 'ติดต่อ' + full.department + '/' + full.objective;
                            },
                        },
                        {
                            // width: '150px',
                            targets: -2,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                if (data == 0) {
                                    return '<span class="font-weight-bolder text-success">เข้า</span>';
                                } else {
                                    return '<span class="font-weight-bolder text-danger">ออก</span>';
                                }

                            },
                        },
                        {
                            // width: '150px',
                            class: 'pr-0',
                            targets: -1,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return '<a href="/admin/print/contact/' + full.contact_code + '" target="_blank" class="btn btn-icon btn-light btn-sm mt-2 ml-2">' +
                                        '<span class="svg-icon svg-icon-md svg-icon-success"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo3\dist/../src/media/svg/icons\Devices\Printer.svg-->'+
                                                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">' +
                                                '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">' +
                                                    '<rect x="0" y="0" width="24" height="24"/>' +
                                                    '<path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>' +
                                                    '<rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>' +
                                                '</g>' +
                                            '</svg>' +
                                        '</span>' +
                                    '</a>' +
                                    '<a href="javascript:showContact(' + data + ')" class="btn btn-icon btn-light btn-sm mt-2 ml-2">' +
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

        jQuery(document).ready(function() {
            // $("#showContactModal").modal('show')
            KTDatatablesDataSourceAjaxServer.init();
        });

        function showContact(id) {
            var URL = "/admin/get/contact";
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
                        $('#showContactModal').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false
                        });

                        $('#create-blacklist').data('contact-id', data.data.id).data('type', data.data.blacklist.type);
                        $('#modal-select-func').data('contact-id', data.data.id).data('type', data.data.blacklist.type).data('status', data.data.blacklist.status);

                        $('#create-blacklist').off('click').on('click', function() {
                            var contact_id = $(this).data('contact-id');
                            var type = $(this).data('type');
                            createBlacklist(contact_id, type);
                        });

                        $('#modal-select-func').off('click').on('click', function() {
                            var status = $(this).data('status');
                            var contact_id = $(this).data('contact-id');
                            var type = $(this).data('type');
                            if (status === 1) {
                                createBlacklist(contact_id, type);
                            } else {
                                openBlacklistModal();
                            }
                        });
                        
                        $(".modal-btn-css").each(function() {
                            if (data.data.blacklist.status == 1) {
                                // ถ้า blacklist_status เป็น 1 ให้เพิ่มคลาส 'btn-outline-danger' และลบคลาส 'btn-danger'
                                $(this).addClass('btn-outline-danger').removeClass('btn-danger');
                            } else {
                                // ถ้าไม่ใช่ 1 ให้ลบคลาส 'btn-outline-danger' และเพิ่มคลาส 'btn-danger'
                                $(this).removeClass('btn-outline-danger').addClass('btn-danger');
                            }
                        });
                        $(".modal-btn-text").html(data.data.blacklist.type)
                        
                        $(".modal-contact-id").html(data.data.id)
                        $(".modal-contact-code").html(data.data.contact_code)
                        $(".modal-name").html(data.data.fullname)
                        var show_idcard = formatIdCard(data.data.idcard);
                        $(".modal-idcard").html(show_idcard)
                        $(".modal-address").html(data.data.address)
                        $(".modal-birth-date").html(data.data.birth_date)
                        $(".modal-from").html(data.data.from)
                        $(".modal-person-contact").html(data.data.person_contact)
                        $(".modal-objective-name").html(data.data.objective_note)

                        $(".modal-vehicel").html(data.data.vehicel_registration)
                        $(".modal-temperature").html(data.data.temperature)
                        $(".modal-department").html(data.data.show_department)
                        $(".modal-objective").html(data.data.show_objective)
                        $(".modal-time_in").html(data.data.time_in)
                        if (data.data.status == 1) {
                            $(".modal-checkin").html(data.data.checkin_time)
                            $(".modal-checkout").html(data.data.checkout_time)
                            $(".modal-status").html(
                                // '<span class="label label-lg font-weight-bold label-danger label-inline">ออก</span>'
                                '<span class="btn btn-danger font-weight-bolder" style="pointer-events: none;">ออก</span>'
                            )
                        } else {
                            $(".modal-checkin").html(data.data.checkin_time)
                            $(".modal-checkout").html('')
                            $(".modal-status").html(
                                // '<span class="label label-lg font-weight-bold label-success label-inline">เข้า</span>'
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
                                                '<img src="/' + item.url + '" class="align-self-end" style="height: 175px !important;" alt="' + item.type_name + '">' +
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
                    }
                }
            });
        }

        function openBlacklistModal() {
            $("#showContactModal").modal('hide');
            $('#showBlacklist').modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
        }

        function closeBlacklistModal() {
            $("#showBlacklist").modal('hide');
        }

        function closeAlertModal() {
            $("#alertModal").modal('hide');
            $('#showBlacklist').modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
        }

        function createBlacklist(contact_id, type) {
            var note = document.getElementById('modal-note-text').value;

            if (!note.trim() && type == "แบล็กลิสต์") {
                $('#alertModal').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false
                });
                return;
            }

            var URL = "/admin/blacklist/contact";
            $.ajax({
                type: "GET",
                dataType: "json",
                contentType: "x-www-form-urlencoded; charset=utf-8",
                cache: false,
                url: URL,
                data: {
                    'contact_id': contact_id,
                    'note': note,
                    'type': type,
                },
                success: function(data) {
                    if (data.status_code == 200) {
                        location.reload();
                    } else {
                        $('#errorModal').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $('#errorModal').modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false
                    });
                }
            });
        }

    </script>
@endsection
