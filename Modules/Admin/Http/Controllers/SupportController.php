<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Admin\Emails\ContactUsReply;
use App\Traits\HelperTrait;
use App\Models\UserMaster;
use App\Models\ContactUs;
use App\Models\Support;
use App\Models\Settings;

class SupportController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    use HelperTrait;
    public function index() {
        $data = [];
        $data['ticket_id'] = $ticket_id = isset($_GET['ticket_id']) ? $_GET['ticket_id'] : "";
        $data['from'] = $from = isset($_GET['from']) ? $_GET['from'] : "";
        $data['to'] = $to = isset($_GET['to']) ? $_GET['to'] : "";
        // $data['transation_id'] = $transation_id = isset($_GET['transation_id']) ? $_GET['transation_id'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = Support::whereIn('status' , ['1','2']);
        if ($ticket_id != "") {
            $query->where('ticket_id', $ticket_id);
        }
        if ($from != "") {
            $query->where('created_at','>=',$from);
        }
        if ($to != "") {
            $query->where('created_at','<=',$to);
        }

        $query->orderBy('id', 'desc');
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('admin::support.index', $data);
    }

    public function view(Request $request, $id) {
        $data = [];
        $data['model'] = $model = Support::findOrFail($id);
        if ($model) {
            return view('admin::support.view', $data);
        } else {
            $request->session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->route('admin-support');
        }
    }

    public function send_request(Request $request) {
        $data = [];

        $model = Support::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
                    'admin_reply' => 'required',
                    'status' => 'required',
        ]);
        if ($validator->passes()) {


            $model->admin_reply = $request->input('admin_reply');
            $model->status = $request->input('status');
            $model->save();

           $email_setting = $this->get_email_data('support_reply', array('NAME' => $model->user->name,'SUBJECT'=>$model->subject,'DESCRIPTION'=>$model->description, 'MESSAGE' => $request->admin_reply));
           $email_data = [
               'to' => $model->user->email,
               'subject' => $email_setting['subject'],
               'template' => 'contact_reply',
               'data' => ['message' => $email_setting['body']]
           ];
           $this->SendMailBySwiftMailer($email_data);

            $request->session()->flash('success', 'Support Request Updated Sucessfully');
        }
        return redirect()->route('admin-viewsupport', ['id' => $model->id])->withErrors($validator)->withInput();
    }

}
