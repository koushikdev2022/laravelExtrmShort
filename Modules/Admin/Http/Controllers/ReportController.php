<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Traits\HelperTrait;
use Yajra\Datatables\Datatables;
use App\Models\{UserMaster,Checkout,Payments};


class ReportController extends AdminController {
    use HelperTrait;

    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function users() {
        $data = [];
        $data['name'] = $name = isset($_GET['name']) ? $_GET['name'] : "";
        $data['status'] = $status = isset($_GET['status']) ? $_GET['status'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = UserMaster::where('status', '<>', '3');
        if ($name != "") {
            $query->where('name', 'like', '%' . $name . '%');
        }
        if ($status != "") {
            if ($status == 'inactive') {
                $query->where('status', '=', '0');
            } else if ($status == 'active') {
                $query->where('status', '=', '1');
            } else {
                
            }
        }
        $query->orderBy('id', 'DESC');
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('admin::reports.users.index', $data);
    }

    public function orders() {
        $data = [];
        $data['status'] = $status = isset($_GET['status']) ? $_GET['status'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = Checkout::where('status', '<>', '3');
       
        if ($status != "") {
            if ($status == 'Pending') {
                $query->where('status', '=', '1');
            } 
            else if ($status == 'Success') {
                $query->where('status', '=', '2');
            } else if ($status == 'Fail') {
                $query->where('status', '=', '3');
            } else {
                
            }
        }
        $query->orderBy('id', 'DESC');
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('admin::reports.order.index', $data);
    }

    public function payments() {
        $data = [];
        $data['name'] = $name = isset($_GET['name']) ? $_GET['name'] : "";
        $data['status'] = $status = isset($_GET['status']) ? $_GET['status'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = Payments::where('status', '=', 'approved');
        if ($name != "") {
            $query->where('first_name', 'like', '%' . $name . '%')->orWhere('last_name', 'like', '%' . $name . '%');
        }
       
        if ($status != "") {
            if ($status == 'Success') {
                $query->where('status', '=', 'approved');
            } 
            if ($status == 'Pending') {
                $query->where('status', '!=', 'approved');
            } 
        }
        $query->orderBy('id', 'DESC');
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('admin::reports.payments.index', $data);
    }

}




