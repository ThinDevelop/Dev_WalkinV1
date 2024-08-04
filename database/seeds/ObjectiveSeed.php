<?php

use Illuminate\Database\Seeder;
use App\Models\ObjectiveType;

class ObjectiveSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'วางบิล',1],
            [2,'จ่ายเงิน',1],
        ];

        foreach ($data as $value) {
            $chk_status = ObjectiveType::where('id',$value[0])->first();
                if($chk_status){
                    $chk_status->update([
                        'name' => $value[1],
                        'company_id' => $value[2],
                    ]);
            }else{
                ObjectiveType::Create([
                        'id' => $value[0],
                        'name' => $value[1],
                        'description' => '',
                        'company_id' => $value[2],
                ]);
            }
        }
    }
}