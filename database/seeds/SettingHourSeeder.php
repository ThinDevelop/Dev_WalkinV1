<?php

use App\Models\SettingHour;
use Illuminate\Database\Seeder;

class SettingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingHour::updateOrCreate(
            [
                'id' => 1
            ], [
                'company_id' => 1,
                'vechicle_cost_types_id' => 1,
                'name_place' => 'รายวัน ละเว้นทั้งหมด',
                'status' => 1,
                'cost' => 100.00,
                'status_stamp' => 1,
                'stamp_type' => 1,
                'num_hour' => null,
            ]
        );

        SettingHour::updateOrCreate(
            [
                'id' => 2
            ], [
                'company_id' => 2,
                'vechicle_cost_types_id' => 2,
                'name_place' => 'รายวัน กำหนดชั่วโมง',
                'status' => 1,
                'cost' => null,
                'status_stamp' => 2,
                'stamp_type' => 1,
                'num_hour' => (2 * 60 * 60),
            ]
        );
    }
}
