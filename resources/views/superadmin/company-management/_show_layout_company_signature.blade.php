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

                                <h5 class="text-dark font-weight-bold mb-10">แบบฟอร์มลายเซ็นบริษัท : {{ $company->name }}</h5>
                                <!--begin::Group  is-valid is-invalid-->
                                <superadmin-company-signature :company="{{$company}}"></superadmin-company-signature>
                                <div class="mt-3 text-danger">
                                    *หมายเหตุ : สามารถลากขึ้นหรือลง เพื่อเรียงลำดับลายเซ็นในใบสลิป
                                </div>
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
