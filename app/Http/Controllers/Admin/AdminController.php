<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\ContactTransection;
use App\Models\Departments;
use App\Exports\ContactTransectionsExportMultiple;
use App\Models\Appointment;
use App\Models\Blacklist;
use App\Models\ImageTransection;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
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

    public function export(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $company_id = $request->company_id;
        $type_checkin = $request->type_checkin;

        if((empty($company_id) || empty($start_date)) || empty($end_date) || empty($type_checkin)){
            abort(404);
        }

        $departments = Departments::select('id','name')
            ->where('company_id', $company_id)
            ->where('status',1)
            ->orderBy('sorting','ASC')
            ->get();

        $departments_array = array();
        foreach($departments as $k => $v){
            $departments_array[$k]['id'] = $v->id;
            $departments_array[$k]['name'] = $v->name;
        }


        $file_name = strtoupper($type_checkin) . "CONTACT" . date("Ymd") . "-" . str_shuffle(date('His')) . ".xlsx";
        // $file_name = "CONTACT".date("Ymd")."-".str_shuffle(date('His')).".xlsx";
        if(!empty($departments_array)){

            return Excel::download(new ContactTransectionsExportMultiple($start_date,$end_date,$company_id,$departments_array, $type_checkin), $file_name);
        }else{
        //    echo 'ไม่สามารถส่ง ออก excel ได้';
            $departments_array[0]['id'] = '';
            $departments_array[0]['name'] = 'ผู้มาติดต่อ';
            return Excel::download(new ContactTransectionsExportMultiple($start_date,$end_date,$company_id,$departments_array, $type_checkin), $file_name);
        }
    }
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

        $total_blacklist = Blacklist::where('company_id', $company_id)
            ->where('status', 1)
            ->count();

        $contact = ContactTransection::where('company_id', $company_id)
            ->offset(0)
            ->limit(10)
            ->orderBy('updated_at','DESC')->get();

        foreach($contact as $k => $v){
            $image = ImageTransection::select('image_url')
                ->where('contact_id', $v->id)
                ->where('image_type_id', 4)
                ->first();

            if(!empty($image)){
                $contact[$k]->image_url = $image->image_url;
            }else{
                $contact[$k]->image_url = '';
            }
        }

        return view('admin.dashboard',compact(
            'contact',
            'total_in',
            'total_out',
            'total_not_out',
            'total_over',
            'total_blacklist'
        ));
    }

    public function visitor()
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

        $total_blacklist = Blacklist::where('company_id', $company_id)
            ->where('status', 1)
            ->count();

        $contact = ContactTransection::where('company_id', $company_id)
            ->where('status', 1)
            ->offset(0)
            ->limit(10)
            ->orderBy('updated_at','DESC')->get();

        foreach($contact as $k => $v){
            $image = ImageTransection::select('image_url')
                ->where('contact_id', $v->id)
                ->where('image_type_id', 4)
                ->first();

            if(!empty($image)){
                // ตรวจสอบ URL ของรูปภาพ
                $fullLogoUrl = public_path($image->image_url);
                if (file_exists($fullLogoUrl)) {
                    $images[$k]['url'] = $image->image_url;
                } else {
                    $images[$k]['url'] = '';
                }
            }else{
                $contact[$k]->image_url = '';
            }
        }

        return view('admin.dashboard_visitor', compact(
            'contact',
            'total_in',
            'total_out',
            'total_not_out',
            'total_over', 
            'total_blacklist'
        ));
    }

    public function appointment()
    {
        $company_id = Auth::user()->company_id;
        $appointments = Appointment::with('department', 'objectiveType')
            ->where('company_id', $company_id)
            ->get()
            ->map(function ($appointment) {
                $appointment->start_time_formatted = Carbon::createFromTimestamp($appointment->start_time)->format('H:i');
                $appointment->end_time_formatted = Carbon::createFromTimestamp($appointment->end_time)->format('H:i');
                return $appointment;
            });

        return view('admin.dashboard_appointment', compact('appointments'));
    }

    public function parking()
    {
        // $date = Carbon::now()->toDateString();
        // $date_start = $date.' 00-00-00';
        // $date_from = $date.' 23-59-59';

        // $company_id = Auth::user()->company_id;

        // $total_in = ContactTransection::where('company_id', $company_id)
        //     ->whereBetween('checkin_time',[$date_start, $date_from])
        //     ->count();

        // $total_out = ContactTransection::where('company_id', $company_id)
        //     ->where('status', 1)
        //     ->whereBetween('checkout_time',[$date_start, $date_from])
        //     ->count();

        // $total_not_out = ContactTransection::where('company_id', $company_id)
        //     ->where('status', 0)
        //     ->whereBetween('checkin_time',[$date_start, $date_from])
        //     ->count();

        // $total_over = ContactTransection::where('company_id', $company_id)
        //     ->where('status', 0)
        //     ->whereBetween('checkin_time',['0000-00-00 00:00:00', $date_start])
        //     ->count();


        // $contact = ContactTransection::where('company_id', $company_id)
        //     ->offset(0)
        //     ->limit(10)
        //     ->orderBy('updated_at','DESC')->get();

        // foreach($contact as $k => $v){
        //     $image = ImageTransection::select('image_url')
        //         ->where('contact_id', $v->id)
        //         ->where('image_type_id', 4)
        //         ->first();

        //     if(!empty($image)){
        //         $contact[$k]->image_url = $image->image_url;
        //     }else{
        //         $contact[$k]->image_url = '';
        //     }
        // }

        // return view('admin.parking.index',compact('contact','total_in','total_out','total_not_out','total_over'));
    }

    public function summary()
    {
        //
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
        //
    }
}
