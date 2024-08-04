<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\DeviceEdc;
use App\Models\CompanyParent;
use App\Models\CompanyDeviceEdc;
use App\Models\DeviceType;
use DB;
use DataTables;

class RootDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            // $device = DeviceEdc::all();
            $device     = DeviceEdc::where('status', 1)->orderBy('id', 'desc')->get();

            foreach($device as $k => $v){
                $device[$k]->type_name = $v->getType->name;
                $device[$k]->company_parent_name = $v->getComapnyParent->name;

                if(!empty($v->company_id)){
                    $device[$k]->company_name = $v->getComapny->name;
                }else{
                    $device[$k]->company_name = '';
                }
            }
            return DataTables::of($device)
            ->make(true);
        }
        return view('root.device-management.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $company_parent =  CompanyParent::where('status', 1)->orderBy('name','ASC')->get();
        $device_type = DeviceType::all();
        return view('root.device-management.create', compact('company_parent','device_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'serial_number' => 'required|unique:App\Models\DeviceEdc,serial_number',
            // 'serial_number' => 'required',
            'company_parent_id' => 'required',
        ]);

        $data   = DeviceEdc::create($request->all());
        // dd($data->id);

        if(!$data){
            App::abort(500, 'Error');
            return response()->json(['status' => 500 , 'messsage' => 'Error#558']);

        }else{

            CompanyDeviceEdc::create([
                'company_parent_id'    => $request['company_parent_id'],
                'edc_id'        => $data->id,
                'action'        => 1,
                'device_status' => $request['type'],
            ]);

            // return view('root.device-management.index');
            return response()->json(['status' => 200 , 'messsage' => '']);

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
        $edc                = DeviceEdc::where('id','=',$id)->where('status','=',1)->first();

        if($edc)
        {
            $company_parent = CompanyParent::where('status', 1)->orderBy('name','ASC')->get();
            $device_type    = DeviceType::all();

            return view('root.device-management.edit', compact('edc','company_parent','device_type'));

        }else{
            return view('root.device-management.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(Request $request, $id)
    {
        $edc    = DeviceEdc::where('id','=',$id)->first();
        
        $validatedData = $request->validate([
            // 'serial_number'     => 'required|unique:App\Models\DeviceEdc,serial_number|max:255',
            'company_parent_id' => 'required|numeric',
            'type'              => 'required|numeric',
        ]);

        DeviceEdc::whereId($id)->update($validatedData);

        if($edc['company_parent_id'] != $request['company_parent_id'] || ( $edc['type'] != $request['type'] ) )
        {
            CompanyDeviceEdc::create([
                'company_parent_id'     => $request['company_parent_id'],
                'edc_id'                => $id,
                'action'                => 2,
                'device_status'         => $request['type'],
            ]);
        }

        // return redirect('/shows')->with('success', 'Show is successfully updated');
        // return view('root.device-management.index');
        return response()->json(['status' => 200 , 'messsage' => '']);
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

    public function DeleteDevice(Request $request)
    {
        $id = $request["id"];

        DeviceEdc::whereId($id)->update(['status' => 0]);;

        // return view('root.company-management.index');
        return response()->json(['status' => 200 , 'messsage' => '']);
    }


}
