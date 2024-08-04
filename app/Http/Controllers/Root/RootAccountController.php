<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyParent;
use Datatables;
use Hash;


class RootAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if(request()->ajax()) {
            $account = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['super-admin']);
            })->get();

            foreach($account as $key => $value){
                $account[$key]->company_parent_name = $value->company_parent->name;
            }

            $data =  datatables()->of($account)
            ->addIndexColumn()
            ->make(true); 
            return $data;
        }
        return view('root.account-management.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $company_parrent = CompanyParent::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('root.account-management.create', compact('company_parrent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = [
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6|same:password',
            'name' => 'required',
            'company_parent_id' => 'required'
        ];
        $this->validate($request, $validate);

        $upd['name'] = $request->name;
        $upd['username'] = $request->username;
        $upd['company_parent_id'] = $request->company_parent_id;
        $upd['password'] = Hash::make($request->password);
        $upd['status'] = 1;

        $user = User::create($upd);
        $user->assignRole('super-admin');

        return redirect()->route('root.account.index')->withInput()
        ->with('success','เพิ่มผู้ใช้งาน เรียบร้อยแล้ว');
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
        $company_parrent = CompanyParent::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('root.account-management.edit',compact('user', 'company_parrent') );
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
        $validate = [
            'name' => 'required',
            'company_parent_id' => 'required'
        ];
        
        $upd['name'] = $request->name;
        $upd['status'] = $request->status;
        $upd['company_parent_id'] = $request->company_parent_id;

        if($request->password || $request->confirm_password){
            $validate['password'] = 'required|min:6|same:confirm_password';
            $validate['confirm_password'] = 'required|min:6|same:password';

            $upd['password'] = Hash::make($request->password);
        }

        $this->validate($request, $validate);
        if($id){

            $user = User::where('id', $id)->update($upd);

            return redirect()->route('root.account.index')->withInput()
            ->with('success','แก้ไขผู้ใช้งาน เรียบร้อยแล้ว');
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
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect()->route('root.account.index')->withInput()
            ->with('success','ลบผู้ใช้งาน เรียบร้อยแล้ว');
        }else{
            return redirect()->route('root.account.index')->withInput()
            ->with('error','ผิดพลาด');
        }
    }
}
