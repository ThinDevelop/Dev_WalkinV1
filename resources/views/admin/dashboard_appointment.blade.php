@extends('layouts.template')
@section('title-bar')
    ผู้นัดหมาย
@endsection
@section('subheader-title')
    ผู้นัดหมาย วันนี้
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Base Table Widget 6-->
            <div class="card card-custom gutter-b">
                <!--begin::Body-->
                <div class="card-body my-4 mx-4">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-separate table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" style="margin-top: 13px !important">
                            <thead>
                                <tr>
                                    <th style="width: 20%">มาจาก</th>
                                    <th style="width: 20%">ชื่อ-นามสกุล</th>
                                    <th style="width: 15%">ช่องทางการติดต่อ</th>
                                    <th style="width: 15%">แผนกติดต่อ</th>
                                    <th style="width: 15%">วัตถุประสงค์</th>
                                    <th style="width: 15%">เวลานัดหมาย</th>
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
        $(document).ready(function() {
            var KTDatatablesDataSourceAjaxServer = function() {
                var initTable1 = function() {
                    var table = $('#kt_datatable').DataTable({
                        responsive: true,
                        searchDelay: 500,
                        processing: true,
                        serverSide: false,
                        rowId: 'id',
                        language: {
                            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
                            emptyTable: 'ไม่มีข้อมูลในตาราง',
                            zeroRecords: 'ไม่พบข้อมูลที่ตรงกับการค้นหา',
                        },
                        order: [],
                        data: {!! json_encode($appointments) !!},
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
                                    if (data && data.department && data.department.name) {
                                        return data.department.name;
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
                                    if (data && data.objective_type && data.objective_type.name) {
                                        return data.objective_type.name;
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
                                    return data.start_time_formatted + ' - ' + data.end_time_formatted;
                                }
                            },
                        ],
                        initComplete: function(settings, json) {
                        }
                    });
                };
                return {
                    init: function() {
                        initTable1();
                    },

                };
            }();
            // เริ่มต้นใช้งาน DataTables
            KTDatatablesDataSourceAjaxServer.init();
        });
    </script>
    <style>
        #kt_datatable thead th {
            color: black;
            font-weight: bold;
            font-size: 16px;
        }
        #kt_datatable tbody td {
            color: black;
            font-size: 16px;
        }
    </style>
@endsection