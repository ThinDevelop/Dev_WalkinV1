<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        $permissions = [
           [1,'no-permission'],
           [2,'role-list'],
           [3,'role-create'],
           [4,'role-edit'],
           [5,'role-delete'],
           
        ];

        // Permission::updateOrCreate($permissions);
        foreach ($permissions as $permission) {
            $chk_permission = Permission::where('id',$permission[0])->first();
            if($chk_permission){
                $chk_permission->update([
                    'name' => $permission[1]
                ]);
            }else{
                Permission::Create([
                    'id' => $permission[0],
                    'name' => $permission[1]
                ]);
            }
        }
    }
}