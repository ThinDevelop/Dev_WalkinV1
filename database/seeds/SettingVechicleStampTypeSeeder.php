<?php

use Illuminate\Database\Seeder;
use App\Models\SettingVechicleStampType;

class SettingVechicleStampTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting_vechicle_stamp_types = [
            [
                "vechicle_cost_type_id" => 1,
                "stamp_type_id" => 1
            ],
            [
                "vechicle_cost_type_id" => 2,
                "stamp_type_id" => 1
            ],
            [
                "vechicle_cost_type_id" => 2,
                "stamp_type_id" => 2
            ],
        ];

        foreach ($setting_vechicle_stamp_types as $key => $setting_vechicle_stamp_type) {
            SettingVechicleStampType::updateOrCreate(
                [
                    'vechicle_cost_type_id' => $setting_vechicle_stamp_type['vechicle_cost_type_id'],
                    'stamp_type_id' => $setting_vechicle_stamp_type['stamp_type_id']
                ],
                [
                    'vechicle_cost_type_id' => $setting_vechicle_stamp_type['vechicle_cost_type_id'],
                    'stamp_type_id' => $setting_vechicle_stamp_type['stamp_type_id']
                ]
            );
        }
    }
}
