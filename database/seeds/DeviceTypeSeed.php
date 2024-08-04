<?php

use Illuminate\Database\Seeder;
use App\Models\DeviceType;

class DeviceTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1,'demo'],
            [2,'เช่า'],
            [3,'ขาย'],
            [4,'ซ้อม'],
            [5,'ส่งคืน'],
        ];

        foreach ($data as $value) {
            $chk_status = DeviceType::where('id',$value[0])->first();
            if($chk_status){
                    $chk_status->update([
                        'name' => $value[1],
                    ]);
            }else{
                DeviceType::Create([
                        'id' => $value[0],
                        'name' => $value[1],
                ]);
            }
        }
    }
}