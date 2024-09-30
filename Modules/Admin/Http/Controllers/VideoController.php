<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;
use App\Traits\HelperTrait;
use App\Models\Project;

class VideoController extends AdminController
{
    use HelperTrait;

    public function index()
    {
        $data = [];
         $data = Project::where(['status'=>'0','step'=>'3'])->get();
        return view('admin::video.index', compact('data'));
    }

    public function view($id)
    {
        $data = [];
        $nid = base64_decode($id);
        $data = Project::findOrFail($nid);
        return view('admin::video.view', compact('data'));
    }

    public function statusUpdate(Request $request, $id)
    {
        Project::where(['id' => $id])->update([
            'status' => $request->input('status')
        ]);
        $request->session()->flash('success', 'Updated successfully.');
        return redirect()->route('admin-video');
    }


    public function project_list()
    {
        $project_list = Project::where('status', '<>', '3');
        return Datatables::of($project_list)
            ->addIndexColumn()
            ->editColumn('title', function ($model) {
                return $model->title;
            })
            ->editColumn('user_id', function ($model) {
                return $model->user->name;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-viewvideo', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                    . '<i class="fa fa-edit"></i>'
                    . '</a>'
                    . '<a href="javascript:void(0);" onclick="deleteVideo(this);"   data-href="' . Route('admin-deletevideo', ['id'=>$model->id]) . '"  class="btn btn-outline btn-circle btn-sm dark">'
                    . '<i class="fa fa-trash"></i>'
                    . '</a>';
                return $action_html;
            })
            ->make(true);
    }


    public function destroy(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = Project::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->save();
                $request->session()->flash('success', 'Deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-video');
    }

}
