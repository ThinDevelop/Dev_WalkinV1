<?php

use Illuminate\Database\Seeder;
use App\Models\Signature;

class SigntureSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'รปภ.',1,1],
            [2,'หัวหน้าแผนก',1,2],
            [3,'ผู้ติดต่อ',1,3],
        ];

        foreach ($data as $value) {
            $chk_status = Signature::where('id',$value[0])->first();
            if($chk_status){
                    $chk_status->update([
                        'name' => $value[1],
                        'company_id' => $value[2],
                        'sorting' => $value[3]
                    ]);
            }else{
                Signature::Create([
                        'id' => $value[0],
                        'name' => $value[1],
                        'company_id' => $value[2],
                        'sorting' => $value[3]
                ]);
            }
        }
    }
}