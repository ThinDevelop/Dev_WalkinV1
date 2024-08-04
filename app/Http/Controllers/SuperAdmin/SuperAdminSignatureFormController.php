<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Signature;
use App\Models\User;

class SuperAdminSignatureFormController extends Controller
{
        /**
     * Logout user (Revoke the token) expired api
     *
     * @return [string] message
     */
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
    public function saveDataSignature(Request $request){

        $message = [
            'status_code' => 200,
            'message' => "Not thing chnage."
        ];

        try {
            $company_id = $request->company_id;
            $lists = $request->list;
            $remove_signature_id = $request->remove_signature_id;
            if (!empty($lists)){
                foreach ($lists as $key => $list) {
                    if(!empty($list['id'])){
                        $signature = Signature::where('company_id','=',$company_id)->find($list['id']);
                        if($signature){
                            $signature->update([
                                'name' => $list['name'],
                                'sorting' => $key
                            ]);
                        }
                    }else{
                        $signature = new Signature();
                        $signature->create([
                            'name' => $list['name'],
                            'sorting' => $key,
                            'company_id' =>$company_id
                        ]);
                    }
                }
            }
            if(!empty($remove_signature_id)){
                foreach ($remove_signature_id as $key => $id) {
                    $signature = Signature::where('company_id','=',$company_id)->find($id);
                    $signature->delete();
                }
            }
            $this->revokedTokenByCompanyId($company_id);
            $message = [
                'status_code' => 200,
                'message' => 'create or update successfully'
            ];

        } catch (\Exception $e) {
            $message = [
                'status_code' => 500,
                'message' => $e->getMessage()
            ];
        }

        return $message;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $request->list;
        if(request()->ajax()) {
            $company_id = $request->company_id;
            $signature_form = Signature::where('company_id',$company_id)->orderBy('sorting','ASC')->get();
            if(!$signature_form){
                return response()->json([

                        'status_code' => 404,
                        'message' => 'Data not found.'

                ],404);
            }

            return response()->json($signature_form);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
    }
}
