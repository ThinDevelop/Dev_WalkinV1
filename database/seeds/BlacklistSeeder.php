<?php

use App\Models\Blacklist;
use App\Models\ImageBlacklist;
use App\Models\Images;
use Illuminate\Database\Seeder;

class BlacklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageBlacklist::updateOrCreate(
            [
                "id" => 1
            ], [
                "image_url" => "company/00003/5ff57a6dcdcab.jpg"
            ]
        );

        ImageBlacklist::updateOrCreate(
            [
                "id" => 2
            ], [
                "image_url" => "company/00003/5ff57a6dcdcab.jpg"
            ]
        );

        Blacklist::updateOrCreate(
            [
                "id" => 3
            ], [
                'fullname' => 'นาย A นามสกุล B',
                'note' => 'วิ่งไทย',
                'company_id' => 37, // 2 TSS 37 Api Company
                'contact_transaction_id' => null,
                'image_blacklist_id' => 1,
                'image_type' => null,
                'address' => "TH",
                'car_registration' => 'งง 9999',
                'from' => "TH",
                'status' => 0,
            ]
        );

        Blacklist::updateOrCreate(
            [
                "id" => 4
            ], [
                'fullname' => 'นาย C นามสกุล D',
                'note' => 'วิ่งไทย',
                'company_id' => 37, // 2 TSS 37 Api Company
                'contact_transaction_id' => null,
                'image_blacklist_id' => 2,
                'image_type' => null,
                'address' => "TH",
                'car_registration' => 'งง 9999',
                'from' => "TH",
                'status' => 1,
            ]
        );

        Blacklist::updateOrCreate(
            [
                "id" => 5
            ], [
                'fullname' => 'นาย A นามสกุล B',
                'note' => 'วิ่งไทย',
                'company_id' => 37, // 2 TSS 37 Api Company
                'contact_transaction_id' => "4391",
                'image_blacklist_id' => null,
                'image_type' => 1,
                'address' => "TH",
                'car_registration' => 'งง 9999',
                'from' => "TH",
                'status' => 0,
            ]
        );

        Blacklist::updateOrCreate(
            [
                "id" => 6
            ], [
                'fullname' => 'นาย C นามสกุล D',
                'note' => 'วิ่งไทย',
                'company_id' => 37, // 2 TSS 37 Api Company
                'contact_transaction_id' => "4390",
                'image_blacklist_id' => null,
                'image_type' => 1,
                'address' => "TH",
                'car_registration' => 'งง 9999',
                'from' => "TH",
                'status' => 1,
            ]
        );

        Images::updateOrCreate(
            [
                "contact_id" => "4391"
            ], [
                'image_type_id' => 1,
                'image_url' => 'company/00003/5ff57a6dcdcab.jpg',
            ]
        );

        Images::updateOrCreate(
            [
                "contact_id" => "4390"
            ], [
                'image_type_id' => 1,
                'image_url' => 'company/00003/5ff57a6dcdcab.jpg',
            ]
        );
    }
}
