<?php

namespace App\Jobs;

use App\Mail\VecvEmailQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;


class SendVecvFeedbackEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {         
          
            $name = $this->details->full_name;
            $email = $this->details->email;
            $phone = $this->details->mobile;


            if($email != " " || $email != "")
              Mail::to($email)->send(new VecvEmailQueue($this->details));

            if($phone != " " || $phone != ""){
                $mobile = "";
                if(strlen($phone) > 10){
                  $mobile = substr($phone, -10);
                }else{
                  $mobile = $phone;
                }

                $body = 'Dear '.$name.', Your feedback is important to improve Udaan Application Support. Click URL for feedback https://vecv.inhelpdesk.com/fdbknw/index.php?gid='.base64_encode($this->details->id);
                $body = str_replace(' ', '%20', $body);

                $url = 'http://easygosms.in/api/eicher/eicher_api.php?api_key=NSna1b7myoBzfFsw&pass=d9O25IhgAE&senderid=GLBTER&message='.$body.'&dest_mobileno='.$mobile.'&mtype=TXT;';

                 $ch = curl_init();
                 curl_setopt($ch, CURLOPT_URL, $url);
                 curl_setopt($ch, CURLOPT_POST, 0);
                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                 $response = curl_exec ($ch);
                 $err = curl_error($ch);  //if you need
                 curl_close ($ch);

            }

    }
}
