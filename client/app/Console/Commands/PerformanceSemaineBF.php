<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use Session;

use Auth;

use App\User;
use DB;


use Notification;

class PerformanceSemaineBF extends Command
    {
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = "performanceBF:semaine";
    
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
        
         $commerciale = DB::table('commerciaus')->where('pays_id', 5)->whereMonth('created_at', $mois)->get();
         $som_obje_commerciale = DB::table('commerciaus')->where('pays_id', 5)->whereMonth('created_at', $mois)->sum('objectif_mois');
         $som_obje_comVisite = DB::table('commerciaus')->where('pays_id', 5)->whereMonth('created_at', $mois)->sum('objectif_visite');
         $som_obje_comdemo = DB::table('commerciaus')->where('pays_id', 5)->whereMonth('created_at', $mois)->sum('nbre_demo');
         $som_obje_comcontact = DB::table('commerciaus')->where('pays_id', 5)->whereMonth('created_at', $mois)->sum('nbre_contact');
         
            $sum_semaineOject_com = $som_obje_commerciale / 4;
         $sum_semaineVisite = $som_obje_comVisite / 4;
         $sum_semaineDemo = $som_obje_comdemo / 4;
         $sum_semaineContact = $som_obje_comcontact / 4;
          
         $now = now();
         foreach($commerciale as $commercial){
             $visite_ajouter = DB::table('prospections')->where('commercial_id', $commercial->id)->where('statut', 1)->whereMonth('created_at', $mois)->count();
             $vente = DB::table('ventes')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->sum('montant');
             $commission = DB::table('commissions')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->sum('commission');
             $nbre_contact_ajouter = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->count();
             $nbre_demo_ajouter = DB::table('demos')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->count();
             //$nbre_contact_ajouter = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->count();
             //$nbre_contact_ajouter = DB::table('contacts')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->count();
             
             
              $obj_moi_com = $commercial->objectif_mois / 4;
                   $demo_moi_com = $commercial->nbre_demo / 4;
                   $contact_moi_com = $commercial->nbre_contact / 4;
                   $visite_moi_com = $commercial->objectif_visite / 4;
    
            
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
             
             if($commercial->nbre_demo){
             $pourcentage_demo_mois = $nbre_demo_ajouter * (100) / ($commercial->nbre_demo);
             }
             else{
                 $pourcentage_demo_mois = 0;
             }
             
             if($commercial->objectif_visite){
             $pourcentage_visite_mois = $visite_ajouter * (100) / ($commercial->objectif_visite);
             }
             else{
                 $pourcentage_visite_mois = 0;
             }
         
                   $perfor_objectV = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('realisation_vente');
                   $perfor_objectC = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('realisation_contact');
                   $perfor_objectD = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('realisation_demo');
                   $perfor_objectVisite = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('realisation_visite');

                   $perfor_objectVp = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('perfo_vente');
                   $perfor_objectCp = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('perfo_contact');
                   $perfor_objectDp = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('perfo_demo');
                   $perfor_objectDVisite = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('perfo_visite');

          $perfor_object = DB::table('performancesbfs')->where('commercial_id', $commercial->id)->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->first();
            if($perfor_object == null)
            {
            DB::table('performancesbfs')
            ->insert([
            'semaine' => 1,
           'objectif_vente' => intval($obj_moi_com),
            'objectif_demo' => intval($demo_moi_com),
            'objectif_contact' => intval($contact_moi_com),
            'objectif_visite' => intval($visite_moi_com),
            
            'realisation_vente' => $vente,
            'realisation_demo' => $nbre_demo_ajouter,
            'realisation_contact' => $nbre_contact_ajouter,
            'realisation_visite' => $visite_ajouter,
            
            'perfo_vente' => $pourcentage_mois,
            'perfo_demo' => $pourcentage_demo_mois,
            'perfo_contact' => $pourcentage_contact_mois,
            'perfo_visite' => $pourcentage_visite_mois,
            
            'commercial_id' => $commercial->id, 
            
            // 'pourcentage_contact_mois' => $pourcentage_contact_mois,
            // 'nbre_contact_ajouter' => $nbre_contact_ajouter,
            // 'nbre_contact' => $commercial->nbre_contact, 
            // 'commission_p' => $commercial->commission_p, 
            // 'pourcentage' => $pourcentage_mois, 
            // 'montant_vente' => $vente,
            // 'commission' => $commission, 
            // 'objectif_mois' => $commercial->objectif_mois,
            // 'commercial_id' => $commercial->id, 
            'created_at' => $now,
            'updated_at' => $now]);
            
  
            }
            
            else {
                
                 DB::table('performancesbfs')
            ->insert([
            'semaine' => 1,
            'objectif_vente' => intval($obj_moi_com),
            'objectif_demo' => intval($demo_moi_com),
            'objectif_contact' => intval($contact_moi_com),
            'objectif_visite' => intval($visite_moi_com),
            
            'realisation_vente' =>  (($vente) - ($perfor_objectV)),
            'realisation_demo' => (($nbre_demo_ajouter) - ($perfor_objectD)),
            'realisation_contact' => (($nbre_contact_ajouter) - ($perfor_objectC)),
            'realisation_visite' => (($visite_ajouter) - ($perfor_objectVisite)),
            
            'perfo_vente' => (($pourcentage_mois) - ($perfor_objectVp)),
            'perfo_demo' => (($pourcentage_demo_mois) - ($perfor_objectDp)),
            'perfo_contact' => (($pourcentage_contact_mois) - ($perfor_objectCp)),
            'perfo_visite' => (($pourcentage_visite_mois) - ($perfor_objectDVisite)),
            
            'commercial_id' => $commercial->id, 
            'created_at' => $now,
            'updated_at' => $now]);
                
            }
            
            
            
            
            // $perfor_reaVente = DB::table('performances')->whereMonth('created_at', $mois)->sum('realisation_vente');
            // $perfor_objectVente = DB::table('performances')->whereMonth('created_at', $mois)->sum('objectif_vente');
            
            
            // $perfor_objectVv = DB::table('performance_globales')->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('realisation_vente');
            // $perfor_objectCv = DB::table('performance_globales')->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('objectif_vente');

                //   $perfor_objectVp = DB::table('performance_globales')->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('perfo_vente');
                //   $perfor_objectCp = DB::table('performance_globales')->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->sum('perfo_contact');

           

         }
         
         
            $perfor_reaVenteGlobal = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('realisation_vente');
            $perfor_objectVenteGlobal = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('objectif_vente');
            
            $perfor_objectVenteGlobalc = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('realisation_contact');
            $perfor_reaVenteGlobalC = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('objectif_contact');
            
            $perfor_objectVenteGlobalD = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('realisation_demo');
            $perfor_reaVenteGlobalD = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('objectif_demo');
            
            $perfor_objectVenteGlobalVisite = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('realisation_visite');
            $perfor_reaVenteGlobalVisite = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('objectif_visite');
            
            $perfor_reaVenteg = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('realisation_vente');
            $perfor_objectVenteg = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('objectif_vente');
            
            $perfor_objectVentegReCont = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('realisation_contact');
            $perfor_objectVenteGlobalObCont = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('objectif_contact');
            
            $perfor_objectVentegDem = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('realisation_demo');
            $perfor_objectVenteGlobalDem = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('objectif_demo');
            
            $perfor_objectVentegReVisite = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('realisation_visite');
            $perfor_objectVenteGlobalObVisite = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('objectif_visite');
            
            $perfor_objectVenteGlobalPerfov = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('perfo_vente');
            $perfor_objectVenteGlobalPerfod = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('perfo_demo');
            $perfor_objectVenteGlobalPerfoc = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('perfo_contact');
            $perfor_objectVenteGlobalPerfovisites = DB::table('performancesbfs')->whereMonth('created_at', $mois)->sum('perfo_visite');

            $perfor_objectVenteGlobalPerfovG = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('perfo_vente');
            $perfor_objectVenteGlobalPerfodG = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('perfo_demo');
            $perfor_objectVenteGlobalPerfocG = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('perfo_contact');
            $perfor_objectVenteGlobalPerfovisite = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->sum('perfo_visite');

            // (($perfor_reaVenteGlobal) - ($perfor_reaVenteg))
            
            // real
            // (($perfor_objectVenteGlobalc) - ($perfor_objectVentegReCont))
            
            // (($perfor_objectVenteGlobalD) - ($perfor_objectVentegDem))
            // obj
            
            // (($perfor_reaVenteGlobalC) - ($perfor_objectVenteGlobalObCont))
            
            // (($perfor_reaVenteGlobalD) - ($perfor_objectVenteGlobalDem))
            
            $perfor_object_g = DB::table('performance_bf_globales')->whereMonth('created_at', $mois)->orderBy('created_at', 'desc')->first();
            if($perfor_object_g == null)
            {
             DB::table('performance_bf_globales')
            ->insert([
            'semaine' => 1,
           'objectif_vente' => intval($sum_semaineOject_com),
            'objectif_demo' => intval($sum_semaineDemo),
            'objectif_contact' => intval($sum_semaineContact),
            'objectif_visite' => intval($sum_semaineVisite),
            
            'realisation_vente' => $perfor_reaVenteGlobal,
            'realisation_demo' => $perfor_objectVenteGlobalD,
            'realisation_contact' => $perfor_objectVenteGlobalc,
            'realisation_visite' => $perfor_objectVenteGlobalVisite,
            
            'perfo_vente' => $perfor_objectVenteGlobalPerfov,
            'perfo_demo' => $perfor_objectVenteGlobalPerfod,
            'perfo_contact' => $perfor_objectVenteGlobalPerfoc,
            'perfo_visite' => $perfor_objectVenteGlobalPerfovisites,
            
            'created_at' => $now,
            'updated_at' => $now]);
            
            }
            
            else {
                
                 DB::table('performance_bf_globales')
            ->insert([
            'semaine' => 1,
           'objectif_vente' => intval($sum_semaineOject_com),
            'objectif_demo' => intval($sum_semaineDemo),
            'objectif_contact' => intval($sum_semaineContact),
            'objectif_visite' => intval($sum_semaineVisite),
            
            'realisation_vente' =>  (($perfor_reaVenteGlobal) - ($perfor_reaVenteg)),
            'realisation_demo' =>  (($perfor_objectVenteGlobalD) - ($perfor_objectVentegDem)),
            'realisation_contact' =>  (($perfor_objectVenteGlobalc) - ($perfor_objectVentegReCont)),
            'realisation_visite' =>  (($perfor_objectVenteGlobalVisite) - ($perfor_objectVentegReVisite)),
            
            'perfo_vente' =>  (($perfor_objectVenteGlobalPerfov) - ($perfor_objectVenteGlobalPerfovG)),
            'perfo_demo' =>  (($perfor_objectVenteGlobalPerfod) - ($perfor_objectVenteGlobalPerfodG)),
            'perfo_contact' =>  (($perfor_objectVenteGlobalPerfoc) - ($perfor_objectVenteGlobalPerfocG)),
            'perfo_visite' =>  (($perfor_objectVenteGlobalPerfovisites) - ($perfor_objectVenteGlobalPerfovisite)),
            
            'created_at' => $now,
            'updated_at' => $now]);
            
            

                
            }
            
    }




    
}
