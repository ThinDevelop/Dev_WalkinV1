<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeederWalkin2_0 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::updateOrCreate(
            [
                'id' => 1,
            ], [
                'promptpay' => '081222221',
                'status_vechicle' => 1,
                'contract_vechicle_id' => 1,
            ]
        );

        Company::updateOrCreate(
            [
                'id' => 2,
            ], [
                'promptpay' => '081222222',
                'status_vechicle' => 1,
                'contract_vechicle_id' => 2,
            ]
        );
    }
}
