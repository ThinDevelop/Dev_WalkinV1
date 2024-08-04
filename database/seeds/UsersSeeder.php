<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $check_user = User::where('username','root')->first();
        if(empty($check_user)){
            // add root
            $root = User::create([
                'name' => 'root',
                'username' => 'root',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'),
                'remember_token' => Str::random(10),
                'company_id' => NULL,
                'company_parent_id' => NULL,
                'status' => 1,
            ]);

            $role = Role::where('name','root')->first();
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $root->assignRole([$role->id]);
        }

        //add super-admin 
        $check_user = User::where('username','admin')->first();
        if(empty($check_user)){
            $admin = User::create([
                'name' => 'ผูดูแลระบบ',
                'username' => 'admin',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'),
                'remember_token' => Str::random(10),
                'company_id' => NULL,
                'company_parent_id' => 1,
                'status' => 1,
            ]);
            $role = Role::where('name','super-admin')->first();
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $admin->assignRole([$role->id]);
        }

        //add admin 
        $check_user = User::where('username','company')->first();
        if(empty($check_user)){
            $company = User::create([
                'name' => 'บริษัท',
                'username' => 'company',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'),
                'remember_token' => Str::random(10),
                'company_id' => 1,
                'company_parent_id' => 1,
                'status' => 1,
            ]);
            $role = Role::where('name','admin')->first();
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $company->assignRole([$role->id]);
        }

        //add user 
        $check_user = User::where('username','user')->first();
        if(empty($check_user)){
            $user = User::create([
                'name' => 'ประตู 1',
                'username' => 'user',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'),
                'remember_token' => Str::random(10),
                'company_id' => 1,
                'company_parent_id' => 1,
                'status' => 1,
            ]);
            $role = Role::where('name','user')->first();
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
        }
    }
}