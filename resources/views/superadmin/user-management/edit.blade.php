@extends('layouts.template')
@section('title-bar') แก้ไขข้อมูลบริษัท @endsection
@section('subheader-title') แก้ไขข้อมูลบริษัท @endsection
@section('button-header')

@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom card-shadowless rounded-top-0">
				<!--begin::Body-->
				<div class="card-body p-0">
					<superadmin-user-edit user="{{ $user }}"></superadmin-user-edit>
				</div>
				<!--end::Body-->
			</div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
