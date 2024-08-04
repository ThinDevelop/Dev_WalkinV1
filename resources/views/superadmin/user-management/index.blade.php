@extends('layouts.template')
@section('title-bar') สร้างผู้ดูแลระบบ @endsection
@section('subheader-title') สร้างผู้ดูแลระบบ @endsection
@section('button-header')
    <!--begin::Button-->
    <a href="{{route('superadmin.user.create')}}" class="btn btn-primary font-weight-bolder">
    <span class="svg-icon svg-icon-md">
        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <circle fill="#000000" cx="9" cy="15" r="6" />
                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
            </g>
        </svg>
        <!--end::Svg Icon-->
    </span>สร้างผู้ดูแลระบบ</a>
    <!--end::Button-->
    <!--end::Button-->
@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            @if ($message = Session::get('success'))
              <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                <div class="alert-text font-weight-bold">{{$message}}</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
              </div>
            @elseif ($message = Session::get('error'))
              <div class="alert alert-custom alert-light-danger alert-dismissible fade show" role="alert">
                  <div class="alert-text font-weight-bold">{{$message}}</div>
                  <div class="alert-close">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true"><i class="ki ki-close"></i></span>
                      </button>
                  </div>
              </div>
            @endif
            <div class="card card-custom card-shadowless rounded-top-0">
				<!--begin::Body-->
				<div class="card-body p-0">
                    <div class="row py-8 px-8 py-lg-15 px-lg-10">
                        <div class="col-xl-12 ">
                            <!--begin: Datatable-->
                            <table class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable" style="margin-top: 13px !important">
                                <thead>
                                    <tr>
                                        {{-- <th>Order ID</th> --}}
                                        <th>ชื่อ สกุล</th>
                                        <th>ชื่อเข้าสู่ระบบ</th>
                                        <th>เข้าระบบล่าสุด</th>
                                        <th>IP Address ล่าสุด</th>
                                        <th>สถานะ</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                            <!--end: Datatable-->
                        </div>
                    </div>
				</div>
				<!--end::Body-->
			</div>
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
    			ajax: {
    				// url: HOST_URL + '/api/datatables/demos/server.php',
                    url: "{{route('superadmin.getUser')}}",
    				type: 'GET',
    				data: {
    					// parameters for custom backend script demo
    					columnsDef: [
    						'id', 'username',
    						'name', 'email', 'last_login_at','last_login_ip',
                            'status','Actions'
                        ],
    				},
    			},
                initComplete: function(settings, json) {

                },
    			columns: [
    				// {data: 'id'},
    				{data: 'name',width: '25%'},
    				{data: 'username',width: '20%'},
    				{data: 'last_login_at', width: '15%'},
                    {data: 'last_login_ip', width: '10%'},
                    {data: 'status', width: '10%'},
    				{data: 'action',width: '15%', responsivePriority: -1},
    			],
    			columnDefs: [
    				{
                        width: '150px',
    					targets: -1,
    					title: 'action',
    					orderable: false,
    					render: function(data, type, full, meta) {
    						return  data;
    					},
                    },
                    {
    					width: '75px',
    					targets: -2,
    					render: function(data, type, full, meta) {
    						var status = {
    							1: {'title': 'Active', 'class': ' label-light-success'},
    							0: {'title': 'Disabled', 'class': ' label-light-danger'},
    						};
    						if (typeof status[data] === 'undefined') {
    							return data;
    						}
    						return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
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
    	KTDatatablesDataSourceAjaxServer.init();
    });

    </script>
@endsection
