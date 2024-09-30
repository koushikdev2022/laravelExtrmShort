<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Session;

// ************ models ************
use App\Models\ExtendExpireDate;
use Carbon\Carbon;

class subsctiptionUpdate extends Command
{
    use HelperTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:subsctiptionUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subsctiption Update status expiry date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // echo "hii";
        // exit;
        $date=date('Y-m-d');
        $subscriptions=ExtendExpireDate::where('end_date',$date)->where('status','1')->get();
        foreach($subscriptions as $subscription)
        {

            $subscriptions_detail=ExtendExpireDate::where('id',$subscription->id)->first();
            $subscriptions_detail->update([
                'status'=>'2',
            ]);
                // $email_setting = $this->get_email_data('installment_payment', array('FIRSTNAME' => $order->first_name,'LASTNAME' => $order->last_name, 'EMAIL' => $order->email,'TYPE' => $order->type,'COURSEAMOUNT' => $order->course_amount,'PAYMENTSTATUS' => 'Next installment date '.$future_date.' keep funded to avoid charges'));
                // $email_data = [
                //     'to' => 'harry@mailinator.com',
                //     'subject' => $email_setting['subject'],
                //     'template' => 'contact_reply',
                //     'data' => ['message' => $email_setting['body']]
                // ];
                // $this->SendMailBySwiftMailer($email_data);
        }
        // return Command::SUCCESS;
    }
}
