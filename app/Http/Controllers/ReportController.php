<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Project;
use DataTables;
use Carbon\Carbon;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class ReportController extends Controller
{
    use HelperTrait;
  
    public function store(Request $request)
    {
        $user = auth()->guard('frontend')->user();
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'message' => 'required',  
            ]);
            if ($validator->passes()) {
            $project=Project::find($request->project_id);
            $review=Report::where('user_id',$user->id)->where('project_id',$request->project_id)->where('status','<>','3')->first();
            if(empty($review)){
                $report = Report::create([
                    'user_id' => $user->id,
                    'author_id' => $project->user_id,
                    'project_id' => $project->id,
                    'message' => $request->message,
                    'status' => "1",
                ]);
                $data['msg'] = "Report submited successfully.";
                $data['link'] = route('task_details',base64_encode($project->id));
                $data['status'] = "success";
            }else{
                $data['msg'] = "Report already submited.";
                $data['status'] = "error";
            }
            
            return response()->json($data);
            }else{
                return response()->json(['error' => $validator->errors()], 422);
            }
        }
    }

}