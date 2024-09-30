<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = env('MAIL_HOST', 'smtp.mailgun.org');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME');                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
            // $mail->Password   = '0Jdh%hkflBj*d$S3xj!!';                               //SMTP password
            $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT', 587);                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('support@newtestserver.com', "Xtream Longshot");
            $mail->addAddress($data['to']);     //Add a recipient
            $mail->addReplyTo('support@newtestserver.com', "Xtream Longshot");
            // if (isset($data['cc']) && !empty($data['cc'])) {
            //     $mail->addCC(is_array($data['cc']) ? $data['cc'] : [$data['cc']]);
            // }
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);  
            $mail->CharSet = "text/html; charset=UTF-8;";                                //Set email format to HTML
            $mail->Subject = $data['subject'];
            $mail->Body    = $data['content'];
            $mail->AltBody = $data['content'];
            $mail->send();
            // if (!$mail->send()) {
            //     return response()->json('Message could not be sent. Mailer Error: {$mail->ErrorInfo}',422);
            // }else{
            //     return response()->json(['status'=>true,'message'=>'Mail Send Successfully'],200);
            // }
        } catch (Exception $e) {
           return response()->json('Message could not be sent.',422);
        }
        // Mail::send([], [], function ($message) use ($data_arr) {
        //     $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        //     $message->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        //     $message->subject($data_arr['subject']);
        //     $message->setBody($data_arr['content'], 'text/html');
        //     $message->to($data_arr['to']);
        // });
    }
}