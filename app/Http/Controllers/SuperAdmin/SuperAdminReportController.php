<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\User;
use App\Models\ContactTransection;
use App\Models\Departments;
use App\Models\Images;
use App\Models\ImageType;
use DB;
use Validator;
use Hash;
use App\Rules\MatchOldPassword;
use DataTables;

use Helper;

use App\Http\Controllers\Admin\AdminContactController;
class SuperAdminReportController extends Controller
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

    public function Today(Request $request){
        $date = Carbon::now()->toDateString();
        $date_start = $date.' 00-00-00';
        $date_from = $date.' 23-59-59';
        $type = 'today';
        $company = Company::select('id','name')->where('status',1)->orderBy('name', 'ASC')->get();
        return view('superadmin.report.show',compact('type', 'date_start', 'date_from','company'));
    }

    public function Week(Request $request){
        $date_start = Carbon::now()->startOfWeek()->format('Y-m-d H:i:s');
        $date_from = Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');
        $type = 'week';

        $company = Company::select('id','name')->where('status',1)->orderBy('name', 'ASC')->get();
        return view('superadmin.report.show',compact('type', 'date_start', 'date_from','company'));
    }

    public function Month(Request $request){

        $date_start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $date_from = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
        $type = 'month';

        $company = Company::select('id','name')->where('status',1)->orderBy('name', 'ASC')->get();
        return view('superadmin.report.show',compact('type', 'date_start', 'date_from', 'company'));
    }

    public function CustomDate(Request $request){

        $date_now = Carbon::now()->toDateString();
        $company = Company::select('id','name')->where('status',1)->orderBy('name', 'ASC')->get();
        $type = '';
        return view('superadmin.report.show_custom',compact('type', 'date_now','company'));

    }

    public function listDate(Request $request, $start, $from){

        if(request()->ajax()) {
            $type_checkin = $request->input('type', null);
            $company = Auth::user()->company_id;

        if($from == 'custom'){
            $contact = ContactTransection::where('company_id', $company)
                ->with(['getDepartment', 'getObjective', 'getCompany', 'getPayment']);
                // ->get();
        }else{
            $contact = ContactTransection::where('company_id', $company)
                ->with(['getDepartment', 'getObjective', 'getCompany', 'getPayment'])
                ->whereBetween('checkin_time', [$start, $from ]);
                // ->get();
        }

        if ($type_checkin == 'parking') {
            $contact->where(function($where){
                $where->whereNotNull('vechicle_cost_types_id');
                $where->where('vehicel_registration', '!=', '');
                $where->where('status', 1);
            });
        }

        return DataTables::of($contact)
                ->addColumn('department', function ($data) {
                    return $data->getDepartment ? $data->getDepartment->name : '';
                })
                ->addColumn('objective', function ($data) {
                    return $data->getObjective ? $data->getObjective->name : '';
                })
                ->addColumn('company', function ($data) {
                    return $data->getCompany ? $data->getCompany->name : '';
                })
                ->editColumn('checkin_time', function ($data) {
                    return "<span class='font-weight-bolder text-success'>$data->checkin_time</span>";
                })
                ->editColumn('checkout_time', function ($data) {
                    return $data->status == 1 ? "<span class='font-weight-bolder text-danger'>$data->checkout_time</span>" : '';
                })
                ->editColumn('time_in', function ($data) {
                    return $data->status == 1 ? Helper::dateDiff($data->checkin_time, $data->checkout_time) : '';
                })
                ->editColumn('price_amount', function ($data) {
                    $str = ($data->status == 1 ? number_format($data->price_amount, 2) . ' บาท' : 0 . ' บาท');
                    $str .= '<br/>';
                    $str .= $data->getPayment ? $data->getPayment->name : '';
                    return $str;
                })
                ->rawColumns(['action', 'price_amount', 'checkin_time', 'checkout_time'])
                // ->addIndexColumn()
                ->make(true);
            // return DataTables::of($contact)
            //         ->make(true);
        }else{
            abort(404);
        }
    }

    public function Export(){
        $company_id = Auth::user()->company_id;


        $company = Company::with(['contractVechicleActive', 'settingParkingCompany.settingHours'])->find($company_id);
        $checkContractVechicle = 0 ; //1 มีสัญญา 0 ไม่มีสัญญส

        if(!empty($company->contractVechicleActive) && $company->status_vechicle == 1) {
            if (!empty($company->settingParkingCompany)) {
                if (!empty($company->settingParkingCompany->settingHours)) {
                    $settingHours = $company->settingParkingCompany->settingHours;
                    if (sizeof($settingHours) > 0) {
                        $checkContractVechicle = 1;
                    }
                }
            }
        }

        $company = Company::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('superadmin.report.export ',compact('company','company_id', 'checkContractVechicle'));
    }

}
