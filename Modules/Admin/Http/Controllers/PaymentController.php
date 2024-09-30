<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\{DB, Validator};
use Session;
use App\Traits\HelperTrait;

use App\Models\{EscrowWallet, BankDetails, UserMaster, Notification};
use Yajra\Datatables\Datatables;

class PaymentController extends AdminController
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function adminRequests()
    {
        if (!isset($_GET['filter'])) {
            $data = DB::table('wallet')
                ->join('user_master as user', 'wallet.user_id', '=', 'user.id')
                ->select('wallet.*', 'user.name', 'user.email', 'user.type_id')
                ->orderBy('wallet.id', 'desc')->get();
        }
        if (isset($_GET['filter']) && $_GET['filter'] == 'pending') {
            $data = DB::table('wallet')
                ->join('user_master as user', 'wallet.user_id', '=', 'user.id')
                ->where('wallet.status', 'pending',)
                ->select('wallet.*', 'user.name', 'user.email', 'user.type_id')
                ->orderBy('wallet.id', 'desc')->get();
        }
        if (isset($_GET['filter']) && $_GET['filter'] == 'completed') {
            $data = DB::table('wallet')
                ->join('user_master as user', 'wallet.user_id', '=', 'user.id')
                ->where('wallet.status', 'completed',)
                ->select('wallet.*', 'user.name', 'user.email', 'user.type_id')
                ->orderBy('wallet.id', 'desc')->get();
        }
        if (isset($_GET['filter']) && $_GET['filter'] == 'decline') {
            $data = DB::table('wallet')
                ->join('user_master as user', 'wallet.user_id', '=', 'user.id')
                ->where('wallet.status', 'decline',)
                ->select('wallet.*', 'user.name', 'user.email', 'user.type_id')
                ->orderBy('wallet.id', 'desc')->get();
        }
        $commission = DB::table('settings')->where('slug', 'commission')->first();
        return view('admin::user.payment', ['data' => $data, 'commission' => $commission]);
    }

    public function statusUpdate($id)
    {
        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d H:i:s', time());

        $id = base64_decode($id);
        if (isset($_GET['s']) && $_GET['s'] == 3) {
            $status = 'decline';
        } elseif ($_GET['s'] == 1) {
            $status = 'completed';
            // $balance = base64_decode($_GET['b']);
            $user_id = base64_decode($_GET['u']);

            $select = DB::table('wallet_balance')->where('user_id', $user_id)->first();

            if (isset($_GET['cb'])) {
                $Updated_balance = $select->balance + base64_decode($_GET['cb']);
            } elseif (isset($_GET['db'])) {
                $Updated_balance = $select->balance - base64_decode($_GET['db']);
            }
            $updateBalance = DB::table('wallet_balance')->where('user_id', $user_id)->update([
                'balance' => $Updated_balance,
            ]);
        }
        $update = DB::table('wallet')->where('id', $id)->update([
            'status' => $status,
            'updated_at' => $date,
        ]);
        if ($update) {
            Session::flash('message', 'Transaction Successfully Done.');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/admin-payment');
        } else {
            Session::flash('message', 'Transaction Failed.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/admin-payment');
        }
    }


    public function specialist_withdraw_req(Request $request)
    {
        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d H:i:s', time());

        $id = $request->input('id');
        $email = $request->input('email');
        $name = $request->input('name');
        $user_id = $request->input('user_id');
        $debitAmount = $request->input('debit_amount');
        $final_deposit_Amount = $request->input('final_deposit_Amount');
        $commission = $debitAmount - $final_deposit_Amount;

        $select = DB::table('wallet_balance')->where('user_id', $user_id)->first();

        if ($request->input('status') == 'Cancel') {
            $Updated_balance = $select->balance + $debitAmount;
            $updateBalance = DB::table('wallet_balance')->where('user_id', $user_id)->update([
                'balance' => $Updated_balance,
            ]);
            $status = 'decline';
            $update = DB::table('wallet')->where('id', $id)->update([
                'status' => $status,
                'deposit_amount_after_commission' => $final_deposit_Amount,
                'updated_at' => $date,
            ]);
            Session::flash('message', 'Transaction decline successfully.');
            Session::flash('alert-class', 'alert-danger');
        } else {
            $status = 'completed';


            $update = DB::table('wallet')->where('id', $id)->update([
                'status' => $status,
                'deposit_amount_after_commission' => $final_deposit_Amount,
                'updated_at' => $date,
            ]);


            $email_setting = $this->get_email_data('bid_invoice', array('LOGOIMAGE' => '', 'FIRSTNAME' => $name, 'TOTALAMOUNT' => $debitAmount, 'NAME' => $name, 'WALLETLINK' => '', 'PAYMENTDATE' => $date, 'AMOUNT' => $debitAmount, 'COMMISIONAMOUNT' => $commission, 'TOTALAMOUNT' => $final_deposit_Amount));

            $email_data = [
                'to' => $email,
                'subject' => 'Bid Payment Invoice',
                'template' => 'signup',
                'data' => ['message' => 'Testing' . $email_setting['body']]
            ];
            // print_r($email_data);
            $this->SendMailBySwiftMailer($email_data);

            Session::flash('message', 'Transaction Successfully Done.');
            Session::flash('alert-class', 'alert-success');
        }

        return redirect('admin/admin-payment');
    }

    private function sendActivationMail($user)
    {
        $url = Route('active-account', ['id' => base64_encode($user->id), 'token' => $user->active_token]);
        $link = '<a href="' . $url . '">Click Here</a>';
        $email_setting = $this->get_email_data('user_registration', array('NAME' => $user->name, 'LINK' => $link));
        $email_data = [
            'to' => $user->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMailBySwiftMailer($email_data);
    }

    public function requested_details()
    {
        $data = [];
        return view('admin::funds.index', $data);
    }

    public function details()
    {
        $details = EscrowWallet::where('status', '<>', '4');
        return DataTables::of($details)
            ->addIndexColumn()

            ->editColumn('user_id', function ($model) {
                return $model->user->name;
            })
            ->editColumn('amount', function ($model) {
                return $model->amount;
            })
            ->editColumn('total_amount', function ($model) {
                return  $model->total_amount;
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-requested-amount-update', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                    . '<i class="fa fa-edit"></i>'
                    . '</a>';

                return $action_html;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data = [];
        $id = base64_decode($id);
        $data['model'] = $model = EscrowWallet::where('status', '=', '2')->findOrFail($id);
        $data['bank'] = $bank = BankDetails::where('status', '=', '1')->where(['user_id' => $model->user_id])->first();
        if (!empty($model)) {
            return view('admin::funds.update', $data);
        }
        return redirect()->route('admin-requested-amount')->with('danger', 'Sorry! No  details found.');
    }

    public function post_update(Request $request, $id)
    {
        // $id = base64_decode($id);
        $model = EscrowWallet::find($id);
        $user = UserMaster::where(['id' => $model->user_id])->first();
        if($request->status == '1'){
              $status = 'Released';  
        }elseif($request->status == '2'){
            $status = 'Hold'; 
        }else{
            $status = 'Not not shown any response to ';
        }
        $notification = new Notification;
        $notification->notifier_id = $user->id;
        $notification->from_id = '1';
        $notification->message = " Admin ". $status." ".$model->amount. " amount";
        $notification->is_view = '0';
        $notification->status = '1';
        $notification->created_at = date("Y-m-d h:i:s");
        $notification->save();
        $model->update(['status' => $request->status]);
        $request->session()->flash('success', 'Updated successfully.');
        return redirect()->route('admin-requested-amount');
    }
}
