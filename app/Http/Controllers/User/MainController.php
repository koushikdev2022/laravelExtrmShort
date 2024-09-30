<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use App\Models\UserMaster;
use App\Models\ExtendExpireDate;

class MainController extends Controller
{

    public function index(){
        return view('user.dashboard');
    }

    public function subscription(){
        $data=[];
        $user = auth()->guard('frontend')->user();
        $data['subscriptions']=SubscriptionPlan::where('status','1')->get();
        $data['user_subscriptions']=ExtendExpireDate::where('user_id',$user->id)->whereIn('status',['1','2'])->paginate('10');
        return view('user.subscription',$data);
    }

    public function upgrade_plan(Request $request){
        $data=[];
        $subscription=SubscriptionPlan::find($request->input('subscription_id'));
        $user = auth()->guard('frontend')->user();
        
            $time = strtotime(date('Y-m-d'));
            // $final = date("Y-m-d", strtotime("+1 month", $time));
            $input=[];
            $input['reference_id']='';
            $input['plan_id']=$subscription->plan_id;
            $input['user_id']=$user->id;
            $input['subscription_id']=$subscription->id;
            $input['start_date']=date('Y-m-d');
            $input['end_date']=date('Y-m-d', strtotime('+'.$subscription->interval_day.'day',$time));
            $input['amount']=$subscription->amount;
            $input['status']='1';
            ExtendExpireDate::create($input);

            $user_details=UserMaster::find($user->id);
            $user_details->update([
                'type_id'=>'3',
            ]);

            $data['status'] = "success";
            $data['message']="Subcription Plan Upgraded successfully";

        return response()->json($data);
    }

    public function message_view(){
        return view('user.message');
    }
   
}
