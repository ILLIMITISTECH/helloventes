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
             
             if($commercial->objectif_visite){
             $pourcentage_visite_mois = $visite_ajouter * (100) / ($commercial->objectif_visite);
             }
             else{
                 $pourcentage_visite_mois = 0;
             }
         
         
            DB::table('stock_mensuelles')->insert(['pourcentage_contact_mois' => $pourcentage_contact_mois,'pourcentage_visite_mois' => $pourcentage_visite_mois,
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
         
         $commerciale = DB::table('commerciaus')->whereMonth('created_at', $mois)->get();
         $som_obje_commerciale = DB::table('commerciaus')->whereMonth('created_at', $mois)->sum('objectif_mois');
         $som_obje_comVisite = DB::table('commerciaus')->whereMonth('created_at', $mois)->sum('objectif_visite');
         $som_obje_comdemo = DB::table('commerciaus')->whereMonth('created_at', $mois)->sum('nbre_demo');
         $som_obje_comcontact = DB::table('commerciaus')->whereMonth('created_at', $mois)->sum('nbre_contact');
         
         $perfor_reaVenteGlobal = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('montant_vente');
            $perfor_objectVenteGlobal = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('objectif_mois');
            
            $perfor_objectVenteGlobalc = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('nbre_contact_ajouter');
            $perfor_reaVenteGlobalC = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('nbre_contact');
            
            $perfor_objectVenteGlobalVisite = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('nbre_visite_ajouter');
            $perfor_reaVenteGlobalVisite = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('objectif_visite');
            
            $perfor_objectVenteGlobalD = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('nbre_demo_ajouter');
            $perfor_reaVenteGlobalD = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('nbre_demo');
            
            $perfor_reaVenteg = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('montant_vente');
            $perfor_objectVenteg = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('objectif_mois');
            
            $perfor_objectVentegReCont = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('nbre_contact_ajouter');
            $perfor_objectVenteGlobalObCont = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('nbre_contact');
            
            $perfor_objectVentegReVisite = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('nbre_visite_ajouter');
            $perfor_objectVenteGlobalObVisite = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('objectif_visite');
            
            $perfor_objectVentegDem = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('nbre_demo_ajouter');
            $perfor_objectVenteGlobalDem = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('nbre_demo');
            
            $perfor_objectVenteGlobalPerfov = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('pourcentage');
            $perfor_objectVenteGlobalPerfoc = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('pourcentage_contact_mois');
            $perfor_objectVenteGlobalPerfovisites = DB::table('stock_mensuelles')->whereMonth('created_at', $mois)->sum('pourcentage_visite_mois');

            $perfor_objectVenteGlobalPerfovG = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('pourcentage');
            $perfor_objectVenteGlobalPerfocG = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('pourcentage_contact_mois');
            $perfor_objectVenteGlobalPerfovisite = DB::table('performance_globales')->whereMonth('created_at', $mois)->sum('pourcentage_visite_mois');

         DB::table('stock_mensuelles')->insert(['pourcentage_contact_mois' => $perfor_objectVenteGlobalPerfoc,'pourcentage_visite_mois' => $perfor_objectVenteGlobalPerfovisites,
            'nbre_contact_ajouter' => $perfor_objectVenteGlobalc,
            'nbre_visite_ajouter' => $perfor_objectVenteGlobalVisite,
            'nbre_demo_ajouter' => $perfor_objectVenteGlobalD,
            'nbre_contact' => intval($sum_semaineContact), 
            'objectif_visite' =>intval($sum_semaineVisite),
            'nbre_demo' => intval($sum_semaineDemo), 
            'pourcentage' => $perfor_objectVenteGlobalPerfov, 
            'montant_vente' => $perfor_reaVenteGlobal,
            'objectif_mois' =>intval($sum_semaineOject_com), 
            'created_at' => $now,  'updated_at' => $now]);
            
    }




    
}
