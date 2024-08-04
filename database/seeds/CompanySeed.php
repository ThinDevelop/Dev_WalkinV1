<?php

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $company = Company::where('id',1)->first();
        if(empty($company)){
            Company::Create([
                'id' => 1,
                'mid' => '00001',
                'name' => 'cyp test',
                'address' => '3  ซอย สีลม เขตบางรัก กทม. 10200',
                'phone' => '081222222',
                'email' => 'test@mail.com',
                'status' => 1,
                'company_parent_id' => 1,
            ]);
        }   

    }
}