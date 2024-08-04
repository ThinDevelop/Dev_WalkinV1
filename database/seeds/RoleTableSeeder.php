<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [1,'root'],
            [2,'super-admin'],
            [3,'admin'],
            [4,'user'],
         ];
         foreach ($roles as $role) {
             $chk_role = Role::where('id',$role[0])->first();
             if($chk_role){
                 $chk_role->update([
                     'name' => $role[1]
                 ]);
             }else{
                 Role::Create([
                     'id' => $role[0],
                     'name' => $role[1]
                 ]);
             }
         }
    }
}