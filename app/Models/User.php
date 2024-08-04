<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasRoles;


    public function getAllPermissionsAttribute() {
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (Auth::user()->can($permission->name)) {
              $permissions[] = $permission->name;
            }
        }
        return $permissions;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','last_login_at','last_login_ip','company_id','status',
        'company_parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function company_parent()
    {
        return $this->belongsTo('App\Models\CompanyParent', 'company_parent_id');
    }
}
