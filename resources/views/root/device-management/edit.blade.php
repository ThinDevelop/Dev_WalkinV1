@extends('layouts.template')
@section('title-bar') แก้ไขเครื่อง EDC @endsection
@section('subheader-title') แก้ไขเครื่อง EDC @endsection
@section('button-header')

<div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
       
@endsection

@section('page-script')
<script src="{{ asset('assets/js/jquery-1.10.0.min.js') }}"></script>
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
									<form action="{{ route('root.device.update',$edc->id) }}" method="POST" class="mb-4" id="inputFrm">
									@csrf
									@method('PATCH')
										<!--begin::Wizard Step 1-->
										<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
											<h5 class="text-dark font-weight-bold mb-10">รายละเอียด</h5>
											<!--begin::Group-->

											
											
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">Serial no</label>
												<div class="col-lg-9 col-xl-9">
													<input class="form-control form-control-solid form-control-lg" name="serial_number" type="text" value="{{$edc->serial_number}}" disabled>
												<div class="fv-plugins-message-container"></div></div>
											</div>
											<!--end::Group-->

                                            <!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">บริษัท</label>
												<div class="col-lg-9 col-xl-9">
                                                    <select name="company_parent_id" class="form-control form-control-solid form-control-lg" required>
                                                        <option value="">= กรุณาเลือก =</option>
                                                        @foreach($company_parent as $value)
                                                        <option value="{{ $value->id }}" {{ ( $edc->company_parent_id == $value->id ? "selected":"") }} >{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
												<div class="fv-plugins-message-container"></div></div>
											</div>
											<!--end::Group-->

                                            <!--begin::Group-->
											<div class="form-group row fv-plugins-icon-container">
												<label class="col-xl-3 col-lg-3 col-form-label">ประเภท</label>
												<div class="col-lg-9 col-xl-9">
                                                    <select name="type" class="form-control form-control-solid form-control-lg" required>
                                                        <option value="">= กรุณาเลือก =</option>
                                                        @foreach($device_type as $value)
                                                        <option value="{{ $value->id }}" {{ ( $edc->type == $value->id ? "selected":"") }}>{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
												<div class="fv-plugins-message-container"></div></div>
											</div>
											<!--end::Group-->
											
										</div>
										<!--end::Wizard Step 4-->
										<!--begin::Wizard Actions-->
										<div class="d-flex justify-content-between border-top pt-10 mt-15">
                                            <div class="mr-2"></div>
											<div>
                                                <a href="{{ route('root.device.index') }}" class="btn btn-danger font-weight-bolder px-4 py-2" >ย้อนกลับ</a>
												<button type="submit" class="btn btn-success font-weight-bolder px-4 py-2" >บันทึก</button>
											</div>
										</div>
										<!--end::Wizard Actions-->
										</form>
									</div>
								</div>
							<div></div><div></div><div></div>
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
		// validate the comment form when it is submitted
        $("#inputFrm").validate(

            {
			rules: {
				serial_number: "required",
				company_parent_id: "required",
				type: "required",
			},
			messages: {
				serial_number: "กรุณากรอกรหัสเครื่อง",
				company_parent_id: "กรุณาเลือกบริษัท",
				type: "กรุณาเลือกประเภท",
			},
                submitHandler: function(form) 
                {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "{{ route('root.device.index')}}";
                            });
                        },
                        fail: function(xhr, textStatus, errorThrown){
                            Swal.fire(
                                {
                                    icon: 'error',
                                    title: 'เกิดความผิดพลาด',
                                    showConfirmButton: false,
                                    timer: 3000
                                }
                            )

                            window.location.href = "{{ route('root.device.index')}}";

                        }
                    });
                },
		    }

        );
        
    });


</script>
@endsection
