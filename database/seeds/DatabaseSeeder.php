<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([

            // ImageTypeSeed::class,
            // CompanyParentSeeder::class,
            // CompanySeed::class,
            // DepartmentsSeed::class,
            // ObjectiveSeed::class,
            // PermissionTableSeeder::class,
            // RoleTableSeeder::class,
            // UsersSeeder::class,
            // SigntureSeed::class,
            // DeviceTypeSeed::class,

            // ข้อมูลตั้งต้น
            // AppointmentStatusSeeder::class,
            // PaymentSeeder::class,
            // VechicleCostTypeSeeder::class,
            // VechicleFunctionSeeder::class,
            // ImageTypeSeederWalkin2_0::class,
            // StampTypeSeeder::class,
            // SettingVechicleStampTypeSeeder::class,
            // PdpaStatusSeeder::class,

            // ข้อมูลสมมุติ
            // PdpaSeeder::class,
            // AppointmentSeeder::class,
            // SettingHourSeeder::class,
            // ContractVechicleSeeder::class,
            // CompanySeederWalkin2_0::class,
            // SettingCostSeeder::class,
            // ContactTransectionSeeder::class,
            // BlacklistSeeder::class
        ]);
    }
}
