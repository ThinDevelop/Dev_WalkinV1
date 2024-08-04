<?php

use App\Models\PdpaStatus;
use Illuminate\Database\Seeder;

class PdpaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PdpaStatus::updateOrCreate(
            [
                'id' => 1
            ], [
                'name' => 'ยินยอม',
            ]
        );
        PdpaStatus::updateOrCreate(
            [
                'id' => 2
            ], [
                'name' => 'ไม่ยินยอม',
            ]
        );
    }
}
