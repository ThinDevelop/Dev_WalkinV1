<!DOCTYPE html>
<html>

<head>
    <title>การยืนยันผลการนัดหมาย</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        body {
            font-family: 'THSarabunNew', sans-serif;
            font-size: 18pt;
            color: black;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <p>เรียน <b>{{ $appointment->name . ' ' . $appointment->lastname }}</b>,</p>

    @if ($appointment->status == 2)
        <p>กำหนดการนัดหมายของคุณ <b>"สำเร็จ"</b></p>
        <p>ขั้นตอน:</p>
        <p>นำไฟล์ที่แนบมาไปยืนยันตามเวลาที่กำหนด</p>
    @elseif($appointment->status == 3)
        <p>กำหนดการนัดหมายของคุณ <b>"ไม่สำเร็จ"</b></p>
        <p>โปรดติดต่อเจ้าหน้าที่เพื่อสอบถามเพิ่มเติม</p>
    @elseif($appointment->status == 4)
        <p>กำหนดการนัดหมายของคุณ <b>"ยกเลิก"</b></p>
        <p>โปรดติดต่อเจ้าหน้าที่เพื่อสอบถามเพิ่มเติม</p>
    @else
        <p>กำหนดการนัดหมายของคุณ <b>"ไม่สำเร็จ"</b></p>
        <p>โปรดติดต่อเจ้าหน้าที่เพื่อสอบถามเพิ่มเติม</p>
    @endif

    <p>ขอแสดงความนับถือ,</p>
</body>

</html>
