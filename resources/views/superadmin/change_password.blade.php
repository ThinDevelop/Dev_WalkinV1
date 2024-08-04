@extends('layouts.template')
@section('title-bar') ตั้งค่าข้อมูลส่วนตัว @endsection
@section('subheader-title') ตั้งค่าข้อมูลส่วนตัว @endsection
@section('subheader-title-2')
    {{-- <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    <span class="text-muted font-weight-bold mr-4">#XRS-45670</span> --}}
@endsection

@section('button-header')
    {{-- <!--begin::Button-->
    <a href="#" class="btn btn-fixed-height btn-white btn-hover-primary font-weight-bold px-2 px-lg-5 mr-2">
    <span class="svg-icon svg-icon-success svg-icon-lg">
        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
            </g>
        </svg>
        <!--end::Svg Icon-->
    </span>New Member</a>
    <!--end::Button--> --}}
@endsection
@section('content')
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin::Base Table Widget 6-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">เปลี่ยนรหัสผ่าน</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
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
                        
                        <div class="card-body pt-2 pb-0 mb-5">
                            <!--begin::Table-->

                            <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                <div class="col-xl-12 col-xxl-10">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                                
                                        {!! Form::open(array('route' => 'superadmin.change.password','method'=>'POST')) !!}
                                        @csrf
                                        @method('POST')

                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3  col-col-form-label">รหัสผ่าน เดิม</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-lg @if($errors->has('old-password')) is-invalid @endif" name="old-password" type="password" v-model="name">
                                                    @if ($errors->has('old-password'))
                                                    <div class="text-danger">*** {{ $errors->first('old-password') }}</div>
                                                    @endif
                                                <div class="fv-plugins-message-container"></div></div>
                                            </div>

                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3  col-col-form-label">รหัสผ่าน ใหม่</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-lg @if($errors->has('password')) is-invalid @endif " name="password" type="password" v-model="name">
                                                    @if ($errors->has('password'))
                                                    <div class="text-danger">*** {{ $errors->first('password') }}</div>
                                                    @endif
                                                <div class="fv-plugins-message-container"></div></div>
                                            </div>

                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3  col-col-form-label">ยืนยันรหัสผ่านอีกครั้ง</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-lg @if($errors->has('confirm-password')) is-invalid @endif" name="confirm-password" type="password" v-model="name">
                                                    @if ($errors->has('confirm-password'))
                                                    <div class="text-danger">*** {{ $errors->first('confirm-password') }}</div>
                                                    @endif
                                                <div class="fv-plugins-message-container"></div></div>
                                            </div>

                                            <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                <div class="mr-2"></div>
                                                <div>
                                                    <button type="submit" class="btn btn-success font-weight-bolder px-4 py-2">บันทึกการเปลี่ยนรหัสผ่าน</button>
                                                </div>
                                            </div>

                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Base Table Widget 6-->
                </div>
            </div>
            <!--end::Row-->
@endsection
@section('custom_javascript')
    <script type="text/javascript">

    </script>
@endsection
