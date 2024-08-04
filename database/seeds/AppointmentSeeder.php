<?php

use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        $appointments = [];
        
        for ($i = 0; $i < 10; $i++) { // สร้าง 10 รายการ
            $date = $faker->date();
            $startTime = $faker->time();
            $endTime = $faker->time();
            $phone = $faker->unique()->randomNumber(9, true);
            $email = substr($faker->unique()->safeEmail, 0, 30);

            $appointments[] = [
                'from' => $faker->address,
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'phone' => $phone,
                'email' => $email,
                'date_appointment' => $date,
                'start_time' => Carbon::parse($startTime)->secondsSinceMidnight(),
                'end_time' => Carbon::parse($endTime)->secondsSinceMidnight(),
            ];
        }

        foreach ($appointments as $user) {
            // สร้าง code ที่ไม่ซ้ำ
            do {
                $year = substr(date("Y"),2,2);
                $num = rand(1000,9999);
                $user['appointment_code'] = $year.date("md").str_shuffle(date('His')).$num;

                $codeExists = Appointment::where('appointment_code', $user['appointment_code'])->exists();
            } while ($codeExists);
            
            Appointment::Create([
                'company_id' => 2, // 2 TSS
                'department_id' => 54, // ผลิตเคมีเกษตร
                'objective_id' => 3, // วางบิล
                'appointment_code' => $user['appointment_code'],
                'from' => $user['from'],
                'name' => $user['name'],
                'lastname' => $user['lastname'],
                'phone' => $user['phone'],
                'email' => $user['email'],
                'date_appointment' => $user['date_appointment'],
                'start_time' => $user['start_time'],
                'end_time' => $user['end_time'],
                'note' => '',
                'status' => 1, // 1 รออนุมัติ, 2 อนุมัติ, 3 ไม่อนุมัติ, 4 ยกเลิก
                'pdpa_id' => 5,
                'pdpa_status_id' => 1, // 1 ยินยอม, 2 ไม่ยินยอม
            ]);
        }

    }
}
