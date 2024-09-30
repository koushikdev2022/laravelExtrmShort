<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Checkout;
use Yajra\Datatables\Datatables;

class OrderController extends AdminController
{

    public function index()
    {
        $data = [];
        return view('admin::orders.index', $data);
    }

    public function order_list()
    {

        $user_list = Checkout::where('status', '<>', '4');
        return DataTables::of($user_list)
            ->addIndexColumn()
            ->editColumn('order_id', function ($model) {
                return $model->order_id;
            })
            ->editColumn('project_id', function ($model) {
                return \Illuminate\Support\Str::limit($model->projects->title,20);
            })
            ->editColumn('user_id', function ($model) {
                return  $model->user->name;
            })
            ->editColumn('amount', function ($model) {
                return $model->amount;
            })
            ->editColumn('total', function ($model) {
                return $model->total;
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-vieworder', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                    . '<i class="fa fa-eye" aria-hidden="true"></i>'
                    . '</a>'
                    . '<a href="javascript:void(0);" onclick="deleteOrder(this);" data-href="' . Route("admin-deleteorder", ['id' => base64_encode($model->id)]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                    . '<i class="fa fa-trash"></i>'
                    . '</a>';

                return $action_html;
            })
            ->make(true);
    }

    public function view($id)
    {
        $data = [];
        $id = base64_decode($id);
        $data['model'] = Checkout::find($id);
        if (!empty($data['model'])) {
           
            return view('admin::orders.view', $data);
        }
        return redirect()->route('admin-order');
    }

    public function destroy(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $id = base64_decode($_GET['id']);
            $model = Checkout::findOrFail($id);
            if (!empty($model) && $model->status != '3') {
                $model->delete();
                $request->session()->flash('success', 'Order deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-order');
    }
}
