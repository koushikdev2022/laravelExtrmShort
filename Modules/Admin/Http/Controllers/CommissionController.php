<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Commission;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class CommissionController extends Controller
{

    public function index()
    {
        $data = [];
        return view('admin::commission.index', $data);
    }

    public function commission_list()
    {
        $commission_list = Commission::where('status', '<>', '3');
        return DataTables::of($commission_list)
            ->addIndexColumn()
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('percentile', function ($model) {
                return $model->percentile."%";
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-viewcommission', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                    . '<i class="fa fa-eye" aria-hidden="true"></i>'
                    . '</a>'.
                    '<a href="' . Route('admin-updatecommission', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="View">'
                    . '<i class="fa fa-edit" aria-hidden="true"></i>'
                    . '</a>'
                    . '<a href="javascript:void(0);" onclick="deleteCommission(this);" data-href="' . Route("admin-deletecommission", ['id' => base64_encode($model->id)]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
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
        $data['model'] = Commission::find($id);
        if (!empty($data['model'])) {

            return view('admin::commission.view', $data);
        }
        return redirect()->route('admin-commission');
    }


    public function create()
    {
        $data = [];
        return view('admin::commission.create', $data);
    }

    public function post_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'percentile' => 'required|max:100',
           
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $input = new Commission();
            $input->name = $request->name;
            $input->percentile = $request->percentile;
           
            $input->status = $request->status;
            $input->created_by = Auth()->guard('backend')->user()->id;
            $input->save();

            $request->session()->flash('success', 'Charges added successfully.');
        } else {
            return redirect()->route('admin-addcommission')->withErrors($validator)->withInput();
        }
        return redirect()->route('admin-commission')->withErrors($validator)->withInput();
    }

    public function edit($id)
    {
        $data = [];
        $nid = base64_decode($id);
        $data['model'] = Commission::find($nid);
        if (!empty($data['model'])) {
            return view('admin::commission.edit', $data);
        }
    }

    public function post_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'percentile' => 'required|max:100',
           
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $commission = Commission::findOrFail($id);
            $commission->update([
                'name' => $request->name,
                'percentile' => $request->percentile,
              
                'status' => $request->status,
                'created_by' => Auth()->guard('backend')->user()->id,
            ]);

            $request->session()->flash('success', 'Charges Updated successfully.');
        } else {
            return redirect()->route('admin-updatecommission')->withErrors($validator)->withInput();
        }
        return redirect()->route('admin-commission')->withErrors($validator)->withInput();
    }

    public function destroy(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $id = base64_decode($_GET['id']);
            $model = Commission::findOrFail($id);
            if (!empty($model) && $model->status != '3') {
                $model->update(['status' => '3']);
                $request->session()->flash('success', 'Deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-commission');
    }
}
