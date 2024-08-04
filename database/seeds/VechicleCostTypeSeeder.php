<?php

use App\Models\VechicleCostType;
use Illuminate\Database\Seeder;

class VechicleCostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VechicleCostType::updateOrCreate(
            [
                'id' => 1
            ], [
                'name' => 'รายวัน',
            ]
        );

        VechicleCostType::updateOrCreate(
            [
                'id' => 2
            ], [
                'name' => 'รายชั่วโมง',
            ]
        );
        VechicleCostType::updateOrCreate(
            [
                'id' => 3
            ], [
                'name' => 'ทั้งหมด',
            ]
        );
    }
}
