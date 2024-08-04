<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

use App\Models\Company;
use App\Models\User;


class SuperAdminNoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function saveDataNote(Request $request){

        $company = Company::find($request->company_id);
        if(!empty($company)){
            $company->update([
                'note' => $request->note
            ]);
            $this->revokedTokenByCompanyId($request->company_id);
        }

        return response()->json([
            'status_code' =>200,
            'message' => 'update ok.',
        ], 200);

    }

    public function revokedTokenByCompanyId($company_id)
    {
        $users = User::where('company_id',$company_id)->get();
        if(!empty($users)){
            foreach ($users as $key => $user) {
                if(!empty($user->tokens)){
                    foreach($user->tokens as  $token) {
                        $token->revoke();
                    }
                }
            }
        }
    }


}
