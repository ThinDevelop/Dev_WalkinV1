<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Company;
use App\Models\ContractVechicle;
use App\Models\Pdpa;
use DB;
use DataTables;
use File;

class SuperAdminCompanyController extends Controller
{
    public function getCompany(Request $request)
    {
        // ใช้ Eloquent Query Builder แทนการใช้ map() เพื่อดึงข้อมูลบริษัททั้งหมด
        $companies = Company::all();

        foreach ($companies as $company) {
            if (!empty($company->logo)) {
                $fullLogoUrl = public_path($company->logo);
                if (file_exists($fullLogoUrl)) {
                    $company->logo = $company->logo;
                } else {
                    $company->logo = 'images/noimage.png';
                }
            } else {
                $company->logo = 'images/noimage.png';
            }
        }

        // ส่งข้อมูลไปยัง DataTables
        return DataTables::of($companies)
            ->addColumn('action', function ($company) {
                return view('superadmin.company-management._btn_datatable', compact('company'))->render();
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
    public function index()
    {
        return view('superadmin.company-management.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.company-management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Create
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string',
            'logo' => 'required|image|max:2048',
        ]);

        if ($request->status2 == 'true') {
            $validator->addRules([
                'prompay' => ['required', 'regex:/^\d{10}$|^\d{13}$/'],
            ]);
            if ($request->selectedContract == 'time') {
                $validator->addRules([
                    'selectedDate1' => ['required_if:selectedContract,time', 'date'],
                    'selectedDate2' => ['required_if:selectedContract,time', 'date', 'after:selectedDate1'],
                ]);
            }
        }
        
        $errors = $validator->errors();

        if ($errors->any()) {
            return response()->json([
                'status_code' => 422,
                'message' => $errors,
            ]);
        }

        // $errors = $validator->errors();
        // if (empty($request->prompay) && $request->status2 == 'true') {
        //     $errors->add('prompay', 'The prompay field is required.');
        // }
        // if ($request->selectedContract == "time" && empty($request->selectedDate1) && $request->status2 == 'true') {
        //     $errors->add('selectedDate1', 'The selectedDate1 field is required.');
        // }
        // if ($request->selectedContract == "time" && empty($request->selectedDate2) && $request->status2 == 'true') {
        //     $errors->add('selectedDate2', 'The selectedDate2 field is required.');
        // }

        // if (!$errors->isEmpty()) {
        //     return response()->json([
        //         'status_code' => 422,
        //         'message' => $errors,
        //     ]);
        // }

        $check_mid = DB::table('company')
            ->select(DB::raw('MAX(SUBSTR(mid,-5))+1 as maxid'))
            ->first();

        if ($check_mid->maxid == "") {
            $mid = "00001";
        } else {
            $mid = "" . sprintf("%05d", $check_mid->maxid);
        }

        { // insert company
            $company                        = new Company;
            $company->mid                   = $mid;
            $company->name                  = $request->name;
            $company->address               = $request->address;
            $company->phone                 = $request->phone;
            $company->email                 = $request->email;
            $company->status                = ($request->status1 == 'true') ? 1 : 0;
            $company->company_parent_id     = Auth::user()->company_parent_id;
            $company->line_token     = !empty($request->linetoken) ? $request->linetoken : '';

            if (!empty($request->logo)) {
                $fileName = $mid . '-' . date("Ymd") . '.' . $request->logo->extension();
                $path = "company/" . $mid . "/logo" . "/" . $fileName;
                $company->logo = $path;
            }

            if ($request->status2 == 'true') {
                $company->status_vechicle       = ($request->status2 == 'true') ? 1 : 0;
                $company->promptpay             = $request->prompay;
            }

            $company->save();
        }

        if ($request->status2 == 'true') {
            $num = rand(1000, 9999);
            $year = substr(date("Y"), 2, 2);
            $code = $year . date("md") . str_shuffle(date('His')) . $num;

            $contract                       = new ContractVechicle;
            $contract->vechicle_function_id = $request->selectedContract == "all" ? 1 : 2;
            $contract->contract_code        = $code;
            $contract->status               = $request->status2 == "true" ? 1 : 0;
            $contract->company_id           = $company->id;
            if ($request->selectedContract == "time") {
                if($request->selectedDate1 == 'null' || $request->selectedDate2 == 'null' || $request->prompay == ''){
                    return response()->json([
                        'status_code' => 422,
                        'message' => [
                            'prompay' => $request->prompay == '' ? ['The prompay field is required.'] : null,
                            'selectedDate1' => $request->selectedDate1 == 'null' ? ['The selectedDate1 field is required.'] : null,
                            'selectedDate2' => $request->selectedDate2 == 'null' ? ['The selectedDate2 field is required.'] : null
                        ]
                    ]);
                }
                $contract->start_date           = $request->selectedDate1;
                $contract->end_date             = $request->selectedDate2;
            } else {
                $contract->start_date           = null;
                $contract->end_date             = null;
            }
            $contract->save();
        }

        if(!empty($request->pdpa)){
            $pdpa = Pdpa::where("company_id", $company->id)->first();

            if ($pdpa) {
                $pdpa->update([
                    "pdpa" => $request->pdpa
                ]);
            } else {
                $pdpa = new Pdpa;
                $pdpa->company_id = $company->id;
                $pdpa->pdpa = $request->pdpa;
                $pdpa->save();
            }
        }else {
            $pdpa = Pdpa::where("company_id", $company->id)->first();
            if ($pdpa) {
                $pdpa->update([
                    "pdpa" => ""
                ]);
            }
        }

        if ($company->exists()) {

            $directory = "company/" . $mid . "/";

            // สร้างไดเร็กทอรีถ้ายังไม่มี
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true); // ใช้โหมดการสร้างเต็มรูปแบบ
            }

            // mkdir("company/".$mid."/logo"."/", 0777);
            if (!empty($request->logo)) {
                $path = "company/" . $mid . "/logo" . "/" . $fileName;
                $move = $request->file('logo')->move("company/" . $mid . "/logo", $path);
            }

            return response()->json([
                'status_code' => 200,
                'message' => 'create successfully.',
                'data' => [
                    'copmpay_id' => $company->id,
                    'mid' => $mid,
                ]
            ], 200);
        } else {
            return response()->json([
                'status_code' => 201,
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
        $company = Company::find($id);
        if (!$company) {
            abort(404);
        }
        return view('superadmin.company-management.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $company = Company::with(["contractVechicles","pdpa"])->find($id);

        // return $company;

        if (!$company) {
            abort(404);
        }

        return view('superadmin.company-management.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    //Edit
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string',
        ]);

        if ($request->status2 == 'true') {
            $validator->addRules([
                'prompay' => ['required', 'regex:/^\d{10}$|^\d{13}$/'],
            ]);
            
            if ($request->selectedContract == 'time') {
                $validator->addRules([
                    'selectedDate1' => ['required_if:selectedContract,time', 'date'],
                    'selectedDate2' => ['required_if:selectedContract,time', 'date', 'after:selectedDate1'],
                ]);
            }
        }
        
        $errors = $validator->errors();

        if ($errors->any()) {
            return response()->json([
                'status_code' => 422,
                'message' => $errors,
            ]);
        }

        $company = Company::find($id);

        if($request->pdpa != "null"){
            $pdpa = Pdpa::where("company_id", $company->id)->first();

            if ($pdpa) {
                $pdpa->update([
                    "pdpa" => $request->pdpa
                ]);
            } else {
                $pdpa = new Pdpa;
                $pdpa->company_id = $company->id;
                $pdpa->pdpa = $request->pdpa;
                $pdpa->save();
            }
        }else {
            //SoftDeletes
            Pdpa::where("company_id", $company->id)->delete();
        }

        // ฟังก์ชันพิเศษคิดค่าจอดรถ
        if($request->status2 == 'true'){
            $company->status_vechicle = 1;
            $company->promptpay = $request->prompay;

            $num = rand(1000, 9999);
            $year = substr(date("Y"), 2, 2);
            $code = $year . date("md") . str_shuffle(date('His')) . $num;

            $dataContract = [];

            $dataContract['status'] = $request->status2 == 'true' ? 1 : 0;

            if($request->selectedContract == "time") {
                $dataContract['vechicle_function_id'] = 2;
                $dataContract['start_date'] = $request->selectedDate1;
                $dataContract['end_date'] = $request->selectedDate2;
            } else {
                $dataContract['vechicle_function_id'] = 1;
                $dataContract['start_date'] = null;
                $dataContract['end_date'] = null;
            }

            $checkContract = ContractVechicle::where("company_id", $company->id)->first();
            if(empty($checkContract)){
                $dataContract['contract_code'] = $code;
            }

            $contract = ContractVechicle::updateOrCreate(
                [
                    'company_id' => $company->id,
                ],
                $dataContract
            );

            // $contract->save();
            if (empty($contract)) {
                return response()->json([
                    'status_code' => 201,
                    'message' => 'update contract error.',
                ], 200);
            }
        } else {
            ContractVechicle::where('company_id', $id)->delete();

            $company->status_vechicle = 0;
            $company->promptpay = null;
        }

        $company->name = $request->name;
        $company->line_token = $request->linetoken;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->status = ($request->status1 == 'true') ? 1 : 0;

        $mid = $request->mid;
        if (!empty($request->logo)) {
            $fileName = $mid . '-' . date("Ymd") . '.' . $request->logo->extension();
            $path = "company/" . $mid . "/logo" . "/" . $fileName;
            $company->logo = $path;
            $move = $request->file('logo')->move("company/" . $mid . "/logo", $path);
        }

        $company->save();
        if (!empty($company)) {
            return response()->json([
                'status_code' => 200,
                'message' => 'update successfully.',
                'data' => [
                    'copmpay_id' => $company->id,
                ]
            ], 200);
        } else {
            return response()->json([
                'status_code' => 201,
                'message' => 'update company error.',
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
        $company = Company::find($id);
        if (!$company) {
            abort(404);
        } else {
            $name = $company->name;
            $delete = Company::destroy($id);
            return redirect()->back()
                ->with('success', $name . ' ถูกลบออกจากระบบเรียบร้อยแล้ว');
        }
    }
}
