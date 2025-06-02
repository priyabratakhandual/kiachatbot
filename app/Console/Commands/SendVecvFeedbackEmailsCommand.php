<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendVecvFeedbackEmail;

class SendVecvFeedbackEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:vecv_feedback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email and sms to vecv dealers for feedback';

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
     * @return mixed
     */
    public function handle()
    {

        $info = \DB::select('SELECT * from vecv_feedback');

        foreach ($info as $det) {
            SendVecvFeedbackEmail::dispatch($det);
        }
        
    }
}
