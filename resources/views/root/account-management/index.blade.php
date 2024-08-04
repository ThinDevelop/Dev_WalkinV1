@extends('layouts.template')
@section('title-bar') จัดการผู้ใช้งาน @endsection
@section('subheader-title') จัดการผู้ใช้งาน @endsection
@section('button-header')

    <!--begin::Dropdown-->
    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="เพิ่มผู้ใช้งาน" data-placement="left">
        <a href="{{ route('root.account.create') }}" class="btn btn-fixed-height btn-white btn-hover-primary font-weight-bold px-2 px-lg-5 mr-2" >
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
        </span>เพิ่มผู้ใช้งาน</a>
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

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b">

                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark"></span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                            </h3>
                        </div>

                        <div class="card-body pt-2 pb-0 mb-5">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-separate table-hover table-head-custom table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" style="margin-top: 13px !important">
                                    <thead>
                                        <tr>
                                            <th>ชื่อเข้าสู่ระบบ</th>
                                            <th>บริษัท รปภ.</th>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>สถานะ</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



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
                url: "/root/account",
                type: 'GET',
                data: {
                    // parameters for custom backend script demo
                    columnsDef: [
                        'username','company_parent_name','name',
                        ,'status','active'
                    ],
                },
            },
            initComplete: function(settings, json) {

            },
            columns: [
                {data: 'username',width: '25%'},
                {data: 'company_parent_name',width: '20%'},
                {data: 'name',width: '20%'},
                {data: 'status',width: '10%'},
                {data: 'id',width: '10%'},
        
            ],
            columnDefs: [
                {
                    class: 'pr-0 text-center',
                    targets: -1,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return  '<a href="/root/account/'+data+'/edit"  class="btn btn-sm btn-clean btn-icon" title="แก้ไข">'+
                                    '<i class="la la-edit"></i>'+
                                '</a>'+
                                '<a href="javascript:;" class="delete btn btn-sm btn-clean btn-icon" data-username="'+row.username+'" data-id="'+data+'"><i class="la la-trash text-danget"></i></i></a>'+
                               
                                '<form id="myform'+data+'" action="/root/account/'+data+'" method="POST">'+
                                '@csrf'+
                                '@method("DELETE")    '+
                                '<input type="hidden" value="'+data+'" name="id">'+
                            '</form>';
                    }
    			},
                {
                    class: 'pr-0 text-center',
                    targets: -2,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var color = 'badge-light';
                        var name = '';
                        if(row.status == 1){
                            color = 'badge-success';
                            name = 'เปิดใช้งาน';
                        }else if(row.status == 0){
                            color = 'badge-danger';
                            name = 'ปิดใช้งาน';
                        }

                        return '<span class="badge '+color+'">'+name+'</span>';
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

    $(document).on("click", ".delete", function() { 
        var $ele = $(this).parent().parent();
       

        var username = $(this).attr("data-username");
        var id = $(this).attr("data-id");

        Swal.fire({
            title: "คุณต้องการจะลบผู้ใช้งาน '"+username+"' หรือไม่ ?",
            text: "ไม่สามารถทำการย้อนกลับข้อมูลได้เมื่อลบไปแล้ว",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'ต้องการลบ !',
            cancelButtonText: "ไม่ต้องการลบ !",
        }).then(function(isConfirm) {
            if (isConfirm.isConfirmed) {
                
                $("#myform"+id).submit();
            }
        })
    });

    


    </script>
@endsection