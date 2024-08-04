@extends('layouts.template')
@section('title-bar') บัญชีผู้ดูแลระบบ @endsection
@section('subheader-title') บัญชีผู้ดูแลระบบ @endsection
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
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom card-shadowless rounded-top-0">
				<!--begin::Body-->
				<div class="card-body p-0">
                    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                        <div class="col-xl-12 col-xxl-10">
                                <div class="row justify-content-center">
                                    <div class="col-xl-9">
                                        <!--begin::Wizard Step 1-->
                                        <div class="my-5 step" >
                                            <h5 class="text-dark font-weight-bold mb-10">รายละเอียดบัญชีผู้ดูแลระบบ:</h5>
                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3 col-form-label">ชื่อเข้าสู่ระบบ</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <label class="col-form-label">{{ $user->username }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3 col-form-label">ชื่อ นามสกุล</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <label class="col-form-label">{{ $user->name }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3 col-form-label">เข้าสู่ระบบ ล่าสุด</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <label class="col-form-label">{{ $user->last_login_at }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3 col-form-label">เข้าสู่ระบบ ล่าสุด (IP Address)</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <label class="col-form-label">{{ $user->last_login_ip }}</label>
                                                </div>
                                            </div>

                                            <div class="form-group row fv-plugins-icon-container">
                                                <label class="col-xl-3 col-lg-3 col-form-label">สถานะ</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <span class="switch switch-icon switch-brand">
                                                        <label>
                                                            <input type="checkbox" name="status" @if($user->status == 0) checked @endif/>
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                <div class="fv-plugins-message-container"></div></div>
                                            </div>
                                        </div>

                                        <!--begin::Wizard Actions-->
                                        <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                            <div class="mr-2"></div>
                                            <div>
                                                <a href="/superadmin/user" class="btn btn-danger font-weight-bolder px-4 py-2" >ย้อนกลับ</a>
                                            </div>
                                        </div>
                                        <!--end::Wizard Actions-->
                                    </div>
                                </div>
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
