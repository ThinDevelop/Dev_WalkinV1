<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

use Carbon\Carbon;
use App\Models\Company;
use DB;
use Validator;
use Hash;
use App\Rules\MatchOldPassword;
use DataTables;

use Helper;

class RootReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Month(Request $request)
    {
        return view('root.company-report.index');

        // $date_start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        // $date_from = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
        // $type = 'month';

        // $company = Company::select('id','name')->where('status',1)->orderBy('name', 'ASC')->get();
        // return view('root.report.show',compact('type', 'date_start', 'date_from', 'company'));
    }

    public function CustomDate(Request $request)
    {
        if(request()->ajax())
        {
            // DB::enableQueryLog();
            $records    = DB::table('company_parent')->leftJoin('device_edc', 'company_parent.id', '=', 'device_edc.company_parent_id')->where('company_parent.status',1)->orderBy('company_parent.id', 'asc')->get();
            // dd(DB::getQueryLog()); 

            // $records    = CompanyParent::all();
            // foreach($records as $record)
            // {
            //     $record->status     = ( $record->status == 1 )?"ไม่ใช้งาน":"ใช้งาน";
            // }
            return DataTables::of($records)->make(true);
        }
        
        return view('root.report.show_custom');

        // $date_now = Carbon::now()->toDateString();
        // $company = Company::select('id','name')->where('status',1)->orderBy('name', 'ASC')->get();
        // return view('root.report.show_custom',compact('type', 'date_now','company'));
    
    }

    public function listDate(Request $request, $start, $from)
    {        
        if(request()->ajax())
        {
            $sql    = '
                        SELECT 		t1.id, t2.name, t3.serial_number, 
                                    (CASE
                                        WHEN t1.device_status = 1 THEN "Demo"
                                        WHEN t1.device_status = 2 THEN "เช่า"
                                        WHEN t1.device_status = 3 THEN "ขาย"
                                        WHEN t1.device_status = 4 THEN "ซ่อม"
                                        WHEN t1.device_status = 5 THEN "ส่งคืน"
                                    END) device_status, t1.created_at 
                        FROM 		company_device_edc t1
                        LEFT JOIN 	company_parent t2 ON t1.company_parent_id = t2.id
                        LEFT JOIN 	device_edc t3 ON t1.edc_id = t3.id
                        WHERE 		(t1.created_at <= ? OR t1.created_at between ? AND ? ) AND t1.device_status = 2
            ';

            $records     = DB::select($sql, [$start,$start,$from]);

            return DataTables::of($records)->make(true);
        }else{
            abort(404);
        }
    } 

}
