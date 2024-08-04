<?php

use Illuminate\Database\Seeder;
use App\Models\StampType;

class StampTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stamp_types = [
            "ละเว้นค่าจอดรถทั้งหมด",
            "ละเว้นค่าจอดรถ (กำหนดชั่วโมง)"
        ];

        foreach ($stamp_types as $key => $stamp_type) {
            StampType::updateOrCreate(
                [
                    'name' => $stamp_type
                ],
                [
                    'name' => $stamp_type,
                    'status' => 1
                ]
            );
        }
    }
}
