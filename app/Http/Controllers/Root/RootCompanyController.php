<?php

namespace App\Http\Controllers\Root;

use Haruncpi\LaravelIdGenerator\IdGenerator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\DeviceEdc;
use App\models\Company;
use App\Models\CompanyParent;
use App\Models\DeviceType;
use DB;
use DataTables;

class RootCompanyController extends Controller
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
            $records    = DB::table('company_parent')->where('status',1)->orderBy('id', 'desc')->get();
            // $records    = CompanyParent::all();
            // foreach($records as $record)
            // {
            //     $record->status     = ( $record->status == 1 )?"ไม่ใช้งาน":"ใช้งาน";
            // }
            return DataTables::of($records)->make(true);
        }
        return view('root.company-management.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('root.company-management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $config = [
            'table'     => 'todos',
            'length'    => 6,
            'prefix'    => date('y')
        ];
        
        $request->merge([
            'status'    => '1',
            // 'mid'       => "12345",
            // 'email'     => "email@mail.com",
        ]);
        // Input::merge(['mid' => '12345']);
        
        // now use it
        // $mid = IdGenerator::generate($config);
        
        // use within single line code
        // $mid = IdGenerator::generate(['table' => 'todos', 'length' => 6, 'prefix' => date('y')]);
        
        $this->validate($request, [
            // 'serial_number' => 'required|unique:App\Models\DeviceEdc,serial_number',
            // 'mid'           => '',
            'name'          => 'required',
            'address'       => 'required',
            'phone'         => 'required',
            'email'         => 'required',
        ]);

        CompanyParent::create($request->all());

        // return view('root.company-management.index');
        return response()->json(['status' => 200 , 'messsage' => '']);
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
        $company    = CompanyParent::where('id','=',$id)->where('status','=',1)->first();

        if($company)
        {
            return view('root.company-management.edit', compact('company'));

        }else{
            return view('root.company-management.index');
        }
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
        // $this->validate($request, [
        $validatedData = $request->validate([
            'name'          => 'required',
            'address'       => 'required',
            'phone'         => 'required',
            'email'         => 'required',
        ]);

        CompanyParent::whereId($id)->update($validatedData);

        // return view('root.company-management.index');
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

    // public function DeleteCompany(Request $request, $id)
    public function DeleteCompany(Request $request)
    // public function DeleteCompany()
    {
        $id = $request["id"];

        CompanyParent::whereId($id)->update(['status' => 0]);;

        // return view('root.company-management.index');
        return response()->json(['status' => 200 , 'messsage' => '']);
    }

    public function ajaxRequestPost(Request $request)
    {

        die("ajaxRequestPost");


        DB::table('posts')->insert([
            'title' => $request->Code, //This Code coming from ajax request
            'details' => $request->Chief, //This Chief coming from ajax request
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }    
}
