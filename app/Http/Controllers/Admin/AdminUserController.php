<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Carbon\Carbon;
use Validator;

use App\Models\User;
use DataTables;
use Hash;
use App\Rules\MatchOldPassword;

class AdminUserController extends Controller
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

    public function showList(Request $request, $type){

        if(request()->ajax()) {
            $company_id = Auth::user()->company_id;
            if($type == 'admin'){
                $user = User::where('company_id', $company_id)->role('admin')->get();
            }else if($type == 'device'){
                $user = User::where('company_id', $company_id)->role('user')->get();
            }

            return response()->json([
                'status_code' => 200,
                'message' => 'get data successfully.',
                'data' => $user
            ], 200);
        }

        return view('admin.user.list', compact('type'));
    }

    // public function changePassword(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'user_id' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //              'status_code' =>422,
    //              'message' => $validator->errors(),
    //         ], 200);
    //     }

    //     $user = User::find($request->user_id);
    //     if(!empty($user)){
    //         $user->update([
    //             'password' => Hash::make($request->password)
    //         ]);
    //         if(!empty($user->tokens)){
    //             foreach($user->tokens as  $token) {
    //                 $token->revoke();
    //             }
    //         }
    //         return response()->json([
    //             'status_code' =>200,
    //             'message' => 'successfully',
    //         ], 200);
    //     }else{
    //         return response()->json([
    //             'status_code' =>201,
    //             'message' => 'no data',
    //         ], 200);
    //     }
    // }

    public function changePassword()
    {

        return view('admin.change_password');
    }

    public function changePasswordSubmit(Request $request){
        $request->validate([
            'old-password' => ['required', new MatchOldPassword],
            'password' => ['required','min:6'],
            'confirm-password' => ['required','same:password','min:6'],
        ]);

        $id = Auth()->id();
        $user = User::find($id);
        if(!$user){abort(404);}

        $user->update(['password'=>Hash::make($request->password)]);
        if(!empty($user->tokens)){
            foreach($user->tokens as  $token) {
                $token->revoke();
            }
        }
        return redirect()->route('admin.changePassword')->withInput()
        ->with('success','เปลี่ยนรหัสผ่าน เรียบร้อยแล้ว');

    }

}
