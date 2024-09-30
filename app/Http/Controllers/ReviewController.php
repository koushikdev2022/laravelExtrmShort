<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Project;
use DataTables;
use Carbon\Carbon;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
class ReviewController extends Controller
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
                'score' => 'required',
                'message' => 'required',
            ]);
            if ($validator->passes()) {
            $project=Project::find($request->project_id);

            $review = DB::table('reviews')->where('user_id', $user->id)->where('client_id', $project->user_id)->where('status', '<>', '3')->first();

            if(empty($review)){
                    $save = DB::table('reviews')->insert([
                        'user_id' => $user->id,
                        'client_id' => $project->user_id,
                        'score' => $request->score,
                        'message' => $request->message,
                        'status' => "0",
                    ]);

                $data['msg'] = "Review added successfully showing after apporovel.";

                return redirect('task_details/'.base64_encode($project->id));

            }else{
                $data['msg'] = "Review already submited.";
                return redirect('task_details/'.base64_encode($project->id));
            }

            return response()->json($data);

            }else{
                return response()->json(['error' => $validator->errors()], 422);
            }

        // }else{
        //     echo 'ts';
        // }

    }

    public function review_store(Request $request)
    {
        $user = auth()->guard('frontend')->user();
        // if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'score' => 'required',
                'message' => 'required',
            ]);
            if ($validator->passes()) {
        
            $review = DB::table('reviews')->where('user_id', $user->id)->where('client_id', $request->talent_id)->where('status', '<>', '3')->first();

            if(empty($review)){
                    $save = DB::table('reviews')->insert([
                        'user_id' => $user->id,
                        'client_id' => $request->talent_id,
                        'score' => $request->score,
                        'message' => $request->message,
                        'status' => "0",
                    ]);

                $data['msg'] = "Review added successfully showing after apporovel.";
                return response()->json($data);

            }else{
                $data['msg'] = "Review already submited.";
                return response()->json($data);
            }

            }else{
                return response()->json(['error' => $validator->errors()], 422);
            }

        // }else{
        //     echo 'ts';
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
