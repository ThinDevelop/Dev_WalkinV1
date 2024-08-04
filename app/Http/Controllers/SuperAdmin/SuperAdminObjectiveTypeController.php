<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjectiveType;
use App\Models\User;
use DB;
use DataTables;

class SuperAdminObjectiveTypeController extends Controller
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
    public function saveDataObjectiveType(Request $request){
        $message = [
            'status_code' => 200,
            'message' => "Not thing chnage."
        ];

        try {
            $company_id = $request->company_id;
            $lists = $request->list;
            $remove_objective_type_id = $request->remove_objective_type_id;
            if (!empty($lists)){
                foreach ($lists as $key => $list) {
                    if(!empty($list['id'])){
                        $objective_type = ObjectiveType::where('company_id','=',$company_id)->find($list['id']);
                        if($objective_type){
                            $objective_type->update([
                                'name' => $list['name'],
                                'status'=>$list['status'],
                                'sorting' => $key
                            ]);
                        }
                    }else{
                        $objective_type = new ObjectiveType;
                        $objective_type->create([
                            'name' => $list['name'],
                            'status' => $list['status'],
                            'sorting' => $key,
                            'company_id' =>$company_id
                        ]);
                    }
                }
            }
            if(!empty($remove_objective_type_id)){
                foreach ($remove_objective_type_id as $key => $id) {
                    $objective_type = ObjectiveType::where('company_id','=',$company_id)->find($id);
                    $objective_type->delete();
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
        if(request()->ajax()) {

            $company_id = $request->company_id;
            $objective_type = ObjectiveType::where('company_id',$company_id)->orderBy('sorting','ASC')->get();
            if(!$objective_type){
                // return response()->json([],404);
            }

            if(!$objective_type){
                return response()->json([

                        'status_code' => 404,
                        'message' => 'Data not found.'

                ],404);
            }

            return response()->json($objective_type);
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
        $objective_type = ObjectiveType::find($id);
        if(!$objective_type){
          abort(404);
        }else{
          $name = $objective_type->name;
          // $delete = ObjectiveType::destroy($id);
        }
          return redirect()->back()
                    ->with('success',$name.' ถูกลบออกจากระบบเรียบร้อยแล้ว');
    }
}
