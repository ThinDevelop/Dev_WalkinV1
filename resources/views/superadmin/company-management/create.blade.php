@extends('layouts.template')
@section('title-bar') สร้างบริษัท @endsection
@section('subheader-title') สร้างบริษัท @endsection
@section('button-header')

@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container p-0">
            <div class="card card-custom card-shadowless rounded-top-0">
			    <!--begin::Body-->
				<div class="card-body p-0">
					<superadmin-company-create url="{{ url('/') }}"></superadmin-company-create>
				</div>
				<!--end::Body-->
			</div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
