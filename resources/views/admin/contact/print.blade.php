<!DOCTYPE html>
<html>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>พิมพ์ ข้อมูลผู้มาติดต่อ</title>
    <link rel="icon" href="/favicon.ico" type = "image/x-icon">

    {{-- <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <title>พิมพ์ ข้อมูลผู้มาติดต่อ</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="icon" href="{{ asset('images/logo/Walkin-Win-Icon.png') }}" type="image/png"> --}}
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNewBold.ttf') }}") format('truetype');
        }

        @page {
            margin: 32pt 20pt 0 20pt;
        }

        body {
            font-family: 'THsarabunNew';
            font-size: 16pt;
        }

        .text-center {
            text-align: center;
        }

        .line-h6 {
            line-height: 6pt;
        }

        .line-h8 {
            line-height: 8pt;
        }

        .line-h10 {
            line-height: 10pt;
        }

        .line-h12 {
            line-height: 12pt;
        }

        .line-h14 {
            line-height: 14pt;
        }

        .line-h16 {
            line-height: 16pt;
        }

        .line-h18 {
            line-height: 18pt;
        }

        .line-h20 {
            line-height: 20pt;
        }

        .line-h22 {
            line-height: 22pt;
        }

        .line-h24 {
            line-height: 24pt;
        }

        .line-h26 {
            line-height: 26pt;
        }

        h2 {
            font-size: 20pt;
            font-weight: bold;
        }

        h3 {
            font-size: 16pt;
            font-weight: bold;
            margin-top: 0px;
            margin-bottom: 8pt;
        }

        p {
            font-size: 16pt;
            font-weight: bold;
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .col-head {
            background-color: #aaacae;
            padding-left: 10pt;
            padding-top: -10px;
        }

        .detail {
            margin-top: 0px;
            margin-left: 10pt;
        }

        .detail .title {
            font-weight: bold;
        }

        .mt-2 {
            margin-top: 2pt
        }

        .mt-10 {
            margin-top: 10pt
        }

        .mt-12 {
            margin-top: 12pt
        }

        .mt-14 {
            margin-top: 14pt
        }

        .mt-20 {
            margin-top: 10pt
        }

        .detail table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            /* border: 1px solid black; */
        }

        .show-img {}

        .image-title {
            margin-top: -5pt
        }
    </style>
</head>

<body>

    <div style="width:100%;position:static">
        <div style="float: left;width: 20%;">
            <div class="show-logo">
                @if (!empty($contact->getCompany->logo))
                    <img src="{{ public_path($contact->getCompany->logo) }}" width="95px" style="padding-left:20%" />
                @endif
            </div>
        </div>
        <div style="float: right;border: 1px solid;width: 35%;padding:16px;">
            <div class="line-h10">Contact Code <b>{{ $contact->contact_code }}</b></div>
            <div class="line-h14">วันที่ <b>{{ $contact->created_at->format('Y-m-d') }}</b></div>
        </div>
    </div>

    <div style="top:8%;position:fixed">
        <h2 class="text-center">รายละเอียดผู้มาติดต่อ</h2>
        <div class="col-head mt-20">
            <h3>1. รายละเอียดผู้มาติดต่อ</h3>
        </div>
        <div class="detail">
            <table>
                <tr>
                    <td width="50%">
                        <span class="title">ชื่อ - นามสกุล</span>
                        <span style="margin-left:20pt;">{{ $contact->fullname }}</span>
                    </td>
                    <td width="50%">
                        <span class="title">หมายเลขบัตร</span>
                        <span style="margin-left:20pt;">
                            {{-- @if (!empty($contact->idcard)) --}}
                            @if (!empty($contact->idcard) && is_numeric($contact->idcard) && strlen($contact->idcard) == 13)
                                {{-- {{ $contact->idcard }} --}}
                                {{-- //1-23XX-XXXXX-12-3 --}}
                                {{-- {{ substr($contact->idcard, 0, 1) }}-{{ substr($contact->idcard, 1, 4) }}-{{ substr($contact->idcard, 5, 5) }}-{{ substr($contact->idcard, 10, 2) }}-{{ substr($contact->idcard, 12, 1) }} --}}
                                {{ substr($contact->idcard, 0, 1) }}-{{ substr($contact->idcard, 1, 2) }}XX-{{ str_repeat('X', 5) }}-{{ substr($contact->idcard, 10, 2) }}-{{ substr($contact->idcard, 12, 1) }}
                            @else
                                -----
                            @endif
                        </span>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="100%">
                        <span class="title">ที่อยู่</span>
                        <span style="margin-left:20pt;">
                            @if (!empty($contact->address))
                                {{ $contact->address }}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                </tr>
            </table>
            {{-- <table>
                <tr>
                    <td width="40%">
                        <span class="title">วันเกิด</span>
                        <span style="margin-left:20pt;">{{ $contact->birth_date }}</span>
                    </td>
                    <td width="30%">
                        <span class="title">อุณหภูมิ</span>
                        <span style="margin-left:20pt;">
                            @if (!empty($contact->temperature))
                                {{ $contact->temperature }}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                    <td width="30%">
                    </td>
                </tr>
            </table> --}}
            <table>
                <tr>
                    <td width="40%">
                        <span class="title">ทะเบียนรถ</span>
                        <span style="margin-left:20pt;">{{ $contact->vehicel_registration }}</span>
                    </td>
                    <td width="40%">
                        <span class="title">มาจาก</span>
                        <span style="margin-left:20pt;">
                            @if (!empty($contact->from))
                                {{ $contact->from }}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                    {{-- <td width="20%"></td> --}}
                </tr>
            </table>
        </div>

        <div class="col-head mt-20">
            <h3>2. รายละเอียดการติดต่อ</h3>
        </div>
        <div class="detail">
            <table>
                <tr>
                    <td width="50%">
                        <span class="title">ต้องการติดต่อ</span>
                        <span style="margin-left:20pt;">
                            @if (isset($contact->person_contact))
                                {{ $contact->person_contact }}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                    <td width="50%">
                        <span class="title">ติดต่อแผนก</span>
                        {{-- <span style="margin-left:20pt;">{{ $contact->getDepartment->name }}</span> --}}
                        <span style="margin-left:20pt;">{{ $contact->show_department }}</span>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    {{-- <td width="50%">
                        <span class="title">ติดต่อแผนก</span>
                        <span style="margin-left:20pt;">{{ $contact->show_department }}</span>
                    </td> --}}
                    <td width="50%">
                        <span class="title">หมายเหตุ</span>
                        <span style="margin-left:20pt;">
                            @if (isset($contact->objective_note))
                                {{ $contact->objective_note }}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                    <td width="50%">
                        <span class="title">วัตถุประสงค์</span>
                        <span style="margin-left:20pt;">
                            {{-- @if (isset($contact->getObjective) && isset($contact->objective_note))
                                {{ $contact->getObjective->name }} / {{ $contact->objective_note }} --}}
                            @if (isset($contact->getObjective))
                                {{ $contact->getObjective->name }}
                            @elseif(!isset($contact->getObjective) && isset($contact->objective_note))
                                {{ $contact->objective_note }}
                            @elseif(isset($contact->getObjective) && !isset($contact->objective_note))
                                {{ $contact->getObjective->name }}
                            @endif
                        </span>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="50%">
                        <span class="title">สถานะ</span>
                        <span style="margin-left:20pt;">
                            @if ($contact->status == 1)
                                ออก
                            @else
                                เข้า
                            @endif
                        </span>
                    </td>
                    <td width="50%">
                        <span class="title">เวลาที่อยู่</span>
                        <span style="margin-left:20pt;">
                            @if ($contact->status == 1)
                                {{ $contact->time_in }}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="50%">
                        <span class="title">เวลาเข้า</span>
                        <span style="margin-left:20pt;">{{ $contact->checkin_time }}</span>
                    </td>
                    <td width="50%">
                        <span class="title">เวลาออก</span>
                        <span style="margin-left:20pt;">
                            @if ($contact->status == 1)
                                {{ $contact->checkout_time }}
                            @else
                                -
                            @endif
                        </span>
                    </td>
                </tr>
            </table>

        </div>
        <div class="col-head mt-20">
            <h3>3. ภาพถ่าย</h3>
        </div>
        <div class="detail">
            <table class="show-table">
                <tr>
                    <td width="33%" class="text-center">
                        @if ($contact->images[0]->url)
                            <img src="{{ public_path($contact->images[0]->url) }}"
                                style="max-width: 115px; max-height: 150px" class="mt-14" />
                        @else
                            <img src="{{ public_path('/images/noimage.jpg') }}" width="115px" class="mt-14" />
                        @endif
                        <div class="image-title">{{ $contact->images[0]->type_name }}</div>
                    </td>
                    <td width="33%" class="text-center">
                        @if ($contact->images[1]->url)
                            <img src="{{ public_path($contact->images[1]->url) }}"
                                style="max-width: 115px; max-height: 150px " class="mt-14" />
                        @else
                            <img src="{{ public_path('/images/noimage.jpg') }}" width="115px; max-height: 150px"
                                class="mt-14" />
                        @endif
                        <div class="image-title">{{ $contact->images[1]->type_name }}</div>
                    </td>
                    <td width="33%" class="text-center">
                        @if ($contact->images[2]->url)
                            <img src="{{ public_path($contact->images[2]->url) }}"
                                style="max-width: 115px; max-height: 150px" class="mt-14" />
                        @else
                            <img src="{{ public_path('/images/noimage.jpg') }}" width="115px; max-height: 150px"
                                class="mt-14" />
                        @endif
                        <div class="image-title">{{ $contact->images[2]->type_name }}</div>
                    </td>
                </tr>
                <tr>
                    <td width="33%" class="text-center">
                        @if ($contact->images[3]->url)
                            <img src="{{ public_path($contact->images[3]->url) }}"
                                style="max-width: 115px; max-height: 150px" class="mt-14" />
                        @else
                            <img src="{{ public_path('/images/noimage.jpg') }}" width="115px; max-height: 150px"
                                class="mt-14" />
                        @endif
                        <div class="image-title">{{ $contact->images[3]->type_name }}</div>
                    </td>

                    <td width="33%" class="text-center">
                        @if ($contact->images[4]->url)
                            <img src="{{ public_path($contact->images[4]->url) }}"
                                style="max-width: 115px; max-height: 150px" class="mt-14" />
                        @else
                            <img src="{{ public_path('/images/noimage.jpg') }}" width="115px; max-height: 135px"
                                class="mt-14" />
                        @endif
                        <div class="image-title">{{ $contact->images[4]->type_name }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


</body>

</html>
