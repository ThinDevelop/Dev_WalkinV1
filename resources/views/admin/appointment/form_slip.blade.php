<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Slip</title>
    <style>
        .text-center {
            text-align: center;
        }
        .text-start {
            text-align: left;
        }
        .fw-bold {
            font-weight: bold;
        }
        .rounded {
            border-radius: 0.25rem;
        }
        .border {
            border: 1px solid;
            padding: 7px;
        }
        .border-black {
            border-color: black;
        }
        .mb-5 {
            margin-bottom: 2em;
        }

        .w-30 {
            width: 30%;
        }

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
            size: A4;
            margin: 0.8in;
        }
        
        body {
            font-family: 'THSarabunNew', sans-serif;
            font-size: 18pt;
            margin: 0;
            padding: 0;
        }

        p {
            margin-top: 7px;
            margin-bottom: 7px;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            vertical-align: top;
            margin-top: 7px;
            margin-bottom: 7px;
            padding: 0;
        }

        .text-red {
            color: red;
        }
    </style>
</head>
<body>
    <p class="text-start fw-bold mb-5">{{ 'ถึง '.$appointment->name.' '.$appointment->lastname }}</p>
    @if($appointment->status == 2)
        <div class="text-center">
            <img src="{{ $qrcodeUri ?? '/images/noimage.png' }}" class="w-30 rounded" alt="QR Code">
        </div>
        <p class="text-center">{{ $appointment->appointment_code ?? '' }}</p>
    @endif
    @if($appointment->status == 2)
        <p class="text-center">บริษัท {{ $company->name }} ได้<b>ทำการลงนัดหมายให้ท่านเรียบร้อยแล้ว</b> รายละเอียดดังนี้</p>
    @elseif($appointment->status == 3)
        <p class="text-center">บริษัท {{ $company->name }} <b class="text-red">ไม่อนุมัติ</b>รายการนัดหมายที่ท่านสร้าง โดยรายละเอียดการนัดหมาย มีดังนี้</p>
    @elseif($appointment->status == 4)
        <p class="text-center">บริษัท {{ $company->name }} <b>ยกเลิกรายการนัดหมาย</b>ของท่าน เนื่องจาก <b>{{ $reason }}</b> ขออภัยในความไม่สะดวก โดยรายละเอียดการนัดหมายมีดังนี้</p>
    @else
        <p class="text-center">บริษัท <b class="text-red">ไม่อนุมัติ</b>รายการนัดหมายที่ท่านสร้าง โดยรายละเอียดการนัดหมาย มีดังนี้</p>
    @endif
    <table>
        <tr>
            <th><p>ข้อมูลผู้นัดหมาย</p></th>
            <th><p></p></th>
        </tr>
        <tr>
            <td><p>ชื่อ-นามสกุล</p></td>
            <td><p>{{ $appointment->name.' '.$appointment->lastname }}</p></td>
        </tr>
        <tr>
            <td><p>ช่องทางการติดต่อ<br></p></td>
            <td><p>{{ $appointment->phone ?? '' }}<br>{{ $appointment->email ?? '' }}</p></td>
        </tr>
        <tr>
            <td><p>แผนกติดต่อ</p></td>
            <td><p>{{ $appointment->department->name ?? '' }}</p></td>
        </tr>
        <tr>
            <td><p>วัตถุประสงค์</p></td>
            <td><p>{{ $appointment->objectiveType->name ?? '' }}</p></td>
        </tr>
        <tr>
            <td><p>มาจาก</p></td>
            <td><p>{{ $appointment->from ?? '' }}</p></td>
        </tr>
        <tr>
            <td><p>รายละเอียดเพิ่มเติม</p></td>
            <td><p>{{ $appointment->note ?? '' }}</p></td>
        </tr>
        <tr>
            <th><p>วัน-เวลานัดหมาย</p></th>
            <th><p></p></th>
        </tr>
        <tr>
            <td><p>วันที่นัดหมาย</p></td>
            <td><p>{{ $date_appointment_formatted }}</p></td>
        </tr>
        <tr>
            <td><p>เวลา</p></td>
            <td><p>{{ $start_time_formatted.' - '.$end_time_formatted }}</p></td>
        </tr>
    </table>

    <p class="border border-black"><b>หมายเหตุ</b><br>1. หากท่านต้องการติดต่อหรือนัดหมาย กรุณาติดต่อเจ้าหน้าที่อีกครั้ง<br>2. อีเมลฉบับนี้เป็นการแจ้งเตือนข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>

    <p class="text-start">ขอแสดงความนับถือ</p>
</body>
</html>
