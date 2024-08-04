<?php

use App\Models\Pdpa;
use Illuminate\Database\Seeder;

class PdpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pdpa::updateOrCreate([
            'company_id' => 2,
            'pdpa' => 'PADA ขอแสดงความยินดีที่ได้รับอนุญาตให้เข้าตึก โปรดทราบว่าเพื่อความปลอดภัยและสะดวกสบายของทุกคนในอาคารนี้ เราขอให้คุณส่งข้อมูลของคุณเพื่อการบันทึกเข้าประวัติเวลาของเรา ข้อมูลที่คุณให้มาจะถูกเก็บไว้เป็นความลับและจะใช้เพื่อเป้าหมายเฉพาะเท่านั้น ขอบคุณที่ร่วมมาสร้างสภาพแวดล้อมที่ปลอดภัยและสวัสดิการสำหรับทุกคนใน PADA!',
        ]);
    }
}
