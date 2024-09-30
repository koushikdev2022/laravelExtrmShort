<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Payments, Settings, Checkout, BankDetails, UserMaster, TaxDetail, EscrowWallet};
use Omnipay\Omnipay;


class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $paypal_credentials = Settings::where(['slug' => 'paypal_secret'])->first();
        $this->paypal_client_id = (isset($paypal_credentials->default) && !empty($paypal_credentials->default)) ? $paypal_credentials->default : 'Adf1Nk6bzgJ3VUdeTobCUZgU_6wj1fW0MYlX2Jr6f61ZmYiLi755frZjzHXhiZXpGb9HLdf2MU8DOacs';
        $this->paypal_secret = (isset($paypal_credentials->value) && !empty($paypal_credentials->value)) ? $paypal_credentials->value : 'EM_Do-TRNHyY2pCGiS3xnlCYn-bW1sL5-C263bmYThUKsz7ubjBBQVNoCP2JdYzM09I8g2yq0p4R_edR';

        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId($this->paypal_client_id);
        $this->gateway->setSecret($this->paypal_secret);
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => 'USD',
                'returnURL' => url('success'),
                'cancelURL' => url('cancel')
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();
            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $order = Checkout::with('user')->where('status', '=', '1')->orderby('id', 'desc')->limit(1)->first();

                $user = Auth()->guard('frontend')->user();
                Payments::create([
                    'user_id' => $user->id,
                    'seller_id' => $order->projects->user_id,
                    'order_id' => $order->id,
                    'project_id' => $order->project_id,
                    'transaction_id' => $arr['id'],
                    'first_name' => ($user->first_name != '') ? $user->first_name : $user->name,
                    'last_name' => $user->last_name,
                    'email' => $arr['payer']['payer_info']['email'],
                    'amount' => $arr['transactions'][0]['amount']['total'],
                    'currency' => 'USD',
                    'status' => $arr['state'],
                    'payment_gateway' => 'Paypal'
                ]);

                $received_amount = EscrowWallet::where(['user_id'=>$user->id,'status'=>'0'])->sum('amount');
                $withdrawal_amount = EscrowWallet::where(['user_id'=>$user->id,'status'=>'1'])->sum('amount');
                $amount = $arr['transactions'][0]['amount']['total']+$received_amount-$withdrawal_amount;
                $input1['user_id'] = $user->id;
                $input1['project_id'] = $order->project_id;
                $input1['amount'] = $arr['transactions'][0]['amount']['total'];
                $input1['total_amount'] = ($amount != '') ? $arr['transactions'][0]['amount']['total'] : $amount;
                $input1['payment_gateway'] = 'Paypal';
                $input1['created_at'] = date("Y-m-d h:i:s");

                EscrowWallet::create($input1);

                Checkout::where(['user_id' => $user->id])->orderBy('id', 'desc')->limit(1)->update([
                    'status' => '2'
                ]);
                    ?>
                <script>
                    alert("New Subscriber Created and Billed");
                </script>

            <?php
                return redirect()->route('dashboard');
            } else {
                $message = $response->getMessage();
            ?>
                <script>
                    alert(<?php echo $message; ?>);
                </script>
            <?php
                return redirect()->route('dashboard');
            }
        } else {
            ?>
            <script>
                alert("Payment Declined");
            </script>
        <?php
            return redirect()->route('dashboard');
        }
    }

    public function cancel()
    {
        ?>
        <script>
            alert("User Declined Payment Request");
        </script>
        <?php
        $user = Auth()->guard('frontend')->user();

        Checkout::where(['user_id' => $user->id])->orderBy('id', 'desc')->limit(1)->update([
            'status' => '3'
        ]);
        return redirect()->route('dashboard');
    }

    public function addBankDetails(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_number' => 'required',
            'holder_name' => 'required',
            'confirm_account_number' => 'required|same:account_number'
        ]);
        $user = Auth()->guard('frontend')->user();

        $details = new BankDetails();
        $details->user_id = $user->id;
        $details->bank_name = $request->bank_name;
        $details->branch_name = $request->branch_name;
        $details->account_number = $request->account_number;
        $details->holder_name = $request->holder_name;
        $details->status = '1';
        $details->save();
        BankDetails::where(['user_id' => $user->id])->where('id', '!=', $details->id)->update(['status' => '0']);
        $data['message'] = 'Bank Details Added Successfully';
        return response()->json($data);
    }

    public function editBankDetails(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_number' => 'required',
            'holder_name' => 'required',
            'confirm_account_number' => 'required|same:account_number'
        ]);
        $user = Auth()->guard('frontend')->user();
        $details = BankDetails::where(['user_id' => $user->id, 'id' => $request->id])->first();
        $details->update([
            'user_id' => $user->id,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'account_number' => $request->account_number,
            'holder_name' => $request->holder_name,
            'status' => '1'
        ]);
        BankDetails::where(['user_id' => $user->id])->where('id', '!=', $details->id)->update(['status' => '0']);
        $data['message'] = 'Bank Details Edited Successfully';
        return response()->json($data);
    }

    public function getAllBankDetails()
    {
        $user = Auth()->guard('frontend')->user();

        $bank_data = BankDetails::where(['user_id' => $user->id])->get();
        $view = view('ajax.bankDetails', compact('bank_data'))->render();
        $result['content'] = $view;
        return response()->json($result);
    }


    public function getBankDetails(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        $bank_data = BankDetails::where(['user_id' => $user->id, 'id' => $request->id])->first();
        return response()->json($bank_data);
    }

    public function deleteDetails(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        BankDetails::where(['user_id' => $user->id, 'id' => $request->id])->delete();
        $data['message'] = 'Details Deleted Successfully';
        return response()->json($data);
    }

    public function setPrimaryAccount(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        BankDetails::where(['user_id' => $user->id])->update(['status' => '0']);
        BankDetails::where(['user_id' => $user->id, 'id' => $request->id])->update(['status' => '1']);
        $data['message'] = 'Set as Primary Account';
        return response()->json($data);
    }

    public function profileAddress()
    {
        $user = Auth()->guard('frontend')->user();
        $data = UserMaster::where(['id' => $user->id])->first();
        return response()->json($data);
    }

    public function saveResidence(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'address' => 'required'
        ]);
        $user = Auth()->guard('frontend')->user();
        if ($request->id != '') {
            $data = TaxDetail::where(['id' => $request->id])->first();
            if ($data != '') {
                $data->update([
                    'state' => $request->state,
                    'address' => $request->address,
                    'country' => $request->country,
                    'zip' => $request->zip,
                    'city' => $request->city,
                ]);
            }
        } else {
            $data = new TaxDetail();
            $data->user_id = $user->id;
            $data->state = $request->state;
            $data->address = $request->address;
            $data->country = $request->country;
            $data->zip = $request->zip;
            $data->city = $request->city;
            $data->save();
        }
        $result['message'] = "Details Added Successfully";
        return response()->json($result);
    }

    public function saveUSTaxData(Request $request)
    {
        $request->validate([
            'us_person' => 'required',
            'legal_payer_name' => 'required',
            'federation_tax_classification' => 'required',
            'identification_type' => 'required',
            'identification_number' => 'required',
            'chk_tax_certification' => 'required',
        ]);

        $data = TaxDetail::where(['id' => $request->id])->first();
        if ($data != '') {
            $data->update([
                'us_person' => $request->us_person,
                'chk_tax_certification' => $request->chk_tax_certification,
                'legal_payer_name' => $request->legal_payer_name,
                'identification_type' => $request->identification_type,
                'federation_tax_classification' => $request->federation_tax_classification,
                'identification_number' => $request->identification_number
            ]);
            $result['message'] = "Details Added Successfully";
            return response()->json($result);
        } else {
            $result['message'] = "Something went wrong";
            return response()->json($result, 422);
        }
    }

    public function saveNonUSTaxData(Request $request)
    {
        $request->validate([
            'us_person' => 'required',
            'legal_payer_name' => 'required',

            'chk_tax_certification' => 'required',
        ]);

        $data = TaxDetail::where(['id' => $request->id])->first();
        if ($data != '') {
            $data->update([
                'us_person' => $request->us_person,
                'chk_tax_certification' => $request->chk_tax_certification,
                'legal_payer_name' => $request->legal_payer_name,

            ]);
            $result['message'] = "Details Added Successfully";
            return response()->json($result);
        } else {
            $result['message'] = "Something went wrong";
            return response()->json($result, 422);
        }
    }

    public function checkAllDetails()
    {
        $user = Auth()->guard('frontend')->user();
        $banks = BankDetails::where(['user_id' => $user->id])->get();
        if (count($banks) > 0) {
            $activeAccount = BankDetails::where(['user_id' => $user->id, 'status' => '1'])->first();
            if ($activeAccount == '') {
                $result['message'] = "Please Select Primary Account";
                return response()->json($result, 422);
            } else {
                $taxes = TaxDetail::where(['user_id' => $user->id])->first();
                if ($taxes != '') {
                    $result['success'] = 'true';
                    return response()->json($result);
                } else {
                    $result['message'] = "Please Add Tax Details First";
                    return response()->json($result, 422);
                }
            }
        }else {
            $result['message'] = "Please Add Bank Details First";
            return response()->json($result, 422);
        }
    }

    public function requestWithdrawalAmount(Request $request){
        $user = Auth()->guard('frontend')->user();

        $received_amount = EscrowWallet::where(['user_id'=>$user->id,'status'=>'0'])->sum('amount');
        $withdrawal_amount = EscrowWallet::where(['user_id'=>$user->id,'status'=>'1'])->sum('amount');
        $hold_amount = EscrowWallet::where(['user_id'=>$user->id,'status'=>'2'])->sum('amount');

        $amount = $received_amount - $withdrawal_amount - $hold_amount-$request->amount;
        if($request->amount < $amount ){
            $input1['user_id'] = $user->id;
            $input1['project_id'] = '';
            $input1['amount'] = $request->amount;
            $input1['total_amount'] = $amount;
            $input1['status'] = '2'; // For hold
            $input1['payment_gateway'] = 'Paypal';
            $input1['created_at'] = date("Y-m-d h:i:s");
    
            EscrowWallet::create($input1);
            $result['message'] = "Request Posted Successfully";
            return response()->json($result);
        }else{
            $result['message'] = "Insufficient Balance";
            return response()->json($result,422);
        }
    }
}
