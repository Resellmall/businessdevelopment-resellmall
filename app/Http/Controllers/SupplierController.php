<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\State;
use App\Models\Subcategory1;
use App\Models\SupplierPlan;
use App\Models\SupplierType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use File;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('users')
                ->join('supplier_details', 'users.id', '=', 'supplier_details.user_id')
                ->select('users.*', 'supplier_details.created_by');
            if (!isAdmin()) {
                $query->where('supplier_details.created_by', session()->get('userId'));
            }
            $users = $query->orderBy('id', 'DESC')->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('user_status', function ($row) {
                    return ($row->user_status == 1) ?  "<a href='javascript:void(0)'><span class='badge label-table badge-success'>Active</span></a>" : "<a href='javascript:void(0)' ><span class='badge label-table badge-danger'>Inactive</span></a>";
                })
                ->addColumn('created_at', function ($row) {

                    return  Carbon::parse($row->created_at)->format('d-M-Y  h:i A');
                })
                ->addColumn('action', function ($row) {
                    $action = "<p class='m-0'><a href='javascript:void(0)' onClick='viewSupplier($row->id)' ><span class='badge label-table badge-primary'>View</span></a> <a href='/supplier/edit/$row->id'><span class='badge label-table badge-info'>Edit</span></a> <a class='delete-$row->id' href='javascript:void(0)' onClick='destroy($row->id)' ><span class='badge label-table badge-danger'>Delete</span></a></p>";
                    return $action;
                })
                ->rawColumns(['action', 'user_status', 'created_at'])
                ->make(true);
        }
        return view('supplier.list');
    }

    public function create()
    {
        $states = State::all();
        $supplierPlans = SupplierPlan::all();
        $supplerTypes = SupplierType::all();
        $categories = Category::all();
        return view('supplier.add', ['states' => $states, 'supplierPlans' => $supplierPlans, 'supplierTypes' => $supplerTypes, 'categories' => $categories]);
    }

    public function profile(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required | max:25 | min:3',
                'mobile' => 'required | digits:10',
                'email' => 'required | email | unique:users,email',
                'gender' => 'required',
                'dob' => 'required | date_format:Y-m-d',
                'image' => 'nullable|image|mimes:jpeg,png,jpg'
            ]);
            if ($validator->passes()) {
                return response()->json(['success' => 'success']);
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function kyc(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'brand_name' => 'required | max:30 | min:3',
                'poc_name' => 'required | max:25 | min:3',
                'poc_mobile' => 'required | digits:10',
                'gst_number' => 'required | max:15',
                'pan_number' => 'required | max:25',
                'gst_certificate' => 'required | file | mimes:jpg,png,pdf',
                'pan_card' => 'required | file | mimes:jpg,png,pdf'
            ]);

            if ($validator->passes()) {
                return response()->json(['success' => 'success']);
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function bank(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required | max:30 | min:3',
                'acholder_name' => 'required | max:25 | min:3',
                'account_number' => 'required | digits_between:11,18',
                'ifsc_code' => 'required | alpha_num | max:11 | min:5',
                'cancelled_cheque' => 'required | file | mimes:jpg,png,pdf'
            ]);

            if ($validator->passes()) {
                return response()->json(['success' => 'success']);
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function shipment(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'cod' => 'required',
                'return_type' => 'required',
                'exchange_type' => 'required',
                'sla_min' => 'required',
                'sla_max' => 'required'
            ]);

            if ($validator->passes()) {
                return response()->json(['success' => 'success']);
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function address(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'pickup_address' => 'required',
                'pickup_landmark' => 'required',
                'pickup_pincode' => 'required | digits:6',
                'pickup_city' => 'required',
                'pickup_state' => 'required',
                'pickup_country' => 'required',
                'address' => 'required',
                'landmark' => 'required',
                'pincode' => 'required | digits:6',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
            ]);

            if ($validator->passes()) {
                return response()->json(['success' => 'success']);
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function business(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make(
                $request->all(),
                [
                    //profile
                    'name' => 'required | max:25 | min:3',
                    'mobile' => 'required | digits:10',
                    'email' => 'required | email | unique:users,email',
                    'gender' => 'required',
                    'dob' => 'required | date_format:Y-m-d',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg',

                    //kyc
                    'brand_name' => 'required | max:30 | min:3',
                    'poc_name' => 'required | max:25 | min:3',
                    'poc_mobile' => 'required | digits:10',
                    'gst_number' => 'required | max:15',
                    'pan_number' => 'required | max:25',
                    'gst_certificate' => 'required | file | mimes:jpg,png,pdf',
                    'pan_card' => 'required | file | mimes:jpg,png,pdf',

                    //bank
                    'bank_name' => 'required | max:30 | min:3',
                    'acholder_name' => 'required | max:25 | min:3',
                    'account_number' => 'required | digits_between:11,18',
                    'ifsc_code' => 'required | alpha_num | max:11 | min:5',
                    'cancelled_cheque' => 'required | file | mimes:jpg,png,pdf',

                    //shipment
                    'cod' => 'required',
                    'return_type' => 'required',
                    'exchange_type' => 'required',
                    'sla_min' => 'required',
                    'sla_max' => 'required',

                    //address
                    'pickup_address' => 'required',
                    'pickup_landmark' => 'required',
                    'pickup_pincode' => 'required | digits:6',
                    'pickup_city' => 'required',
                    'pickup_state' => 'required',
                    'pickup_country' => 'required',
                    'address' => 'required',
                    'landmark' => 'required',
                    'pincode' => 'required | digits:6',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',

                    //business
                    'aggregator' => 'required',
                    'aggregator_commission' => 'required_if:aggregator,1',
                    'plan_id' => 'required',
                    'order_guarantee' => 'required',
                    'replica_supplier' => 'required',
                    'supplier_type' => 'required',
                    'primary_category' => 'required',
                    'secondary_category' => 'required'
                ],
                [
                    'aggregator_commission.required_if' => 'The aggregator commission field is required when aggregator is Yes.'
                ],
            );

            if ($validator->passes()) {

                $userName = Str::of($request->name)->slug('-');

                if ($request->hasFile('image')) {
                    $ext = $request->image->extension();
                    $imagePath = $request->file('image')->storeAs(
                        'profile',
                        $userName . "-" . time() . "." . $ext
                    );
                } else {
                    $imagePath = NULL;
                }

                if ($request->hasFile('gst_certificate')) {
                    $ext = $request->gst_certificate->extension();
                    $gstPath = $request->file('gst_certificate')->storeAs(
                        'gst',
                        $userName . "-GST-" . time() . "." . $ext
                    );
                }

                if ($request->hasFile('pan_card')) {
                    $ext = $request->pan_card->extension();
                    $panPath = $request->file('pan_card')->storeAs(
                        'pan',
                        $userName . "-PAN-" . time() . "." . $ext
                    );
                }

                if ($request->hasFile('cancelled_cheque')) {
                    $ext = $request->cancelled_cheque->extension();
                    $chequePath = $request->file('cancelled_cheque')->storeAs(
                        'cheque',
                        $userName . "-CHEQUE-" . time() . "." . $ext
                    );
                }

                DB::beginTransaction();
                try {
                    DB::table('users')->insert(
                        [
                            'name' => $request->name,
                            'mobile' =>  $request->mobile,
                            'email' => $request->email,
                            'password' => Hash::make($request->name . '@123'),
                            'gender' => $request->gender,
                            'image' => $imagePath,
                            'role_id' => 2,
                            'dob' => $request->dob,
                            'user_status' => 1,
                            'created_at' => Carbon::now()->toDateTimeString()
                        ]
                    );
                    $userId = DB::getPdo()->lastInsertId();

                    DB::table('user_addresses')->insert(
                        [
                            'user_id' => $userId,
                            'name' => $request->name,
                            'mobile' => $request->mobile,
                            'address' => $request->address,
                            'landmark' => $request->landmark,
                            'city' => $request->city,
                            'state_id' => $request->state,
                            'pincode' => $request->pincode,
                            'country_id' => $request->country,
                            'created_at' => Carbon::now()->toDateTimeString()
                        ]
                    );

                    DB::table('pickup_addresses')->insert(
                        [
                            'user_id' => $userId,
                            'name' => $request->name,
                            'mobile' => $request->mobile,
                            'address' => $request->pickup_address,
                            'landmark' => $request->pickup_landmark,
                            'city' => $request->pickup_city,
                            'state_id' => $request->pickup_state,
                            'pincode' => $request->pickup_pincode,
                            'country_id' => $request->pickup_country,
                            'created_at' => Carbon::now()->toDateTimeString()
                        ]
                    );


                    DB::table('supplier_details')->insert(
                        [
                            'user_id' => $userId,
                            'created_by' => session()->get('userId'),
                            'brand_name' => $request->brand_name,
                            'poc_name' => $request->poc_name,
                            'poc_mobile' => $request->poc_mobile,
                            'gst_number' => $request->gst_number,
                            'gst_certificate' => $gstPath,
                            'pan_number' => $request->pan_number,
                            'pan_card' => $panPath,
                            'bank_name' => $request->bank_name,
                            'acholder_name' => $request->acholder_name,
                            'account_number' => $request->account_number,
                            'ifsc_code' => $request->ifsc_code,
                            'cancelled_cheque' => $chequePath,
                            'cod' => $request->cod,
                            'return_type' => $request->return_type,
                            'exchange_type' => $request->exchange_type,
                            'sla_min' => $request->sla_min,
                            'sla_max' => $request->sla_max,
                            'aggregator' => $request->aggregator,
                            'aggregator_commission' => $request->aggregator_commission,
                            'plan_id' => $request->plan_id,
                            'order_guarantee' => $request->order_guarantee,
                            'replica_supplier' => $request->replica_supplier,
                            'supplier_type' => $request->supplier_type,
                            'primary_category' => $request->primary_category,
                            'secondary_category' => $request->secondary_category,
                            'created_at' => Carbon::now()->toDateTimeString()
                        ]
                    );
                    DB::commit();

                    // all good
                    $request->session()->flash('success', 'Supplier registration completed.');
                    return response()->json(['success' => 'success']);
                } catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong
                    Storage::delete([$imagePath, $gstPath, $panPath, $chequePath]);
                    return response()->json(['failed' => 'error']);
                }
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function edit(Request $request)
    {
        $userId = $request->id;
        $states = State::all();
        $supplierPlans = SupplierPlan::all();
        $supplerTypes = SupplierType::all();
        $categories = Category::all();
        $subcategory1s = Subcategory1::all();
        $user = User::findOrFail($userId);
        $userAddress = DB::table('user_addresses')->where('user_id', $userId)->first();
        $pickupAddress = DB::table('pickup_addresses')->where('user_id', $userId)->first();
        $supplierDetail = DB::table('supplier_details')->where('user_id', $userId)->first();
        return view('supplier.edit', ['states' => $states, 'user' => $user, 'userAddress' => $userAddress, 'pickupAddress' => $pickupAddress, 'supplierPlans' => $supplierPlans, 'supplierTypes' => $supplerTypes, 'categories' => $categories, 'subcategory1s' => $subcategory1s, 'supplierDetail' => $supplierDetail]);
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $userId = $request->id;
            $files = DB::table('users')
                ->join('supplier_details', 'supplier_details.user_id', '=', 'users.id')
                ->select('users.image', 'supplier_details.pan_card', 'supplier_details.gst_certificate', 'supplier_details.cancelled_cheque')
                ->where('users.id', $userId)
                ->first();
            DB::beginTransaction();
            try {
                DB::table('users')->where('id', $userId)->delete();
                DB::table('user_addresses')->where('user_id', $userId)->delete();
                DB::table('pickup_addresses')->where('user_id', $userId)->delete();
                DB::table('supplier_details')->where('user_id', $userId)->delete();
                DB::commit();
                // all good   
                if (Storage::exists($files->image)) {
                    Storage::delete($files->image);
                }
                if (Storage::exists($files->pan_card)) {
                    Storage::delete($files->pan_card);
                }
                if (Storage::exists($files->gst_certificate)) {
                    Storage::delete($files->gst_certificate);
                }
                if (Storage::exists($files->cancelled_cheque)) {
                    Storage::delete($files->cancelled_cheque);
                }
                return response()->json(['success' => 'success']);
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                return response()->json(['failed' => 'error']);
            }
        }
    }

    public function view(Request $request)
    {
        if ($request->ajax()) {
            $userId = $request->id;
            $user = DB::table('users')->where('id', $userId)->first();
            $userAddress = DB::table('user_addresses')
                ->join('states', 'states.id', '=', 'user_addresses.state_id')
                ->select('user_addresses.*', 'states.state')
                ->first();
            $pickupAddress = DB::table('pickup_addresses')
                ->join('states', 'states.id', '=', 'pickup_addresses.state_id')
                ->select('pickup_addresses.*', 'states.state')
                ->first();
            $supplierDetail = DB::table('supplier_details')->where('user_id', $userId)->first();

            if ($user && $userAddress && $pickupAddress && $supplierDetail) {
                $image =  ($user->image) ? asset('storage/' . $user->image) : asset('assets/images/dummy_logo.png');
                $pan_card = asset('storage/' . $supplierDetail->pan_card);
                $gst_certificate = asset('storage/' . $supplierDetail->gst_certificate);
                $cancelled_cheque = asset('storage/' . $supplierDetail->cancelled_cheque);
                $gender = ($user->gender == 1) ? 'Male' : 'Female';
                $modal = "<div class='row'>
                <div class='col-lg-3'>
                    <div class='info'>
                        <h4>Profile</h4>
                        <div class='text-center'>
                            <img src='$image'  width='100' height='100' class='rounded mb-2' alt='Image'>
                        </div>
                        <div class='infobx'><span>Name :</span> $user->name </div>
                        <div class='infobx'><span>Brand Name :</span> $supplierDetail->brand_name  </div>
                        <div class='infobx'><span>Mobile :</span> $user->mobile </div>
                        <div class='infobx'><span>Email :</span> $user->email </div>
                        <div class='infobx'><span>Gender :</span> $gender </div>
                        <div class='infobx'><span>DOB :</span> $user->dob </div>
                        <div class='infobx'><span>POC Name :</span> $supplierDetail->poc_name </div>
                        <div class='infobx'><span>POC Mobile :</span> $supplierDetail->poc_mobile  </div>
                    </div>
                </div>
                <div class='col-lg-9 rightbx'>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <h4>KYC Details</h4>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>GST Number :</span> $supplierDetail->gst_number </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>GST Certificate :</span> <a href='$pan_card' target='_blank'>Certificate</a>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>PAN Number :</span> $supplierDetail->pan_number  </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info border-none'>
                                <div class='infobx'><span>PAN Image :</span> <a href='$gst_certificate ' target='_blank'>Image</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <h4>Bank Details</h4>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Bank :</span> $supplierDetail->bank_name </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>A/c Holder :</span> $supplierDetail->acholder_name </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>A/c Number :</span> $supplierDetail->account_number </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info border-none'>
                                <div class='infobx'><span>IFSC Code :</span> $supplierDetail->ifsc_code </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Cancelled Check :</span> <a href='$cancelled_cheque' target='_blank'>Cancelled Check</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <h4>Shipment Details</h4>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>COD Option :</span>
                                    <select disabled>
                                        <option value='1' ($supplierDetail->cod == 1) ? 'selected' : '' >Available</option>
                                        <option value='1' ($supplierDetail->cod == 2) ? 'selected' : ''>Not Availab</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>SLA Min :</span>
                                    <select disabled>
                                        <option ($supplierDetail->sla_min == 24) ? 'selected' : ''>24 Hour</option>
                                        <option ($supplierDetail->sla_min == 48) ? 'selected' : ''>48 Hour</option>
                                        <option ($supplierDetail->sla_min == 72) ? 'selected' : ''>72 Hour</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>SLA Max :</span>
                                    <select disabled>
                                    <option ($supplierDetail->sla_max == 24) ? 'selected' : ''>24 Hour</option>
                                    <option ($supplierDetail->sla_max == 48) ? 'selected' : ''>48 Hour</option>
                                    <option ($supplierDetail->sla_max == 72) ? 'selected' : ''>72 Hour</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info border-none'>
                                <div class='infobx'><span>Return Type :</span>
                                    <select disabled>
                                    <option value='1' ($supplierDetail->return_type == 1) ? 'selected' : '' >Available</option>
                                    <option value='1' ($supplierDetail->return_type == 2) ? 'selected' : ''>Not Availab</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Exchange Type :</span>
                                    <select disabled>
                                    <option value='1' ($supplierDetail->exchange_type == 1) ? 'selected' : '' >Available</option>
                                    <option value='1' ($supplierDetail->exchange_type == 2) ? 'selected' : ''>Not Availab</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <h4>Pickup Address</h4>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Address :</span> $pickupAddress->address </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Landmark :</span> $pickupAddress->landmark </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Pincode :</span> $pickupAddress->pincode</div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info border-none'>
                                <div class='infobx'><span>City :</span> $pickupAddress->city </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>State :</span>
                                    <select disabled>
                                        <option selected> $pickupAddress->state </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Country :</span>
                                    <select disabled>
                                        <option selected>India</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <h4>Registered Address</h4>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Address :</span> $userAddress->address </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Landmark :</span> $userAddress->landmark </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Pincode :</span> $userAddress->pincode</div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info border-none'>
                                <div class='infobx'><span>City :</span> $userAddress->city </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>State :</span>
                                    <select disabled>
                                        <option selected>$userAddress->state</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Country :</span>
                                    <select disabled>
                                        <option selected>India</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class='row'>
                        <div class='col-lg-12'>
                            <h4>Business Details</h4>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Aggregator :</span>
                                    <select disabled>
                                    <option value='1' ($supplierDetail->aggregator == 1) ? 'selected' : '' >Yes</option>
                                    <option value='1' ($supplierDetail->aggregator == 2) ? 'selected' : ''>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Aggregator Commission :</span>
                                    <select disabled>
                                    <option value='1' ($supplierDetail->aggregator_commission == 5) ? 'selected' : '' >5 %</option>
                                    <option value='1' ($supplierDetail->aggregator_commission == 10) ? 'selected' : ''>10 %</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Plan :</span>
                                    <select disabled>
                                        <option selected>Plan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info border-none'>
                            <div class='infobx'><span>Order Guarantee :</span> $supplierDetail->order_guarantee </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Replica Supplier :</span>
                                    <select disabled>
                                    <option value='1' ($supplierDetail->replica_supplier == 1) ? 'selected' : '' >Yes</option>
                                    <option value='1' ($supplierDetail->replica_supplier == 2) ? 'selected' : ''>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Supplier Type :</span>
                                    <select disabled>
                                        <option selected>Supplier Type</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info'>
                                <div class='infobx'><span>Primary Category :</span>
                                    <select disabled>
                                        <option selected>Primary Category</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3'>
                            <div class='info border-none'>
                                <div class='infobx'><span>Secondary Category :</span>
                                    <select disabled>
                                        <option selected>Primary Category</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
                return response()->json(['success' => 'success', 'modal' => $modal]);
            } else {
                return response()->json(['failed' => 'failed']);
            }
        }
    }


    public function updateProfile(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required | max:25 | min:3',
                'mobile' => 'required | digits:10',
                'email' => ['required', Rule::unique('users')->ignore($request->hid)],
                'gender' => 'required',
                'dob' => 'required | date_format:Y-m-d',
                'image' => 'nullable|image|mimes:jpeg,png,jpg'
            ]);
            if ($validator->passes()) {

                $user = DB::table('users')->where('id', $request->hid)->first();
                $userName = Str::of($request->name)->slug('-');
                if ($request->hasFile('image')) {
                    $ext = $request->image->extension();
                    $imagePath = $request->file('image')->storeAs(
                        'profile',
                        $userName . "-" . time() . "." . $ext
                    );
                } else {
                    $imagePath = $user->image;
                }

                DB::beginTransaction();
                try {
                    DB::table('users')
                        ->where('id', $request->hid)
                        ->update([
                            'name' => $request->name,
                            'mobile' => $request->mobile,
                            'email' => $request->email,
                            'gender' => $request->gender,
                            'dob' => $request->dob,
                            'image' => $imagePath,
                            'action_id' => session()->get('userId'),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);

                    DB::commit();
                    // all good
                    if ($request->hasFile('image')) {
                        Storage::delete($user->image);
                    }
                    return response()->json(['success' => 'success']);
                } catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong
                    if (Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                    return response()->json(['failed' => 'error']);
                }
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function updateKyc(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'brand_name' => 'required | max:30 | min:3',
                'poc_name' => 'required | max:25 | min:3',
                'poc_mobile' => 'required | digits:10',
                'gst_number' => 'required | max:15',
                'pan_number' => 'required | max:25',
                'gst_certificate' => 'nullable | file | mimes:jpg,png,pdf',
                'pan_card' => 'nullable | file | mimes:jpg,png,pdf'
            ]);
            if ($validator->passes()) {
                $supplierDetail = DB::table('supplier_details')
                    ->join('users', 'users.id', '=', 'supplier_details.user_id')
                    ->select('supplier_details.*', 'users.name')
                    ->where('supplier_details.user_id', $request->hid)
                    ->first();
                $userName = Str::of($supplierDetail->name)->slug('-');
                if ($request->hasFile('gst_certificate')) {
                    $ext = $request->gst_certificate->extension();
                    $gstPath = $request->file('gst_certificate')->storeAs(
                        'gst',
                        $userName . "-" . time() . "." . $ext
                    );
                } else {
                    $gstPath = $supplierDetail->gst_certificate;
                }

                if ($request->hasFile('pan_card')) {
                    $ext = $request->pan_card->extension();
                    $panPath = $request->file('pan_card')->storeAs(
                        'pan',
                        $userName . "-" . time() . "." . $ext
                    );
                } else {
                    $panPath = $supplierDetail->pan_card;
                }

                DB::beginTransaction();
                try {
                    DB::table('supplier_details')
                        ->where('user_id', $request->hid)
                        ->update([
                            'brand_name' => $request->brand_name,
                            'poc_name' => $request->poc_name,
                            'poc_mobile' => $request->poc_mobile,
                            'pan_number' => $request->pan_number,
                            'gst_number' => $request->gst_number,
                            'pan_card' => $panPath,
                            'gst_certificate' => $gstPath,
                            'action_id' => session()->get('userId'),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);

                    DB::commit();
                    // all good
                    if ($request->hasFile('gst_certificate')) {
                        Storage::delete($supplierDetail->gst_certificate);
                    }
                    if ($request->hasFile('pan_card')) {
                        Storage::delete($supplierDetail->pan_card);
                    }
                    return response()->json(['success' => 'success']);
                } catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong
                    if (Storage::exists($gstPath)) {
                        Storage::delete($gstPath);
                    }
                    if (Storage::exists($panPath)) {
                        Storage::delete($panPath);
                    }
                    return response()->json(['failed' => 'error']);
                }
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function updateBank(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required | max:30 | min:3',
                'acholder_name' => 'required | max:25 | min:3',
                'account_number' => 'required | digits_between:11,18',
                'ifsc_code' => 'required | alpha_num | max:11 | min:5',
                'cancelled_cheque' => 'nullable | file | mimes:jpg,png,pdf'
            ]);
            if ($validator->passes()) {
                $supplierDetail = DB::table('supplier_details')
                    ->join('users', 'users.id', '=', 'supplier_details.user_id')
                    ->select('supplier_details.*', 'users.name')
                    ->where('supplier_details.user_id', $request->hid)
                    ->first();
                $userName = Str::of($supplierDetail->name)->slug('-');
                if ($request->hasFile('cancelled_cheque')) {
                    $ext = $request->cancelled_cheque->extension();
                    $chequePath = $request->file('cancelled_cheque')->storeAs(
                        'cheque',
                        $userName . "-" . time() . "." . $ext
                    );
                } else {
                    $chequePath = $supplierDetail->cancelled_cheque;
                }

                DB::beginTransaction();
                try {
                    DB::table('supplier_details')
                        ->where('user_id', $request->hid)
                        ->update([
                            'bank_name' => $request->bank_name,
                            'acholder_name' => $request->acholder_name,
                            'account_number' => $request->account_number,
                            'ifsc_code' => $request->ifsc_code,
                            'cancelled_cheque' => $chequePath,
                            'action_id' => session()->get('userId'),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);

                    DB::commit();
                    // all good
                    if ($request->hasFile('cancelled_cheque')) {
                        Storage::delete($supplierDetail->cancelled_cheque);
                    }
                    return response()->json(['success' => 'success']);
                } catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong
                    if (Storage::exists($chequePath)) {
                        Storage::delete($chequePath);
                    }

                    return response()->json(['failed' => 'error']);
                }
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function updateShipment(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'cod' => 'required',
                'return_type' => 'required',
                'exchange_type' => 'required',
                'sla_min' => 'required',
                'sla_max' => 'required'
            ]);
            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    DB::table('supplier_details')
                        ->where('user_id', $request->hid)
                        ->update([
                            'cod' => $request->cod,
                            'sla_min' => $request->sla_min,
                            'sla_max' => $request->sla_max,
                            'return_type' => $request->return_type,
                            'exchange_type' => $request->exchange_type,
                            'action_id' => session()->get('userId'),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);

                    DB::commit();
                    // all good                                      
                    return response()->json(['success' => 'success']);
                } catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong                    
                    return response()->json(['failed' => 'error']);
                }
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function updateAddress(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'pickup_address' => 'required',
                'pickup_landmark' => 'required',
                'pickup_pincode' => 'required | digits:6',
                'pickup_city' => 'required',
                'pickup_state' => 'required',
                'address' => 'required',
                'landmark' => 'required',
                'pincode' => 'required | digits:6',
                'city' => 'required',
                'state' => 'required',
            ]);
            if ($validator->passes()) {
                $user = DB::table('users')->where('id', $request->hid)->first();
                DB::beginTransaction();
                try {
                    DB::table('pickup_addresses')
                        ->where('user_id', $request->hid)
                        ->update([
                            'name' => $user->name,
                            'mobile' => $user->mobile,
                            'address' => $request->pickup_address,
                            'landmark' => $request->pickup_landmark,
                            'pincode' => $request->pickup_pincode,
                            'city' => $request->pickup_city,
                            'state_id' => $request->pickup_state,
                            'action_id' => session()->get('userId'),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);

                    DB::table('user_addresses')
                        ->where('user_id', $request->hid)
                        ->update([
                            'name' => $user->name,
                            'mobile' => $user->mobile,
                            'address' => $request->address,
                            'landmark' => $request->landmark,
                            'pincode' => $request->pincode,
                            'city' => $request->city,
                            'state_id' => $request->state,
                            'action_id' => session()->get('userId'),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);

                    DB::commit();
                    // all good                                      
                    return response()->json(['success' => 'success']);
                } catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong                    
                    return response()->json(['failed' => 'error']);
                }
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function updateBusiness(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make(
                $request->all(),
                [
                    'aggregator' => 'required',
                    'aggregator_commission' => 'required_if:aggregator,1',
                    'plan_id' => 'required',
                    'order_guarantee' => 'required',
                    'replica_supplier' => 'required',
                    'supplier_type' => 'required',
                    'primary_category' => 'required',
                    'secondary_category' => 'required'
                ],
                [
                    'aggregator_commission.required_if' => 'The aggregator commission field is required when aggregator is Yes.'
                ],
            );
            if ($validator->passes()) {

                DB::beginTransaction();
                try {

                    DB::table('supplier_details')
                        ->where('user_id', $request->hid)
                        ->update([
                            'aggregator' => $request->aggregator,
                            'aggregator_commission' => $request->aggregator_commission,
                            'plan_id' => 1,
                            'order_guarantee' => $request->order_guarantee,
                            'replica_supplier' => $request->replica_supplier,
                            'supplier_type' => $request->supplier_type,
                            'primary_category' => $request->primary_category,
                            'secondary_category' => $request->secondary_category,
                            'action_id' => session()->get('userId'),
                            'updated_at' => Carbon::now()->toDateTimeString()
                        ]);

                    DB::commit();
                    // all good                                      
                    return response()->json(['success' => 'success']);
                } catch (\Exception $e) {
                    DB::rollback();
                    // something went wrong                    
                    return response()->json(['failed' => 'error']);
                }
            }
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function subcategory1(Request $request)
    {
        if ($request->ajax()) {
            $categoryId = $request->categoryId;
            $subcategory1s = DB::table('subcategory1s')->where('category_id', $categoryId)->get();
            $data = "<option value='' selected>Select Secondary Category</option>";
            foreach ($subcategory1s as $subcategory) {
                $data .= "<option value='$subcategory->id'>$subcategory->name</option>";
            }
            return $data;
        }
    }
}
