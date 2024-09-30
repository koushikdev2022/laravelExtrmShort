<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Notification;
use Yajra\Datatables\Datatables;
use App\Models\UserMaster;


class DashboardController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        $data['total_user']=UserMaster::where('type_id','2')->where('status', '<>', '3')->count();
        $data['total_active_user']=UserMaster::where('type_id','2')->where('status','1')->count();
        $data['total_inactive_user']=UserMaster::where('type_id','2')->where('status','0')->count();
        return view('admin::dashboard.index', $data);
    }


    public function notifications (){
        $data = [];
        return view('admin::notification.index', $data);
    }

    public function changeNotificationStatus($id){
        $notifications = Notification::findOrFail($id);
        if($notifications !=''){
            $notifications->update(['is_view'=>'1']);
            return true;
        }
    }

    public function notification_list()
    {

        $notification_list = Notification::where('status', '<>', '4');
        return DataTables::of($notification_list)
            ->addIndexColumn()
            ->editColumn('from_id', function ($model) {
                return $model->author->name;
            })
            ->editColumn('message', function ($model) {
                return \Illuminate\Support\Str::limit($model->message,20);
            })
            ->editColumn('is_view', function ($model) {
                return  $model->is_view;
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $action_html =  '<a href="javascript:void(0);" onclick="deleteNotification(this);" data-href="' . Route("admin-deletenotification", ['id' => base64_encode($model->id)]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                    . '<i class="fa fa-trash"></i>'
                    . '</a>';

                return $action_html;
            })
            ->make(true);
    }
    public function delete(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $id = base64_decode($_GET['id']);
            $model = Notification::findOrFail($id);
            if (!empty($model) && $model->status != '3') {
                $model->update(['status'=>'3']);
                $request->session()->flash('success', 'Notification deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('notifications');
    }
    
}
