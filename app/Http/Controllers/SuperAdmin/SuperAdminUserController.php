<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use DataTables;
use Validator;
use Hash;
use Auth;
use App\Rules\MatchOldPassword;

class SuperAdminUserController extends Controller
{
    public function saveDataUserFromCompany(Request $request)
    {
        $messages_validate = [
            'required' => 'The :attribute field is required.',
            'unique' => 'มีชื่อเข้าใช้ระบบนี้อยู่แล้ว',
        ];

        $user_id = $request->user_id;
        $username = $request->username;
        $password = $request->password;
        $name = $request->name;
        $company_id = $request->company_id;
        $role_id = $request->role_id;
        $status = $request->status;
        $mode_status = $request->mode_status;
        $message=[];
        if(($mode_status=="create") && (empty($user_id))){
            $validator = Validator::make($request->all(), [
                'username' => 'required|unique:users,username',
            ], $messages_validate);

            if ($validator->fails()) {
                return response()->json([
                     'status_code' =>422,
                     'username_duplicate' => $request->username,
                     'message' => $validator->errors(),
                 ], 200);
            }

            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email_verified_at' => now(),
                'password' =>  Hash::make($request->password),
                'company_id' => $company_id,
                'status' => $status
            ]);
            $user->assignRole([$role_id]);
            $message = [
                'status_code' => 200,
                'message' => 'create  was successfully.'
            ];
        }elseif(($mode_status=="edit") && (!empty($user_id))){
            $validator = Validator::make($request->all(), [
                'username' => 'required|unique:users,username,'.$user_id,
            ], $messages_validate);

            if ($validator->fails()) {
                return response()->json([
                     'status_code' =>422,
                     'username_duplicate' => $request->username,
                     'message' => $validator->errors(),
                 ], 200);
            }
            $user = User::find($user_id);

            
            if(!empty($user->tokens)){
                foreach($user->tokens as  $token) {
                    $token->revoke();
                }
            }
            if(!$user){
                $message = [
                    'status_code' => 404,
                    'message' => 'user not found.'
                ];
            }
            $user->name = $name;
            if(!empty($username)){
                $user->username = $username;
            }
            if(!empty($password)){
                $user->password =  Hash::make($password);
            }

            DB::table('model_has_roles')->where('model_id',$user_id)->delete();

            $user->status = $status;
            $user->company_id = $company_id;
            $user->assignRole([$role_id]);
            $user->save();
            $message = [
                'status_code' => 200,
                'message' => 'updated  was successfully.'
            ];
        }else{
            $message = [
                'status_code' => 200,
                'message' => 'no data change.'
            ];
        }

        return response()->json($message);
    }
    public function getUserByCompanyId(Request $request){

        $company_id = $request->company_id;
        // $users = User::role('admin')->where('company_id',"=",$company_id);
        $users = User::with('roles')->where('company_id',"=",$company_id);


        return DataTables::of($users)->addColumn('action', function($users) {
                    return view('superadmin.user-management._btn_datatable_for_user_company', compact('users'))->render();
                })
                ->addColumn('refId', function($users) {
                            return "USRID".$users->id;
                        })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
    }
    public function getUser(Request $request){
        $users = User::role('super-admin');


        return DataTables::of($users)->addColumn('action', function($users) {
                    return view('superadmin.user-management._btn_datatable', compact('users'))->render();
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(request()->ajax()) {

            
          return response()->json($users);
        }

        return view('superadmin.user-management.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('superadmin.user-management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'มีชื่อเข้าใช้ระบบนี้อยู่แล้ว',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required|min:4|unique:users,username',
            'password' => 'required|string',
        ], $messages);


        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 200);
        }

        $user = User::create([
            'username'              => $request->username,
            'name'                  => $request->name,
            'password'              => Hash::make($request->password),
            'email'                 => NULL,
            'company_parent_id'     => Auth::user()->company_parent_id,
            'company_id'            => NULL,
            'status'                => 1
        ]);
        
        $user->assignRole(['super-admin']);

        if(!empty($user)){

            return response()->json([
                'status_code' =>200,
                'message' => 'create successfully.',
                'data'=>[
                    'user_id' => $user->id,
                ]
            ], 200);
        }else{
            return response()->json([
                'status_code' =>201,
                'message' => 'create error.',
            ], 200);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user){abort(404);}
        return view('superadmin.user-management.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if(!$user){abort(404);}
        return view('superadmin.user-management.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'มีชื่อเข้าใช้ระบบนี้อยู่แล้ว',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 200);
        }

        $user = User::find($id);
        if(!empty($request->password)){
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'status' => ($request->status == true) ? 1 : 0
            ]);

            if(!empty($user->tokens)){
                foreach($user->tokens as  $token) {
                    $token->revoke();
                }
            }
        }else{
            $user->update([
                'name' => $request->name,
                'status' => ($request->status == true) ? 1 : 0
            ]);
            if(!empty($user->tokens)){
                foreach($user->tokens as  $token) {
                    $token->revoke();
                }
            }
        }

        $user->assignRole(['super-admin']);

        if(!empty($user)){
            return response()->json([
                'status_code' =>200,
                'message' => 'update successfully.',
                'data'=>[
                    'user_id' => $user->id,
                ]
            ], 200);
        }else{
            return response()->json([
                'status_code' =>201,
                'message' => 'update error.',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
          abort(404);
        }else{
          $name = $user->name;
          $delete = User::destroy($id);
        }
          return redirect()->back()
                    ->with('success',$name.' ถูกลบออกจากระบบเรียบร้อยแล้ว');
    }
}
