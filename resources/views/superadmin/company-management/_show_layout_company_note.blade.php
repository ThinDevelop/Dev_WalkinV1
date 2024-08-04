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

                                <h5 class="text-dark font-weight-bold mb-10">หมายเหตุ ท้ายใบสลิป : {{ $company->name }}</h5>
                                <!--begin::Group  is-valid is-invalid-->
                                <!-- <textarea style="width:57mm;text-align:center" id="exampleFormControlTextarea1" rows="3"></textarea>-->
                                <superadmin-company-change-note :company_id="{{$company->id}}" company_note="{{$company->note}}"></superadmin-company-change-note>
                                <div class="mt-3 text-danger">
                                    *หมายเหตุ : กรุณาจัดรูปแบบข้อข้อความ เนื่องจากใบสลิป สามารถใช้ตัวอักษร ต่อบรรทัดได้ไม่เกิน 25 ตัวอักษร
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
