<!--begin::Card-->
<div class="card card-custom card-shadowless rounded-top-0 mb-5">
    <!--begin::Body-->
    <div class="card-body p-0">
        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-10">
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <!--begin::Wizard Step 1-->
                            <div class="my-2" >

                                <h5 class="text-dark font-weight-bold mb-10">บัญชีผู้ใช้งานของบริษัท : {{ $company->name }}</h5>
                                <superadmin-company-user-create :company="{{$company}}"></superadmin-company-user-create>

                                <!--begin: Datatable-->
                                {{-- <table class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable_user" style="margin-top: 13px !important">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ สกุล</th>
                                            <th>ชื่อเข้าสู่ระบบ</th>
                                            <th>เข้าระบบล่าสุด</th>
                                            <th>IP Address ล่าสุด</th>
                                            <th>ประเภทบัญชี</th>
                                            <th>สถานะ</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table> --}}
                                <!--end: Datatable-->
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
