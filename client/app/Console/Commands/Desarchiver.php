<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use Session;

use App\Action;

use Auth;

use App\User;
use App\Agent;
use DB;

use App\Notifications\EscalationAction;
use App\Notifications\EscalationActionResponsable;
use App\Notifications\AlerteEscalation;
use Notification;

class Desarchiver extends Command
{
/**
* The name and signature of the console command.
*
* @var string
*/
protected $signature = "desarchiver:opportunite";

/**
 * The console command description.
 *
 * @var string
 */
protected $description = 'Escalade l action si le délais est dépassé';

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

     $dates = date('Y-m-d');
     
     DB::table('opportunites')->where('deadline_desarchiver', '<', $dates)->update(['archiver' => 0]);
       
    $this->info('L\'escalation a été faite');
}

}
