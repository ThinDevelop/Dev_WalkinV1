@extends('layouts.template')
@section('title-bar')
    สรุปยอดค่าจอดรถ
@endsection
@section('subheader-title')
    สรุปยอดค่าจอดรถ
@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

            @if ($message = Session::get('success'))
                <div class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                    <div class="alert-text font-weight-bold">{{ $message }}</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
            @elseif ($message = Session::get('error'))
                <div class="alert alert-custom alert-light-danger alert-dismissible fade show" role="alert">
                    <div class="alert-text font-weight-bold">{{ $message }}</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="card card-custom card-shadowless rounded-top-0">
                <div class="row justify-content-center">
                    <div class="col-11">
                        <div class="mb-0 mt-5 step">
                            <div class="form-group row fv-plugins-icon-container">
                                <label>ช่วงเวลา :</label>
                                <div class="col-lg-10 col-xl-10">
                                    <div class="radio-inline">

                                        <label class="radio radio-lg">
                                            <input type="radio" id="dailyRadio" value="daily" name="vehicle_cost_type" />
                                            <span></span>
                                            รายวัน
                                        </label>
                                        <label for="priceTypeMonth" class="radio radio-lg">
                                            <input type="radio" id="priceTypeMonth" value="month"
                                                name="vehicle_cost_type" />
                                            <span></span>
                                            รายเดือน
                                        </label>
                                        <label class="radio radio-lg">
                                            <input type="radio" id="yearlyRadio" value="yearly"
                                                name="vehicle_cost_type" />
                                            <span></span>
                                            รายปี
                                        </label>

                                    </div>

                                    {{-- <div class="col-lg-12 col-xl-12" id="chart">
                                        <!-- ส่วนของกราฟ-->
                                        <canvas id="myChart" width="16" height="9"></canvas>
                                    </div> --}}

                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container">
                                <div class="col-lg-12 col-xl-12 mt-5" id="chart">
                                    <!-- ส่วนของกราฟ-->
                                    <canvas id="myChart" width="15" height="6"></canvas>
                                </div>

                                <div class="fv-plugins-message-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="row py-8 px-8 py-lg-15 px-lg-10">
                        <div class="col-xl-12 ">
                            <!--begin: Datatable-->
                            <table
                                class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline collapsed"
                                id="kt_datatable" style="margin-top: 13px !important; text-align: center;">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>ลำดับ</th>
                                        <th>Id</th>
                                        <th>ชื่อ นามสกุล</th>
                                        <th>มาจาก</th>
                                        <th>วันที่/เวลาเข้า-ออก</th>
                                        <th>ทะเบียนรถ</th>
                                        <th>ช่องทางการชำระเงิน</th>
                                        <th>จำนวน</th>
                                        <th>checkin</th>
                                        <th>checkout</th>
                                    </tr>
                                </thead>
                            </table>
                            <!--end: Datatable-->
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        // import DatePicker from 'vue2-datepicker';
        // import 'vue2-datepicker/index.css';
        // import 'vue2-datepicker/locale/th';
        "use strict";

        if (1) { // chart js

            var chartData = {
                labels: [],
                datasets: [{
                    label: 'My Dataset',
                    data: [],
                    fill: false,
                    borderColor: '#1BC5BD',
                    tension: 0.1
                }]
            };

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'ราคา'
                            },
                            ticks: {
                                beginAtZero: true,
                                // stepSize: 500,
                            },
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'เวลา'
                            },
                            gridLines: {
                                labelString: 'ราคา',
                                display: false, // ปิดการแสดงเส้นแบ่งระหว่างช่วงของแกน y
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    // ตรวจสอบค่าที่ต้องการแสดงตามค่าที่ผู้ใช้เลือก
                                    switch (value) {
                                        case 'month':
                                            return 'ชั่วโมง';

                                        case 'daily':
                                            return 'วันที่';

                                        case 'yearly':
                                            return 'เดือน';

                                        default:
                                            return value; // ค่าเริ่มต้นหากไม่มีการเลือก
                                    }
                                }
                            }
                        }],
                    }
                },
            });

            // let MyScale = Chart.Scale.extend({
            //     /* extensions ... */
            // });

            // Chart.scaleService.registerScaleType('myScale', MyScale);

            // var ctx = document.getElementById("myChart").getContext('2d');
            // var myChart = new Chart(ctx, {
            //     type: 'bar',
            //     data: {
            //         labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            //         datasets: [{
            //             label: 'รายวัน',
            //             yAxisID: 'A',
            //             data: [120, 96, 23, 76, 69]
            //             // }, {
            //             //     label: 'รายเดือน',
            //             //     yAxisID: 'B',
            //             //     data: [1, 1, 1, 1, 0]
            //         }, ]
            //     },
            //     options: {
            //         scales: {
            //             yAxes: [{
            //                     id: 'A',
            //                     type: 'linear',
            //                     position: 'left',
            //                     ticks: {
            //                         stepSize: 25
            //                     }
            //                 },
            //                 // {
            //                 //     id: 'B',
            //                 //     type: 'linear',
            //                 //     position: 'left',
            //                 //     ticks: {
            //                 //         stepSize: 0.5
            //                 //     }
            //                 // },
            //             ]
            //         }
            //     }
            // });

            function showContactMonth(selectedValue) {
                //
                console.log('showContactMonth');
                var URL = "/admin/chartParkingMonth";
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    contentType: "x-www-form-urlencoded; charset=utf-8",
                    cache: false,
                    url: URL,
                    data: {
                        'type_time': selectedValue
                    },
                    success: function(response) {
                        console.log('showContactMonth Success');
                        if (response.status_code == 200) {
                            updateChartData(response.data, selectedValue);
                        } else {
                            updateChartData(null);
                        }
                    }
                });
            }

            function showContactDaily(selectedValue) {
                //
                console.log('showContactDaily');
                var URL = "/admin/chartParkingDaily";
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    contentType: "x-www-form-urlencoded; charset=utf-8",
                    cache: false,
                    url: URL,
                    data: {
                        'type_time': selectedValue
                    },
                    success: function(response) {
                        console.log('showContactDaily Success');
                        if (response.status_code == 200) {
                            updateChartData(response.data, selectedValue);
                        } else {
                            updateChartData(null);
                        }
                    }
                });
            }

            function showContactYearly(selectedValue) {
                //
                console.log('showContactYearly');
                var URL = "/admin/chartParkingYear";
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    contentType: "x-www-form-urlencoded; charset=utf-8",
                    cache: false,
                    url: URL,
                    data: {
                        'type_time': selectedValue
                    },
                    success: function(response) {
                        console.log('showContactYearly Success');
                        if (response.status_code == 200) {
                            updateChartData(response.data, selectedValue);
                        } else {
                            updateChartData(null);
                        }
                    }
                });
            }

            // ฟังก์ชันสำหรับอัปเดตข้อมูลในกราฟ
            function updateChartData(data, selectedValue) {
                // นำ selectedValue ไปใช้ในการอัปเดตข้อมูลตามที่คุณต้องการ
                // ในตัวอย่างนี้เราจะให้ข้อมูลเป็นข้อมูลสุ่มเพื่อแสดงการอัปเดตข้อมูล
                console.log('updateChartData');
                var updatedData = {
                    labels: [],
                    datasets: [{
                        label: '?',
                        data: [],
                        fill: false,
                        borderColor: [],
                        tension: 0.1
                    }]
                };
                if (data) {
                    console.log('updateChartData Success');
                    var updatedData = {
                        // labels: Array.from({ length: 23 }, (_, i) => `${i < 10 ? '0' + i : i}:00`),
                        labels: data.chart_label,
                        datasets: [{
                            label: 'My Dataset',
                            data: data.chart_data,
                            fill: false,
                            backgroundColor: getBorderColor(selectedValue, data.chart_data.length),
                            // tension: 0.1
                        }]
                    };
                }

                // อัปเดตข้อมูลในกราฟ
                myChart.data = updatedData;
                myChart.update();
            }

            $('body').on('click', 'input[name="vehicle_cost_type"]', function(e) {
                var selectedValue = $(this).val();
                // ทำสิ่งที่คุณต้องการทำเมื่อมีการคลิกที่ radio label
                console.log(selectedValue); // ตัวอย่าง: month, daily, yearly
                // นอกจากนี้, คุณสามารถอัปเดตข้อมูลในกราฟตาม selectedValue ตามที่คุณต้องการ
                // ยกตัวอย่างเช่น:
                console.log(11);

                var options = myChart.options;
                options.scales = options.scales || {};
                options.scales.xAxes = options.scales.xAxes || [{}];
                options.scales.xAxes[0].scaleLabel = options.scales.xAxes[0].scaleLabel || {};

                switch (selectedValue) {
                    case 'month':
                        showContactMonth(selectedValue);
                        myChart.options.scales.xAxes[0].scaleLabel.labelString = 'วันที่';
                        myChart.options.scales.xAxes[0].scaleLabel.description = '';
                        break;

                    case 'daily':
                        showContactDaily(selectedValue);
                        myChart.options.scales.xAxes[0].scaleLabel.labelString =
                            'ชั่วโมง\n(โดยเริ่มต้นจาก 0 = 00:00 น. ถึง 23 = 23:59 น.)';
                        myChart.update();
                        break;

                    case 'yearly':
                        showContactYearly(selectedValue);
                        myChart.options.scales.xAxes[0].scaleLabel.labelString = 'เดือน';
                        myChart.options.scales.xAxes[0].scaleLabel.description = '';
                        break;

                    default:
                        showContactMonth('month');
                        myChart.options.scales.xAxes[0].scaleLabel.description = '';
                        break;
                }
            });

            // ฟังก์ชันสำหรับกำหนดสีของเส้นกราฟ
            function getBorderColor(selectedValue, lengthValue) {
                switch (selectedValue) {
                    case 'month':
                        return Array.from({
                            length: lengthValue
                        }, () => '#1BC5BD');
                    case 'daily':
                        return Array.from({
                            length: lengthValue
                        }, () => '#1BC5BD');
                    case 'yearly':
                        return Array.from({
                            length: lengthValue
                        }, () => '#1BC5BD');
                    default:
                        return Array.from({
                            length: lengthValue
                        }, () => 'rgb(0, 0, 0)');
                }
            }

        }

        //datatable
        if (1) {

            // var KTDatatablesDataSourceAjaxServer = function() {

            //     var initTable1 = function() {
            var table = $('#kt_datatable');

            // begin first table
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [
                    [1, 'desc']
                ],
                rowId: 'id',
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                ajax: {
                    // url: HOST_URL + '/api/datatables/demos/server.php',
                    url: "/admin/parking/lists",
                    type: 'GET',
                    data: {
                        // parameters for custom backend script demo
                        columnsDef: [
                            'DT_RowIndex', 'id', 'fullname', 'from',
                            'check_in_out',
                            'vehicel_registration', 'payment_way',
                            'price_amount', 'checkin_time', 'checkout_time'
                        ],
                    },
                },
                initComplete: function(settings, json) {

                },
                columns: [
                    // {data: 'id'},
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'contact_transection.id',
                        visible: false,
                        searchable: false
                    },
                    {
                        data: 'fullname'
                    },
                    {
                        data: 'from',
                        name: 'from',
                        searchable: true
                    },
                    {
                        data: 'check_in_out',
                        searchable: false
                    },
                    {
                        data: 'vehicel_registration'
                    },
                    {
                        data: 'payment_way',
                        name: 'payment.name'
                    },
                    {
                        data: 'price_amount'
                    },
                    {
                        data: 'checkin_time',
                        name: 'contact_transection.checkin_time',
                        searchable: true,
                        visible: false
                    },
                    {
                        data: 'checkout_time',
                        name: 'contact_transection.checkout_time',
                        searchable: true,
                        visible: false
                    }
                ],
                columnDefs: [{
                        width: '0px',
                        targets: -1,
                        title: 'จำนวน',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return data;
                        },
                    },
                    {
                        width: '75px',
                        targets: -2,
                        render: function(data, type, full, meta) {
                            var status = {
                                1: {
                                    'title': 'Active',
                                    'class': ' label-light-success'
                                },
                                0: {
                                    'title': 'Disabled',
                                    'class': ' label-light-danger'
                                },
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="label label-lg font-weight-bold' + status[
                                    data]
                                .class + ' label-inline">' + status[data].title + '</span>';
                        },
                    },
                    // {
                    //     targets: -4,
                    //     render: function(data, type, full, meta) {
                    //         var htmlTagRender_address = $("<textarea/>").html(data).text();

                    //         return "<pre>" + htmlTagRender_address + "</pre>";
                    //     },
                    // },
                    // {
                    //     width: '150px',
                    //     targets: -6,
                    //     orderable: false,
                    //     render: function(data, type, full, meta) {
                    //         var image = '';
                    //         var APP_URL = {!! json_encode(url('/')) !!};
                    //         if (data) {
                    //             image = "<img src='" + APP_URL + "/" + data +
                    //                 "' width='85'>"
                    //         } else {
                    //             image = "<img src='" + APP_URL + "/" +
                    //                 "images/noimage.png" +
                    //                 "' width='85'>"
                    //         }


                    //         return image;
                    //     },
                    // },
                ],
            });
            //     };

            //     return {

            //         //main function to initiate the module
            //         init: function() {
            //             initTable1();
            //         },

            //     };

            // }();
        }


        // KTDatatablesDataSourceAjaxServer.init();
        $('input[name="vehicle_cost_type"]')[0].click();

        // jQuery(document).ready(function() {
        //     KTDatatablesDataSourceAjaxServer.init();
        // });
    </script>
@endsection
