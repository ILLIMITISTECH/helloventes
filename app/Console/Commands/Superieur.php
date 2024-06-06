<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use Session;

use Auth;

use App\User;
use DB;


use Notification;

class Superieur extends Command
    {
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = "superieur:update";
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mise a jour de  l activitée';
    
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
         $commerciaux = DB::table('commerciaus')->get();
        foreach($commerciaux as $commerciau)
        {
            DB::table('prospects')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('opportunites')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('action_commerciales')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('prospections')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('contacts')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('demos')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('update_opps')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
            DB::table('stock_mensuelles')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
             DB::table('stock_journalieres')
             ->whereIn('commercial_id', [$commerciau->id])
            ->update(['superieur_id' => $commerciau->superieur_id]);
            
        }
        
        echo 'yes is okay';
        
    }




    
}
