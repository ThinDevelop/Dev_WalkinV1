@extends('layouts.template')
@section('title-bar') แก้ไขบริษัท @endsection
@section('subheader-title') แก้ไขบริษัท @endsection

@section('button-header')
    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">   
@endsection

@section('page-script')
<!-- <script src="{{ asset('assets/js/jquery-1.10.0.min.js') }}" type="text/javascript"></script> -->
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
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom card-shadowless rounded-top-0">
            <div class="card-body p-0">
                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                    <div class="col-xl-12 col-xxl-10">
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <form action="{{ route('root.company.update',$company->id) }}" method="POST" class="mb-4" id="inputFrm">
                                @csrf
                                @method('PATCH')
                                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                    <h5 class="text-dark font-weight-bold mb-10">รายละเอียด</h5>

                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label"> <span style="color:red;font-size:16px;">*</span> ชื่อบริษัท</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="name" type="text"  value="{{$company->name}}" required>
                                        <div class="fv-plugins-message-container"></div></div>
                                    </div>

                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label"> <span style="color:red;font-size:16px;">*</span> ที่อยู่</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="address" type="text"  value="{{ $company->address }}" required>
                                        <div class="fv-plugins-message-container"></div></div>
                                    </div>

                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label"> <span style="color:red;font-size:16px;">*</span> เบอร์โทรศัพท์</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="phone" type="text"  value="{{ $company->phone }}" required>
                                        <div class="fv-plugins-message-container"></div></div>
                                    </div>

                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label"> <span style="color:red;font-size:16px;">*</span> Email</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="email" type="email"  value="{{ $company->email }}" required>
                                        <div class="fv-plugins-message-container"></div></div>
                                    </div>

                                    <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                        <div class="mr-2"></div>
                                        <div>
                                            <a href="{{ route('root.company.index') }}" class="btn btn-danger font-weight-bolder px-4 py-2" >ย้อนกลับ</a>
                                            <button type="submit" class="btn btn-success font-weight-bolder px-4 py-2" >บันทึก</button>
                                        </div>
                                    </div>
                                        
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_javascript')
<script src="{{ asset('assets/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">

	$().ready(function() {
		// validate the comment form when it is submitted
        $("#inputFrm").validate(

            {
			rules: {
				name: "required",
                address: "required",
                phone: "required",
				// username: {
				// 	required: true,
				// 	minlength: 2
				// },
				// password: {
				// 	required: true,
				// 	minlength: 5
				// },
				// confirm_password: {
				// 	required: true,
				// 	minlength: 5,
				// 	equalTo: "#password"
				// },
				email: {
					required: true,
					email: true
				},
				// topic: {
				// 	required: "#newsletter:checked",
				// 	minlength: 2
				// },
				// agree: "required"
			},
			messages: {
                name: "กรุณากรอกชื่อบริษัท",
                address: "กรุณากรอกชื่อที่อยู่",
                phone: "กรุณากรอกเบอร์โทรศัพท์",
				// lastname: "Please enter your lastname",
				// username: {
				// 	required: "Please enter a username",
				// 	minlength: "Your username must consist of at least 2 characters"
				// },
				// password: {
				// 	required: "Please provide a password",
				// 	minlength: "Your password must be at least 5 characters long"
				// },
				// confirm_password: {
				// 	required: "Please provide a password",
				// 	minlength: "Your password must be at least 5 characters long",
				// 	equalTo: "Please enter the same password as above"
				// },
                // email: "Please enter a valid email address",
                email: "กรุณากรอก Email ให้ถูกต้อง",
				// agree: "Please accept our policy",
				// topic: "Please select at least 2 topics"
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
                                window.location.href = "{{ route('root.company.index')}}";
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

                            window.location.href = "{{ route('root.company.index')}}";

                        }
                    });
                },
		    }

        );
        
    });


</script>
@endsection

