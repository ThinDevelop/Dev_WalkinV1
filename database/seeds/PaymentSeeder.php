<?php

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::updateOrCreate(
            [
                'id' => 1
            ], [
                'name' => 'QR Code',
            ]
        );

        Payment::updateOrCreate(
            [
                'id' => 2
            ], [
                'name' => 'เงินสด',
            ]
        );
    }
}
