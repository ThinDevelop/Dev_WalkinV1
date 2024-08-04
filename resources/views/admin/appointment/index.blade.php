@extends('layouts.template')
@section('title-bar') รายการนัดหมาย @endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Head-->
            <div class="d-flex flex-row align-items-end my-3">
                <h2 class="font-weight-bold mb-0">รายการนัดหมาย</h2>
                <div class="ml-auto button-container">
                    <a id="copyLink" href="{{ url('/external/appointment/' . $company->name) }}" class="btn btn-gray mr-1" style="width: 150px;">
                        <img src="{{ asset('svg/appointment_copy_link.svg') }}" alt="Icon" class="svg-icon"/>
                    </a>                    
                    <a href="{{route('admin.appointment.create')}}" class="btn btn-success ml-1" style="width: 150px;">
                        <img src="{{ asset('svg/appointment_create_appoint.svg') }}" alt="Icon" class="svg-icon"/>
                    </a>
                </div>
             </div>
            <!--end::Head-->
            <!--begin::Base Table Widget 6-->
            <div class="card card-custom gutter-b">
                <!--begin::Body-->
                <div class="card-body my-4 mx-4">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-separate table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th style="width: 15%">มาจาก</th>
                                    <th style="width: 15%">ชื่อ-นามสกุล</th>
                                    <th style="width: 15%">ช่องทางการติดต่อ</th>
                                    <th style="width: 15%">แผนกติดต่อ/วัตถุประสงค์</th>
                                    <th style="width: 15%">วัน/เวลานัดหมาย</th>
                                    <th style="width: 15%">สถานะ</th>
                                    <th style="width: 10%">จัดการ</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <!--end::Row-->

    <!-- Modal Detail -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">ข้อมูลการนัดหมาย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body mx-5 px-5">
                    <div class="my-4">
                        <div class="row">
                            <div class="col-4">
                                <strong>ชื่อ-นามสกุล :</strong>
                            </div>
                            <div class="col-8">
                                <span id="modalFullName"></span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <div class="row">
                            <div class="col-4">
                                <strong>ช่องทางติดต่อ :</strong>
                            </div>
                            <div class="col-8">
                                <span id="modalPhone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <div class="row">
                            <div class="col-4">
                                <strong>อีเมล :</strong>
                            </div>
                            <div class="col-8">
                                <span id="modalEmail"></span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <div class="row">
                            <div class="col-4">
                                <strong>แผนกติดต่อ :</strong>
                            </div>
                            <div class="col-8">
                                <span id="modalDepartment"></span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <div class="row">
                            <div class="col-4">
                                <strong>วัตถุประสงค์ :</strong>
                            </div>
                            <div class="col-8">
                                <span id="modalObjective"></span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <div class="row">
                            <div class="col-4">
                                <strong>มาจาก :</strong>
                            </div>
                            <div class="col-8">
                                <span id="modalFrom"></span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <div class="row">
                            <div class="col-4">
                                <strong>รายละเอียดเพิ่มเติม :</strong>
                            </div>
                            <div class="col-8">
                                <span id="modalNote"></span>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <div class="row">
                            <div class="col-4">
                                <strong>วัน/เวลานัดหมาย :</strong>
                            </div>
                            <div class="col-8">
                                <span id="modalDate"></span>
                            </div>
                        </div>
                    </div>
                </div>                               
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-danger wx-1 equal-width" style="font-size: 16px;" id="rejectButton">ไม่อนุมัติ</button>
                    <button type="button" class="btn btn-green wx-1 equal-width" style="font-size: 16px;" id="approveButton">อนุมัติ</button>
                    <button type="button" class="btn btn-secondary wx-1 equal-width" style="font-size: 16px;" id="closeButton">ปิด</button>
                    <button type="button" class="btn btn-danger wx-1 equal-width" style="font-size: 16px;" id="cancelApproveButton">ยกเลิกอนุมัติ</button>
                </div>                
            </div>
        </div>
    </div>

    <!-- Modal Alert -->
    <div class="modal fade" id="cancelAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="cancelAppointmentModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-custom modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 justify-content-center">
                    <h5 class="modal-title" id="cancelAppointmentModalLabel" style="font-size: 20px;">ต้องการยกเลิกการนัดหมาย ?</h5>
                </div>
                <div class="modal-body border-0">
                    <textarea class="form-control" id="reason" rows="3" placeholder="ระบุสาเหตุ (ถ้ามี)" style="background-color: #F3F6F9; resize: none; height: 100px; font-size: 18px;"></textarea>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="btn btn-danger flex-grow-1 mx-1" style="font-size: 16px;" id="backButton">ย้อนกลับ</button>
                    <button type="button" class="btn btn-success flex-grow-1 mx-1" style="font-size: 16px;" id="confirmButton">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notify -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-custom modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center border-0">
                    <h5 class="modal-title" id="notificationModalLabel" style="font-size: 24px;">การแจ้งเตือน</h5>
                </div>
                <div class="modal-body d-flex flex-column border-0">
                    <p id="notificationMessage" class="d-flex justify-content-center" style="font-size: 18px;"></p>
                    <p id="notificationMessageDesc" class="d-flex justify-content-center" style="font-size: 16px;"></p>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0">
                    <button type="button" class="btn btn-secondary flex-grow-1 mx-1" style="font-size: 16px;" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom_javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            var KTDatatablesDataSourceAjaxServer = {
                init: function() {
                    var initTable1 = function() {
                        var table = $('#kt_datatable').DataTable({
                            responsive: true,
                            searchDelay: 500,
                            processing: true,
                            serverSide: false,
                            rowId: 'id',
                            language: {
                                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                                emptyTable: 'ไม่มีข้อมูลในตาราง',
                                zeroRecords: 'ไม่พบข้อมูลที่ตรงกับการค้นหา',
                            },
                            order: [],
                            ajax: {
                                url: '/admin/appointment/dashboard', // URL สำหรับดึงข้อมูลจากเซิร์ฟเวอร์
                                type: 'GET', // หรือ 'POST' ตามที่เซิร์ฟเวอร์รอรับข้อมูล
                                dataType: 'json', // ประเภทข้อมูลที่คาดหวังจากการตอบกลับ
                                dataSrc: '' // ชื่อของตัวแปรที่มาจาก API ที่มีข้อมูลทั้งหมด
                            },
                            columns: [
                                {
                                    data: 'from',
                                    searchable: false,
                                    orderable: false,
                                },
                                {
                                    data: null,
                                    searchable: true,
                                    orderable: false,
                                    render: function(data, type, full, meta) {
                                        return data.name + ' ' + data.lastname;
                                    }
                                },
                                {
                                    data: null,
                                    searchable: false,
                                    orderable: false,
                                    render: function(data, type, full, meta) {
                                        var content = '';
                                        content += '<div style="color: black;">' + data.phone + '</div>';
                                        content += '<div style="color: grey;">' + data.email + '</div>';
                                        return content;
                                    }
                                },
                                {
                                    data: null,
                                    searchable: false,
                                    orderable: false,
                                    render: function(data, type, full, meta) {
                                        var content = '';
                                        if(data){
                                            if (data.department && data.department.name) {
                                                content += '<div style="color: black;">' + data.department.name + '</div>';
                                            } else {
                                                content += '<div style="color: black;"></div>';
                                            }
                                            if (data.objective_type && data.objective_type.name) {
                                                content += '<div style="color: grey;">' + data.objective_type.name + '</div>';
                                            } else {
                                                content += '<div style="color: grey;"></div>';
                                            }
                                            return content;
                                        } else {
                                            return '';
                                        }
                                    }
                                },
                                {
                                    data: null,
                                    searchable: false,
                                    orderable: false,
                                    render: function(data, type, full, meta) {
                                        var content = '';
                                        content += '<div style="color: black;">' + data.date_appointment_formatted + '</div>';
                                        content += '<div style="color: grey;">' + data.start_time_formatted + ' - ' + data.end_time_formatted + '</div>';
                                        return content;
                                    }
                                },
                                {
                                    data: null,
                                    searchable: false,
                                    orderable: false,
                                    render: function(data, type, full, meta) {
                                        var statusText = '';
                                        var statusColor = '';
                                        var textColor = '#FFFFFF'; // สีดำเป็นค่าเริ่มต้นสำหรับข้อความ
                                        var borderColor = 'transparent'; // ไม่มีขอบเป็นค่าเริ่มต้น

                                        switch (data.status) {
                                            case 1:
                                                statusText = 'รออนุมัติ';
                                                statusColor = '#FFA800';
                                                break;
                                            case 2:
                                                statusText = 'อนุมัติ';
                                                statusColor = '#2CBE4E';
                                                break;
                                            case 3:
                                                statusText = 'ไม่อนุมัติ';
                                                statusColor = '#F64E60';
                                                break;
                                            case 4:
                                                statusText = 'ยกเลิก';
                                                statusColor = '#FFFFFF';
                                                textColor = '#6C757D';
                                                borderColor = '#000000';
                                                break;
                                            default:
                                                statusText = 'ไม่ทราบสถานะ';
                                                statusColor = '#CCCCCC';
                                                break;
                                        }

                                        return '<div style="padding: 5px; background-color: ' + statusColor + '; color: ' + textColor + '; border-radius: 5px; border: 1px solid ' + borderColor + ';" class="text-center">' + statusText + '</div>';
                                    }
                                },
                                {
                                    data: null,
                                    searchable: false,
                                    orderable: false,
                                    render: function(data, type, full, meta) {
                                        var viewButton = '<button class="btn btn-primary" style="background-color: transparent; border: none;" data-toggle="modal" data-target="#viewModal" data-whatever=\'' + JSON.stringify(data) + '\'><i class="la la-eye" style="cursor: pointer; color: #B5B5C3; font-size: 20px;"></i></button>';
                                        var editButton = data.status === 1 ? 
                                            '<a href="/admin/appointment/' + data.id + '/edit" class="btn btn-warning" style="background-color: transparent; border: none;">' +
                                            '   <i class="la la-edit" style="cursor: pointer; color: #B5B5C3; font-size: 20px;"></i>' +
                                            '</a>' : '';
                                        return viewButton + ' ' + editButton;
                                    }
                                },
                            ],
                            initComplete: function(settings, json) {
                            }
                        });
                        return table;
                    };
                    return {
                        initTable1: initTable1 // รีเทิร์นฟังก์ชัน initTable1 เพื่อให้สามารถเรียกใช้นอกจาก init ได้
                    };
                }
            };

            // เริ่มต้นใช้งาน DataTables
            var table = KTDatatablesDataSourceAjaxServer.init().initTable1();

            // เมื่อ Modal แสดง
            $('#viewModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // ปุ่มที่ถูกคลิก
                var data = button.data('whatever'); // ข้อมูลที่คุณต้องการส่งไปยัง Modal
                console.log(data);

                // กำหนดข้อมูลใน Modal ตามที่คุณต้องการ
                var modal = $(this);
                modal.find('#modalFullName').text(data.name + ' ' + data.lastname);
                modal.find('#modalPhone').text(data.phone);
                modal.find('#modalEmail').text(data.email);
                if (data.department && data.department.name) {
                    modal.find('#modalDepartment').text(data.department.name);
                }
                modal.find('#modalObjective').text(data.objective_type.name);
                modal.find('#modalFrom').text(data.from);
                modal.find('#modalNote').text(data.note);
                modal.find('#modalDate').text(data.date_appointment + ' ' + data.start_time_formatted + ' ' + data.end_time_formatted);

                // เช็คค่า data.status เพื่อแสดงหรือซ่อนปุ่มตามเงื่อนไข
                modal.find('#rejectButton').toggle(data.status === 1);
                modal.find('#approveButton').toggle(data.status === 1);
                modal.find('#cancelApproveButton').toggle(data.status === 2);
                modal.find('#closeButton').toggle(data.status === 3 || data.status === 4);
                
                modal.find('#rejectButton').off('click').click(function() {
                    handleAppointmentAction('reject', data, table);
                    modal.modal('hide');
                });
                modal.find('#approveButton').off('click').click(function() {
                    handleAppointmentAction('approve', data, table);
                    modal.modal('hide');
                });
                modal.find('#cancelApproveButton').off('click').click(function() {
                    modal.modal('hide');
                    setTimeout(function() {
                        var cancelAppointmentModal = $('#cancelAppointmentModal');
                        cancelAppointmentModal.data('whatever', [data, table]);
                        cancelAppointmentModal.modal('show');
                    }, 500)
                });
                modal.find('#closeButton').off('click').click(function() {
                    modal.modal('hide');
                });
            });

            // เมื่อ Modal cancelAppointmentModal แสดง
            $('#cancelAppointmentModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var data = $(this).data('whatever');
                
                var modal = $(this);

                modal.find('#backButton').off('click').click(function() {
                    modal.modal('hide');
                });
                modal.find('#confirmButton').off('click').click(function() {
                    handleAppointmentAction('cancel', data[0], data[1]);
                    modal.modal('hide');
                });
            });

            $('#copyLink').click(function(event) {
                event.preventDefault();
                var url = $(this).attr('href');

                // สร้าง element input ที่ใช้เก็บ URL ที่ต้องการคัดลอก
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();

                // แสดงข้อความหลังจากคัดลอก
                alert("คัดลอก URL ไปยังคลิปบอร์ดแล้ว");
            });

        });

        // ฟังก์ชันสำหรับจัดการการทำงานของปุ่มต่างๆ
        function handleAppointmentAction(type, data, table) {
            // Get the value from the textarea
            var reason = $('#cancelAppointmentModal').find('#reason').val();

            // ประกาศตัวแปรเพื่อกำหนดข้อมูลที่จะส่งไปยังเซิร์ฟเวอร์
            var requestData = {
                type: type,
                _token: '{{ csrf_token() }}'
            };

            // เพิ่มฟิลด์ reason ไปใน requestData ถ้ามีค่า
            if (reason.trim() !== '') {
                requestData.reason = reason;
            }

            // ทำการ Ajax request ไปยังเซิร์ฟเวอร์
            $.ajax({
                type: 'PUT',
                dataType: "json",
                cache: false,
                url: '/admin/appointment/' + data.id,
                data: requestData,
                success: function(response) {

                    // เก็บข้อมูลที่ได้จากการตอบกลับ
                    var responseData = response.data;
                    var statusCode = response.status_code;

                    if(statusCode == 200){
                        setTimeout(function() {
                            $('#notificationMessage').text('ส่งอีเมลเรียบร้อยแล้ว');
                            $('#notificationMessageDesc').text("");
                            $('#notificationModal').modal('show');

                            // จัดเก็บข้อมูลที่ได้ไว้เพื่อใช้หลังจากปิด Notification Modal
                            $('#notificationModal').on('hidden.bs.modal', function () {
                                table.ajax.reload(null, false);
                            });
                        }, 500);
                    } else {
                        setTimeout(function() {
                            $('#notificationMessage').text("ส่งอีเมลไม่สำเร็จ");
                            $('#notificationMessageDesc').text("โปรดตรวจสอบเมลผู้นัดหมาย");
                            $('#notificationModal').modal('show');

                            // จัดเก็บข้อมูลที่ได้ไว้เพื่อใช้หลังจากปิด Notification Modal
                            $('#notificationModal').on('hidden.bs.modal', function () {
                                table.ajax.reload(null, false);
                            });
                        }, 500);
                    }
                },
                error: function(xhr, status, error) {
                    setTimeout(function() {
                        $('#notificationMessage').text('เกิดข้อผิดพลาดกรุณาแจ้งเจ้าหน้าที่');
                        $('#notificationMessageDesc').text("");
                        $('#notificationModal').modal('show');

                        // จัดเก็บข้อมูลที่ได้ไว้เพื่อใช้หลังจากปิด Notification Modal
                        $('#notificationModal').on('hidden.bs.modal', function () {
                            window.location.reload(); // โหลดหน้าใหม่
                        });
                    }, 500);
                }
            });
        }
    </script>
    <style>
        #kt_datatable thead th {
            color: black;
            font-weight: bold;
            font-size: 12px;
        }

        #kt_datatable tbody td {
            color: black;
            font-size: 12px;
        }

        .equal-width {
            width: 150px;
        }

        .modal-dialog {
            max-width: 40%;
        }

        .modal-dialog-custom {
            max-width: 20%;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }
        
        .btn-green:hover {
            background-color: #218838;
            color: white;
        }

        .btn-gray {
            background-color: gray;
            border-color: gray;
        }

        .btn-gray:hover {
            background-color: darkgray;
            border-color: darkgray;
        }
    </style>
@endsection
