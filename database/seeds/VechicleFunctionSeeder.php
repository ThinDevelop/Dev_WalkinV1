<?php

use App\Models\VechicleFunction;
use Illuminate\Database\Seeder;

class VechicleFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VechicleFunction::updateOrCreate(
            [
                'id' => 1
            ], [
                'name' => 'ซื้อขาด',
            ]
        );

        VechicleFunction::updateOrCreate(
            [
                'id' => 2
            ], [
                'name' => 'กำหนดวัน',
            ]
        );
    }
}
