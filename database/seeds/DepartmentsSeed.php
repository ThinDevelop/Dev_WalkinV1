<?php

use Illuminate\Database\Seeder;
use App\Models\Departments;

class DepartmentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'บุคคล',1],
            [2,'บัญชี',1],
            [3,'การเงิน',1],
        ];

        foreach ($data as $value) {
            $chk_status = Departments::where('id',$value[0])->first();
            if($chk_status){
                    $chk_status->update([
                        'name' => $value[1],
                        'company_id' => $value[2],
                    ]);
            }else{
                Departments::Create([
                        'id' => $value[0],
                        'name' => $value[1],
                        'description' => '',
                        'company_id' => $value[2],
                ]);
            }
        }
    }

}