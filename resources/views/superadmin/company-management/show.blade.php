@extends('layouts.template')
@section('title-bar') ข้อมูลบริษัท {{ $company->name }} @endsection
@section('subheader-title') ข้อมูลบริษัท {{ $company->name }} @endsection
@section('button-header')

@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            @include('superadmin.company-management._show_layout_company_description')
            @include('superadmin.company-management._show_layout_company_users')
            @include('superadmin.company-management._show_layout_company_departments')
            @include('superadmin.company-management._show_layout_company_objective_type')
            @include('superadmin.company-management._show_layout_company_signature')
            @include('superadmin.company-management._show_layout_company_note')

        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

    <!--begin::Wizard Actions-->
    {{-- <div class="d-flex justify-content-between border-top pt-10 mt-15">
        <div class="mr-2"></div>
        <div>
            <a href="/superadmin/dashboard" class="btn btn-danger font-weight-bolder px-4 py-2" >ย้อนกลับ</a>
        </div>
    </div> --}}
    <!--end::Wizard Actions-->
@endsection
@section('custom_javascript')
    <script type="text/javascript">
    "use strict";
    var KTDatatablesDataSourceAjaxServerCompanyPageShow = function() {

    	var initTable1 = function() {
    		var table = $('#kt_datatable_objective_type');

    		// begin first table
    		table.DataTable({
    			responsive: true,
    			searchDelay: 500,
    			processing: true,
    			serverSide: true,
                rowId: 'refId',
                language: {
                  processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
    			ajax: {
    				// url: HOST_URL + '/api/datatables/demos/server.php',
                    url: "{{route('superadmin.objective.index')}}?company_id=" + {{$company->id}},
    				type: 'GET',
    				data: {
    					// parameters for custom backend script demo
    					columnsDef: [
    						'id', 'name','refId',
    						'created_at',
                            'action'
                        ],
    				},
    			},
                createdRow: function( row, data, dataIndex ) {
                    console.log(data);
                },
                initComplete: function(settings, json) {

                },
    			columns: [
    				{data: 'DT_RowIndex'},
                    {data: 'name',width: '150px'},
    				{data: 'created_at',width: '150px'},
    				{data: 'action', responsivePriority: -1},
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

    			],
    		});
    	};

        var initTable2 = function() {
    		var table = $('#kt_datatable_user');

    		// begin first table
    		table.DataTable({
    			responsive: true,
    			searchDelay: 500,
    			processing: true,
    			serverSide: true,
                rowId: 'refId',
                language: {
                  processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
    			ajax: {
    				// url: HOST_URL + '/api/datatables/demos/server.php',
                    url: "{{route('superadmin.getUserByCompanyId')}}?company_id=" + {{$company->id}},
    				type: 'GET',
    				data: {
    					// parameters for custom backend script demo
    					columnsDef: [
                            'id','username','refId',
    						'name', 'email', 'last_login_at','last_login_ip','roles',
                            'status','Actions'
                        ],
    				},
    			},
                initComplete: function(settings, json) {

                },
    			columns: [
                    {data: 'DT_RowIndex',name: 'DT_Row_Index' , orderable: false, searchable: false},
                    {data: 'name',width: '25%'},
                    {data: 'username',width: '20%'},
                    {data: 'last_login_at', width: '15%'},
                    {data: 'last_login_ip', width: '10%'},
                    {data: 'roles', width: '10%', orderable: false, searchable: false},
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
                                0: {'title': 'Active', 'class': ' label-light-success'},
                                1: {'title': 'Disabled', 'class': ' label-light-danger'},
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                        },
                    },
                    {
                        width: '75px',
                        targets: -3,
                        render: function(data, type, full, meta) {
                            var status_ = {
                                "admin": {'title': "Admin", 'class': ' label-light-warning'},
                                "user": {'title': "User", 'class': ' label-light-info'},
                            };
                            if (typeof status_[data[0].name] === 'undefined') {
                                return "";
                            }
                                                        // data.forEach(myFunction);
                            // console.log(status[data[0].name]);
                            return '<span class="label label-lg font-weight-bold' + status_[data[0].name].class + ' label-inline">' + status_[data[0].name].title + '</span>';
                        },
                    }
    			],
                order:[[ 1, 'asc' ]],
    		});
    	};

    	return {

    		//main function to initiate the module
    		init: function() {
    			initTable1();
                initTable2();
    		},

    	};

    }();

    jQuery(document).ready(function() {
    	// KTDatatablesDataSourceAjaxServerCompanyPageShow.init();
    });


    </script>
@endsection
