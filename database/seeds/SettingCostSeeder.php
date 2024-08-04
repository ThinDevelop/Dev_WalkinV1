<?php

use App\Models\SettingCost;
use Illuminate\Database\Seeder;

class SettingCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingCost::updateOrCreate(
            [
                'id' => 1
            ], [
                'setting_hour_id' => 2,
                'cost' => 10.00,
                'start_hour' => (0 * 60 *60)+1,
                'end_hour' => 1 * 60 *60,
            ]
        );

        SettingCost::updateOrCreate(
            [
                'id' => 2
            ], [
                'setting_hour_id' => 2,
                'cost' => 20.00,
                'start_hour' => (1 * 60 *60)+1,
                'end_hour' => 2 * 60 *60,
            ]
        );

        SettingCost::updateOrCreate(
            [
                'id' => 3
            ], [
                'setting_hour_id' => 2,
                'cost' => 30.00,
                'start_hour' => (2 * 60 *60)+1,
                'end_hour' => null,
            ]
        );
    }
}
