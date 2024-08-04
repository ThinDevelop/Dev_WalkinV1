@extends('layouts.template')
@section('title-bar') สร้างนัดหมาย @endsection
@section('subheader-title') สร้างนัดหมาย @endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container p-0">
            <div class="card card-custom card-shadowless rounded-top-0">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <admin-appointment-edit
                        :appointment="{{ json_encode($appointment) }}"
                        :departments="{{ json_encode($departments) }}"
                        :objective-types="{{ json_encode($objectiveTypes) }}"
                    ></admin-appointment-edit>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection