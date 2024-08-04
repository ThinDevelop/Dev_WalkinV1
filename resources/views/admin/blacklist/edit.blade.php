@extends('layouts.template')
@section('title-bar')
    แก้ไขแบล็กลิสต์
@endsection
@section('subheader-title')
    แก้ไขแบล็กลิสต์
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
                    <admin-blacklist-edit
                        blacklist="{{ $blacklist }}"
                        url="{{ url('/') }}"
                    ></admin-blacklist-edit>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
