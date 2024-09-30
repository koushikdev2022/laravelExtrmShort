<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\UserServices;
use DataTables;
use Carbon\Carbon;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Session;

class SupportController extends Controller
{
    use HelperTrait;
    public function support()
    {
        $data = [];
        $id = auth()->guard('frontend')->user()->id;
        $data['open_tickets'] = Support::where('user_id', $id)->where('status', '=', '1')->count();
        $data['close_tickets'] = Support::where('user_id', $id)->where('status', '=', '2')->count();
        $data['support_tickets'] = Support::where('user_id', $id)->count();
        $data['supports'] = Support::where('user_id', $id)->get();
        return view('user.support', $data);
    }

    public function showTickets(Request $request,$id)
    {
        $data = [];
        $id=base64_decode($id);
        $data['support'] = Support::where('id', $id)->first();
        return view('user.show-tickets', $data);
    }

    public function store(Request $request)
    {
        $user = auth()->guard('frontend')->user();
        // if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'subject' => 'required',
                'description' => 'required',
            ]);
            if ($validator->passes()) {
            $support = Support::create([
                'ticket_id' => $this->rand_number(8),
                'subject' => $request->subject,
                'description' => $request->description,
                'user_id' => $user->id,
                'status' => "1",
            ]);
            // $data['msg'] = "Ticket Added Successfully";
            // $data['link'] = route('user.support');
            // $data['status'] = "success";
            // return response()->json($data);

            Session::flash('message', 'Ticket Added Successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect('user/support');
            }else{
                return response()->json(['error' => $validator->errors()], 422);
            }
        // }
    }

    public function check_support_form($request)
    {
        $data = [];
        $validator = Validator::make($request->all(),  [
            'category'   => 'required',
            'order' => 'required',
            'subject'   => 'required',
            'description' => 'required',
            'other_category' => "required_if:category,==,Other"
        ]);
        if ($validator->fails()) {
            $data['errors'] = $validator->errors()->getMessages();
            $data['status'] = 422;
        }
        return $data;
    }
}
