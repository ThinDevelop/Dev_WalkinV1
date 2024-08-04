<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SettingCost;
use App\Models\SettingHour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ContactTransection;
use App\Models\SettingParkingCompany;
use App\Models\SettingVechicleStampType;
use App\Models\Images;
use App\Models\VechicleCostType;
use App\Models\StampType;
use App\Models\RelStampTypeSettingHour;

use Validator;
use DataTables;
use PDO;
use DB;

class AdminParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now()->toDateString();
        $date_start = $date.' 00-00-00';
        $date_from = $date.' 23-59-59';

        $company_id = Auth::user()->company_id;

        $total_in = ContactTransection::where('company_id', $company_id)
            ->whereBetween('checkin_time',[$date_start, $date_from])
            ->count();

        $total_out = ContactTransection::where('company_id', $company_id)
            ->where('status', 1)
            ->whereBetween('checkout_time',[$date_start, $date_from])
            ->count();

        $total_not_out = ContactTransection::where('company_id', $company_id)
            ->where('status', 0)
            ->whereBetween('checkin_time',[$date_start, $date_from])
            ->count();

        $total_over = ContactTransection::where('company_id', $company_id)
            ->where('status', 0)
            ->whereBetween('checkin_time',['0000-00-00 00:00:00', $date_start])
            ->count();

        $contact = ContactTransection::where('company_id', $company_id)
            ->offset(0)
            ->limit(10)
            ->orderBy('updated_at','DESC')->get();

        foreach($contact as $k => $v){
            $image = Images::select('image_url')
                ->where('contact_id', $v->id)
                ->where('image_type_id', 4)
                ->first();

            if (!empty($image)) {
                $contact[$k]->image_url = $image->image_url;
            } else {
                $contact[$k]->image_url = '/images/default.jpg';
            }
        }

        // dd($total_out);
        return view('admin.parking.index',compact('contact','total_in','total_out','total_not_out','total_over'));
    }
    //     $this->middleware('auth');
    // }

    public function chartParkingToday(Request $request){
        $hour_start = date('Y-m-d 00:00:00');
        $hour_end = date('Y-m-d 23:59:59');
        $type = 'hour';
        $company_id = Auth::user()->company_id;

        $chart_label = [];
        $chart_data = [];

        $ContactTransections = ContactTransection::select(
                DB::raw('DATE_FORMAT(checkout_time, "%H") as contact_hour') // data ที่ได้ 24
                , DB::raw('sum(COALESCE(price_amount, 0)) as sum_price_amount') // + เงินทั้งหมด
            )
            ->where('company_id', $company_id)
            ->whereBetween('checkout_time', [ $hour_start, $hour_end ])
            ->whereNotNull('vehicel_registration')
            ->groupBy(DB::raw('DATE_FORMAT(checkout_time, "%H")'))
            ->get();

        for ($i = 0; $i < 24; $i++) {
            $ContactTransection = $ContactTransections->where('contact_hour', $i)->first();
            if ( !empty($ContactTransection) ) {
                array_push($chart_label, (int)$ContactTransection->contact_hour);
                array_push($chart_data, $ContactTransection->sum_price_amount);
            } else {
                array_push($chart_label, $i);
                array_push($chart_data, 0);
            }
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'successfully.',
            'data' => [
                'chart_label' => $chart_label,
                'chart_data' => $chart_data
            ]
        ]);
    }

    public function chartParkingMonth(Request $request){
        $date_start = date('Y-m-01 00:00:00'); // first day
        $date_from = date('Y-m-t 23:59:59'); // last day
        $date_all_month = date('t');
        // $date_start = '2023-11-13 00:00:00';
        // $date_from = '2023-11-13 23:59:59';
        $type = 'today';
        $company_id = Auth::user()->company_id;

        $chart_label = [];
        $chart_data = [];

        // แปลงเป็น laravel php
        $ContactTransections = ContactTransection::select(
                DB::raw('DATE_FORMAT(checkout_time, "%e") as contact_day') // data ที่ได้ 1 - 28 or 29 or 30 or 31 วัน
                , DB::raw('sum(COALESCE(price_amount, 0)) as sum_price_amount') // + เงินทั้งหมด
            )
            ->where('company_id', $company_id)
            ->whereBetween('checkout_time', [ $date_start, $date_from ])
            ->whereNotNull('vehicel_registration')
            ->groupBy(DB::raw('DATE_FORMAT(checkout_time, "%e")'))
            ->get();
        for ($i = 1; $i <= $date_all_month; $i++) {

            $ContactTransection = $ContactTransections->where('contact_day', $i)->first();
            if ( !empty($ContactTransection) ) {
                array_push($chart_label, (int)$ContactTransection->contact_day);
                array_push($chart_data, $ContactTransection->sum_price_amount);
            } else {
                array_push($chart_label, $i);
                array_push($chart_data, 0);
            }
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'successfully.',
            'data' => [
                'chart_label' => $chart_label,
                'chart_data' => $chart_data
            ]
        ]);
    }

    public function chartParkingYear(Request $request){

        $date_start = date('Y-01-01 00:00:00');
        $date_from = date('Y-12-31 23:59:59');
        $type = 'year';
        $company_id = Auth::user()->company_id;

        $chart_label = [];
        $chart_data = [];

        $ContactTransections = ContactTransection::select(
            DB::raw('DATE_FORMAT(checkout_time, "%c") as contact_month') // data ที่ได้ 1-12
            , DB::raw('sum(COALESCE(price_amount, 0)) as sum_price_amount') // + เงินทั้งหมด
        )
        ->where('company_id', $company_id)
        ->whereBetween('checkout_time', [ $date_start, $date_from ])
        ->whereNotNull('vehicel_registration')
        ->groupBy(DB::raw('DATE_FORMAT(checkout_time, "%c")'))
        ->get();

        for ($i = 1; $i <= 12; $i++) {

            $ContactTransection = $ContactTransections->where('contact_month', $i)->first();
            if ( !empty($ContactTransection) ) {
                array_push($chart_label, $ContactTransection->contact_month);
                array_push($chart_data, $ContactTransection->sum_price_amount);
            } else {
                array_push($chart_label, $i);
                array_push($chart_data, 0);
            }
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'successfully.',
            'data' => [
                'chart_label' => $chart_label,
                'chart_data' => $chart_data
            ]
        ]);
    }

    public function lists(Request $request)
    {
        // select a.id, a.fullname, b.name as company_name, CONCAT(a.checkin_time,' - ', a.checkout_time) AS check_in_out
        // , a.vehicel_registration
        // , c.name as payment_way , a.price_amount
        // FROM walkin_dev.contact_transection as a
        // inner join walkin_dev.company as b on a.company_id = b.id
        // inner join  walkin_dev.payment as c on a.payment_id = c.id

        $company_id = Auth::user()->company_id;

        $ContactTransections = ContactTransection::select(
                'contact_transection.id'
                , 'contact_transection.fullname'
                // , 'company.name as company_name'
                , 'contact_transection.from'
                , DB::raw('CONCAT(contact_transection.checkin_time," - ", contact_transection.checkout_time) AS check_in_out')
                , 'contact_transection.checkin_time'
                , 'contact_transection.checkout_time'
                , 'contact_transection.vehicel_registration'
                , 'payment.name as payment_way'
                , 'contact_transection.price_amount'
            )
            ->join('company', 'contact_transection.company_id', '=', 'company.id')
            ->join('payment', 'contact_transection.payment_id', '=', 'payment.id')
            ->where('company.id', $company_id)
            ->whereNotNull('vehicel_registration');

        return Datatables::of($ContactTransections)
            ->addColumn('action', function ($data) {
                // return view('admin.parking.index', compact('data'))->render();
            })
            ->editColumn('check_in_out', function ($data) {
                return '<span class="text-success">' . $data->checkin_time . '</span> - <span class="text-danger">' . $data->checkout_time . '</span>';
            })
            ->rawColumns(['action', 'check_in_out'])
            ->addIndexColumn()
            ->orderColumn('checkin_time', 'asc') // เรียงตาม checkin_time ในลำดับจากน้อยไปมาก
            ->make(true);
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

    public function create() {

        $company_id = Auth::user()->company_id;
        $company = Company::find($company_id);
        $setting_parking_company = SettingParkingCompany::select()
            ->with(['settingHours' => function($query) {
                $query->with('settingCost');
                $query->with(['RelStampTypeSettingHour']);
            }])
            ->where('company_id', $company->id)
            // ->where('status', 0)
            ->orderBy('id', 'asc')
            ->first();

        $VechicleCostTypes = VechicleCostType::select()->with('SettingVechicleStampType')->get();
        $StampTypes = StampType::select()->get();

        if (1) { // set data send
            $data = [
                'id' => $company_id,
                'vechicle_cost_types' => $VechicleCostTypes,
                'stamp_types' => $StampTypes,
                'setting_parking_company' => [
                    'setting_parking_company_id' => !empty($setting_parking_company) ? $setting_parking_company->id : "",
                    'status' => !empty($setting_parking_company) ? $setting_parking_company->status : 0,
                    'name_place' => !empty($setting_parking_company) ? $setting_parking_company->name_place : "",
                    'setting_hours' => []
                ]
            ];
            foreach ($VechicleCostTypes as $key => $VechicleCostType) {
                $data['setting_parking_company']['setting_hours'][$VechicleCostType->id] = [
                    'vechicle_cost_types_id' => $VechicleCostType->id,
                    'status' => 0,
                    'cost' => "",
                    'status_stamp' => 0,
                    'stamp_type_id' => ""
                ];
                if ($VechicleCostType->id == 2) {
                    $data['setting_parking_company']['setting_hours'][$VechicleCostType->id]['setting_cost'] = [
                        [
                            'cost' => "0",
                            'start_hour' => '00:01',
                            'end_hour' => "",
                        ],[
                            'cost' => "0",
                            'start_hour' => '',
                            'end_hour' => "",
                        ]
                    ];
                }
                if (!empty($setting_parking_company) && sizeof($setting_parking_company->settingHours) > 0) {
                    $setting_hour = $setting_parking_company->settingHours->where('vechicle_cost_types_id', $VechicleCostType->id)->first();
                    $data['setting_parking_company']['setting_hours'][$VechicleCostType->id] = [
                        'vechicle_cost_types_id' => $VechicleCostType->id,
                        'status' => $setting_hour->status,
                        'cost' => $setting_hour->cost,
                        'status_stamp' => $setting_hour->status_stamp,
                        'stamp_type_id' => !empty($setting_hour->RelStampTypeSettingHour) ? $setting_hour->RelStampTypeSettingHour->stamp_type_id : '',
                        'stamp_type_num_hour' => !empty($setting_hour->RelStampTypeSettingHour) ? $setting_hour->RelStampTypeSettingHour->num_hour : '',
                    ];
                    if ($VechicleCostType->id == 2 && sizeof($setting_hour->settingCost) > 0) {
                        $setting_costs = $setting_hour->settingCost;
                        foreach ($setting_costs as $key => $setting_cost) {
                            $data['setting_parking_company']['setting_hours'][$VechicleCostType->id]['setting_cost'][] = [
                                'cost' => $setting_cost->cost,
                                'start_hour' => $this->secondsToTime($setting_cost->start_hour),
                                'end_hour' =>$this->secondsToTime($setting_cost->end_hour)
                            ];
                        }
                    } else {
                        if ($VechicleCostType->id == 2) {
                            $data['setting_parking_company']['setting_hours'][$VechicleCostType->id]['setting_cost'] = [
                                [
                                    'cost' => "0",
                                    'start_hour' => '00:01',
                                    'end_hour' => "",
                                ],[
                                    'cost' => "0",
                                    'start_hour' => '',
                                    'end_hour' => "",
                                ]
                            ];
                        }
                    }
                }
            }
        }

        return view('admin.parking.create')->with('company', $data);
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
        // return $request->all();
        // return response()->json([
        //     'status_code' => 500,
        //     'message' => 'กำลังพัฒนา.',
        // ], 500);

        // $validator = Validator::make($request->all(), [
        //     'vechicle_cost_types_id' => 'required|string',
        //     'name_place' => 'required|string',
        //     'status' => 'required|boolean',
        //     'stamp_type' => 'required|boolean',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //          'status_code' =>422,
        //          'message' => $validator->errors(),
        //      ], 200);
        // }

        $setting_parking_company_id = $request->input('setting_parking_company_id', null);
        $setting_hours = $request->input('setting_hours', []);
        $company_id = Auth::user()->company_id;

        // $test = [];
        // foreach ($setting_hours as $key => $setting_hour) {
        //     if (!empty($setting_hour['stamp_type_num_hour'])) {
        //         $test = $setting_hour['stamp_type_num_hour'];
        //     }
        // }
        // return $test;

        if (true) { // validate
            $hasValid = false;
            $updatedInputs = [];
            $name_place_valid = "";
            $cost_valid = "";
            //Format
            $name_place_valid = $request->input('name_place', null) ? "is-valid" : "is-invalid";
            $inputs = $setting_hours[2]['setting_cost'];
            // Check name_place
            if($name_place_valid === "is-invalid"){
                $hasValid = true;
            }

            // Check cost
            if ($setting_hours[1]['status']) {
                $cost_valid =  !empty($setting_hours[1]['cost']) ? 'is-valid' : 'is-invalid';
                if ($cost_valid === "is-invalid") {
                    $hasValid = true;
                }
            }

            // Check setting cost
            if ($setting_hours[2]['status']) {
                foreach ($inputs as $key => $data) {
                    if($data['start_hour'] !== null){
                        $data['start_valid'] = 'is-valid';
                    } else {
                        $data['start_valid'] = 'is-invalid';
                        $hasValid = true;
                    }
                    if($data['end_hour'] !== null){
                        $data['end_valid'] = 'is-valid';
                    } elseif($key === array_key_last($setting_hours[2]['setting_cost'])) {
                        $data['end_valid'] = 'is-valid';
                    } else {
                        $data['end_valid'] = 'is-invalid';
                        $hasValid = true;
                    }

                    if($data['cost'] !== null){
                        $data['price_valid'] = 'is-valid';
                    } else {
                        $data['price_valid'] = 'is-invalid';
                        $hasValid = true;
                    }
                    $updatedInputs[$key] = $data;
                }
            } else {
                $updatedInputs = $inputs;
            }
        }

        if(!$hasValid){
            DB::beginTransaction();
            try {
                if ($setting_parking_company_id) {
                    SettingParkingCompany::where('id', $setting_parking_company_id)
                        ->update([
                            'name_place' => $request->input('name_place', null),
                            'status' => $request->input('status', 0)
                        ]);
                    $SettingParkingCompany = SettingParkingCompany::find($setting_parking_company_id);
                } else {
                    $SettingParkingCompany = SettingParkingCompany::create([
                        'company_id' => $company_id,
                        'name_place' => $request->input('name_place', null),
                        'status' => $request->input('status', 0)
                    ]);
                }

                foreach ($setting_hours as $key => $setting_hour) {
                    $settingHour = SettingHour::updateOrCreate(
                        [
                            'vechicle_cost_types_id' => $setting_hour['vechicle_cost_types_id'],
                            'setting_parking_company_id' => $SettingParkingCompany->id
                        ], // เงื่อนไขสำหรับค้นหาข้อมูล
                        [
                            "vechicle_cost_types_id" => $setting_hour['vechicle_cost_types_id'],
                            "status" => $setting_hour['status'],
                            "cost" => $setting_hour['cost'],
                            "status_stamp" => $setting_hour['status_stamp'],
                        ] // ข้อมูลที่ต้องการอัปเดตหรือสร้างใหม่
                    );

                    if (true) { // จัดการข้อมูล setting_cost
                        SettingCost::where('setting_hour_id', $settingHour->id)->delete(); // ล้างข้อมูล
                        if (!empty($setting_hour['setting_cost']) && sizeof($setting_hour['setting_cost']) > 0) {
                            foreach ($setting_hour['setting_cost'] as $key => $setting_cost) {
                                $start_seconds = $this->timeToSeconds($setting_cost['start_hour']);
                                $end_seconds = $this->timeToSeconds($setting_cost['end_hour']);
                                SettingCost::create([
                                    'setting_hour_id' => $settingHour->id,
                                    'start_hour' => $start_seconds,
                                    'end_hour' => $end_seconds,
                                    'cost' => $setting_cost['cost'] ? $setting_cost['cost'] : 0,
                                ]);
                            }
                        }
                    }

                    if (true) { // จัดการข้อมูล RelStampTypeSettingHour
                        if(!empty($setting_hour['stamp_type_id']) && $setting_hour['stamp_type_id'] == 1 && $setting_hour['status_stamp'] == 1){
                            RelStampTypeSettingHour::where('setting_hour_id', $settingHour->id)->delete(); // ล้างข้อมูล
                            RelStampTypeSettingHour::insert([
                                'setting_hour_id' => $settingHour->id,
                                'stamp_type_id' => $setting_hour['stamp_type_id'],
                                'num_hour' => null
                            ]);
                        }

                        if(!empty($setting_hour['stamp_type_id']) && $setting_hour['stamp_type_id'] == 2 && $setting_hour['status_stamp'] == 1){
                            RelStampTypeSettingHour::where('setting_hour_id', $settingHour->id)->delete(); // ล้างข้อมูล
                            RelStampTypeSettingHour::insert([
                                'setting_hour_id' => $settingHour->id,
                                'stamp_type_id' => $setting_hour['stamp_type_id'],
                                'num_hour' => !empty($setting_hour['stamp_type_num_hour']) ? $setting_hour['stamp_type_num_hour'] : null
                            ]);
                        }
                    }

                    if ($setting_hour['status'] == 0) {
                        if($setting_hour['vechicle_cost_types_id'] == 1){
                            if(!empty($setting_parking_company_id)) {
                                $settingHour = SettingHour::updateOrCreate(
                                    [
                                        'vechicle_cost_types_id' => $setting_hour['vechicle_cost_types_id'],
                                        'setting_parking_company_id' => $SettingParkingCompany->id
                                    ], // เงื่อนไขสำหรับค้นหาข้อมูล
                                    [
                                        "status" => 0,
                                        "cost" => null,
                                        "status_stamp" => 0,
                                    ] // ข้อมูลที่ต้องการอัปเดตหรือสร้างใหม่
                                );
                                RelStampTypeSettingHour::where('setting_hour_id', $settingHour->id)->delete();
                            }
                        }

                        if($setting_hour['vechicle_cost_types_id'] == 2){
                            $settingHour = SettingHour::updateOrCreate(
                                [
                                    'vechicle_cost_types_id' => $setting_hour['vechicle_cost_types_id'],
                                    'setting_parking_company_id' => $SettingParkingCompany->id
                                ], // เงื่อนไขสำหรับค้นหาข้อมูล
                                [
                                    "status" => 0,
                                    "cost" => null,
                                    "status_stamp" => 0,
                                ] // ข้อมูลที่ต้องการอัปเดตหรือสร้างใหม่
                            );
                            SettingCost::where('setting_hour_id', $settingHour->id)->delete(); // ล้างข้อมูล
                            RelStampTypeSettingHour::where('setting_hour_id', $settingHour->id)->delete();
                        }
                    }

                }

                DB::commit();
                return response()->json([
                    'status_code' => 200,
                    'setting_parking_company_id' => $SettingParkingCompany->id,
                    'message' => 'SettingHour updated successfully.',
                ], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status_code' => 500,
                    'line' => $e->getLine(),
                    'message' => $e->getMessage()
                ], 200);
            }
        } else {
            return response()->json([
                'status_code' => 422,
                'message' => 'update error.',
                'data' => [
                    'name_place_valid' => $name_place_valid,
                    'cost_valid' => $cost_valid,
                    'inputs' => $updatedInputs,
                ]
            ], 200);
        }
    }

    public function timeToSeconds($time_str)
    {
        if($time_str === null || $time_str === ""){
            return null;
        }

        // แยกชั่วโมงและนาทีจากข้อความ "HH:mm"
        list($hours, $minutes) = explode(':', $time_str);

        // แปลงชั่วโมงเป็นวินาที (ชั่วโมง * 3600) และนาทีเป็นวินาที (นาที * 60)
        $total_seconds = ($hours * 3600) + ($minutes * 60);

        return $total_seconds;
    }

    function secondsToTime($seconds)
    {
        if($seconds === null || $seconds === ""){
            return null;
        }

        // คำนวณชั่วโมงและนาทีจากจำนวนวินาที
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);

        // กำหนดรูปแบบของเวลาในรูปแบบ "HH:mm"
        $formattedHours = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);

        // สร้างสตริงเวลาที่แปลงแล้ว
        $timeString = $formattedHours . ':' . $formattedMinutes;

        return $timeString;
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
