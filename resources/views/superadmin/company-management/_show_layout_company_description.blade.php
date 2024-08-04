<!--begin::Card-->
<div class="card card-custom card-shadowless rounded-top-0 mb-5">
    <!--begin::Body-->
    <div class="card-body p-0">
        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-10">
                    <div class="row justify-content-center">
                        <div class="col-xl-11">
                            <!--begin::Wizard Step 1-->
                            <div class="my-2" >

                                <h5 class="text-dark font-weight-bold mb-10">รายละเอียดบริษัท : {{ $company->name }}</h5>
                                <!--begin::Group  is-valid is-invalid-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">รหัสบริษัท</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <label class="col-form-label">{{ $company->mid }}</label>
                                    </div>
                                </div>

                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ชื่อบริษัท</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <label class="col-form-label">{{ $company->name }}</label>
                                    </div>
                                </div>

                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">เบอร์โทรศัพท์ </label>
                                    <div class="col-lg-9 col-xl-9">
                                        <label class="col-form-label">{{ $company->phone }}</label>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">อีเมล </label>
                                    <div class="col-lg-9 col-xl-9">
                                        <label class="col-form-label">{{ $company->email }}</label>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ที่อยู่</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <label class="col-form-label">{{ $company->address }}</label>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">สถานะ</label>
                                    <div class="col-lg-9 col-xl-9">
                                        @if($company->status == 0)
                                            <span class="label label-lg font-weight-bold label-light-danger label-inline">Disabled</span>
                                        @elseif ($company->status == 1)
                                            <span class="label label-lg font-weight-bold label-light-success label-inline">Active</span>
                                        @endif
                                    <div class="fv-plugins-message-container"></div></div>
                                </div>
                                <!--end::Group-->
                            </div>
                            <!--end::Wizard Step 1-->

                        </div>
                    </div>
                <!--end::Wizard Form-->
            </div>
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::Card-->
