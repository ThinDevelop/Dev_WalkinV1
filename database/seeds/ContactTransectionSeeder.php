<?php

use App\Models\Blacklist;
use App\Models\ContactTransection;
use App\Models\Images;
use Illuminate\Database\Seeder;

use Illuminate\Support\Carbon;

class ContactTransectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $year = substr(date("Y"),2,2);
        $num = rand(1000,9999);
        $code = $year.date("md").str_shuffle(date('His')).$num;

        $randomIdcard = '';
        while (strlen($randomIdcard) < 13) {
            $randomIdcard .= str_shuffle('0123456789');
        }
        $idcard = substr($randomIdcard, 0, 13);
        $pricetest = substr(str_shuffle('123456789'), 0, 4);

        $createContact = ContactTransection::Create([
            'company_id' => 37,
            'department_id' => null, 
            'objective_id' => 3,
            'user_id' => 6, 
            'pdpa_id' => null,
            'status_pdpa_id' => null,
            'contact_code' => $code,
            'idcard' => $idcard,
            'fullname' => 'นาย A นามสกุล B',
            'gender' => null,
            'birth_date' => null,
            'address' => "TH",
            'vehicel_registration' => substr(str_shuffle('0123456789'), 0, 2)."-".substr(str_shuffle('0123456789'), 0, 4),
            'vehicel_registration' => 'งง เลย 555',
            'temperature' => '',
            'from' => "HOME",
            'checkin_time' => Carbon::parse('2024-05-08 08:00:00'),
            'checkout_time' => Carbon::parse('2024-05-08 13:00:00'),
            'objective_note' => null,
            'person_contact' => null,
            'status' => 1, // 0 เข้า 1 ออก
            'price' => $pricetest+500, // ราคาเต็ม
            'price_amount' => $pricetest, // ราคาที่ต้องจ่าย
            'price_discount' => 500, // ส่วนต่าง
            'payment_id' => random_int(1, 2), // 1 QR Code 2 เงินสด
            'vechicle_cost_types_id' => 1, // 1 รายวัน 2 รายชั่วโมง
            'stamp_type_id' => 1, // 1 ละเว้นค่าจอดรถทั้งหมด 2 ละเว้นค่าจอดรถ (กำหนดชั่วโมง)
        ]);
        
        Images::updateOrCreate(
            [
                'contact_id' => $createContact->id
            ], [
                'image_type_id' => 4,
                'image_url' => "company/00003/5ff57a6dcdcab.jpg"
            ]
        );

        // เพิ่ม Blacklist
        // $contact_transaction_id = ContactTransection::select('id')->where('contact_code', $code)->first();
        // Blacklist::Create([
        //     'fullname' => '',
        //     'note' => '',
        //     'company_id' => 2, // TSS
        //     'contact_transaction_id' => $contact_transaction_id->id,
        //     'image_type' => 1, // คน
        // ]);
    }
}
