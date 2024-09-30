<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\{Validator, Auth, Hash};
use App\Models\{UserMaster, Language, Country};
use App\Models\UserDetail;
use App\Models\UserDocument;
use App\Models\UserVerification;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use App\Models\ExtendExpireDate;
use App\Traits\HelperTrait;
use Carbon\Carbon;
use File;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends AdminController
{

    use HelperTrait;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [];
        return view('admin::users.user.client_index', $data);
    }

    public function professional_index()
    {
        $data = [];
        $data['subscriptions'] = SubscriptionPlan::where('status', '1')->get();
        return view('admin::users.user.professional_index', $data);
    }

    public function user_list()
    {
        $user_list = UserMaster::where('type_id', '=', '2')->where('status', '<>', '3');
        return DataTables::of($user_list)
            ->addIndexColumn()
          
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('email', function ($model) {
                return $model->email;
            })
            ->editColumn('user_verifications', function ($model) {
                return  $model->user_verifications ;
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->editColumn('last_login', function ($model) {
                if ($model->last_login == NULL) {
                    return 'N/A';
                } else {
                    return date("jS M Y, g:i A", strtotime($model->last_login));
                }
            })
            ->addColumn('action', function ($model) {
                // if ($model->status === '1') {
                // $action_html = '<a href="' . url('user-profile/' . base64_encode($model->id)) . '" target="_blank" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                //     . '<i class="fa fa-eye" aria-hidden="true"></i>'
                //     . '</a>';
                // } else {


                $action_html = '<a href="' . Route('admin-viewuser', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                    . '<i class="fa fa-eye" aria-hidden="true"></i>'
                    . '</a>';

                // }
                $action_html .= '<a href="' . Route('admin-updateuser', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                    . '<i class="fa fa-edit"></i>'
                    . '</a>'
                    // . '<a href="' . Route('admin-message', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                    // . '<i class="fa fa-envelope" aria-hidden="true"></i>'
                    // . '</a>'
                    // . '<a href="' . Route('user-documents.index') . '?uid=' . base64_encode($model->id) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Certificate">'
                    // . '<i class="fa fa-file-text" aria-hidden="true"></i>'
                    // . '</a>'
                    . '<a href="javascript:void(0);" onclick="deleteUser(this);" data-href="' . Route("admin-deleteuser", ['id' => base64_encode($model->id)]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                    . '<i class="fa fa-trash"></i>'
                    . '</a>';
                // . '<a href="' . Route('admin-updateuser', ['id' => base64_encode($model->id)]) . '"  class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Flag">'
                // . '<i class="fa fa-flag" aria-hidden="true"></i>'
                // . '</a>';
                return $action_html;
            })
            ->make(true);
    }

    public function professional_list()
    {
        $professional_list = UserMaster::where('type_id', '=', '3')->where('status', '<>', '3');
        return DataTables::of($professional_list)
            ->addIndexColumn()
            // ->editColumn('type_id', function ($model) {
            //     return $model->type_id === '2' ? 'Client' : 'Professional';
            // })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            // ->editColumn('last_name', function ($model) {
            //     return $model->last_name;
            // })
            ->editColumn('phone', function ($model) {
                return $model->phone;
            })
            ->editColumn('city', function ($model) {
                return $model->city;
            })
            ->editColumn('active', function ($model) {
                return !empty($model->status) && $model->status === '1' ? 'Yes' : 'No';
            })
            ->editColumn('verified', function ($model) {
                return !empty($model->verification) && $model->verification->profile === '1' ? 'Yes' : 'No';
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })

            // ->editColumn('expire_date', function ($model) {
            //     return !empty($model->subscription->end_date)  ? date("jS M Y", strtotime($model->subscription->end_date))  : 'No subscription';
            // })

            ->editColumn('expire_date', function ($model) {
                if (!empty($model->subscription->subscription_id)) {
                    $ExtendExpireDate = ExtendExpireDate::where('subscription_id', $model->subscription->subscription_id)->where('user_id', $model->id)->orderBy('id', 'DESC')->first();
                    if (!empty($ExtendExpireDate->end_date)) {
                        return date("jS M Y", strtotime($ExtendExpireDate->end_date));
                    } else {
                        return 'Not Given';
                    }
                } else {
                    return 'Not Given';
                }
            })

            ->editColumn('subscription_payments', function ($model) {
                if (!empty($model->subscription->subscription_id)) {

                    $str = '';
                    $ExtendExpireDate = ExtendExpireDate::where('subscription_id', $model->subscription->subscription_id)->where('user_id', $model->id)->get();
                    foreach ($ExtendExpireDate as $e) {
                        $str .= '<p>$' . $e->amount . ' ' . date("d.m.y", strtotime($e->start_date)) . '</p><br>';
                    }
                    return $str;
                } else {
                    return 'Not Given';
                }
            })

            ->editColumn('tasks', function ($model) {
                return 'Not Given';
            })
            ->editColumn('accepted', function ($model) {
                return 'Not Given';
            })
            ->editColumn('reviews', function ($model) {
                return 'Not Given';
            })
            ->editColumn('totalspent', function ($model) {
                return 'Not Given';
            })
            ->editColumn('paid_unpaid', function ($model) {

                if (!empty($model->subscription->subscription_id)) {
                    $paid_unpaid_html = '';
                    $ExtendExpireDate = ExtendExpireDate::where('subscription_id', $model->subscription->subscription_id)->where('user_id', $model->id)->where('end_date', '>', date("Y-m-d"))->orderBy('id', 'DESC')->limit(1)->first();
                    if (!empty($ExtendExpireDate) && $ExtendExpireDate->payment_status == 1) {
                        $paid_unpaid_html .= '<a href="javascript:void(0);" onclick="paid_unpaid_plan(' . $model->subscription->subscription_id . ',' . $model->id . ',' . $ExtendExpireDate->payment_status . ');"  data-subscription="' . $model->subscription->subscription_id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Unpaid">'
                            . 'Unpaid'
                            . '</a>';
                    } elseif (!empty($ExtendExpireDate) && $ExtendExpireDate->payment_status == 0) {
                        $paid_unpaid_html .= '<a href="javascript:void(0);" onclick="paid_unpaid_plan(' . $model->subscription->subscription_id . ',' . $model->id . ',' . $ExtendExpireDate->payment_status . ');"  data-subscription="' . $model->subscription->subscription_id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Paid">'
                            . 'Paid'
                            . '</a>';
                    }
                    return $paid_unpaid_html;
                } else {
                    return 'Not Given';
                }
            })
            // ->editColumn('deactivate', function ($model) {
            //     return !empty($model->subscription->status) && ($model->subscription->status=='1')  ? '$'.$model->subscription->status : 'No subscription';
            // })
            ->addColumn('action', function ($model) {
                // if ($model->status === '1') {
                // $action_html = '<a href="' . url('user-profile/' . base64_encode($model->id)) . '" target="_blank" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                //     . '<i class="fa fa-eye" aria-hidden="true"></i>'
                //     . '</a>';
                // } else {
                $action_html = '<a href="' . Route('admin-viewuser', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                    . '<i class="fa fa-eye" aria-hidden="true"></i>'
                    . '</a>';
                // }
                $action_html .= '<a href="' . Route('admin-updateuser', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                    . '<i class="fa fa-edit"></i>'
                    . '</a>'
                    // . '<a href="' . Route('admin-message', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                    // . '<i class="fa fa-envelope" aria-hidden="true"></i>'
                    // . '</a>'
                    // . '<a href="' . Route('user-documents.index') . '?uid=' . base64_encode($model->id) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Certificate">'
                    // . '<i class="fa fa-file-text" aria-hidden="true"></i>'
                    // . '</a>'
                    . '<a href="javascript:void(0);" onclick="deleteUser(this);" data-href="' . Route("admin-deleteuser", ['id' => base64_encode($model->id)]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                    . '<i class="fa fa-trash"></i>'
                    . '</a>';
                if (!empty($model->subscription->subscription_id)) {
                    $action_html .= '<a href="javascript:void(0);" onclick="extend_plan(this);" data-id="' . $model->id . '" data-subscription="' . $model->subscription->subscription_id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Extend expire date">'
                        . '<i class="fa fa-hand-peace-o" aria-hidden="true"></i>'
                        . '</a>';
                }

                return $action_html;
            })
            ->rawColumns(['action', 'subscription_payments', 'paid_unpaid'])
            ->make(true);
    }

    public function add()
    {
        $data = [];
        return view('admin::users.user.create', $data);
    }

    public function post_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|in:2,3',
            'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        $validator->after(function ($validator) use ($request) {
            $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->first();
            if (!empty($other_user)) {
                $validator->errors()->add('email', 'Email id already in use.');
            }
        });
        if ($validator->passes()) {

           
            $IP = request()->ip();
            $input = new UserMaster;
            $input->type_id = $request->type_id;
            $input->first_name = $request->first_name;
            $input->last_name = $request->last_name;
            $input->password = Hash::make($request->password);
            $input->email = $request->email;
            $input->ip_address = $IP;
            $input->email_verification = '1';
            $input->status = '1';
            $input->created_by = Auth()->guard('backend')->user()->id;
            $input->save();
            ///Detail
            UserDetail::create(['user_id' => $input->id]);
            ///Verification
            $input->verification()->update([
                'user_id' => $input->id,
                'email_address' => "1",
            ]);
            $email_setting = $this->get_email_data('user_registration_by_admin', array('NAME' => $request->first_name . " " . $request->last_name, 'EMAIL' => $request->email, 'PASSWORD' => $request->password));
            $email_data = [
                'to' => $request->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMailBySwiftMailer($email_data);
            $request->session()->flash('success', 'User added successfully.');
        } else {
            return redirect()->route('admin-adduser')->withErrors($validator)->withInput();
        }
        return redirect()->route('admin-user')->withErrors($validator)->withInput();
    }

    public function edit($id)
    {
        $data = [];
        $id = base64_decode($id);
        $data['model'] = $model = UserMaster::findOrFail($id);
        $data['countries'] = Country::where('status', '1')->get();
        $data['languages'] = Language::where('status', '1')->get();
        if (!empty($model)) {
            return view('admin::users.user.update', $data);
        }
        return redirect()->route('admin-user')->with('danger', 'Sorry!No user details found.');
    }

    public function post_update(Request $request, $id)
    {
        // return 'testing';

        $data = [];
        // $id = base64_decode($id);
        $model = UserMaster::find($id);
        $validator = Validator::make($request->all(), [
            // 'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            // 'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
           // 'username' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email||max:255',
            'status' => 'required',
        ]);
        // return 'testing';
        $validator->after(function ($validator) use ($request, $id) {
            $other_user = UserMaster::where('email', $request->input('email'))->where('id', '<>', $id)->where('status', '<>', '3')->first();
            $other_username = UserMaster::where('username', $request->input('username'))->where('id', '<>', $id)->where('status', '<>', '3')->first();
            if (!empty($other_user)) {
                $validator->errors()->add('email', 'Email id already in use.');
            }
            // if (!empty($other_username)) {
            //     $validator->errors()->add('username', 'Username is already in use.');
            // }
        });
        if ($validator->passes()) {

            if ($request->has('profile_picture')) {
                $folder = "profile_picture";
                $input['new_profile_picture'] = $this->imageUpload($request, 'profile_picture', $folder, $model);
                $model->profile_picture = $input['new_profile_picture'];
            }

            $model->first_name = $request->first_name;
            $model->last_name = $request->last_name;
            $model->username = $request->username;
            $model->email = $request->email;
            $model->status = $request->status;
            $model->user_verifications = $request->user_verifications;
            $model->updated_at = Carbon::now();
            $model->save();
             $request->session()->flash('success', 'User updated successfully.');
            // return 'success';
            return redirect()->route('admin-user');
        } else {
            // return 'failed' . $validator->errors();
            return redirect()->route('admin-updateuser', ['id' => base64_encode($id)])->withErrors($validator)->withInput();
        }
    }

    function imageUpload(Request $request, $fname, $folder, $model)
    {
        if ($request->hasFile($fname)) {  //check the file present or not
            if ($model != '') {
                if (file_exists(public_path('uploads/frontend/' . $folder . '/original/' . $model->$folder))) {
                    File::delete(public_path('uploads/frontend/' . $folder . '/original/' . $model->$folder));
                    File::delete(public_path('uploads/frontend/' . $folder . '/preview/' . $model->$folder));
                    File::delete(public_path('uploads/frontend/' . $folder . '/thumb/' . $model->$folder));
                }
            }
            $image = $request->file($fname); //get the file
            $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/frontend/' . $folder . '/original/'); //public path folder dir
            $path = public_path('uploads/frontend/' . $folder . '/');
            Image::make($image->getRealPath())->resize(300, 200)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            return $name;
        }
    }

    public function user_verify(Request $request, $id)
    {
        $data = [];
        $id = base64_decode($id);
        $model = UserVerification::where('user_id', $id)->first();
        // dd($model);
        if ($model->profile == 0) {
            $model->profile = '1';
            $model->save();
            $request->session()->flash('success', 'User verified successfully.');
        } else {
            $model->profile = '0';
            $model->save();
            $request->session()->flash('success', 'User Unverified successfully.');
        }
        return redirect()->route('admin-viewuser', ['id' => base64_encode($id)]);
    }

    public function view($id)
    {
        $data = [];
        $id = base64_decode($id);
        $data['model'] = UserMaster::find($id);
        if (!empty($data['model'])) {
            $data['country_name'] = isset($data['model']->countryDetail->country_name) ? $data['model']->countryDetail->country_name : '';
            $data['identity_documents'] = UserDocument::where(['user_id' => $id, 'document_type' => '2'])->latest()->get();
            $data['documents'] = UserDocument::where(['user_id' => $id])->whereIn('document_type', ['11', '12', '13'])->latest()->get();
            // $data['business_documents'] = UserDocument::where(['user_id' => $id])->whereIn('document_type', ['6', '7', '8'])->latest()->get();
            // $data['certificates'] = UserDocument::where(['user_id' => $id, 'document_type' => '9'])->latest()->get();
            // $data['business_audit'] = UserDocument::where(['user_id' => $id, 'document_type' => '10'])->latest()->first();
            return view('admin::users.user.view', $data);
        }
        return redirect()->route('admin-user');
    }

    public function delete(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $id = base64_decode($_GET['id']);
            $model = UserMaster::findOrFail($id);
            if (!empty($model) && $model->status != '3') {
                $model->delete();
                // $model->status = '3';
                // $model->save();
                $request->session()->flash('success', 'User deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-user');
    }


    public function extend_expire_date(Request $request)
    {
        $user_id = $request->input('user_id');
        $subscription_id = $request->input('subscription_id');
        $amount = $request->input('amount');
        // $end_date = $request->input('end_date');
        // dd($subscription_id);
        // $model = UserSubscription::where('user_id',$user_id)->where('status','2')->first();
        // dd($model);
        $subscription = SubscriptionPlan::where('id', $subscription_id)->first();
        $ExtendExpireDate = ExtendExpireDate::where('subscription_id', $subscription_id)->where('user_id', $user_id)->orderBy('id', 'DESC')->limit('1')->first();
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            // 'end_date' => 'required',
        ]);
        if ($validator->passes()) {
            // if (!empty($model)) {
            $input = [];
            $time = strtotime($ExtendExpireDate->end_date);
            $input['plan_id'] = $subscription->plan_id;
            $input['user_id'] = $user_id;
            $input['subscription_id'] = $subscription->id;
            $input['amount'] = $amount;
            $input['start_date'] = date('Y-m-d');
            $input['end_date'] = date('Y-m-d', strtotime('+' . $subscription->interval_day . 'day', $time));;
            $input['status'] = '1';
            ExtendExpireDate::create($input);
            $data['status'] = 200;
            $data['message'] = "Extend expire date successfully.";
            return response()->json($data);
            // } else {
            //     $data['message'] = "Oops. Something went wrong.";
            //     $data['status'] = 422;
            //     return response()->json($data);
            // }
        } else {
            return response()->json(['error' => $validator->errors()], 422);
        }
    }

    public function paid_unpaid_subscription(Request $request)
    {
        $data = [];
        $user_id = $request->input('user_id');
        $subscription_id = $request->input('subscription_id');
        $payment_status = $request->input('payment_status');
        $ExtendExpireDate = ExtendExpireDate::where('subscription_id', $subscription_id)->where('user_id', $user_id)->orderBy('id', 'DESC')->limit('1')->first();
        if ($ExtendExpireDate->end_date > date("Y-m-d")) {

            if (!empty($ExtendExpireDate)) {
                if ($payment_status == 0) {
                    $ExtendExpireDate->payment_status = '1';
                    $ExtendExpireDate->save();
                    $data['status'] = 200;
                    $data['message'] = "Amount Paid successfully.";
                    return response()->json($data);
                } elseif ($payment_status == 1) {
                    $ExtendExpireDate->payment_status = '0';
                    $ExtendExpireDate->save();
                    $data['status'] = 200;
                    $data['message'] = "Amount Unpaid successfully.";
                    return response()->json($data);
                }
            }
        } else {
            $data['status'] = 404;
            $data['message'] = "Please Extand expire date first.";
            return response()->json($data);
        }
    }
}
