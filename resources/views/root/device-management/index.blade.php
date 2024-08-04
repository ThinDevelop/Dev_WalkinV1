@extends('layouts.template')
@section('title-bar') เครื่อง EDC @endsection
@section('subheader-title') เครื่อง EDC @endsection
@section('button-header')
   
    <!--begin::Dropdown-->
    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="เพิ่มเครื่อง EDC" data-placement="left">
        <a href="{{ route('root.device.create') }}" class="btn btn-fixed-height btn-white btn-hover-primary font-weight-bold px-2 px-lg-5 mr-2" >
        <span class="svg-icon svg-icon-success svg-icon-lg">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                    <rect fill="#000000" x="6" y="11" width="9" height="2" rx="1" />
                    <rect fill="#000000" x="6" y="15" width="5" height="2" rx="1" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>เพิ่ม เครื่อง EDC</a>
@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-12">
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
                                <table class="table table-separate table-hover table-head-custom table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" style="margin-top: 13px !important">
                                    <thead>
                                        <tr>
                                            <th>Serial no</th>
                                            <th>บริษัท</th>
                                            <th>ประเภท</th>
                                            <th>จัดการ</th>
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

            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
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
            // order:[[5,'desc']],
            ajax: {
                url: "/root/device",
                type: 'GET',
                data: {
                    // parameters for custom backend script demo
                    columnsDef: [
                        'serial_number','company_parent_id',
                        ,'type_name','active'
                    ],
                },
            },
            initComplete: function(settings, json) {

            },
            columns: [
                {data: 'serial_number',width: '25%'},
                // {data: 'company_name',width: '20%'},
                {data: 'company_parent_name',width: '20%'},
                {data: 'type_name',width: '10%'},
                {data: 'id',width: '10%'},
        
            ],
            columnDefs: [
                {
                    class: 'pr-0 text-center',
                    targets: -1,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return  '<a href="/root/device/'+data+'/edit"  class="btn btn-sm btn-clean btn-icon" title="แก้ไข">'+
                                    '<i class="la la-edit"></i>'+
                                '</a>'+
                                '<a href="javascript:delect('+data+',\''+row.serial_number+'\')"  class="btn btn-sm btn-clean btn-icon" title="ลบ">'+
                                    '<i class="la la-trash"></i>'+
                                '</a>';
                    }
    			},
                {
                    class: 'pr-0 text-center',
                    targets: -2,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var color = 'badge-light';
                        if(row.type == 1){
                            color = 'badge-warning';
                        }else if(row.type == 2){
                            color = 'badge-info';
                        }else if(row.type == 3){
                            color = 'badge-success';
                        }else if(row.type == 4){
                            color = 'badge-danger';
                        }else if(row.type == 5){
                            color = 'badge-primary';
                        }

                        return '<span class="badge '+color+'">'+data+'</span>';
                    }
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

    function delect(id,serial) {
        let data = id;

        Swal.fire({
            title: "คุณต้องการจะลบ '"+serial+"' หรือไม่ ?",
            text: "ไม่สามารถทำการย้อนกลับข้อมูลได้เมื่อลบไปแล้ว",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'ต้องการลบ !',
            cancelButtonText: "ไม่ต้องการลบ !",
        }).then(function(isConfirm) {
            if (isConfirm.isConfirmed) {
                event.preventDefault();
                device_delete(id);
                // document.getElementById(data.id).submit();
            }
        })
    }

    function device_delete(idx){

        var formData = {
            id: idx,
        };

        var ajaxurl = "/root/deleteDevice";
        var type = "POST";

        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ajaxurl,
            type: type,
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'ลบข้อมูลเรียบร้อยแล้ว',
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "{{ route('root.device.index')}}";
                });
            },
            fail: function(xhr, textStatus, errorThrown){
                Swal.fire(
                    {
                        icon: 'error',
                        title: 'เกิดความผิดพลาด',
                        showConfirmButton: false,
                        timer: 3000
                    }
                )

                window.location.href = "{{ route('root.device.index')}}";

            }
        });        

    }


    </script>
@endsection