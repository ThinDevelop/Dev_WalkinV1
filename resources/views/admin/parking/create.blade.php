@extends('layouts.template')
@section('title-bar') ตั้งราคาค่าจอดรถ @endsection
@section('subheader-title') ตั้งราคาค่าจอดรถ @endsection
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
                    <admin-parking-create :company="{{ json_encode($company) }}"></admin-parking-create>
				</div>
				<!--end::Body-->
			</div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection