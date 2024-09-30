<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use App\Traits\HelperTrait;

use App\Models\SubscriptionPlan;
use App\Models\Country;
use App\Models\UserSubscription;

class SubscrptionController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    use HelperTrait;

    public function index() {
        $data = [];
        return view('admin::subscription.index', $data);
    }

    public function add_index() {
         $data = [];
         return view('admin::subscription.create', $data);
    }

    public function post_create(Request $request) {
        $data = [];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'currency' => 'required',
            'duration' => 'required',
            'interval_day' => 'required',
            'plan_text' => 'required',
        ]);
        if($validator->passes()) {
            $input=[];
            $input['name']=$request->input('name');
            $input['plan_id']='price_1'.$this->rand_string(23);
            $input['amount']=$request->input('amount');
            $input['currency']=$request->input('currency');
            $input['duration']=$request->input('duration');
            $input['interval_day']=$request->input('interval_day');
            $input['plan_text']=$request->input('plan_text');
            $input['status']='1';
            SubscriptionPlan::create($input);
            $request->session()->flash('success', 'Plan created successfully.');
            return view('admin::subscription.index');
        }else{
            return redirect()->route('admin-addsunscriptionplan')->withErrors($validator)->withInput();
        }
    }

    public function plan_list()
    {
        $plan_list = SubscriptionPlan::where('status', '<>', '3');
        return Datatables::of($plan_list)
            ->addIndexColumn()
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('amount', function ($model) {
                return $model->amount;
            })
            ->editColumn('currency', function ($model) {
                return $model->currency;
            })
            ->editColumn('duration', function ($model) {
                return $model->duration;
            })
            ->editColumn('total_number', function ($model) {
                return $model->total_number;
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-editsunscriptionplan', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                        . '<i class="fa fa-edit"></i>'
                        . '</a>'
                        . '<a href="javascript:;" data-tbl="subscription"   data-href="' . Route('admin-deletesunscriptionplan', [base64_encode($model->id)]) . '" data-title="Plan" onclick="deleteObject(this);" class="btn btn-outline btn-circle btn-sm dark">'
                        . '<i class="fa fa-trash"></i>'
                        . '</a>';
                       
                // $action_html="";
                return $action_html;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data=[];
        $data['model'] = $model = SubscriptionPlan::find($id);
        return view('admin::subscription.update', $data);
    }

    public function update(Request $request,$id)
    {

        $data = [];
        $model = SubscriptionPlan::find($id);

        $validator = Validator::make($request->all(), [
                    'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    'status' => 'required',
                    'plan_id' => 'required',
                    'plan_text' => 'required',
        ]);
        
        if($validator->passes()) {
            $model->amount = $request->amount;
            $model->status = $request->status;
            $model->plan_id = $request->plan_id;
            $model->plan_text = $request->plan_text;
            $model->save();
            $request->session()->flash('success', 'Plan updated successfully.');
            return redirect()->route('admin-subscriptionplan')->withErrors($validator)->withInput();
        }else{
            return redirect()->route('admin-editsunscriptionplan', ['id' => $id])->withErrors($validator)->withInput();
        }
    }

    public function destroy($id)
    {
        $data = [];
        $sid = base64_decode($id);
        $model = SubscriptionPlan::where('id', $sid)->where('status', '<>', '3')->first();
        if (!empty($model)) {
            $model->update(['status' => '3']);
            $data['msg'] = 'Plan deleted successfully.';
            $data['status'] = 200;
        } else {
            $data['msg'] = 'Plan details not found.';
        }
        return response()->json($data);
    }

 }
