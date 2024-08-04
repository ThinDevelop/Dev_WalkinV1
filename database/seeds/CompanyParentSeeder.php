<?php

use Illuminate\Database\Seeder;
use App\Models\CompanyParent;

class CompanyParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = CompanyParent::where('id',1)->first();
        if(empty($company)){
            CompanyParent::Create([
                'id' => 1,
                'name' => 'CYP Guard',
                'address' => '144/119 หมู่บ้าน ยิ่งรวยพรีเมียร์ ถ.มาลัยแมน ต.รั้วใหญ่ อ.เมืองสพุรรณ จ.สุพรรณบุรี 72000',
                'phone' => '094-4904134',
                'email' => 'chiyapruek.container@gmail.com',
                'status' => 1,
            ]);
        }   
    }
}
