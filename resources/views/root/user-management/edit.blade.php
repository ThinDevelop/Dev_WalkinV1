@extends('layouts.template')
@section('title-bar') แก้ไขผู้ดูแลระบบ @endsection
@section('subheader-title') แก้ไขผู้ดูแลระบบ >> {{ $user->username }} @endsection
@section('button-header')

<div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
       
@endsection

@section('page-script')
<!-- <script src="{{ asset('assets/js/jquery-1.10.0.min.js') }}"></script> -->
@endsection

@section('page-style')
<style>
#inputFrm label.error {
    display: none;
    color: red;
}
</style>
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
							<!--begin::Wizard Form-->
							<!-- <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form"> -->
								<div class="row justify-content-center">
									<div class="col-xl-9">
									<form action="{{ route('root.user.update', $user->id ) }}" method="POST" class="mb-4" id="inputFrm">
									@csrf
									@method('PUT')
										<!--begin::Wizard Step 1-->
										<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
											<!--begin::Group-->

											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">ชื่อเข้าสู่ระบบ :</label>
												<div class="col-lg-9 col-xl-9">
                                                {{ $user->username }}
                                                </div>
											</div>

                                            <div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">รหัสผ่าน :</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" name="password" type="password"  >
                                                    @if ($errors->has('password'))
                                                    <div class="text-danger">*** {{ $errors->first('password') }}</div>
                                                    @endif
                                                </div>
											</div>

                                            <div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">ยืนยันรหัสผ่าน :</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" name="confirm_password" type="password"  >
                                                    @if ($errors->has('confirm_password'))
                                                    <div class="text-danger">*** {{ $errors->first('confirm_password') }}</div>
                                                    @endif
                                                </div>
											</div>

                                            <div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">ชื่อ - สกุล :</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" name="name" type="text"  value="{{ $user->name }}" >
                                                    @if ($errors->has('name'))
                                                    <div class="text-danger">*** {{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
											</div>

                                            <div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">สถานะ:</label>
												<div class="col-lg-9 col-xl-9">
                                                    <select class="form-control seltitle" id="status" name="status" title="{{ $user->status }}">
                                                        <option value="0">ปิดใช้งาน</option>
                                                        <option value="1">เปิดใช้งาน</option>
                                                    </select>
                                                    @if ($errors->has('status'))
                                                    <div class="text-danger">*** {{ $errors->first('status') }}</div>
                                                    @endif
                                                </div>
											</div>
											<!--end::Group-->

										<!--begin::Wizard Actions-->
										<div class="d-flex justify-content-between border-top pt-10 mt-15">
                                            <div class="mr-2"></div>
											<div>
                                                <a href="{{ route('root.user.index') }}" class="btn btn-danger font-weight-bolder px-4 py-2" >ย้อนกลับ</a>
												<button type="submit" class="btn btn-success font-weight-bolder px-4 py-2" >บันทึก</button>
											</div>
										</div>
										<!--end::Wizard Actions-->
                                        </div>
										</form>
									</div>
								</div>
							<!-- </form> -->
							<!--end::Wizard Form-->
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


@section('custom_javascript')
<script src="{{ asset('assets/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$().ready(function() {
	$(".seltitle").each(function(){
          var t = this.title;
          if(t == "") return;
          if(typeof t === undefined) return ;
          $(this).val(t);
      })
});
</script>
@endsection