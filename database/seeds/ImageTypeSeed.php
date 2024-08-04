<?php

use Illuminate\Database\Seeder;
use App\Models\ImageType;

class ImageTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
                [1,'คน','คน'],
                [2,'รถ','รถ'],
                [3,'บัตร ปชช.','บัตร ปชช.'],
                [4,'รูปหน้าบัตร','รูปหน้าบัตร'],
                [5,'อื่น ๆ','อื่น ๆ']
            ];

            foreach ($type as $value) {
                $chk_status = ImageType::where('id',$value[0])->first();
                if($chk_status){
                    $chk_status->update([
                        'name' => $value[1],
                    ]);
            }else{
                ImageType::Create([
                        'id' => $value[0],
                        'name' => $value[1],
                        'description' => '',
                ]);
            }
        }
    }
}