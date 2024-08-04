<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator;
use DB;

use App\Models\User;
use App\Models\Company;
use App\Models\Signature;
use App\Models\DeviceEdc;
use App\Models\Departments;
use App\Models\ObjectiveType;
use App\Models\VechicleFunction;
use App\Models\ContractVechicle;
use App\Models\Pdpa;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // เช็ค username, password
        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 422);
        }

        $credentials = request(['username', 'password']);
        $credentials['status'] = 1;

        if(!Auth::attempt($credentials) || !Auth::user()->hasRole('user') ){
            return response()->json([
                'status_code' =>201,
                'message' => 'Login failed',
            ], 200);
        }

        // gen token
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        //set timer expire
        $token->expires_at = Carbon::now()->addWeeks(2);
        $expiration = $token->expires_at->diffInSeconds(Carbon::now());
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
        $token->save();

        // เช็ค Company
        $company = Company::select()
            ->with(['contractVechicleActive'])
            ->find($user->company_id);

        // list Signature
        $signature = Signature::select('name','sorting')
            ->where('company_id',$user->company_id)
            ->orderBy('sorting','ASC')
            ->get();

        // list Departments
        $department = Departments::select('id','name','description')
            ->where('company_id',$user->company_id)
            ->where('status',1)
            ->orderBy('sorting','ASC')
            ->get();

        // list ObjectiveType
        $objective_type = ObjectiveType::select('id','name','description')
            ->where('company_id',$user->company_id)
            ->orderBy('sorting','ASC')
            ->where('status',1)
            ->get();

        $compnay_note = str_replace(array("\r\n","\r","\n"),"\n",$company->note);

        return response()->json([
            'status_code' => 200,
            'message' => 'successfully.',
            'token_type' => 'Bearer',
            'access_token' => $tokenResult->accessToken,
            'expires_in'=>$expiration,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'data' => [
                'user' => [
                    'id'=> $user->id,
                    'name'=> $user->name,
                ],
                'company' => [
                    'id' => $company->id,
                    'name' => $company->name,
                    'address' => $company->address,
                    'phone' => $company->phone,
                    'email' => $company->email,
                    'status' => $company->status,
                    'note' => $compnay_note,
                    'logo' => ($company->logo == NULL)? '' : url()->previous().'/'.$company->logo,
                ],
                'signature' => $signature,
                'department' => $department,
                'objective_type' => $objective_type,
            ],
        ]);

    }

    public function device(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serial_number' => 'required|string',
            // 'company_id' => 'required',
        ]);

        return response()->json([
            'status_code' => 200,
            'message' => 'successfully.',
            'data' => [
                'device_id' => "" ,
                'serial_number'=> $request->serial_number,
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 422);
        }

        // $company = Company::find($request->input('company_id'));
        // if (empty($company)) {
        //     return response()->json([
        //          'status_code' =>901,
        //          'message' => 'company is not.',
        //      ], 200);
        // }

        $device = DeviceEdc::where('serial_number', $request->input('serial_number'))
            // ->where('company_id', $company->id)
            ->first();
        if (empty($device)) {
            return response()->json([
                    'status_code' =>902,
                    'message' => 'serial_number is not.',
                ], 200);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'successfully.',
            'data' => [
                'device_id' => $device->id,
                'serial_number'=> $device->serial_number,
            ]
        ]);

    }

}
