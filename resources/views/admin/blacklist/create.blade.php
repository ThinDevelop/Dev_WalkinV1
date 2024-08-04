{{-- @extends('layouts.template')
@section('title-bar')
    Blacklist create
@endsection
@section('subheader-title')
    สร้างแบล็กลิสต์
@endsection
@section('content')
    <admin-blacklist-create url="{{ url('/') }}"></admin-blacklist-create>
@endsection --}}

@extends('layouts.template')
@section('title-bar')
    สร้างแบล็กลิสต์
@endsection
@section('subheader-title')
    สร้างแบล็กลิสต์
@endsection
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
                    {{-- <admin-blacklist-create :company="{{ json_encode($company ?? '') }}"></admin-blacklist-create> --}}
                    <admin-blacklist-create url="{{ url('/') }}"></admin-blacklist-create>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
