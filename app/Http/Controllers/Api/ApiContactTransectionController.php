<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Blacklist;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Image;
use Auth;

use App\Models\User;
use App\Models\Company;
use App\Models\Images;
use App\Models\ImageType;
use App\Models\ContactTransection;
use App\Models\SettingHour;
use App\Models\ContractVechicle;
use App\Models\Pdpa;
use App\Models\SettingParkingCompany;
use App\Models\SettingVechicleStampType;
use App\Models\VechicleCostType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Helper;

class ApiContactTransectionController extends Controller
{

    public function Summary(Request $request){

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 422);
        }

        $company = Company::find($request->input('company_id'));
        if (empty($company)) {
            return response()->json([
                 'status_code' =>901,
                 'message' => 'company is not.',
             ], 200);
        }

        $date = Carbon::now()->toDateString();
        $date_start = $date.' 00-00-00';
        $date_from = $date.' 23-59-59';

        $total_in = ContactTransection::where('company_id', $request->company_id)
            ->whereBetween('checkin_time',[$date_start, $date_from])
            ->count();

        $total_out = ContactTransection::where('company_id', $request->company_id)
            ->where('status', 1)
            ->whereBetween('checkout_time',[$date_start, $date_from])
            ->count();

        $total_not_out = ContactTransection::where('company_id', $request->company_id)
            ->where('status', 0)
            ->whereBetween('checkin_time',[$date_start, $date_from])
            ->count();

        $total_over = ContactTransection::where('company_id', $request->company_id)
            ->where('status', 0)
            ->whereBetween('checkin_time',['0000-00-00 00:00:00', $date_start])
            ->count();

        if  (
                $company->contractVechicleActive &&
                $company->contractVechicleActive->status == 1 &&
                in_array($company->contractVechicleActive->vechicle_function_id, [1, 2])
            ) {
                $total_car_in = ContactTransection::where('company_id', $request->company_id)
                    ->where('status', 0)
                    ->where('vehicel_registration', '!=', "")
                    ->whereBetween('checkin_time', [$date_start, $date_from])
                    ->count();

                $total_car_out = ContactTransection::where('company_id', $request->company_id)
                    ->where('status', 1)
                    ->where('vehicel_registration', '!=', "")
                    ->whereBetween('checkin_time', [$date_start, $date_from])
                    ->count();
        } else {
            $total_car_in = null;
            $total_car_out = null;
        }

        $total_black_list = Blacklist::where('company_id', $request->company_id)
            ->where('status', 1)
            ->count();

        $today = Carbon::now()->format('Y-m-d');
        $total_appointment = Appointment::where('company_id', $request->company_id)
            ->whereDate('date_appointment', '>=', $today)
            ->count();

        return response()->json([
            'status_code' => 200,
            'message' => 'successfully.',
            'data' => [
                'total_in' => $total_in,
                'total_out' => $total_out,
                'total_not_out' => $total_not_out,
                'total_over' => $total_over,
                'total_car_in' => $total_car_in,
                'total_car_out' => $total_car_out,
                'total_black_list' => $total_black_list,
                'total_appointment' => $total_appointment,
            ]
        ]);

    }

    public function checkIn(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            //'from' => 'required|string',
            // 'vehicle_id' => 'required|string',
            // 'temperature' => 'required|string',
            // 'images' => 'required|json',
            //'department_id' => 'required',
            'objective_id' => 'required',
            'user_id' => 'required',
        ]);

        //เช็ค name, objective_id, user_id
        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 422);
        }

        //เช็ค User
        $user = User::find($request->input('user_id'));
        if (empty($user)) {
            return response()->json([
                 'status_code' =>903,
                 'message' => 'user is not.',
             ], 200);
        }

        //เช็ค Company
        $company = Company::find($user->company_id);
        if (empty($company)) {
            return response()->json([
                 'status_code' =>901,
                 'message' => 'company is not.',
             ], 200);
        }

        $pdpa = Pdpa::where("company_id", $company->id)
            ->first();

        //เช็ค Blacklist
        $status_blacklist = 0;
        $blacklist = Blacklist::where('company_id', $user->company_id)
            ->where('status', 1)
            ->get();

        if ($blacklist->isNotEmpty()) {

            $inputIdCard = $request->input('idcard');
            $inputName = $request->input('name');
            $inputName = preg_replace('/^(นาย|นาง|นางสาว|น.ส.|ด.ช.|เด็กชาย|ด.ญ.|เด็กหญิง|คุณ|ม.ล.|ม.ร.ว.|ม.จ.|ศ.ดร.|ผศ.ดร.|รศ.ดร.|ดร.|ศ.|ผศ.|รศ.|พล.อ.|พล.ท.|พล.ต.|พล.อ.ต.|พล.อ.ท.|พล.อ.อ.|พล.ร.อ.|พล.ร.ท.|พล.ร.ต.|น.อ.|น.ท.|น.ต.|น.อ.|น.ท.|น.ต.|ร.ต.ท.|ร.ต.อ.|พ.ต.ท.|พ.ต.อ.|Mr.|Mrs.|Ms.|Miss|Dr.|Prof.|Asst. Prof.|Assoc. Prof.|Col.|Lt. Col.|Maj.|Gen.|Lt. Gen.|Maj. Gen.|Capt.|Cmdr.|Adm.|Lt. Cmdr.|Lt.|Cpl.|Sgt.|Ens.)\s*/', '', $inputName);
            
            foreach ($blacklist as $item) {
                $fullNameBlacklist = preg_replace('/^(นาย|นาง|นางสาว|น.ส.|ด.ช.|เด็กชาย|ด.ญ.|เด็กหญิง|คุณ|ม.ล.|ม.ร.ว.|ม.จ.|ศ.ดร.|ผศ.ดร.|รศ.ดร.|ดร.|ศ.|ผศ.|รศ.|พล.อ.|พล.ท.|พล.ต.|พล.อ.ต.|พล.อ.ท.|พล.อ.อ.|พล.ร.อ.|พล.ร.ท.|พล.ร.ต.|น.อ.|น.ท.|น.ต.|น.อ.|น.ท.|น.ต.|ร.ต.ท.|ร.ต.อ.|พ.ต.ท.|พ.ต.อ.|Mr.|Mrs.|Ms.|Miss|Dr.|Prof.|Asst. Prof.|Assoc. Prof.|Col.|Lt. Col.|Maj.|Gen.|Lt. Gen.|Maj. Gen.|Capt.|Cmdr.|Adm.|Lt. Cmdr.|Lt.|Cpl.|Sgt.|Ens.)\s*/', '', $item->fullname);
                if (!empty($item->idcard) && $item->idcard === $inputIdCard && $status_blacklist == 0) {
                    $status_blacklist = 1;
                    if (!empty($company->line_token)) {
                        $this->LineNotify($item, $company->line_token);
                    }
                } elseif (!empty($fullNameBlacklist) && $fullNameBlacklist === $inputName && $status_blacklist == 0) {
                    $status_blacklist = 1;
                    if (!empty($company->line_token)) {
                        $this->LineNotify($item, $company->line_token);
                    }
                }
            }

        }

        \DB::beginTransaction();
        try {
            if($status_blacklist == 0){
                $birth_date = NULL;
                $year = substr(date("Y"),2,2);
    
                $num = rand(1000,9999);
                $code = $year.date("md").str_shuffle(date('His')).$num;
    
                $show_idcard = '-----';
                $idcard = $request->idcard;

                if (mb_strlen($idcard) == 13 && ctype_digit($idcard)) {
                    $show_idcard = substr($idcard, 0, 2) . 'XXXXXXXX' . substr($idcard, -3);
                } else {
                    $idcard = $show_idcard;
                }

                $contact = ContactTransection::create([
                    'company_id' => $company->id,
                    'department_id' => (isset($request->department_id))? $request->department_id : NULL,
                    'objective_id' => (isset($request->objective_id))? $request->objective_id : NULL,
                    'from' => (isset($request->from))? $request->from : NULL,
                    'user_id' => $user->id,
                    'contact_code' => $code,
                    'idcard' => $idcard,
                    'fullname' => $request->input('name'),
                    'gender' => (!empty($request->gender))? $request->gender : NULL,
                    'objective_note' => (!empty($request->objective_note))? $request->objective_note : NULL,
                    'person_contact' => (!empty($request->person_contact))? $request->person_contact : NULL,
                    'birth_date' => $birth_date,
                    'address' => (!empty($request->address))? $request->address : NULL,
                    'vehicel_registration' => (isset($request->vehicel_registration))? $request->vehicel_registration : '',
                    'temperature' => (isset($request->temperature))? $request->temperature : '',
                    'checkin_time' => Carbon::now()->toDateTimeString(),
                    'pdpa_id' => !empty($pdpa) ? $pdpa->id : null,
                    'status_pdpa_id' => !empty($pdpa) ? 1 : null,
                    'status' => 0,
                    'appointment_id' => $request->appointment_id != -1 ? $request->appointment_id : null,
                ]);
                
                $images = json_decode($request->input('images'), true); // เพิ่ม 'true' เพื่อแปลง JSON เป็น associative array
                if (is_array($images)) {
                    foreach ($images as $k => $v) {
                        $this->saveImage($company->mid, $contact->id, $v['file'], $v['type']);
                    }
                }
    
                \DB::commit();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Check In successfully.',
                    'data' => [
                        'contact_code' => $contact->contact_code,
                        'idcard' => $show_idcard,
                        'fullname' => $contact->fullname,
                        'vehicel_registration' => (!empty($contact->vehicel_registration)) ? $contact->vehicel_registration: '',
                        'temperature' => $contact->temperature,
                        'from' => (!empty($contact->from)) ? $contact->from: '',
                        'department' => (!empty($contact->department_id)) ? $contact->getDepartment->name: '',
                        'objective_type' => (!empty($contact->objective_id)) ? $contact->getObjective->name: '',
                        'objective_note' => (!empty($contact->objective_note)) ? $contact->objective_note: '',
                        'person_contact' => (!empty($contact->person_contact)) ? $contact->person_contact: '',
                        'chcekin_time' => $contact->checkin_time,
                        'status_blacklist' => $status_blacklist, //0 ไม่มีแบล็กลิสต์ 1 มีแบล็กลิสต์
                        'appointment_id' => $contact->appointment_id,
                    ]
                ], 200);
            } else {
                \DB::commit();
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Blacklist successfully.',
                    'data' => [
                        'status_blacklist'=>$status_blacklist, //0 ไม่มีแบล็กลิสต์ 1 มีแบล็กลิสต์
                    ]
                ], 200);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage(),
            ], 200);
        }

    }

    function LineNotify($blacklist, $line_token){
        // ทำการส่งไฟล์ที่เปลี่ยนสิทธิ์แล้วไปยัง API โดยใช้ GuzzleHttp
        $client = new Client();
        $url = 'https://notify-api.line.me/api/notify';
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $line_token,
            'Content-Type' => 'application/x-www-form-urlencoded',
            // 'Content-Type' => 'multipart/form-data',
        ];
        $data = [
            'message' => "ชื่อ-นามสกุล: $blacklist->fullname\nสาเหตุ: $blacklist->note\nบุคคลนี้พยายามเข้าสถานที่ โปรดระมัดระวัง",
        ];
        // $data = [
        //     [
        //         'name' => 'message',
        //         'contents' => "ชื่อ-นามสกุล: นายเอ บี\nสาเหตุ: ขโมยของ\nบุคคลนี้พยายามเข้าสถานที่ โปรดระมัดระวัง",
        //     ],
        //     [
        //         'name' => 'imageFile',
        //         // 'contents' => fopen($imagePath, 'r'),
        //         'contents' => Psr7\Utils::tryFopen($imagePath, 'r'),
        //     ],
        // ];

        try {

            $response = $client->post($url, [
                'headers' => $headers,
                'form_params' => $data,
                // 'multipart' => $data,
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            return response()->json([
                'status_code' => $statusCode,
                'error' => $responseBody,
            ], 200);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $responseBody = $e->getResponse()->getBody()->getContents();

                return response()->json([
                    'status_code' => $statusCode,
                    'error' => $responseBody,
                ], 200);
            } else {
                return response()->json([
                    'status_code' => 500,
                    'error' => 'Internal Server Error',
                ], 200);
            }
        }
    }

    public function saveImage($mid, $contact_id,$file, $type){

        if(!empty($file)){
            $uuid = uniqid();
            $image_extention = 'jpg';
            $image_name = $uuid.'.'.$image_extention;
            $image_resize = Image::make(base64_decode($file));

            $image_resize->resize(540, 540, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($image_extention)->save("company/".$mid."/".$image_name);
            $res_image = "company/".$mid."/".$image_name;

            Images::create([
                'contact_id' => $contact_id,
                'image_type_id' => $type,
                'image_url' => $res_image
            ]);
        }

    }

    public function checkOut(Request $request){
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|string',
            'contact_code' => 'required|string',
            'payment_id' => 'nullable|string',
            'price' => 'nullable|numeric',
            'price_amount' => 'nullable|numeric',
            'price_discount' => 'nullable|numeric',
            'vechicle_cost_type_id' => 'nullable',
            'stamp' => 'nullable | string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 422);
        }

        $company = Company::find($request->company_id);
        if (empty($company)) {
            return response()->json([
                 'status_code' =>901,
                 'message' => 'company is not.',
             ], 200);
        }

        $contact = ContactTransection::where('contact_code', $request->contact_code)
            ->where('company_id', $request->company_id)
            ->first();
        if(empty($contact)) {
            return response()->json([
                 'status_code' =>904,
                 'message' => 'contact transection is not.',
             ], 200);
        }

        if($contact->status == 1){
            return response()->json([
                'status_code' =>905,
                'message' => 'contact transection checked out.',
            ], 200);
        }

        if(isset($request->image) && !empty($request->image)){
            //upload image
            $uuid = uniqid();
            $image_extention = 'jpg';
            $image_name = $uuid.'.'.$image_extention;
            $image_resize = Image::make(base64_decode($request->image));

            $image_resize->resize(540, 540, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($image_extention)->save("company/".$company->mid."/".$image_name);
            $res_image = "company/".$company->mid."/".$image_name;


            if (!empty($request->image_type_id))
            {
                Images::create([
                    'contact_id' => $contact->id,
                    'image_type_id' => 6,
                    'image_url' => $res_image
                ]);
            }
            else{
                Images::create([
                    'contact_id' => $contact->id,
                    'image_type_id' => 5,
                    'image_url' => $res_image
                ]);
            }
        }

        $check_out = Carbon::now()->toDateTimeString();
        $payment_id = $request->input('payment_id', null);
        $price = $request->input('price', null);
        $price_amount = $request->input('price_amount', null);
        $price_discount = $request->input('price_discount', null);
        $vechicle_cost_type_id = $request->input('vechicle_cost_type_id', null);
        $stamp = $request->input('stamp', 0);
        $stamp_type_id = NULL;
        $VechicleCostType = NULL;
        if ($vechicle_cost_type_id && $stamp == 1) { // ถ้าไม่เลือกอะไรมาเลย ไม่ต้อง query
            $VechicleCostType = VechicleCostType::find($vechicle_cost_type_id);
            $SettingParkingCompany = SettingParkingCompany::with(['settingHour' => function($query) use ($vechicle_cost_type_id){
                    $query->where('vechicle_cost_types_id', $vechicle_cost_type_id);
                    $query->with(["RelStampTypeSettingHour"]);
                }])
                ->first();
            if (!empty($SettingParkingCompany->settingHour)) {
                if (!empty($SettingParkingCompany->settingHour->RelStampTypeSettingHour)) {
                    $stamp_type_id = $SettingParkingCompany->settingHour->RelStampTypeSettingHour->stamp_type_id;
                }
            }
        }

        $contact->update([
            'status' => 1,
            'checkout_time' => $check_out,
            'payment_id' => $payment_id,
            'price' => $price,
            'price_amount' => $price_amount,
            'price_discount' => $price_discount,
            'vechicle_cost_types_id' => $vechicle_cost_type_id,
            'stamp_type_id' => $stamp_type_id,
        ]);


        if($contact->status == 1){
            $show_time = Helper::dateDiff($contact->checkin_time, $check_out);
        }else{
            $show_time = '';
        }

        $show_idcard = '';
        if(isset($company->contactTransection->idcard)){
            $length = mb_strlen($company->contactTransection->idcard);
            if ($length == 13) {
                $show_idcard = substr($company->contactTransection->idcard, 0 ,2);
                $show_idcard .= 'XXXXXXXX';
                $show_idcard .= substr($company->contactTransection->idcard, -3);
            }
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Check Out successfully.',
            'data' => [
                'contact_code' => $contact->contact_code,
                'checkout_time'=>$contact->checkout_time,
                'show_time' => $show_time,
                'department_id' => $contact->department_id,
                'objective_id' => $contact->objective_id,
                'from' => (isset($contact->from))? $contact->from : '',
                'idcard' =>$show_idcard,
                'fullname' => $contact->fullname,
                'gender' => $contact->gender,
                'objective_note' => $contact->objective_note,
                'person_contact' => $contact->person_contact,
                'birth_date' => $contact->birth_date,
                'address' => $contact->address,
                'vechicle_cost_type' => (isset($VechicleCostType)) ? $VechicleCostType->name : '',
                'vehicel_registration' => (isset($contact->vehicel_registration))? $contact->vehicel_registration : '',
                'temperature' => $contact->temperature,
                'checkin_time' => $contact->checkin_time,
                'status' => 1,
            ]
        ], 200);
    }

    public function SearchOrder(Request $request){

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|string',
            //'contact_code' => 'required_if:appointment_code,"",appointment_code,"null"|string',
            //'appointment_code' => 'required_if:contact_code,"",contact_code,"null"|string',
            'contact_code' => 'required|string',
            'vechicle_cost_type_id' => 'nullable',
            'stamp' => 'nullable | string',
            // 'appointment_fname' => 'nullable|string',
            // 'appointment_lname' => 'nullable|string',
            'type_scan_qr' => 'nullable | integer | in:1,2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' =>422,
                'message' => $validator->errors(),
            ], 422);
        }
        // Company
        $companyQuery = Company::with(['contractVechicleActive']);

        if ($request->input('vechicle_cost_type_id', NULL)) { // ถ้าไม่เลือกอะไรมาเลย ไม่ต้อง query
            $companyQuery->with([
                    'settingParkingCompany.settingHour' => function($query) use ($request){
                        $query->where('vechicle_cost_types_id', $request->input('vechicle_cost_type_id', NULL));
                        $query->with([
                                "vechicleCostType", "settingCost",
                                "RelStampTypeSettingHour"
                        ]);
                    }
                ]);
        }

        // vechicle_cost_type_id
        // Contact
        if ($request->contact_code) {
            $companyQuery->with([
                'contactTransection' => function ($query) use ($request) {
                    $query->where('contact_code', $request->contact_code)
                        ->with(['imageTransections' => function ($query) {
                            $query->orderBy('image_type_id', 'asc')
                                ->with('imageType');
                        }]);
                },
            ]);
        }

        // Appoint
        if ($request->appointment_code) {
            $companyQuery->with([
                'appointment' => function ($query) use ($request) {
                    $query->where('appointment_code', $request->appointment_code)
                        ->with('pdpa')
                        ->with('pdpaStatus');
                },
            ]);
        }

        $company = $companyQuery->find($request->company_id);

        if (empty($company) || empty($company->contactTransection) || (empty($request->contact_code) && empty($request->appointment_code))) {
            return response()->json([
                'status_code' => 904,
                'message' => 'Incomplete information, please contact staff.',
            ], 200);
        }

        if ($company->status != 1) {
            return response()->json([
                'status_code' =>904,
                'message' => 'This contact code has been checked out.',
            ], 200);
        }

        $contract_vechicle = false; // true มีฟังชั่น false ไม่มีฟังชั่น
        if (!empty($company->contractVechicleActive)) {
            if ($company->contractVechicleActive->vechicle_function_id == 1) {
                $contract_vechicle = true;
            } elseif ($company->contractVechicleActive->vechicle_function_id == 2) {
                $currentDate = Carbon::parse(Carbon::now()->format('Y-m-d'));
                $startDate = Carbon::parse($company->contractVechicleActive->start_date);
                $endDate = Carbon::parse($company->contractVechicleActive->end_date);

                if (!$currentDate->between($startDate, $endDate)) {
                    return response()->json([
                        'status_code' => 904,
                        'message' => 'The parking fee function has expired. Please contact the staff.',
                    ], 200);
                }
                $contract_vechicle = true;
            } else {
                $contract_vechicle = false;
            }
        } else {
            $contract_vechicle = false;
        }

        $images = [];

        if ($contract_vechicle == true) {
            $image_data_default = ImageType::all();
        } else {
            $image_data_default = ImageType::whereBetween('id', [1, 5])->get();
        }

        foreach ($image_data_default as $data) {
            $image_data = $company->contactTransection->imageTransections->where('image_type_id', $data->id)->first();
            $image_url = !empty($image_data->image_url) ? url()->previous() . '/' . $image_data->image_url : '';
            $images[] = [
                'type' => $data->id,
                'type_name' => $data->name,
                'url' => $image_url
            ];
        }

        $show_idcard = '';
        if(isset($company->contactTransection->idcard)){
            $length = mb_strlen($company->contactTransection->idcard);
            if ($length == 13) {
                $show_idcard = substr($company->contactTransection->idcard, 0 ,2);
                $show_idcard .= 'XXXXXXXX';
                $show_idcard .= substr($company->contactTransection->idcard, -3);
            }
        }

        // 1 Contact 2 Appointment other Normal
        if ($request->type_scan_qr == 1) {
            return $this->SearchOrderVechicle($company, $request, $images, $show_idcard);
        } elseif($request->type_scan_qr == 2){
            return $this->SearchOrderAppointment($request);
        } else {
            return $this->SearchOrderNormal($company, $images, $show_idcard);
        }

    }

    function qrCodePromtPay($MobileorIDcard, $price) {

        $price_len = str_pad(strlen($price), 2, "0", STR_PAD_LEFT);

        if (strlen($MobileorIDcard) == 10) {
            $formatMobile = substr($MobileorIDcard, 1);
            $data = "00020101021229370016A00000067701011101130066".$formatMobile."5802TH530376454".$price_len.$price."6304";
        } elseif (strlen($MobileorIDcard) == 13) {
            $data = "00020101021229370016A0000006770101110113".$MobileorIDcard."5802TH530376454".$price_len.$price."6304";
        } else {
            return null;
        }

        $polynomial = 0x1021;
        $crc = 0xFFFF;

        for ($i = 0; $i < strlen($data); $i++) {
            $crc ^= (ord($data[$i]) << 8) & 0xFFFF;

            for ($j = 0; $j < 8; $j++) {
                if ($crc & 0x8000) {
                    $crc = (($crc << 1) ^ $polynomial) & 0xFFFF;
                } else {
                    $crc = ($crc << 1) & 0xFFFF;
                }
            }
        }

        $checksum_hex = strtoupper(dechex($crc));
        $checksum_hex = str_pad($checksum_hex, 4, "0", STR_PAD_LEFT);

        $qr_code_promtpay = $data.$checksum_hex;

        return $qr_code_promtpay;
    }

    private function SearchOrderNormal($company, $images, $show_idcard) {

        $contact = $company->contactTransection;

        return response()->json([
            'status_code' => 200,
            'message' => 'Search successfully.',
            'data' => [
                'contact_code' => $contact->contact_code,
                'name' => $contact->fullname,
                'idcard' => $show_idcard,
                'vehicel_registration' => (isset($contact->vehicel_registration)) ? $contact->vehicel_registration: '',
                'from' => (isset($contact->from))? $contact->from : '',
                'temperature' => $contact->temperature,
                'department' => (isset($contact->department_id)) ? $contact->getDepartment->name: '',
                'objective_type' => (isset($contact->objective_id)) ? $contact->getObjective->name: '',
                'objective_note' => (isset($contact->objective_note)) ? $contact->objective_note: '',
                'person_contact' => (isset($contact->person_contact)) ? $contact->person_contact: '',
                'checkin_time' => $contact->checkin_time,
                'checkout_time' => ($contact->status == 1)? $contact->checkout_time : '',
                'status' => $contact->status,
                'stauts_name'=> ($contact->status == 1)? 'out' : 'in',
                'images' => $images,
                'appointment_id' => $contact->appointment_id
            ]
        ], 200);
    }

    private function SearchOrderVechicle($company, $request, $images, $show_idcard) {

        $contact = $company->contactTransection;

        //Set Response
        $qr_pay = "";
        $total_price = 0;
        $price_pay = 0;
        $discount_price = 0;

        //Check Prompt Pay
        $promptpay = $company->promptpay;
        if(empty($promptpay)) {
            return response()->json([
                'status_code' =>904,
                'message' => 'Prompt Pay transection is not.',
            ], 200);
        }

        //Check setting parking company
        $setting_parking_company = $company->settingParkingCompany;
        if(empty($setting_parking_company) || $setting_parking_company->status == 0) {
            return response()->json([
                'status_code' =>904,
                'message' => 'setting parking company transection is not.',
            ], 200);
        }

        //Check checkin Time
        if(empty($contact->checkin_time)) {
            return response()->json([
                'status_code' =>904,
                'message' => 'checkin Time transection is not.',
            ], 200);
        }
        //Diff Time Convert Second
        $date_and_time = Helper::DateAndSecond($contact->checkin_time);
        $range_time = $date_and_time->diff;
        $range_time_text = Helper::SecondToTime($contact->checkin_time);
        $checkout_time = $date_and_time->current;

        //Check Vechicle Cost Type
        $vechicle_cost_type = NULL;
        $setting_hour = NULL;
        if (!empty($setting_parking_company->settingHour)) {
            $setting_hour = $setting_parking_company->settingHour;
            $vechicle_cost_type = $setting_parking_company->settingHour->vechicleCostType;
        }

        if(empty($vechicle_cost_type)) {
            return response()->json([
                'status_code' =>904,
                'message' => 'Vechicle Cost Type transection is not.',
            ], 200);
        }

        //Type Day
        if($vechicle_cost_type->id == 1){

            //price
            $price_to_time = $setting_hour->cost;

            //Calculate price
            $total_days = floor($range_time / (60 * 60 * 24));
            $total_price = ($total_days + 1) * $price_to_time;

            //Use Stamp
            if($request->stamp == 1){

                //Check Status Stamp
                if ($setting_hour->status_stamp == 0 && empty($setting_hour->RelStampTypeSettingHour)) {
                    return response()->json([
                        'status_code' => 904,
                        'message' => 'stamp Type transection is not.',
                    ], 200);
                }

                $qr_pay = "Free";
                $price_pay = 0;
                $discount_price = $total_price;

            }

            //Not Stamp
            else {
                $price_pay = $total_price;
                $discount_price = 0;
                $qr_pay = $total_price <= 0 ? "Free" : $this->qrCodePromtPay($promptpay, $price_pay);
            }

        }

        //Type Hour
        elseif($vechicle_cost_type->id == 2){

            //Check Setting Cost
            $setting_costs =  $setting_hour->settingCost;
            if(empty($setting_costs)){
                return response()->json([
                    'status_code' =>904,
                    'message' => 'setting Cost transection is not.',
                ], 200);
            }
            $RelStampTypeSettingHour = NULL;
            if (!empty($setting_hour->RelStampTypeSettingHour)) {
                $RelStampTypeSettingHour = $setting_hour->RelStampTypeSettingHour;
            }
            //Time Stamp
            $range_time_stamp = $range_time - (!empty($RelStampTypeSettingHour->num_hour) ? $RelStampTypeSettingHour->num_hour : 0);
            //Calculate price
            foreach ($setting_costs as $key => $setting_cost) {
                $start = $setting_cost->start_hour;
                $end = $setting_cost->end_hour;
                $price_to_time = $setting_cost->cost;

                //Check Start
                if (is_null($start)) {
                    return response()->json([
                        'status_code' => 904,
                        'message' => 'setting Cost transection is not.',
                    ], 200);
                }

                if (!is_null($end)) {

                    if (($start - 60) <= $range_time && $range_time <= $end) {
                        $total_price += $price_to_time;
                    } elseif ($end <= $range_time) {
                        $total_price += $price_to_time;
                    }
                    if (($start - 60) <= $range_time_stamp && $range_time_stamp <= $end) {
                        $price_pay += $price_to_time;
                    } elseif ($end <= $range_time_stamp) {
                        $price_pay += $price_to_time;
                    }
                } else {

                    if ($start <= $range_time) {
                        $time_calculate = $range_time - ($start - 60);
                        for ($i = 1; $i <= $time_calculate; $i += 3600) {
                            $total_price += $price_to_time;
                        }
                    }

                    if ($start <= $range_time_stamp) {
                        $time_calculate = $range_time_stamp - ($start - 60);
                        for ($i = 1; $i <= $time_calculate; $i += 3600) {
                            $price_pay += $price_to_time;
                        }
                    }
                }

            }

            //Use Stamp
            if ($request->stamp == 1) {

                //Check Status Stamp
                if ($setting_hour->status_stamp == 0) {
                    return response()->json([
                        'status_code' => 904,
                        'message' => 'stamp Type transection is not.',
                    ], 200);
                }

                //Stamp All
                if ($RelStampTypeSettingHour->stamp_type_id == 1) {
                    $price_pay = 0;
                    $discount_price = $total_price;
                    $qr_pay = "Free";
                }

                //Stamp Hour
                elseif ($RelStampTypeSettingHour->stamp_type_id == 2) {

                    //Check Time Stamp
                    if (empty($RelStampTypeSettingHour->num_hour)) {
                        return response()->json([
                            'status_code' => 904,
                            'message' => 'num Hour transection is not.',
                        ], 200);
                    }

                    $discount_price = $total_price - $price_pay;
                    $qr_pay = $this->qrCodePromtPay($promptpay, $price_pay);
                }

            }

            //Not Stamp
            else {
                $discount_price = 0;
                $price_pay = $total_price;
                $qr_pay = $this->qrCodePromtPay($promptpay, $price_pay);
            }
        }

        //Check Response
        return response()->json([
            'status_code' => 200,
            'message' => 'Search successfully.',
            'data' => [
                'contact_code' => $contact->contact_code,
                'name' => $contact->fullname,
                'idcard' => $show_idcard,
                'vehicel_registration' => (isset($contact->vehicel_registration)) ? $contact->vehicel_registration: '',
                'from' => (isset($contact->from))? $contact->from : '',
                'vechicle_cost_type' => (isset($setting_hour)) ? $setting_hour->vechicleCostType->name : '',
                'department' => (isset($contact->department_id)) ? $contact->getDepartment->name: '',
                'objective_type' => (isset($contact->objective_id)) ? $contact->getObjective->name: '',
                'objective_note' => (isset($contact->objective_note)) ? $contact->objective_note: '',
                'person_contact' => (isset($contact->person_contact)) ? $contact->person_contact: '',
                'checkin_time' => $contact->checkin_time,
                'checkout_time' => ($contact->status == 1)? $contact->checkout_time : $checkout_time,
                'status' => $contact->status,
                'stauts_name'=> ($contact->status == 1)? 'out' : 'in',
                'qr_pay' => $qr_pay,
                'total_price' => (isset($total_price)) ? $total_price : '',
                'price_pay' => (isset($price_pay)) ? $price_pay : '',
                'discount_price' => (isset($discount_price)) ? $discount_price : '',
                'range_time_text' => (isset($range_time_text)) ? $range_time_text : '',
                'images' => $images,
                'appointment_id' => $contact->appointment_id
            ]
        ], 200);

    }

    private function SearchOrderAppointment($request) {

        //Check Appointment
        $appointment = Appointment::where('appointment_code', $request->appointment_code )
            ->where('company_id', $request->company_id)
            ->first();
        if(empty($appointment)) {
            return response()->json([
                'status_code' =>904,
                'message' => 'appointment transection is not.',
            ], 200);
        }

        //Check Response
        return response()->json([
            'status_code' => 200,
            'message' => 'Search successfully.',
            'data' => [
                'phone' => (isset($appointment->phone)) ? $appointment->phone: '',
                'email' => (isset($appointment->email)) ? $appointment->email: '',
                'date_appointment' => (isset($appointment->date_appointment)) ? $appointment->date_appointment: '',
            ]
        ], 200);

    }

    public function ListByType(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required|numeric',
            'company_id' => 'required',
            'limit' => 'required|numeric',
            'offset' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 422);
        }

        $company = Company::find($request->company_id);

        if (empty($company)) {
            return response()->json([
                 'status_code' =>901,
                 'message' => 'company is not.',
             ], 200);
        }

        $where_status = array();

        $date = Carbon::now()->toDateString();
        $date_start = $date.' 00:00:00';
        $date_from = $date.' 23:59:59';

        if (0) {
            // $contact = ContactTransection::where('company_id', $request->company_id);
            // if($request->type == 1){
            //     $contact->whereBetween('checkin_time',[$date_start, $date_from]);
            // }else if($request->type == 2){
            //     $contact->where('status', 1);
            //     $contact->whereBetween('checkout_time',[$date_start, $date_from]);
            // }else if($request->type == 3){
            //     $contact->where('status', 0);
            //     $contact->whereBetween('checkin_time',[$date_start, $date_from]);
            // }else if($request->type == 4){
            //     $date_start = '0000-00-00 00:00:00';
            //     $date_from = $date.' 00:00:00';
            //     $contact->where('status', 0);
            //     $contact->whereBetween('checkin_time',[$date_start, $date_from]);
            // }else if($request->type == 5){

            // }else if($request->type == 6){

            // }
            // else if($request->type == 7){
            //     $contact->where('status', 0);
            //     $contact->whereIn('stamp_discount_id', [1,2]);
            //     $contact->whereIn('stamp_discount_id', [1,2]);
            //     $contact->whereIn('stamp_discount_id', [1,2]);
            //     $contact->whereIn('stamp_discount_id', [1,2]);
            //     $contact->whereIn('stamp_discount_id', [1,2]);
            //     $contact->whereIn('stamp_discount_id', [1,2]);
            // }
            // else if($request->type == 8){

            // }else{
            //     return response()->json([
            //         'status_code' => 906,
            //         'message' => 'type contact transection is not.',
            //     ], 200);
            // }
            // $contact = $contact->orderBy('checkin_time', 'DESC')
            //     ->offset($request->offset)
            //     ->limit($request->limit)
            //     ->get();
        }

        if (1) {
            if($request->type == 1){
            }else if($request->type == 2){
                $where_status = array('status' => 1);
            }else if($request->type == 3){
                $where_status = array('status' => 0);
            }else if($request->type == 4){
                $where_status = array('status' => 0);
                $date_start = '0000-00-00 00:00:00';
                $date_from = $date.' 00-00-00';
            }else if($request->type == 5){

            }else if($request->type == 6){

            }
            else if($request->type == 7){
                $where_status = array('contact_transection.status' => 0);
            }
            else if($request->type == 8){
                $where_status = array('contact_transection.status' => 1);
            }else{
                return response()->json([
                    'status_code' =>906,
                    'message' => 'type contact transection is not.',
                ], 200);
            }

            if ($request->type == 2) {
                $contact = ContactTransection::where('company_id', $request->company_id)
                    ->with(['getDepartment', 'getObjective', 'imageTransections'])
                    ->where($where_status)
                    ->whereBetween('checkout_time', [$date_start, $date_from])
                    ->orderBy('checkin_time', 'DESC')
                    ->offset($request->offset)
                    ->limit($request->limit)
                    ->get();
            } else if ($request->type == 1 || $request->type == 3 || $request->type == 4) {
                $contact = ContactTransection::where('company_id', $request->company_id)
                    ->with(['getDepartment', 'getObjective', 'imageTransections'])
                    ->where($where_status)
                    ->whereBetween('checkin_time', [$date_start, $date_from])
                    ->orderBy('checkin_time', 'DESC')
                    ->offset($request->offset)
                    ->limit($request->limit)
                    ->get();
            } else if ($request->type == 5) {
                $today = Carbon::now()->format('Y-m-d');
                $appointment = Appointment::where("company_id", $request->company_id)
                    ->with(['department', 'objectiveType'])
                    ->whereDate('date_appointment', '>=', $today)
                    ->orderBy('date_appointment','DESC')
                    ->get();

                    $data = [];
                    foreach ($appointment as $k => $v) {
                        $start_time = sprintf("%02d:%02d", floor($v->start_time / 3600), ($v->start_time % 3600) / 60);
                        $end_time = sprintf("%02d:%02d", floor($v->end_time / 3600), ($v->end_time % 3600) / 60);
                        
                        $data[$k]['id'] = $v->id;
                        $data[$k]['fullname'] = $v->name .' ' . $v->lastname;
                        $data[$k]['department'] = $v->department->name ?? '';
                        $data[$k]['objective'] = $v->objectiveType->name ?? '';
                        $data[$k]['date'] = $v->date_appointment.' '.$start_time.' - '.$end_time;
                    }

                    return response()->json([
                        'status_code' => 200,
                        'message' => 'ListByType successfully.',
                        'data' => $data,
                    ], 200);
            } else if ($request->type == 6) {
                $blacklist = Blacklist::where("company_id", $request->company_id)
                    ->where("status", 1)
                    ->with(['contactTransection.imageTransections', 'imageBlacklist'])
                    ->orderBy('updated_at','DESC')
                    ->get();
                
                $data = [];
                foreach ($blacklist as $k => $v) {
                    $data[$k]['id'] = $v->id;
                    $data[$k]['fullname'] = $v->fullname;
                    $data[$k]['from'] = $v->from;
                    $data[$k]['note'] = $v->note;
                    $data[$k]['created_at'] = $v->created_at->format('Y-m-d H:i:s');
                    $data[$k]['updated_at'] = $v->updated_at->format('Y-m-d H:i:s');
                    if (!empty($v->contact_transaction_id)) {
                        $found = false;
                        foreach ($v->contactTransection->imageTransections as $k2 => $v2) {
                            if ($v2->image_type_id === 4) {
                                $found = true;
                                $fullLogoUrl = public_path($v2->image_url);
                                if (file_exists($fullLogoUrl)) {
                                    $data[$k]['image_url'] = url()->previous().'/'.$v2->image_url;
                                } else {
                                    $data[$k]['image_url'] = "";
                                }
                            }
                        }
                        
                        if ($found == false) {
                            $data[$k]['image_url'] = "";
                        }
                    } else if (!empty($v->image_blacklist_id)) {
                        $fullLogoUrl = public_path($v->imageBlacklist->image_url);
                        if (file_exists($fullLogoUrl)) {
                            $data[$k]['image_url'] = url()->previous().'/'.$v->imageBlacklist->image_url;
                        } else {
                            $data[$k]['image_url'] = "";
                        }
                    } else {
                        $data[$k]['image_url'] = "";
                    }
                }

                return response()->json([
                    'status_code' => 200,
                    'message' => 'ListByType successfully.',
                    'data' => $data,
                ], 200);
                
            } else if ($request->type == 7) { // รถเข้า
                if ($company->contractVechicleActive->status == 1 && in_array($company->contractVechicleActive->vechicle_function_id, [1, 2])) {
                    $contact = ContactTransection::select('contact_transection.*')
                        ->join('company', 'company.id', '=', 'contact_transection.company_id')
                        ->join('setting_parking_company', 'company.id', '=', 'setting_parking_company.company_id')
                        ->where($where_status)
                        ->where('contact_transection.vehicel_registration', '!=', '')
                        ->where('contact_transection.company_id', $request->company_id)
                        ->where('setting_parking_company.status', 1) // เช็คสถานะ setting_parking_company
                        ->whereBetween('contact_transection.checkin_time', [$date_start, $date_from])
                        ->orderBy('contact_transection.checkin_time', 'DESC')
                        ->offset($request->offset)
                        ->limit($request->limit)
                        ->get();
                }else{
                    $contact = [];
                }
                // เงื่อนไข
                //     ซื้อไหม + หมดอายุ
                //     เช็คสถานะ setting_parking_company
                //$contact = ContactTransection::select('contact_transection.*', 'setting_hour.id as setting_hour_id')
                // $contact = ContactTransection::select('contact_transection.*')
                //     ->join('company', 'company.id', '=', 'contact_transection.company_id')
                //     ->join('setting_parking_company', 'company.id', '=', 'setting_parking_company.company_id')
                //     ->join('contract_vechicle', 'company.id', '=', 'contract_vechicle.company_id')
                //     ->with(['getDepartment', 'getObjective', 'imageTransections'])
                //     ->where($where_status)
                //     ->where(function ($where) use ($date){ // ซื้อไหม + หมดอายุ
                //         $where->where(function ($where1) use ($date) {
                //             $where1->where(function ($where2) use ($date) {
                //                 $where2->where('contract_vechicle.vechicle_function_id', 2);
                //                 $where2->where('contract_vechicle.end_date', '>=', $date);
                //                 $where2->where('contract_vechicle.start_date', '<=', $date);
                //             })
                //             ->orWhere('contract_vechicle.vechicle_function_id', 1);
                //         });
                //     })
                //     ->where('contact_transection.vehicel_registration', '!=', '')
                //     ->where('contact_transection.company_id', $request->company_id)
                //     ->where('setting_parking_company.status', 1) // เช็คสถานะ setting_parking_company
                //     ->whereBetween('contact_transection.checkin_time', [$date_start, $date_from])
                //     ->orderBy('contact_transection.checkin_time', 'DESC')
                //     ->offset($request->offset)
                //     ->limit($request->limit)
                //     ->get();
            } else if ($request->type == 8) { // รถออก
                if ($company->contractVechicleActive->status == 1 && in_array($company->contractVechicleActive->vechicle_function_id, [1, 2])) {
                    $contact = ContactTransection::select('contact_transection.*')
                        ->join('company', 'company.id', '=', 'contact_transection.company_id')
                        ->join('setting_parking_company', 'company.id', '=', 'setting_parking_company.company_id')
                        ->where($where_status)
                        ->where('contact_transection.vehicel_registration', '!=', '')
                        ->where('contact_transection.company_id', $request->company_id)
                        ->where('setting_parking_company.status', 1) // เช็คสถานะ setting_parking_company
                        ->whereBetween('contact_transection.checkin_time', [$date_start, $date_from])
                        ->orderBy('contact_transection.checkin_time', 'DESC')
                        ->offset($request->offset)
                        ->limit($request->limit)
                        ->get();
                }else{
                    $contact = [];
                }
                // เงื่อนไข
                //     ซื้อไหม + หมดอายุ
                //     เช็คสถานะ setting_parking_company
                //$contact = ContactTransection::select('contact_transection.*', 'setting_hour.id as setting_hour_id')
                // $contact = ContactTransection::select('contact_transection.*')
                //     ->join('company', 'company.id', '=', 'contact_transection.company_id')
                //     ->join('setting_parking_company', 'company.id', '=', 'setting_parking_company.company_id')
                //     ->join('contract_vechicle', 'company.id', '=', 'contract_vechicle.company_id')
                //     ->with(['getDepartment', 'getObjective', 'imageTransections'])
                //     ->where($where_status)
                //     ->where(function ($where) use ($date){ // ซื้อไหม + หมดอายุ
                //         $where->where('contract_vechicle.status', 1);
                //         $where->where(function ($where1) use ($date) {
                //             $where1->where(function ($where2) use ($date) {
                //                 $where2->where('contract_vechicle.vechicle_function_id', 2);
                //                 $where2->where('contract_vechicle.end_date', '>=', $date);
                //                 $where2->where('contract_vechicle.start_date', '<=', $date);
                //             })
                //             ->orWhere('contract_vechicle.vechicle_function_id', 1);
                //         });
                //     })
                //     ->whereNotNull('contact_transection.vechicle_cost_types_id')
                //     ->where('contact_transection.company_id', $request->company_id)
                //     ->where('setting_parking_company.status', 1) // เช็คสถานะ setting_parking_company
                //     ->whereBetween('contact_transection.checkin_time', [$date_start, $date_from])
                //     ->orderBy('contact_transection.checkin_time', 'DESC')
                //     ->offset($request->offset)
                //     ->limit($request->limit)
                //     ->get();
            } else {
                # code...
            }
        }

        $item = array();

        foreach($contact as $k => $v){
            $item[$k]['contact_code'] = $v->contact_code;
            $item[$k]['name'] = $v->fullname;
            $item[$k]['checkin_time'] = $v->checkin_time;
            $item[$k]['status'] = $v->status;
            if($v->status == 0){
                $item[$k]['status_name'] = 'in';
                $item[$k]['checkout_time'] = '';
                $item[$k]['show_time'] = '';
            }else{
                $item[$k]['status_name'] = 'out';
                $item[$k]['checkout_time'] = $v->checkout_time;
                $item[$k]['show_time'] = Helper::dateDiff($v->checkin_time, $v->checkout_time);
            }

            if(isset($v->getDepartment)){
                $item[$k]['department'] = $v->getDepartment->name;
            }else{
                $item[$k]['department'] = '';
            }

            if(isset($v->getObjective)){
                $item[$k]['objective_type'] = $v->getObjective->name;
            }else{
                $item[$k]['objective_type'] = '';
            }

            $item[$k]['from'] = (isset($v->from)) ? $v->from : '';
            $item[$k]['vehicel_registration'] = (isset($v->vehicel_registration)) ? $v->vehicel_registration : '';

            // $item[$k]['status_name'] = '';
            // $item[$k]['checkout_time'] = '';
            // $item[$k]['show_time'] = '';
            // if (!empty($v->setting_hour_id)) {
            //     $item[$k]['status_name'] = $v->setting_hour_id;
            //     $item[$k]['checkout_time'] = '';
            //     $item[$k]['show_time'] = '';
            // }

            $images = array();
            for($i =0; $i<=2; $i++){
                if($i == 0){
                    $type = 2;
                    $images[$i]['type_name'] = 'รถ';
                }else if($i == 1){
                    $type = 4;
                    $images[$i]['type_name'] = 'รูปหน้าบัตร';
                }else if($i==2){
                    $type = 1;
                    $images[$i]['type_name'] = 'คน';
                }
                $contact_image = $v->imageTransections->where('image_type_id', $type)->first();

                $images[$i]['type'] = $type;
                if(!empty($contact_image)){
                    $images[$i]['url'] = url()->previous().'/'.$contact_image['image_url'];
                }else{
                    $images[$i]['url'] = '';
                }
            }
            $item[$k]['images'] = $images;
        }

        if(count($contact) == 0) {
            return response()->json([
                 'status_code' =>904,
                 'message' => 'contact transection is not.',
                 'data' => []
             ], 200);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'ListByType successfully.',
            'data' => $item
        ], 200);
    }

    public function DetailList($id){
        $appointment = Appointment::with(['department', 'objectiveType'])->find($id);

        $data = [];
        $start_time = sprintf("%02d:%02d", floor($appointment->start_time / 3600), ($appointment->start_time % 3600) / 60);
        $end_time = sprintf("%02d:%02d", floor($appointment->end_time / 3600), ($appointment->end_time % 3600) / 60);
        
        $data['id'] = $appointment->id ?? '';
        $data['from'] = $appointment->from ?? '';
        $data['fullname'] = $appointment->name .' ' . $appointment->lastname ?? '';
        $data['department_id'] = $appointment->department->id ?? '';
        $data['department'] = $appointment->department->name ?? '';
        $data['phone'] = $appointment->phone ?? '';
        $data['email'] = $appointment->email ?? '';
        $data['objective_id'] = $appointment->objectiveType->id ?? '';
        $data['objective'] = $appointment->objectiveType->name ?? '';
        $data['date'] = $appointment->date_appointment.' '.$start_time.' - '.$end_time ?? '';
        $data['note'] = $appointment->note ?? '';

        return response()->json([
            'status_code' => 200,
            'message' => 'DetailList successfully.',
            'data' => $data,
        ], 200);
        
    }

    public function CheckAppointment(Request $request) {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|string',
            'fullname' => 'required|string',
            'appointment_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 422,
                'message' => $validator->errors(),
            ]);
        }

        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->timestamp;
        $inputName = preg_replace(strtolower('/^(นาย|นาง|นางสาว|น.ส.|ด.ช.|เด็กชาย|ด.ญ.|เด็กหญิง|คุณ|ม.ล.|ม.ร.ว.|ม.จ.|ศ.ดร.|ผศ.ดร.|รศ.ดร.|ดร.|ศ.|ผศ.|รศ.|พล.อ.|พล.ท.|พล.ต.|พล.อ.ต.|พล.อ.ท.|พล.อ.อ.|พล.ร.อ.|พล.ร.ท.|พล.ร.ต.|น.อ.|น.ท.|น.ต.|น.อ.|น.ท.|น.ต.|ร.ต.ท.|ร.ต.อ.|พ.ต.ท.|พ.ต.อ.|Mr.|Mrs.|Ms.|Miss|Dr.|Prof.|Asst. Prof.|Assoc. Prof.|Col.|Lt. Col.|Maj.|Gen.|Lt. Gen.|Maj. Gen.|Capt.|Cmdr.|Adm.|Lt. Cmdr.|Lt.|Cpl.|Sgt.|Ens.)\s*/'), '', strtolower($request->input('fullname')));
        
        // แยกชื่อและนามสกุลจาก fullname
        $parts = explode(' ', $inputName, 2);
        $name = $parts[0];  // ชื่อ
        $lastname = isset($parts[1]) ? $parts[1] : '';  // นามสกุล (ถ้ามี)

        // return $parts;

        $checkAppointment = Appointment::where('company_id', $request->input('company_id'))
            ->where('appointment_code', $request->input('appointment_code'))
            ->whereRaw('LOWER(name) = ?', [$name])
            ->whereRaw('LOWER(lastname) = ?', [$lastname])
            ->where('status', 2)
            ->first();

        if ($checkAppointment) {
            if ($checkAppointment->date_appointment != $currentDate) {
                return response()->json([
                    'status_code' => 200,
                    'message' => 'successfully.',
                    'data' => [
                        'status' => 2,
                        'message' => 'มาไม่ตรงวันนัดหมาย',
                    ]
                ]);
            }

            // แปลง end_time เป็น timestamp
            $appointmentTimestamp = $this->convertEndTimeToTimestamp($checkAppointment->date_appointment, $checkAppointment->end_time);

            // เปรียบเทียบเวลาปัจจุบันกับเวลาสิ้นสุดของการนัดหมาย
            if ($currentTime <= $appointmentTimestamp) {
                return response()->json([
                    'status_code' => 200,
                    'message' => 'successfully.',
                    'data' => [
                        'status' => 1,
                        'message' => 'มีนัดหมาย',
                        'appointment_id' => $checkAppointment->id,
                    ]
                ]);
            } else {
                return response()->json([
                    'status_code' => 200,
                    'message' => 'successfully.',
                    'data' => [
                        'status' => 3,
                        'message' => 'เลยเวลานัดหมาย',
                        'appointment_id' => $checkAppointment->id,
                    ]
                ]);
            }
        } else {
            return response()->json([
                'status_code' => 200,
                'message' => 'successfully.',
                'data' => [
                    'status' => 4,
                    'message' => 'ไม่มีการนัดหมาย',
                ]
            ]);
        }
    }

     // ฟังก์ชันสำหรับแปลงวินาทีให้เป็น timestamp
     private function convertEndTimeToTimestamp($dateAppointment, $endTimeInSeconds) {
        // แปลงวินาทีเป็นชั่วโมง:นาที
        $hours = floor($endTimeInSeconds / 3600);
        $minutes = floor(($endTimeInSeconds % 3600) / 60);
        
        // สร้าง Carbon object จาก date_appointment
        $carbonDate = Carbon::createFromFormat('Y-m-d', $dateAppointment)->startOfDay();

        // เพิ่มชั่วโมงและนาทีลงไปใน Carbon object
        $carbonDate->addHours($hours)->addMinutes($minutes);

        // คืนค่าเป็น timestamp
        return $carbonDate->timestamp;
    }

    public function PrintOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|string',
            'contact_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 422);
        }


        $company = Company::find($request->company_id);
        if (empty($company)) {
            return response()->json([
                 'status_code' =>901,
                 'message' => 'company is not.',
             ], 200);
        }

        $contact = ContactTransection::where('contact_code', $request->contact_code)
            ->where('company_id', $request->company_id)
            ->first();
        if(empty($contact)) {
            return response()->json([
                 'status_code' =>904,
                 'message' => 'contact transection is not.',
             ], 200);
        }

        $images = ImageType::select('id as type','name as type_name')->get();
        foreach($images as $k => $v){
            $contact_image = Images::where('contact_id', $contact->id)->where('image_type_id', $v->type)->first();
            if(!empty($contact_image)){
                $images[$k]['url'] = url()->previous().'/'.$contact_image['image_url'];
            }else{
                $images[$k]['url'] = '';
            }
        }
        $show_time = '';
        if($contact->status  == 1){
            $show_time = Helper::dateDiff($contact->checkin_time, $contact->checkout_time);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Search successfully.',
            'data' => [
                'contact_code' => $contact->contact_code,
                'name' => $contact->fullname,
                'idcard' => $contact->idcard,
                'vehicel_registration' => $contact->vehicel_registration,
                'temperature' => $contact->temperature,
                'department' => $contact->getDepartment->name,
                'objective_type' => $contact->getObjective->name,
                'checkin_time' => $contact->checkin_time,
                'checkout_time' => ($contact->status == 1)? $contact->checkout_time : '',
                'status' => $contact->status,
                'stauts_name'=> ($contact->status == 1)? 'out' : 'in',
                'images' => $images,
                'show_time' => $show_time,
            ]
        ], 200);
    }

    // function สำหรับ เช็ค qrcode ว่ามาจาก ค่าจอดรถหรือคน checkin ธรรม หรือ นัดหมาย(ยังไมไ่ด้ทำ)
    public function SearchWay(Request $request){
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|string',
            'contact_code' => 'required|string',
        ]);

        if (1) { // ตรวจสอบค่าต่าง ๆ
            if ($validator->fails()) {
                return response()->json([
                    'status_code' => 422,
                    'message' => $validator->errors(),
                ], 422);
            }

            if (2) { // ตรวจสอบ company_id มีไหม
                $company = Company::find($request->company_id);
                if (empty($company)) {
                    return response()->json([
                        'status_code' => 901,
                        'message' => 'company is not.',
                    ], 200);
                }
            }

            if (3) { // ตรวจสอบ company_id และ contact_code ว่าตรงกันไหม
                $contact = ContactTransection::where('contact_code', $request->contact_code)
                    ->where('company_id', $request->company_id)
                    ->first();
                if (empty($contact)) {
                    return response()->json([
                        'status_code' => 904,
                        'message' => 'contact transection is not.',
                    ], 200);
                }
            }
        }

        try {
            // return $company;
            $SettingParking = [];
            if ( $company->status_vechicle == 1 ) {
                $date = date('Y-m-d');
                $contract_vechicle = ContractVechicle::select()
                    ->where('company_id', $company->id)
                    ->where('status', 1)
                    ->where(function ($where) use ($date) {
                        $where->where(function ($where2) use ($date) {
                            $where2->where('vechicle_function_id', 2);
                            $where2->where('end_date', '>=', $date);
                            $where2->where('start_date', '<=', $date);
                        })
                        ->orWhere('vechicle_function_id', 1);
                    })
                    ->orderBy('id', 'desc')
                    ->first();

                $setting_parking_company = SettingParkingCompany::select()
                    ->with(['settingHours' => function($query){
                        $query->with('vechicleCostType');
                        $query->with(['RelStampTypeSettingHour' => function($query2){
                            $query2->with('StampType');
                        }]);
                        $query->orderBy('vechicle_cost_types_id');
                    }])
                    ->where('company_id', $company->id)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->first();

                if ( !empty($contract_vechicle) && !empty($setting_parking_company) && !empty($setting_parking_company->settingHours) ) {
                    foreach ($setting_parking_company->settingHours as $key => $settingHour) {
                        $RelStampTypeSettingHour = NULL;
                        if (!empty($settingHour->RelStampTypeSettingHour)) {
                            $RelStampTypeSettingHour = $settingHour->RelStampTypeSettingHour;
                        }

                        if ($settingHour->status == 1) {
                            $SettingParking[] = [
                                "stamp_type_name" => ($RelStampTypeSettingHour ? $RelStampTypeSettingHour->StampType->name : 0), //ส่วนลด2แบบ 1=ละเว้นหมด / 2=กำหนดชั่วโมง
                                "stamp_type" => ($RelStampTypeSettingHour ? $RelStampTypeSettingHour->stamp_type_id : 0), //ส่วนลด2แบบ 1=ละเว้นหมด / 2=กำหนดชั่วโมง
                                "status_stamp" => $settingHour->status_stamp, // 0=ไม่กดกำหนดส่วนลด  /  1=กดกำหนดส่วนลด
                                "vechicle_cost_type" => $settingHour->vechicleCostType->name, //แบบคิดค่าจอด
                                "vechicle_cost_type_id" => $settingHour->vechicle_cost_types_id //ลำดับรูปแบบคิดค่าจอด
                            ];
                        }
                    }
                }
            }

            return response()->json([
                'status_code' => 200,
                'message' => 'Search successfully.',
                'data' => [
                    "vehicel_registration" => $contact->vehicel_registration,
                    "status_vechicle" => $company->status_vechicle,  //การซื้อฟังก์ชันพิเศษค่าจอดรถ
                    "status_in_out" => $contact->status,
                    "status" => (!empty($setting_parking_company) ? $setting_parking_company->status : 0),  //สถานะการเปิดใช้ 0=ปิด / 1=เปิด
                    "type" => $SettingParking
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage(),
            ], 200);
        }

    }

    public function CheckPDPA(Request $request){
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                 'status_code' =>422,
                 'message' => $validator->errors(),
             ], 422);
        }

        $pdpa = Pdpa::where('company_id', $request->company_id)->first();

        return response()->json([
            'status_code' => 200,
            'message' => 'successfully.',
            'data' => [
                'id' => $pdpa->id ?? null,
                'message' => $pdpa->pdpa ?? null,
            ]
        ]);
    }
}
