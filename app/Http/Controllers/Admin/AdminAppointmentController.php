<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Company;
use App\Models\Departments;
use App\Models\ObjectiveType;
use Illuminate\Http\Request;
use Auth;
use Validator;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\SlipMail;

class AdminAppointmentController extends Controller
{
    public function index(){
        $company = Company::find(Auth::user()->company_id);
        return view('admin.appointment.index',  compact('company'));
    }

    public function create(){
        $company_id = Auth::user()->company_id;
        $departments = Departments::select('id', 'name')
            ->where('company_id', $company_id)   
            ->where('status', 1)  
            ->orderby('sorting', 'asc')                   
            ->get();

        $objectiveTypes = ObjectiveType::select('id', 'name')
            ->where('company_id', $company_id)   
            ->where('status', 1)  
            ->orderby('sorting', 'asc')                   
            ->get();
            
        return view('admin.appointment.create', compact('departments', 'objectiveTypes'));
    }

    public function externalIndex($companyName){
        $company = Company::where('name', $companyName)->first();

        if (!$company) {
            abort(404, 'Company not found');
        }

        $departments = Departments::select('id', 'name')
            ->where('company_id', $company->id)
            ->where('status', 1)
            ->orderby('sorting', 'asc')
            ->get();

        $objectiveTypes = ObjectiveType::select('id', 'name')
            ->where('company_id', $company->id)
            ->where('status', 1)
            ->orderby('sorting', 'asc')
            ->get();

        return view('admin.appointment.create_external', compact('company', 'departments', 'objectiveTypes'));
    }

    //Create
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'objective_id' => 'required|integer',
            'date_appointment' => 'required|string',
            'start_time' => 'required|string|date_format:H:i',
            'end_time' => 'required|string|date_format:H:i',
        ]);

        $errors = $validator->errors();

        if ($errors->any()) {
            return response()->json([
                'status_code' => 422,
                'message' => $errors,
            ]);
        }

        // Generate the initial code
        $year = substr(date("Y"), 2, 2);
        $num = rand(1000, 9999);
        $code = $year . date("md") . str_shuffle(date('His')) . $num;

        // Check if the code exists in the database
        $existingAppointment = Appointment::where('appointment_code', $code)->first();

        // If the code already exists, generate a new one until a unique code is found
        while ($existingAppointment) {
            $num = rand(1000, 9999);
            $code = $year . date("md") . str_shuffle(date('His')) . $num;
            $existingAppointment = Appointment::where('appointment_code', $code)->first();
        }
        $formattedDate = implode('-', array_reverse(explode('-', $request->input('date_appointment'))));
        $startTimeInSeconds = $this->convertTimeToSeconds($request->input('start_time'));
        $endTimeInSeconds = $this->convertTimeToSeconds($request->input('end_time'));

        $company_id = Auth::user()->company_id;

        // Create the appointment
        $appointment = Appointment::create(
            [
                'appointment_code' => $code,
                'company_id' => $company_id,
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'department_id' => $request->input('department_id'),
                'objective_id' => $request->input('objective_id'),
                'from' => $request->input('from'),
                'note' => $request->input('note'),
                'date_appointment' => $formattedDate,
                'start_time' => $startTimeInSeconds,
                'end_time' => $endTimeInSeconds,
                'pdpa_id' => null,
                'pdpa_status_id' => null,
                'status' => 1,
            ]
        );

        if ($appointment) {
            return response()->json([
                'status_code' => 200,
                'message' => 'create successfully.',
            ], 200);
        } else {
            return response()->json([
                'status_code' => 201,
                'message' => 'create error.',
            ], 200);
        }
    }

    public function externalCreate(Request $request){
        // Validate incoming request data (similar to store method)
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'objective_id' => 'required|integer',
            'date_appointment' => 'required|string',
            'start_time' => 'required|string|date_format:H:i',
            'end_time' => 'required|string|date_format:H:i',
        ]);

        // Generate the initial code
        $year = substr(date("Y"), 2, 2);
        $num = rand(1000, 9999);
        $code = $year . date("md") . str_shuffle(date('His')) . $num;

        // Check if the code exists in the database
        $existingAppointment = Appointment::where('appointment_code', $code)->first();

        // If the code already exists, generate a new one until a unique code is found
        while ($existingAppointment) {
            $num = rand(1000, 9999);
            $code = $year . date("md") . str_shuffle(date('His')) . $num;
            $existingAppointment = Appointment::where('appointment_code', $code)->first();
        }

        $formattedDate = implode('-', array_reverse(explode('-', $request->input('date_appointment'))));
        $startTimeInSeconds = $this->convertTimeToSeconds($request->input('start_time'));
        $endTimeInSeconds = $this->convertTimeToSeconds($request->input('end_time'));

        $company_id = $request->input('id');

        // Create the appointment with company_id from URL parameter
        $appointment = Appointment::create([
            'appointment_code' => $code,
            'company_id' => $company_id,
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'department_id' => $request->input('department_id'),
            'objective_id' => $request->input('objective_id'),
            'from' => $request->input('from'),
            'note' => $request->input('note'),
            'date_appointment' => $formattedDate,
            'start_time' => $startTimeInSeconds,
            'end_time' => $endTimeInSeconds,
            'pdpa_id' => null,
            'pdpa_status_id' => null,
            'status' => 1,
        ]);

        if ($appointment) {
            return response()->json([
                'status_code' => 200,
                'message' => 'Appointment created successfully.',
            ], 200);
        } else {
            return response()->json([
                'status_code' => 500,
                'message' => 'Failed to create appointment.',
            ], 500);
        }
    }

    //Update
    public function update(Request $request, $id){
        $company_id = Auth::user()->company_id;
        $company = Company::findOrFail($company_id);
        $appointment = Appointment::with('department', 'objectiveType')->findOrFail($id);

        // ตรวจสอบว่ามีการส่งค่า 'reason' มาหรือไม่
        $reason = $request->input('reason', '');

        if (!$appointment) {
            return response()->json(['error' => 'ไม่พบรายการนัดหมาย'], 404);
        }

        switch ($request->input('type')) {
            case 'approve':
                $appointment->status = 2;
                break;
            case 'reject':
                $appointment->status = 3;
                break;
            case 'cancel':
                $appointment->status = 4;
                break;
            case 'edit':
                $validator = Validator::make($request->all(), [
                    'date_appointment' => 'required|string',
                    'start_time' => 'required|string|date_format:H:i',
                    'end_time' => 'required|string|date_format:H:i',
                ]);
        
                if ($validator->fails()) {
                    return response()->json([
                        'status_code' => 422,
                        'message' => $validator->errors(),
                    ]);
                }

                $appointment->date_appointment = implode('-', array_reverse(explode('-', $request->input('date_appointment'))));
                $appointment->start_time = $this->convertTimeToSeconds($request->input('start_time'));
                $appointment->end_time = $this->convertTimeToSeconds($request->input('end_time'));
        
                try {
                    $appointment->save();
        
                    return response()->json([
                        'status_code' => 200,
                        'message' => 'update successfully.',
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'status_code' => 201,
                        'message' => 'update error.',
                    ], 200);
                }
                break;
            default:
                return response()->json(['error' => 'ไม่มีข้อมูลบางส่วน'], 500);
        }

        try {
            // สร้าง QR Code เป็น base64 encoded image data
            $qrcodeData = QrCode::format('png')->size(256)->generate($appointment->appointment_code);
            $qrcodeUri = 'data:image/png;base64,' . base64_encode($qrcodeData);

            $date_appointment_formatted = implode('-', array_reverse(explode('-', $appointment->date_appointment)));
            $start_time_formatted = sprintf("%02d:%02d", floor($appointment->start_time / 3600), ($appointment->start_time % 3600) / 60);
            $end_time_formatted = sprintf("%02d:%02d", floor($appointment->end_time / 3600), ($appointment->end_time % 3600) / 60);
            
            // return $date_appointment_formatted.' '.$start_time_formatted.' '.$start_time_formatted;
            // สร้าง PDF โดยระบุ path ของ view ที่ถูกต้อง
            $pdf = PDF::loadView('admin.appointment.form_slip', [
                'company' => $company,
                'appointment' => $appointment,
                'reason' => $reason,
                'date_appointment_formatted' => $date_appointment_formatted,
                'start_time_formatted' => $start_time_formatted,
                'end_time_formatted' => $end_time_formatted,
                'qrcodeUri' => $qrcodeUri,
            ]);
    
            // เก็บ PDF ในตัวแปร
            $pdfOutput = $pdf->output();
            
            try {
                // ส่งอีเมลพร้อมไฟล์แนบ
                Mail::to($appointment->email)->send(new SlipMail($company, $appointment, $date_appointment_formatted, $pdfOutput));

                $appointment->save();
                
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Email sent successfully.',
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status_code' => 100,
                    'message' => 'Failed to send email: ' . $e->getMessage(),
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล ' . $e->getMessage()], 500);
        }
    }

    //Edit
    public function edit($id){
        $appointment = Appointment::find($id);
        $appointment->date_appointment_formatted = implode('-', array_reverse(explode('-', $appointment->date_appointment)));
        $appointment->start_time_formatted = sprintf("%02d:%02d", floor($appointment->start_time / 3600), ($appointment->start_time % 3600) / 60);
        $appointment->end_time_formatted = sprintf("%02d:%02d", floor($appointment->end_time / 3600), ($appointment->end_time % 3600) / 60);

        $departments = Departments::select('id', 'name')
            ->where('company_id', $appointment->company_id)
            ->where('status', 1)
            ->orderby('sorting', 'asc')
            ->get();

        $objectiveTypes = ObjectiveType::select('id', 'name')
            ->where('company_id', $appointment->company_id)
            ->where('status', 1)
            ->orderby('sorting', 'asc')
            ->get();

        return view('admin.appointment.edit',  compact('appointment', 'departments', 'objectiveTypes'));
    }

    //Get Data
    public function dashboardAppointment(Request $request){
        if(request()->ajax()) {
            $company_id = Auth::user()->company_id;
            $appointments = Appointment::with('department', 'objectiveType')
                ->where('company_id', $company_id)
                ->orderby('date_appointment', 'desc')
                ->get()
                ->map(function ($appointment) {
                    $appointment->date_appointment_formatted = implode('-', array_reverse(explode('-', $appointment->date_appointment)));
                    $appointment->start_time_formatted = sprintf("%02d:%02d", floor($appointment->start_time / 3600), ($appointment->start_time % 3600) / 60);
                    $appointment->end_time_formatted = sprintf("%02d:%02d", floor($appointment->end_time / 3600), ($appointment->end_time % 3600) / 60);
                    
                    return $appointment;
                });

            return response()->json($appointments);
        }
        return view('admin.appointment.index');
    }

    function convertTimeToSeconds($timeString) {
        list($hours, $minutes) = explode(':', $timeString);
        return ($hours * 3600) + ($minutes * 60);
    }
}
