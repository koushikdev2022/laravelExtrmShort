<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use URL;
use DateTime;
use Illuminate\Support\Facades\Validator;

use Session;
// use DB;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{


    public function index()
    {
        $timezone = date_default_timezone_get();
            date_default_timezone_set($timezone);
            $date = date('Y-m-d H:i:s', time());
        $user_id = auth()->guard('frontend')->user()->id;
        $data = DB::table('wallet')->where('user_id',$user_id)->orderBy('id', 'desc')->get();

        $balance = DB::table('wallet_balance')->where('user_id',$user_id)->first();
        if(empty($balance)){
            $insert = DB::table('wallet_balance')->insert([
                'user_id'=>$user_id,
                'balance'=>0,
                'updated_at'=>$date,
            ]);
            $balance = DB::table('wallet_balance')->where('user_id',$user_id)->first();
        }
        return view('user.wallet.wallet', ['data'=>$data, 'balance'=>$balance]);
    }



    // Deposit Screen Controller Start
    public function deposit_index()
    {
        // echo "testing";
        return view('user.wallet.deposit');
    }

    public function deposit_fund(Request $request)
    {
        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d H:i:s', time());

        $user_id = auth()->guard('frontend')->user()->id;

        if($request->input('amount')){
            $depositReq = DB::table('wallet')->insert([
                'user_id' => $user_id,
                'credit_amount' => $request->input('amount'),
                'status' => 'pending',
                'updated_at' => $date,
            ]);
            Session::flash('message', 'Your Deposit Funds Request Successfully Submitted.');
            Session::flash('alert-class', 'alert-success');
            return redirect('/user/wallet');
        }
        else{
            return redirect('/user/wallet');
            Session::flash('message', 'Error Please try again.');
            Session::flash('alert-class', 'alert-danger');
        }
    }



    // Withdraw Screen Controllers start
    public function withdraw_index()
    {
        $user_id = auth()->guard('frontend')->user()->id;
        $balance = DB::table('wallet_balance')->where('user_id',$user_id)->first();
        return view('user.wallet.withdraw-fund', ['data'=>$balance]);
    }

    public function withdraw_fund(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'name' => 'required',
            'iban_no' => 'required',
            'account_no' => 'required',
            'user_type_id' => 'required',
        ]);
        if ($validator->fails()){
            return redirect('/user/wallet');
            Session::flash('message', 'Error Please try again.');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            $timezone = date_default_timezone_get();
            date_default_timezone_set($timezone);
            $date = date('Y-m-d H:i:s', time());

            $user_id = auth()->guard('frontend')->user()->id;
                $balance = DB::table('wallet_balance')->where('user_id',$user_id)->first();

                if($balance->balance >= $request->input('amount')){

                        $depositReq = DB::table('wallet')->insert([
                            'user_id' => $user_id,
                            'user_type_id' => $request->input('user_type_id'),
                            'name' => $request->input('name'),
                            'IBAN_No' => $request->input('iban_no'),
                            'account_no' => $request->input('account_no'),
                            'debit_amount' => $request->input('amount'),
                            'status' => 'pending',
                            'updated_at' => $date,
                        ]);

                        $balanceupdate = DB::table('wallet_balance')->where('user_id',$user_id)->update([
                            'balance'=>$balance->balance - $request->input('amount'),
                            'updated_at'=>$date
                        ]);

                        Session::flash('message', 'Your Withdraw Request Successfully Submitted.');
                        Session::flash('alert-class', 'alert-success');
                        return redirect('/user/wallet');

                }else{
                    Session::flash('message', 'Your withdrawal request fund more than your wallet balance. Please enter valid amount.');
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/user/wallet');
                }

        }
    }

}
