@extends('layouts.template')
@section('title-bar')
    รายงาน
@endsection
@section('subheader-title')
    รายงาน
@endsection
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
                        <span class="card-label font-weight-bolder text-dark">
                            ส่งออก Excel
                        </span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2 pb-0 mb-5">
                    <!--begin::Table-->
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-xl-10">
                            <div class="col-xl-9 offset-xl-3">
                                <!--begin::Wizard Step 1-->
                                <div class="my-5 step">
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">ประเภทรายงาน :</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <div class="radio-inline">
                                                <label class="radio radio-lg">
                                                    <input type="radio" value="checkin" name="select_type_checkin" checked/>
                                                    <span></span>
                                                    รายงานผู้มาติดต่อ
                                                </label>
                                                <label class="radio radio-lg" style="{{ $checkContractVechicle == 0 ? 'color: #cccccc;' : '' }}">
                                                    <input type="radio" value="parking" name="select_type_checkin" {{ $checkContractVechicle == 0 ? 'disabled' : '' }}/>
                                                    {{-- <input type="radio" value="parking" name="select_type_checkin"/> --}}
                                                    <span></span>
                                                    รายงานค่าจอดรถ
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">ช่วงเวลา :</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <div class="radio-inline">
                                                <label class="radio radio-lg">
                                                    <input type="radio" value="date" name="select_type_time" checked
                                                        onchange="handleChange('date')" />
                                                    <span></span>
                                                    รายวัน
                                                </label>
                                                <label class="radio radio-lg">
                                                    <input type="radio" value="month" name="select_type_time"
                                                        onchange="handleChange('month')" />
                                                    <span></span>
                                                    รายเดือน
                                                </label>
                                                <label class="radio radio-lg">
                                                    <input type="radio" value="year" name="select_type_time"
                                                        onchange="handleChange('year')" />
                                                    <span></span>
                                                    รายปี
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row fv-plugins-icon-container export_date">
                                        <label class="col-xl-3 col-lg-3 col-form-label">วันที่ :</label>
                                        <div class="col-lg-4 col-xl-4">
                                            <input type="text" id="export_date" name="export_date" class="form-control">
                                            <div class="invalid-feedback">กรุณาเลือก วันที่ ที่ต้องการส่งออก</div>
                                        </div>
                                    </div>
                                    <div class="form-group row fv-plugins-icon-container export_month" style="display:none">
                                        <label class="col-xl-3 col-lg-3 col-form-label">เดือน :</label>
                                        <div class="col-lg-4 col-xl-4">
                                            <input type="text" id="export_month" name="export_month"
                                                class="form-control">
                                            <div class="invalid-feedback">กรุณาเลือก เดือน ที่ต้องการส่งออก</div>
                                        </div>
                                    </div>
                                    <div class="form-group row fv-plugins-icon-container export_year" style="display:none">
                                        <label class="col-xl-3 col-lg-3 col-form-label">ปี :</label>
                                        <div class="col-lg-4 col-xl-4">
                                            <input type="text" id="export_year" name="export_year" class="form-control">
                                            <div class="invalid-feedback">กรุณาเลือก ปี ที่ต้องการส่งออก</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="button" onclick="exportExcel()" class="btn btn-primary">ส่งออก Excel</button>
                        </div>
                    </div>

                </div>
                <!--end::Body-->
                <div class="text-center mb-5">
                </div>
            </div>
            <!--end::Base Table Widget 6-->

            <!-- Button trigger modal-->

        </div>
    </div>
    <!--end::Row-->
@endsection
@section('custom_javascript')
    <script type="text/javascript">
        "use strict";


        $('#my_checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('input[name="totalCost"]').val(10);
            } else {
                calculate();
            }
        });


        $(function() {
            // handleChange('date')
            $('#export_date').datepicker({
                format: 'yyyy-mm-dd',
                language: 'TH',
            }).change(function(e) {
                $('#export_date').removeClass('is-invalid');
            });

            $('#export_month').datepicker({
                format: 'yyyy-mm',
                language: 'TH',
                viewMode: "months",
                minViewMode: "months"
            }).change(function(e) {
                $('#export_month').removeClass('is-invalid');
            });

            $('#export_year').datepicker({
                format: 'yyyy',
                language: 'TH',
                viewMode: "years",
                minViewMode: "years"
            }).change(function(e) {
                $('#export_year').removeClass('is-invalid');
            });
        })

        function handleChange(event) {
            if (event == 'date') {
                $(".export_date").show();
                $(".export_month").hide();
                $(".export_year").hide();
                $("#export_month").val('');
                $("#export_year").val('');

                $('#export_month').removeClass('is-invalid');
                $('#export_year').removeClass('is-invalid');
            } else if (event == 'month') {
                $(".export_date").hide();
                $(".export_month").show();
                $(".export_year").hide();
                
                $("#export_date").val('');
                $("#export_year").val('');

                $('#export_date').removeClass('is-invalid');
                $('#export_year').removeClass('is-invalid');

            } else {
                $(".export_date").hide();
                $(".export_month").hide();
                $(".export_year").show();

                $("#export_date").val('');
                $("#export_month").val('');

                $('#export_date').removeClass('is-invalid');
                $('#export_month').removeClass('is-invalid');

            }
        }

        function exportExcel() {
            var type_checkin = $("input[name='select_type_checkin']:checked").val();
            var type_time = $("input[name='select_type_time']:checked").val();
            var c_export = true;

            var company_id = "{{ $company_id }}";


            var start_date = '';
            var end_date = '';

            if (type_time == 'date') {
                var c_date = $('#export_date').val();
                if (c_date == "") {
                    c_export = false;
                    $('#export_date').addClass('is-invalid');
                } else {
                    start_date = c_date + ' 00:00:00'
                    end_date = c_date + ' 23:59:59'
                }
            } else if (type_time == 'month') {
                var c_date = $('#export_month').val();
                if (c_date == "") {
                    c_export = false;
                    $('#export_month').addClass('is-invalid');
                } else {
                    var yearMonth = c_date.split('-'); // แยกปีและเดือนออกจากกัน
                    var year = parseInt(yearMonth[0]); // แปลงปีให้เป็นตัวเลข
                    var month = parseInt(yearMonth[1]) - 1; // แปลงเดือนให้เป็นตัวเลขและลบ 1 เนื่องจากเดือนใน JavaScript เริ่มต้นที่ 0

                    // สร้างวันแรกของเดือน
                    var startDate = new Date(year, month, 1);
                    // สร้างวันสุดท้ายของเดือน
                    var endDate = new Date(year, month + 1, 0);

                    // แปลงวันที่เป็นรูปแบบ 'yyyy-mm-dd'
                    var start_date = formatDate(startDate)+ ' 00:00:00';
                    var end_date = formatDate(endDate)+ ' 23:59:59';

                    // start_date = c_date + '-01 00:00:00'
                    // end_date = c_date + '-31 23:59:59'
                }
            } else if (type_time == 'year') {
                var c_date = $('#export_year').val();
                if (c_date == "") {
                    c_export = false;
                    $('#export_year').addClass('is-invalid');
                } else {
                    start_date = c_date + '-01-01 00:00:00'
                    end_date = c_date + '-12-31 23:59:59'
                }
            }

            if (c_export == false) {
                return false;
            }

            // console.log(company_id+"\n"+start_date+"\n"+end_date+"\n"+type_checkin);

            window.location.href = "/admin/export/contact-transection?company_id=" + company_id + "&start_date=" +
                start_date + "&end_date=" + end_date + "&type_checkin=" + type_checkin;

        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return year + '-' + month + '-' + day;
        }

        $.fn.datepicker.dates['TH'] = {
            days: ["อาทิตย์", "จันทร์", "อังคาร", "พุทธ", "พฤหัสบดี", "ศุกร์", "เสาร์"],
            daysShort: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
            daysMin: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
            // daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน",
                "ดุลาคม", "พศจิกายน", "ธันวาคม"
            ],
            monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.",
                "ธ.ค."
            ],
            today: "วันนี้",
            clear: "Clear",
            titleFormat: "MM yyyy",
            /* Leverages same syntax as 'format' */
            weekStart: 0
        };

    </script>
@endsection
