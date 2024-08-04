@extends('layouts.template')
@section('title-bar')
    Blacklist Dashboard
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Base Table Widget 6-->

            <!--begin::Head-->
            <div class="d-flex flex-row align-items-center my-3">
                <h2 class="font-weight-bold py-auto my-auto">ข้อมูลแบล็กลิสต์</h2>
                <div class="ml-auto">
                    <a href="{{ route('admin.blacklist.create')}}" class="btn btn-success"
                        style="width: 150px; font-size:16px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path opacity="0.3"
                                d="M9.99984 18.3334C14.6022 18.3334 18.3332 14.6025 18.3332 10.0001C18.3332 5.39771 14.6022 1.66675 9.99984 1.66675C5.39746 1.66675 1.6665 5.39771 1.6665 10.0001C1.6665 14.6025 5.39746 18.3334 9.99984 18.3334Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.16667 9.16667V5.83333C9.16667 5.3731 9.53976 5 10 5C10.4602 5 10.8333 5.3731 10.8333 5.83333V9.16667H14.1667C14.6269 9.16667 15 9.53976 15 10C15 10.4602 14.6269 10.8333 14.1667 10.8333H10.8333V14.1667C10.8333 14.6269 10.4602 15 10 15C9.53976 15 9.16667 14.6269 9.16667 14.1667V10.8333H5.83333C5.3731 10.8333 5 10.4602 5 10C5 9.53976 5.3731 9.16667 5.83333 9.16667H9.16667Z"
                                fill="white" />
                        </svg>
                        สร้างแบล็กลิสต์
                    </a>
                </div>
            </div>
            <!--end::Head-->

            <!--begin::Base Table Widget 6-->
            <div class="card card-custom gutter-b">

                <!--begin::Body-->
                <div class="card-body pt-2 pb-5">

                    <!--begin::Select Type -->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">
                            <div class="form-inline my-2">
                                <label for="type">ข้อมูล: </label>
                                <select id="type" name="type" class="form-control mx-3">
                                    <option value="blacklist" selected>ผู้ถูกแบล็กลิสต์</option>
                                    <option value="un_blacklist">ผู้เคยถูกแบล็กลิสต์</option>
                                </select>
                            </div>
                        </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <!--end::Select Type -->

                    <!--begin::Table -->
                    <div class="table-responsive">
                        <table class="table table-separate table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datable_blacklist" style="margin-top: 13px !important">
                            <thead class="custom-thead">
                                <tr>
                                    <th style="width: 10%">รูป</th>
                                    <th style="width: 20%">ชื่อ-นามสกุล</th>
                                    <th style="width: 20%">มาจาก</th>
                                    <th style="width: 20%">สาเหตุ</th>
                                    <th style="width: 20%">วันที่สร้าง</th>
                                    <th style="width: 10%" class="change-text">จัดการ</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!--end::Table -->

                </div>
                <!--end::Body-->
            </div>
            <!--end::Base Table Widget 6-->
        </div>
    </div>
    <!--end::Row-->

    <!-- Success successModal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 id="successModalLabel">สำเร็จ</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <h3>ลบ blacklist เรียบร้อยแล้ว!</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" style="width: 120px" onclick="reloadPage()">ตกลง</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error errorModal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 id="errorModalLabel">เกิดข้อผิดพลาด</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <h3>ไม่สามารถลบได้ กรุณาติดต่อเจ้าหน้าที่</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" style="width: 120px">ตกลง</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error selectModal -->
    <div class="modal fade" id="selectModal" tabindex="-1" role="dialog" aria-labelledby="selectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 id="selectModalLabel">ต้องการจะลบหรือไม่</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&amp;times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="text-align: center;">
                    <h3>ต้องการลบข้อมูล Blacklist นี้หรือไม่</h3>
                    <h3>ข้อมูลจะถูกย้ายไปยังหน้า ผู้เคยถูกแบล็กลิสต์</h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal" style="width: 120px">ยกเลิก</button>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" style="width: 120px" id="confirmDeleteButton">ตกลง</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom_javascript')
    <script type="text/javascript">
        "use strict";

        var typeSelect = document.getElementById('type');
        var KTDatatablesDataSourceAjaxServer = function() {

            var initTable = function() {
                var table = $('#kt_datable_blacklist');
                
                table.DataTable({
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    rowId: 'id',
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                    },
                    order: [],
                    ajax: {
                        url: "/admin/blacklist/dashboard",
                        type: 'GET',
                        data: function (d) {
                            d.columnsDef = [
                                'image_url',
                                'fullname',
                                'from',
                                'note',
                                'created_at',
                                'id',
                            ];
                            d.type = typeSelect.value; // เพิ่ม type ใน data object
                        },
                    },
                    initComplete: function(settings, json) {
                    },
                    columns: [
                        { data: 'image_url' },
                        { data: 'fullname' },
                        { data: 'from' },
                        { data: 'note' },
                        { data: 'created_at' },
                        { data: 'id'},
                    ],
                    columnDefs: [
                        {
                            targets: 0, // คอลัมน์ที่ 0 คือ 'image_url'
                            render: function(data, type, full, meta) {
                                var APP_URL = {!! json_encode(url('/')) !!};
                                if (data) {
                                    return "<img src='"+ APP_URL + "/" + data + "' width='85'>";
                                } else {
                                    // ไม่มีข้อมูล URL ของรูปภาพ
                                    return "<img src='" + APP_URL + "/images/noimage.png' width='85'>";
                                }
                            },
                        },
                        {
                            targets: 4, // คอลัมน์ที่ 4 คือ 'created_at'
                            render: function(data, type, full, meta) {
                                var date = new Date(data);
                                var formattedDate = date.toISOString().split('T')[0];
                                return formattedDate;
                            },
                        },
                        {
                            targets: 5, // คอลัมน์ที่ 5 คือ 'id'
                            render: function(data, type, full, meta) {
                                if (typeSelect.value == "blacklist") {
                                    return '<div class="d-flex">'+
                                        '<a href="/admin/blacklist/'+ data +'/edit" class="btn btn-icon btn-light btn-sm my-2 mx-2" style="font-size: 18px;">' +
                                            '<span class="svg-icon svg-icon-md svg-icon-success">' +
                                                '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">' +
                                                    '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">' +
                                                        '<polygon points="0 0 24 0 24 24 0 24" />' +
                                                        '<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />' +
                                                        '<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />' +
                                                    '</g>' +
                                                '</svg>' +
                                            '</span>' +
                                        '</a>' +
                                        '<a href="javascript:selectModalFunc('+ data +')" class="btn btn-icon btn-light btn-sm my-2 mx-2" style="font-size: 18px;">' +
                                            '<i class="la la-trash"></i>' +
                                        '</a>' +
                                    '</div>';
                                } else {
                                    var date = new Date(full.updated_at);
                                    var formattedDate = date.toISOString().split('T')[0];
                                    return formattedDate;
                                }
                            },
                        },
                        {
                            targets: '_all', // ปิดการเรียงลำดับสำหรับทุกคอลัมน์
                            orderable: false
                        }
                    ],
                    dom: 'rtip' // ปิดการแสดง "Show entries" dropdown
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

        typeSelect.addEventListener('change', function() {
            $(".change-text").html(typeSelect.value === 'blacklist' ? 'จัดการ' : 'วันที่ยกเลิก');
            var table = $('#kt_datable_blacklist').DataTable();
            table.ajax.url("/admin/blacklist/dashboard").load();
        });

        let deleteId = null;
        function selectModalFunc(id) {
            deleteId = id;
            $('#selectModal').modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
        }

        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            deleteBlacklist(deleteId);
        });

        function deleteBlacklist(id) {
            var URL = "/admin/blacklist/delete";
            $.ajax({
                type: "GET",
                dataType: "json",
                contentType: "x-www-form-urlencoded; charset=utf-8",
                cache: false,
                url: URL,
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.status_code == 200) {
                        $('#successModal').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false
                        });
                    } else {
                        $('#errorModal').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false
                        });
                    }
                }
            });
        }

        // function selectModalFunc() {
        //     $('#selectModal').modal({
        //         show: true,
        //         backdrop: 'static',
        //         keyboard: false
        //     });
        // }

        function reloadPage() {
            location.reload();
        }

    </script>

    <style>
        #kt_datable_blacklist thead th {
            color: black;
            font-weight: bold;
            font-size: 16px;
        }

        #kt_datable_blacklist tbody td {
            color: black;
            font-size: 16px;
            vertical-align: top;
        }
</style>

@endsection