<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Payments;
use Yajra\Datatables\Datatables;

class TransactionController extends AdminController {

    public function index()
    {
        $data = [];
        return view('admin::transaction.index', $data);
    }

    public function transaction_list()
    {

        $transaction_list = Payments::where('status', '=', 'approved');
        return DataTables::of($transaction_list)
            ->addIndexColumn()
            ->editColumn('first_name', function ($model) {
                return $model->first_name;
            })
            ->editColumn('last_name', function ($model) {
                return $model->last_name;
            })
            ->editColumn('email', function ($model) {
                return  $model->email;
            })
            ->editColumn('amount', function ($model) {
                return $model->amount;
            })
            ->editColumn('currency', function ($model) {
                return $model->currency;
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-viewtransaction', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                    . '<i class="fa fa-eye" aria-hidden="true"></i>'
                    . '</a>';

                return $action_html;
            })
            ->make(true);
    }

    public function view($id)
    {
        $data = [];
        $id = base64_decode($id);
        $data['model'] = Payments::find($id);
        if (!empty($data['model'])) {
           
            return view('admin::transaction.view', $data);
        }
        return redirect()->route('admin-transaction');
    }

}