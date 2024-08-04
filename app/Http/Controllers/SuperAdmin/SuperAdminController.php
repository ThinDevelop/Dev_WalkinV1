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
use App\Models\Images;
use App\Models\ImageType;
use App\Models\Departments;
use DB;
use Validator;
use Hash;
use App\Rules\MatchOldPassword;
use App\Exports\ContactTransectionsExportMultiple;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Helper;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class SuperAdminController extends Controller
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

        if ((empty($company_id) || empty($start_date)) || empty($end_date) || empty($type_checkin)) {
            abort(404);
        }

        $departments = Departments::select('id', 'name')
            ->where('company_id', $company_id)
            ->where('status', 1)
            ->orderBy('sorting', 'ASC')
            ->get();

        $departments_array = array();
        foreach ($departments as $k => $v) {
            $departments_array[$k]['id'] = $v->id;
            $departments_array[$k]['name'] = $v->name;
        }

        //--> backup <--//
        // $file_name = strtoupper($type_checkin) . "CONTACT" . date("Ymd") . "-" . str_shuffle(date('His')) . ".xlsx";
        // if (!empty($departments_array)) {
        //     return Excel::download(new ContactTransectionsExportMultiple($start_date, $end_date, $company_id, $departments_array, $type_checkin), $file_name);
        // } else {
        //     $departments_array[0]['id'] = '';
        //     $departments_array[0]['name'] = 'ผู้มาติดต่อ';
        //     return Excel::download(new ContactTransectionsExportMultiple($start_date, $end_date, $company_id, $departments_array, $type_checkin), $file_name);
        // }

        $file_name = strtoupper($type_checkin) . "CONTACT" . date("Ymd") . "-" . str_shuffle(date('His')) . ".xlsx";
        if (!empty($departments_array)) {
            return Excel::download(new ContactTransectionsExportMultiple($start_date, $end_date, (int)$company_id, $departments_array, $type_checkin), $file_name);
        } else {
            $departments_array[0]['id'] = '';
            $departments_array[0]['name'] = 'ผู้มาติดต่อ';
            return Excel::download(new ContactTransectionsExportMultiple($start_date, $end_date, (int)$company_id, $departments_array, $type_checkin), $file_name);
}

    }

    public function index(Request $request)
    {
        $company_total = Company::count();
        $company_disabled = Company::where('status', 0)->count();
        $company_active = Company::where('status', 1)->count();
        $company_enabled = Company::where('status', 1)->count();
        $vechicle_total = Company::where('status_vechicle', 1)->count();


        $user_total = User::where('company_id', '!=', '')->role('admin')->count();

        return view('superadmin.dashboard', compact('company_total', 'company_active', 'company_enabled','company_disabled', 'user_total', 'vechicle_total'));
    }

    public function visitor(Request $request)
    {
        $company_total = Company::count();
        $company_enabled = Company::where('status', 1)->count();
        $company_disabled = Company::where('status', 0)->count();
        $user_total = User::count();
        $vechicle_total = Company::where('status_vechicle', 1)->count();

        return view('superadmin.dashboard_visitor', compact('company_total', 'company_disabled', 'company_enabled', 'user_total', 'vechicle_total'));
    }

    public function parking(Request $request)
    {
        $date_now = date('Y-m-d H:i:s');
        $vechicle_total = Company::whereExists(function ($query) use ($date_now) {
                $query->select(DB::raw(1))
                    ->from('contract_vechicle')
                    ->whereColumn('company.id', 'contract_vechicle.company_id')
                    ->where('contract_vechicle.status', 1)
                    ->where(function ($where1) use ($date_now) {
                        $where1->where(function ($where2) use ($date_now) {
                            $where2->where('contract_vechicle.vechicle_function_id', 2);
                            $where2->where('contract_vechicle.end_date', '>=', $date_now);
                            $where2->where('contract_vechicle.start_date', '<=', $date_now);
                        })
                            ->orWhere('contract_vechicle.vechicle_function_id', 1);
                    });
            })
            ->count();

        return view('superadmin.dashboard_parking', compact('vechicle_total'));
    }

    public function getContactParking()
    {
        if (request()->ajax()) {
            $date_now = date('Y-m-d H:i:s');
            $company = Company::whereExists(function ($query) use ($date_now) {
                    $query->select(DB::raw(1))
                        ->from('contract_vechicle')
                        ->whereColumn('company.id', 'contract_vechicle.company_id')
                        ->where('contract_vechicle.status', 1)
                        ->where(function ($where1) use ($date_now) {
                            $where1->where(function ($where2) use ($date_now) {
                                $where2->where('contract_vechicle.vechicle_function_id', 2);
                                $where2->where('contract_vechicle.end_date', '>=', $date_now);
                                $where2->where('contract_vechicle.start_date', '<=', $date_now);
                            })
                                ->orWhere('contract_vechicle.vechicle_function_id', 1);
                        });
                })
                ->with([
                    'contractVechicleActive.vehicleFunction'
                ])
                ->get();

            // dd($company->contractVechicleActive);
            // start_date
            // end_date

            return DataTables::of($company)
                ->editColumn('status_vechicle', function ($data) {
                    if($data->status_vechicle == 1){
                        return '<span class="label label-lg font-weight-bold label-success label-inline" style="width: 70px;">Active</span>';
                    } else {
                        return '<span class="label label-lg font-weight-bold label-danger label-inline" style="width: 70px;">Inactive</span>';
                    }
                })
                ->editColumn('contract_start_end', function ($data) {
                    if($data->contractVechicleActive->vechicle_function_id == 1){
                        return '<span class="font-weight-bold text-lg" style="color: black;">' . $data->contractVechicleActive->vehicleFunction->name . '</span>';
                    } elseif($data->contractVechicleActive->vechicle_function_id == 2) {
                        return '<span class="text-success">' . $data->contractVechicleActive->start_date . '</span> - <span class="text-danger">' . $data->contractVechicleActive->end_date . '</span>';
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['status_vechicle', 'contract_start_end'])
                ->make(true);
        } else {
            abort(404);
        }

    }

    public function profile()
    {

        return view('superadmin.profile');
    }

    public function changePassword()
    {

        return view('superadmin.change_password');
    }

    public function changePasswordSubmit(Request $request)
    {
        $request->validate([
            'old-password' => ['required', new MatchOldPassword],
            'password' => ['required', 'min:6'],
            'confirm-password' => ['required', 'same:password', 'min:6'],
        ]);

        $id = Auth()->id();
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        $user->update(['password' => Hash::make($request->password)]);
        return redirect()->route('superadmin.changePassword')->withInput()
            ->with('success', 'เปลี่ยนรหัสผ่าน เรียบร้อยแล้ว');
    }

    public function getContact()
    {

        if (request()->ajax()) {
            $company = Company::where('status', 1)->orderBy('created_at', 'DESC')->get();

            $date = Carbon::now()->toDateString();
            $date_start = $date . ' 00-00-00';
            $date_from = $date . ' 23-59-59';
            foreach ($company as $k => $v) {

                $total_in = ContactTransection::where('company_id', $v->id)
                    ->whereBetween('checkin_time', [$date_start, $date_from])
                    ->count();

                $total_out = ContactTransection::where('company_id', $v->id)
                    ->where('status', 1)
                    ->whereBetween('checkout_time', [$date_start, $date_from])
                    ->count();

                $total_not_out = ContactTransection::where('company_id', $v->id)
                    ->where('status', 0)
                    ->whereBetween('checkin_time', [$date_start, $date_from])
                    ->count();

                $total_over = ContactTransection::where('company_id', $v->id)
                    ->where('status', 0)
                    ->whereBetween('checkin_time', ['0000-00-00 00:00:00', $date_start])
                    ->count();

                $company[$k]->in = $total_in;
                $company[$k]->out = $total_out;
                $company[$k]->not_out = $total_not_out;
                $company[$k]->over = $total_over;
            }

            return DataTables::of($company)
                ->make(true);
        } else {
            abort(404);
        }
    }

    public function contactDetail(Request $request, $type, $company_id)
    {

        $company = Company::find($company_id);
        if (!$company) {
            abort(404);
        }

        if (request()->ajax()) {

            $date = Carbon::now()->toDateString();
            $date_start = $date . ' 00-00-00';
            $date_from = $date . ' 23-59-59';

            $where_status = array();
            if ($type == 'in') {
            } else if ($type == 'out') {
                $where_status = array('status' => 1);
            } else if ($type == 'stay') {
                $where_status = array('status' => 0);
            } else if ($type == 'over') {
                $where_status = array('status' => 0);
                $date_start = '0000-00-00 00:00:00';
                $date_from = $date . ' 00-00-00';
            }

            if ($type == 'out') {
                $contact =  ContactTransection::where('company_id', $company_id)
                    ->where($where_status)
                    ->whereBetween('checkout_time', [$date_start, $date_from])
                    ->get();
            } else {
                $contact =  ContactTransection::where('company_id', $company_id)
                    ->where($where_status)
                    ->whereBetween('checkin_time', [$date_start, $date_from])
                    ->get();
            }

            foreach ($contact as $k => $v) {

                if ($v->status == 1) {
                    $contact[$k]->checkout_time = $v->checkout_time;
                    $contact[$k]->time_in = Helper::dateDiff($v->checkin_time, $v->checkout_time);
                } else {
                    $contact[$k]->checkout_time = '';
                    $contact[$k]->time_in = '';
                }

                $image = Images::select('image_url')
                    ->where('contact_id', $v->id)
                    ->where('image_type_id', 4)
                    ->first();

                if (!empty($image)) {
                    $contact[$k]->image_url = $image->image_url;
                } else {
                    $contact[$k]->image_url = '';
                }

                $contact[$k]->department = (isset($v->getDepartment)) ? $v->getDepartment->name : '';
                $contact[$k]->objective = (isset($v->getObjective)) ? $v->getObjective->name : '';
            }

            return DataTables::of($contact)
                ->make(true);
        }

        return view('superadmin.contact-list.show', compact('company', 'type'));
    }

    public function contactDetailVisitor(Request $request, $type, $company_id)
    {

        $company = Company::find($company_id);
        if (!$company) {
            abort(404);
        }

        if (request()->ajax()) {

            $date = Carbon::now()->toDateString();
            $date_start = $date . ' 00-00-00';
            $date_from = $date . ' 23-59-59';

            $where_status = array();
            if ($type == 'in') {
            } else if ($type == 'out') {
                $where_status = array('status' => 1);
            } else if ($type == 'stay') {
                $where_status = array('status' => 0);
            } else if ($type == 'over') {
                $where_status = array('status' => 0);
                $date_start = '0000-00-00 00:00:00';
                $date_from = $date . ' 00-00-00';
            }

            if ($type == 'out') {
                $contact =  ContactTransection::where('company_id', $company_id)
                    ->where($where_status)
                    ->whereBetween('checkout_time', [$date_start, $date_from])
                    ->get();
            } else {
                $contact =  ContactTransection::where('company_id', $company_id)
                    ->where($where_status)
                    ->whereBetween('checkin_time', [$date_start, $date_from])
                    ->get();
            }

            foreach ($contact as $k => $v) {

                if ($v->status == 1) {
                    $contact[$k]->checkout_time = $v->checkout_time;
                    $contact[$k]->time_in = Helper::dateDiff($v->checkin_time, $v->checkout_time);
                } else {
                    $contact[$k]->checkout_time = '';
                    $contact[$k]->time_in = '';
                }

                $image = Images::select('image_url')
                    ->where('contact_id', $v->id)
                    ->where('image_type_id', 4)
                    ->first();

                if (!empty($image)) {
                    $contact[$k]->image_url = $image->image_url;
                } else {
                    $contact[$k]->image_url = '';
                }

                $contact[$k]->department = (isset($v->getDepartment)) ? $v->getDepartment->name : '';
                $contact[$k]->objective = (isset($v->getObjective)) ? $v->getObjective->name : '';
            }

            return DataTables::of($contact)
                ->make(true);
        }

        return view('superadmin.contact-list-visitor.show', compact('company', 'type'));
    }

    public function showGet(Request $request)
    {
        $contact = ContactTransection::find($request->contact);
        if (!empty($contact)) {


            $contact->show_objective = (isset($contact->getObjective)) ? $contact->getObjective->name : '';
            $contact->show_department = (isset($contact->getDepartment)) ? $contact->getDepartment->name : '';

            if ($contact->status == 1) {
                $contact->time_in = Helper::dateDiff($contact->checkin_time, $contact->checkout_time);
            } else {
                $contact->time_in = '';
            }

            $images = ImageType::select('id as type', 'name as type_name')->get();
            foreach ($images as $k => $v) {
                $contact_image = Images::where('contact_id', $contact->id)->where('image_type_id', $v->type)->first();
                if (!empty($contact_image)) {
                    $images[$k]['url'] = $contact_image['image_url'];
                } else {
                    $images[$k]['url'] = '';
                }
            }

            $contact->images = $images;

            return response()->json([
                'status_code' => 200,
                'message' => 'get data successfully.',
                'data' => $contact
            ], 200);
        } else {
            return response()->json([
                'status_code' => 201,
                'message' => 'get data no contact.',
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


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
