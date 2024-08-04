<?php

use App\Models\ImageType;
use Illuminate\Database\Seeder;

class ImageTypeSeederWalkin2_0 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageType::updateOrCreate(
            [
                'id' => 6
            ], [
                'name' => 'รูปสลิปหลักฐานการชำระ',
                'description' => '',
            ]
        );
    }
}
