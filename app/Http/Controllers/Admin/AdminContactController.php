<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blacklist;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\ContactTransection;
use App\Models\Images;
use App\Models\ImageType;
use DataTables;
use PDF;
use Helper;

class AdminContactController extends Controller
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

    public function showGet(Request $request){


        $contact = ContactTransection::find($request->contact);
        if(!empty($contact)){

            $contact->show_objective = (!empty($contact->getObjective)) ? $contact->getObjective->name : '-';
            $contact->show_department = (!empty($contact->getDepartment)) ? $contact->getDepartment->name : '-';

            if($contact->status == 1){
                $contact->time_in = Helper::dateDiff($contact->checkin_time, $contact->checkout_time);
            }else{
                $contact->time_in = '';
            }

            $images = ImageType::select('id as type','name as type_name')->get();
            foreach($images as $k => $v){
                $contact_image = Images::where('contact_id', $contact->id)
                    ->where('image_type_id', $v->type)
                    ->first();

                if(!empty($contact_image)){
                    // ตรวจสอบ URL ของรูปภาพ
                    $fullLogoUrl = public_path($contact_image['image_url']);
                    if (file_exists($fullLogoUrl)) {
                        $images[$k]['url'] = $contact_image['image_url'];
                    } else {
                        $images[$k]['url'] = '';
                    }
                }else{
                    $images[$k]['url'] = '';
                }
            }

            $contact->images = $images;

            
            $contactBlacklist = [];
            $blacklist = Blacklist::where('company_id', $contact->company_id)
                    ->where('fullname', $contact->fullname)
                    ->where('contact_transaction_id', $contact->id)
                    ->where('status', 1)
                    ->first();

            if(!empty($blacklist)) {
                $contactBlacklist['type'] = "ยกเลิกแบล็กลิสต์";
                $contactBlacklist['status'] = $blacklist->status;
            } else {
                $contactBlacklist['type'] = "แบล็กลิสต์";
                $contactBlacklist['status'] = null;
            }

            $contact->blacklist = $contactBlacklist;

            return response()->json([
                'status_code' => 200,
                'message' => 'get data successfully.',
                'data' => $contact
            ], 200);
        }else{
            return response()->json([
                'status_code' => 201,
                'message' => 'get data no contact.',
            ], 200);
        }

    }

    public function showAllow(Request $request){


        $contact = ContactTransection::find($request->contact);
        if(!empty($contact)){

            // $contact->show_objective = (isset($contact->getObjective)) ? $contact->getObjective->name : '';
            // $contact->show_department = (isset($contact->getDepartment)) ? $contact->getDepartment->name : '';

            $contact->show_objective = (!empty($contact->getObjective)) ? $contact->getObjective->name : '-';
            $contact->show_department = (!empty($contact->getDepartment)) ? $contact->getDepartment->name : '-';

            if($contact->status == 1){
                $contact->time_in = Helper::dateDiff($contact->checkin_time, $contact->checkout_time);
            }else{
                $contact->time_in = '';
            }

            $images = ImageType::select('id as type','name as type_name')->get();
            foreach($images as $k => $v){
                $contact_image = Images::where('contact_id', $contact->id)->where('image_type_id', $v->type)->first();
                if(!empty($contact_image)){
                    $images[$k]['url'] = $contact_image['image_url'];
                }else{
                    $images[$k]['url'] = '';
                }
            }

            $contact->images = $images;

            return response()->json([
                'status_code' => 200,
                'message' => 'get data successfully.',
                'data' => $contact
            ], 200);
        }else{
            return response()->json([
                'status_code' => 201,
                'message' => 'get data no contact.',
            ], 200);
        }

    }

    public function showIn(){

        return view('admin.contact.in');
    }

    public function showList(Request $request, $type){

        if(request()->ajax()) {
            $company_id = Auth::user()->company_id;

            $date = Carbon::now()->toDateString();
            $date_start = $date.' 00-00-00';
            $date_from = $date.' 23-59-59';

            $where_status = array();
            if($type == 'in'){
            }else if($type == 'out'){
                $where_status = array('status' => 1);
            }else if($type == 'stay'){
                $where_status = array('status' => 0);
            }else if($type == 'over'){
                $where_status = array('status' => 0);
                $date_start = '0000-00-00 00:00:00';
                $date_from = $date.' 00-00-00';
            }

            if($type == 'out'){
                $contact =  ContactTransection::where('company_id', $company_id)
                    ->with(['getDepartment', 'getObjective'])
                    ->where($where_status)
                    ->whereBetween('checkout_time',[$date_start, $date_from])
                    ->get();
            }else{
                $contact =  ContactTransection::where('company_id', $company_id)
                    ->with(['getDepartment', 'getObjective'])
                    ->where($where_status)
                    ->whereBetween('checkin_time',[$date_start, $date_from])
                    ->get();
            }

            $contact_arr = $contact->pluck('id');

            $imageContactTransection = Images::select('contact_id', 'image_url')
                ->whereIntegerInRaw('contact_id',$contact_arr)
                ->where('image_type_id', 4)
                ->get();

            foreach($contact as $k => $v){

                if($v->status == 1){
                    $contact[$k]->checkout_time = $v->checkout_time;
                    $contact[$k]->time_in = Helper::dateDiff($v->checkin_time, $v->checkout_time);
                }else{
                    $contact[$k]->checkout_time = '';
                    $contact[$k]->time_in = '';
                }

                $image = $imageContactTransection->where('contact_id', $v->id)->first();

                if (!empty($image)) {
                    $fullLogoUrl = public_path($image->image_url);
                    if (file_exists($fullLogoUrl)) {
                        $contact[$k]->image_url = $image->image_url;
                    } else {
                        $contact[$k]->image_url = '';
                    }
                } else {
                    $contact[$k]->image_url = '';
                }

                $contact[$k]->department = (isset($v->getDepartment)) ? $v->getDepartment->name : '';
                $contact[$k]->objective = (isset($v->getObjective)) ? $v->getObjective->name : '';
            }

            return DataTables::of($contact)
                ->make(true);
            }
            
            return view('admin.contact.list', compact('type'));
    }

    function printContact(Request $request, $code){

        $contact = ContactTransection::where('contact_code',$code)->first();
        // return view('admin.contact.print', compact('contact'));exit();
        if(!empty($contact)){

            $contact->show_objective = (isset($contact->getObjective)) ? $contact->getObjective->name : '';
            $contact->show_department = (isset($contact->getDepartment)) ? $contact->getDepartment->name : '';

            if($contact->status == 1){
                $contact->time_in = Helper::dateDiff($contact->checkin_time, $contact->checkout_time);
            }else{
                $contact->time_in = '-';
            }

            $images = ImageType::select('id as type','name as type_name')->get();
            foreach($images as $k => $v){
                $contact_image = Images::where('contact_id', $contact->id)->where('image_type_id', $v->type)->first();
                if(!empty($contact_image)){
                    $images[$k]['url'] = $contact_image['image_url'];
                }else{
                    $images[$k]['url'] = '';
                }
            }

            $contact->images = $images;

            // dd($contact->getDepartment);

            $pdf = PDF::loadView('admin.contact.print',compact('contact'));
            return $pdf->stream('test.pdf');

        }else{
        }

    }

}
