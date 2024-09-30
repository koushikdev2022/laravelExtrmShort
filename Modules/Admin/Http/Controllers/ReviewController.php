<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;
use Validator;
use App\Models\Email;
use Illuminate\Support\Facades\DB;
class ReviewController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {

        $data = DB::table('reviews')
        ->join('user_master as client', 'reviews.client_id', 'client.id')
        ->join('user_master as user', 'reviews.user_id','=','user.id')
        ->where('reviews.status', '<=', 3)
        ->select('reviews.*', 'user.name as user_name','client.name as client_name')
        ->get();

        return view('admin::user.review', ['data'=>$data]);
    }

    public function reviewStatusUpdate($id)
    {
        if(isset($_GET['status']) && $_GET['status'] == 1){
            Session::flash('message', 'Review Approved Successfully!');
            Session::flash('alert-class', 'alert-success');
            $status = '1';
        }else {
            Session::flash('message', 'Review Rejected!');
            Session::flash('alert-class', 'alert-danger');
            $status = '2';
        }

        $id = base64_decode($id);
        $update = DB::table('reviews')->where('id', $id)->update(['status'=>$status]);

        return redirect('admin/review');

    }

}
