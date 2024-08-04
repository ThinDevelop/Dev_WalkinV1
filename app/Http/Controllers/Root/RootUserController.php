<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Datatables;
use Hash;
use Auth;
use App\Rules\MatchOldPassword;


class RootUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $users = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['root']);
            })->get();

            $data =  datatables()->of($users)
            ->addIndexColumn()
            ->make(true); 
            return $data;
        }
        return view('root.user-management.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('root.user-management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = [
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6|same:password',
            'name' => 'required',
            // 'level' => 'required'
        ];
        $this->validate($request, $validate);

        $upd['name'] = $request->name;
        $upd['username'] = $request->username;
        $upd['password'] = Hash::make($request->password);
        $upd['status'] = 1;

        $user = User::create($upd);
        $user->assignRole('root');

        return redirect()->route('root.user.index')->withInput()
        ->with('success','เพิ่มผู้ดูแลระบบ เรียบร้อยแล้ว');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('root.user-management.edit',compact('user') );
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
        //
        $validate = [
            // 'username' => 'required|unique:users,username',
            // 'password' => 'required|min:6|same:confirm_password',
            // 'confirm_password' => 'required|min:6|same:password',
            'name' => 'required',
            // 'level' => 'required'
        ];
        
        $upd['name'] = $request->name;
        $upd['status'] = $request->status;

        if($request->password || $request->confirm_password){
            $validate['password'] = 'required|min:6|same:confirm_password';
            $validate['confirm_password'] = 'required|min:6|same:password';

            $upd['password'] = Hash::make($request->password);
        }

        $this->validate($request, $validate);
        if($id){

            $user = User::where('id', $id)->update($upd);

            return redirect()->route('root.user.index')->withInput()
            ->with('success','แก้ไขผู้ดูแลระบบ เรียบร้อยแล้ว');
        }else{
            return redirect()->route('root.user.index')->withInput()
            ->with('error','ผิดพลาดไม่สามารถแก้ไขได้');
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
        //
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect()->route('root.user.index')->withInput()
            ->with('success','ลบผู้้ดูแลระบบ เรียบร้อยแล้ว');
        }else{
            return redirect()->route('root.user.index')->withInput()
            ->with('error','ผิดพลาด');
        }
    }

    public function changePassword(){
        echo 'test';

        $id = Auth::user()->id;

        $user = User::find($id);
        if(!$user){abort(404);}
        return view('root.user-management.change_password',compact('user') );
    }

    public function changePasswordSubmit(Request $request){

        $request->validate([
            'password_old' => ['required', new MatchOldPassword],
            'password' => ['required','min:6'],
            'confirm_password' => ['required','same:password'],
        ]);

        $user = User::find(Auth::user()->id);
        $user->update(['password'=> Hash::make($request->password)]);
        
        return redirect()->route('root.dashboard')->withInput()
                        ->with('success','เปลี่ยนรหัสผ่าน เรียบร้อยแล้ว');
       

    }
}
