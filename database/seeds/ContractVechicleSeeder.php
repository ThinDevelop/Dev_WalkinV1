<?php

use App\Models\ContractVechicle;
use Illuminate\Database\Seeder;

class ContractVechicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ซื้อขาด
        ContractVechicle::updateOrCreate(
            [
                'id' => 1
            ], [
                'vechicle_function_id' => 1,
                'contract_code' => 'CONTRACT001',
                'start_date' => null,
                'end_date' => null,
            ]
        );

        //กำหนดวัน
        ContractVechicle::updateOrCreate(
            [
                'id' => 2
            ], [
                'vechicle_function_id' => 2,
                'contract_code' => 'CONTRACT002',
                'start_date' => '2024-02-01',
                'end_date' => '2024-12-31',
            ]
        );
    }
}
