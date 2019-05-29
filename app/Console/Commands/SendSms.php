<?php

namespace App\Console\Commands;

use App\Http\Controllers\SmsController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointmentSms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily appointment Sms';

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
        //

        app()->call(SmsController::class . '@' . 'dailyAllAppointment');



    }
}
