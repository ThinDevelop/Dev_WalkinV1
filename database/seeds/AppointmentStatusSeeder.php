<?php

use App\Models\AppointmentStatus;
use Illuminate\Database\Seeder;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppointmentStatus::updateOrCreate(
            [
                'id' => 1
            ], [
                'name' => 'รออนุมัติ',
            ]
        );

        AppointmentStatus::updateOrCreate(
            [
                'id' => 2
            ], [
                'name' => 'อนุมัติ',
            ]
        );

        AppointmentStatus::updateOrCreate(
            [
                'id' => 3
            ], [
                'name' => 'ไม่อนุมัติ',
            ]
        );

        AppointmentStatus::updateOrCreate(
            [
                'id' => 4
            ], [
                'name' => 'ยกเลิก',
            ]
        );
    }
}
