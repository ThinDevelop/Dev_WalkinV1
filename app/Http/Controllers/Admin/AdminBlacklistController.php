<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Blacklist;
use App\Models\Company;
use App\Models\ImageBlacklist;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\ContactTransection;
use App\Models\Images;
use Validator;
use DataTables;
use PDO;
use DB;
class AdminBlacklistController extends Controller
{
    public function getCompany(Request $request) {
        $companies = Company::all();

        return DataTables::of($companies)->addColumn('action', function ($companies) {
            return view('admin.blacklist._btn_datatable', compact('companies'))->render();;
        })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function index() {

        return view('admin.blacklist.index');
    }

    public function create() {
        return view('admin.blacklist.create');
    }

    // Create
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'note' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 422,
                'message' => $validator->errors(),
            ]);
        }

        $company_id = Auth::user()->company_id;
        $company = Company::find($company_id);
        $mid = $company->mid; // Set your mid value appropriately
        $directory = "company/" . $mid . "/blacklist/" ;
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $image_blacklist_index = null;
        if ($request->hasFile('image_blacklist_id')) {
            $image = $request->file('image_blacklist_id');
            $uuid = uniqid();
            $image_extention = $image->extension();
            $image_name = $uuid.'.'.$image_extention;
            $image->move(public_path($directory), $image_name);
            $res_image = $directory . $image_name;

            $imageBlacklist = new ImageBlacklist();
            $imageBlacklist->image_url = $res_image;
            $imageBlacklist->save();

            // ตรวจสอบว่าบันทึกสำเร็จหรือไม่
            if ($imageBlacklist->wasRecentlyCreated) {
                $image_blacklist_index = $imageBlacklist->id;
            } else {
                // ลบรูปออกจาก public directory หากบันทึกไม่สำเร็จ
                unlink(public_path($res_image));
            }
        }

        $reidcard = $request->input('idcard');

        $blacklist = new Blacklist();
        $blacklist->idcard = (!empty($reidcard) && strlen($reidcard) === 13 && ctype_digit($reidcard)) ? $reidcard : '-----';
        $blacklist->fullname = $request->input('fullname');
        $blacklist->address = !empty($request->input('address')) ? $request->input('address') : "";
        $blacklist->car_registration = !empty($request->input('car_registration')) ? $request->input('car_registration') : "" ;
        $blacklist->from = !empty($request->input('from')) ? $request->input('from') : "";
        $blacklist->note = $request->input('note');
        $blacklist->status = 1;
        $blacklist->image_blacklist_id = $image_blacklist_index; // Link to image_blacklist
        $blacklist->company_id = $company_id;
        $blacklist->save();

        // ตรวจสอบว่าบันทึกสำเร็จหรือไม่
        if ($blacklist->wasRecentlyCreated) {
            // บันทึกสำเร็จ
        } else {
            // ลบรูปออกจาก public directory หากบันทึกไม่สำเร็จ
            if ($image_blacklist_index) {
                $imageBlacklist = ImageBlacklist::find($image_blacklist_index);
                if ($imageBlacklist) {
                    unlink(public_path($imageBlacklist->image_url));
                    $imageBlacklist->delete();
                }
            }
        }

        if ($blacklist->id) {
            // บันทึกสำเร็จ
            return response()->json([
                'status_code' => 200,
                'message' => 'Record saved successfully.',
                'data' => [
                    'blacklist_id' => $blacklist->id,
                ]
            ], 200);
        } else {
            // บันทึกไม่สำเร็จ
            return response()->json([
                'status_code' => 500,
                'message' => 'Failed to save record.',
            ], 500);
        }
    }

    public function show($id) {
        $company = Company::find($id);
        if (!$company) {
            abort(404);
        }
        return view('admin.blacklist.show', compact('company'));
    }

    public function destroy($id) {
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

    // Edit
    public function edit($id) {
        $blacklist = Blacklist::with(['contactTransection.imageTransections', 'imageBlacklist'])
            ->find($id);

        if (!empty($blacklist->contact_transaction_id)) {
            $found = false;
            foreach ($blacklist->contactTransection->imageTransections as $k2 => $v2) {
                if ($v2->image_type_id === 4) {
                    $found = true;
                    $fullLogoUrl = public_path($v2->image_url);
                    if (file_exists($fullLogoUrl)) {
                        $blacklist->image_url = $v2->image_url;
                    } else {
                        $blacklist->image_url = "images/noimage.png";
                    }
                }

                if ($v2->image_type_id == 4) {
                    $found = true;
                }
            }
            // if ($found) {
            //     $fullLogoUrl = public_path($v2->image_url);
            //     if (file_exists($fullLogoUrl)) {
            //         $blacklist->image_url = $v2->image_url;
            //     } else {
            //         $blacklist->image_url = "images/noimage.png";
            //     }
            // } else {
            //     $blacklist->image_url = "images/noimage.png";
            // }
        } 
        else if (!empty($blacklist->image_blacklist_id)) {
            $fullLogoUrl = public_path($blacklist->imageBlacklist->image_url);
            if (file_exists($fullLogoUrl)) {
                $blacklist->image_url = $blacklist->imageBlacklist->image_url;
            } else {
                $blacklist->image_url = "images/noimage.png";
            }
        } else {
            $blacklist->image_url = "images/noimage.png";
        }

        return view('admin.blacklist.edit', compact('blacklist'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'note' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 422,
                'message' => $validator->errors(),
            ]);
        }

        $blacklist = Blacklist::find($id);
        $blacklist->update([
            "note" => $request->note
        ]);

        if ($blacklist->wasChanged()) {
            return response()->json([
                'status_code' => 200,
                'message' => 'update data successfully.',
            ], 200);
        } else {
            return response()->json([
                'status_code' => 422,
                'message' => 'update data failed.',
            ], 200);
        }
    }

    //หน้า Modal กด Blacklist
    public function contactBlacklist(Request $request) {
        $validator = Validator::make($request->all(), [
            'contact_id' => 'required|string',
            'type' => 'required|string',
        ]);

        $company_id = Auth::user()->company_id;

        if (1) { // ตรวจสอบค่าต่าง ๆ
            if ($validator->fails()) {
                return response()->json([
                    'status_code' => 422,
                    'message' => $validator->errors(),
                ], 422);
            }

            if (2) { // ตรวจสอบ company_id มีไหม
                $company = Company::find($company_id);
                if (empty($company)) {
                    return response()->json([
                        'status_code' => 901,
                        'message' => 'company is not.',
                    ], 200);
                }
            }

            if (3) { // ตรวจสอบ company_id และ contact_code ว่าตรงกันไหม
                $contact = ContactTransection::where('id', $request->contact_id)
                    ->where('company_id', $company_id)
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
            // return $contact;
            if ($request->type === "แบล็กลิสต์") {
                $blacklist = Blacklist::where('company_id', $company_id)
                    ->where('contact_transaction_id', $contact->id)
                    ->first();

                if ($blacklist) {
                    $blacklist->update([
                        'idcard' => $contact->idcard,
                        'fullname' => $contact->fullname,
                        'note' => !empty($request->note) ? $request->note : '',
                        'company_id' => $company_id,
                        'contact_transaction_id' => $contact->id,
                        'image_type' => 4,
                        'address' => $contact->address,
                        'car_registration' => $contact->vehicel_registration,
                        'from' => $contact->from,
                        'status' => 1,
                    ]);

                    return response()->json([
                        'status_code' => 200,
                        'message' => 'Blacklist updated successfully',
                    ], 200);
                } else {
                    Blacklist::create([
                        'idcard' => $contact->idcard,
                        'fullname' => $contact->fullname,
                        'note' => !empty($request->note) ? $request->note : '',
                        'company_id' => $company_id,
                        'contact_transaction_id' => $contact->id,
                        'image_type' => 1,
                        'address' => $contact->address,
                        'car_registration' => $contact->vehicel_registration,
                        'from' => $contact->from,
                        'status' => 1,
                    ]);

                    return response()->json([
                        'status_code' => 200,
                        'message' => 'Blacklist created successfully',
                    ], 200);
                }
            } else if ($request->type === "ยกเลิกแบล็กลิสต์") {
                $blacklist = Blacklist::where('company_id', $company_id)
                    ->where('contact_transaction_id', $contact->id)
                    ->first();

                if ($blacklist) {
                    $blacklist->update([
                        'status' => 0,
                    ]);

                    return response()->json([
                        'status_code' => 200,
                        'message' => 'Blacklist updated successfully',
                    ], 200);
                } else {
                    return response()->json([
                        'status_code' => 500,
                        'message' => "เกิดข้อผิดพลด blacklist",
                    ], 200);
                }

            } else {
                return response()->json([
                    'status_code' => 500,
                    'message' => "เกิดข้อผิดพลด type",
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    public function dashboardBlacklist(Request $request){

        if(request()->ajax()) {
            $company_id = Auth::user()->company_id;
            $index = $request->type == "blacklist" ? 1 : 0 ;
            $blacklist = Blacklist::where("company_id", $company_id)
                ->where("status", $index)
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
                                $data[$k]['image_url'] = $v2->image_url;
                            } else {
                                $data[$k]['image_url'] = "images/noimage.png";
                            }
                        }
                    }
                    
                    if ($found == false) {
                        $data[$k]['image_url'] = "images/noimage.png";
                    }
                } else if (!empty($v->image_blacklist_id)) {
                    $fullLogoUrl = public_path($v->imageBlacklist->image_url);
                    if (file_exists($fullLogoUrl)) {
                        $data[$k]['image_url'] = $v->imageBlacklist->image_url;
                    } else {
                        $data[$k]['image_url'] = "images/noimage.png";
                    }
                } else {
                    $data[$k]['image_url'] = "images/noimage.png";
                }
            }

            return DataTables::of($data)
                ->make(true);
        }

        return view('admin.blacklist.index');
    }

    public function deleteBlacklist(Request $request){

        $blacklist = Blacklist::find($request->id);
        if (!empty($blacklist)) {

            $blacklist->update([
                'status' => 0
            ]);

            if ($blacklist->wasChanged()) {
                return response()->json([
                    'status_code' => 200,
                    'message' => 'update data successfully.',
                ], 200);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'message' => 'update data failed.',
                ], 200);
            }
        } else {
            return response()->json([
                'status_code' => 422,
                'message' => 'get data no blacklist.',
            ], 200);
        }
    }
}
