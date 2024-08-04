@extends('layouts.template')
@section('title-bar') รายงานข้อมูลบริษัท @endsection
@section('subheader-title') รายงานข้อมูลบริษัท @endsection
@section('button-header')

    <!--begin::Dropdown-->
    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="เพิ่มบริษัท" data-placement="left">
        
@endsection

@section('page-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap py-3">
                    <div class="d-flex align-items-center mr-2 py-2">
                        <!--begin::Title-->
                        เลือกช่วงเวลาที่ต้องการ &nbsp;&nbsp;&nbsp;&nbsp; <input name="daterange">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b">

                        <div class="card-body pt-2 pb-0 mb-5">
                            <!--begin::Table-->
                            <div class="table-responsive">

                            

                                <table class="table table-separate table-hover table-head-custom table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" style="margin-top: 13px !important">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>บริษัท</th>
                                            <th>serial number</th>
                                            <th>ประเภท</th>
                                            <th>Date create</th>
                                            <!-- <th>สถานะ</th> -->
                                            <!-- <th>จัดการ</th> -->
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
    
    jQuery(document).ready(function() {
        // $("#showContactModal").modal('show')
        // KTDatatablesDataSourceAjaxServer.init();

        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            // dataTable.draw();
            // dataTable.destroy(); 

            var groupColumn = 1;

            var table = $('#kt_datatable');


            // begin first table
            var dataTable = $('#kt_datatable').DataTable({
            // table.DataTable({
                responsive: true,
                searchDelay: 500,
                stateSave: true,
                processing: true,
                serverSide: true,
                rowId: 'id',
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                // "order": [[ 0, "desc" ]],
                // order:[[5,'desc']],
                ajax: {
                    url: "/root/report/list/"+ start.format('YYYY-MM-DD') +"/"+ end.format('YYYY-MM-DD'),
                    type: 'GET',
                },
                initComplete: function(settings, json) {

                },
                columns: [
                    {data: 'id',width: '1%'},
                    {data: 'name',width: '25%'},
                    // {data: 'company_name',width: '20%'},
                    {data: 'serial_number',width: '20%'},
                    {data: 'device_status',width: '10%'},
                    {data: 'created_at',width: '10%'},
                    // {data: 'status',width: '10%'},
                    // {data: 'id',width: '10%'},
                ],
                columnDefs: [
                    {   "visible": false, 
                        "targets": [groupColumn],
                    },
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
                ],
                order: [[ 0, 'asc' ]],


                drawCallback: function ( settings ) {
                    var api     = this.api();
                    var rows    = api.rows( {page:'current'} ).nodes();
                    var last    = null;

                    api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) 
                    {
                        if ( last !== group ) {
                            $(rows).eq( i ).before(
                                '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                            );

                            last = group;
                        }
                    });
                },

                bDestroy: true
            });
        });
    });

</script>
@endsection