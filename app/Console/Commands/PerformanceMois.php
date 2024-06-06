<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use Session;

use Auth;

use App\User;
use DB;


use Notification;

class PerformanceMois extends Command
    {
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = "performance:update";
    
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
        $mois = date('m');
         $commerciale = DB::table('commerciaus')->get();
         $now = now();
         foreach($commerciale as $commercial){
             $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->sum('montant');
             $visite_ajouter = DB::table('prospections')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->count();
             $commission = DB::table('commissions')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->sum('commission');
             $nbre_contact_ajouter = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->count();
             $nbre_demo_ajouter = DB::table('demos')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->count();
             if($commercial->objectif_mois){
             $pourcentage_mois = $vente * (100) / ($commercial->objectif_mois);
             }
             else{
                 $pourcentage_mois = 0;
             }
             if($commercial->nbre_contact){
             $pourcentage_contact_mois = $nbre_contact_ajouter * (100) / ($commercial->nbre_contact);
             }
             else{
                 $pourcentage_contact_mois = 0;
             }
         
         
            DB::table('stock_mensuelles')->insert(['pourcentage_contact_mois' => $pourcentage_contact_mois,
            'nbre_contact_ajouter' => $nbre_contact_ajouter,
            'nbre_visite_ajouter' => $visite_ajouter,
            'nbre_demo_ajouter' => $nbre_demo_ajouter,
            'nbre_contact' => $commercial->nbre_contact, 
            'commission_p' => $commercial->commission_p,
            'objectif_visite' => $commercial->objectif_visite,
            'nbre_demo' => $commercial->nbre_demo, 
            'pourcentage' => $pourcentage_mois, 
            'montant_vente' => $vente,
            'commission' => $commission,
            'objectif_mois' => $commercial->objectif_mois, 
            'commercial_id' => $commercial->id,  
            'created_at' => $now,  'updated_at' => $now]);

         }
    }




    
}
