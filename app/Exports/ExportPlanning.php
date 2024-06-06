<?php

namespace App\Exports;

use App\User;
use App\Prospect_a_appeller;
use App\Prospection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPlanning implements FromCollection
{
    
//     protected $id;

//  function __construct($id) {
//         $this->id = $id;
//  }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $top_mois = date('m');
        $annee = date('Y');
        
           $weekday = " ";
            
                        $saturday = strtotime('monday this week');
                        
                        
                        foreach (range(0,0) as $day) {
                            $weekday = date("Y-m-d", (($day * 86400) + $saturday));
                        }
          
            $weekday_plus4 = (date('d', strtotime($weekday)) + 4);       
        return Prospection::select('prospections.date','prospections.heure_debut','prospections.statut', 'prospects.nom_entreprise', 'commerciaus.prenom','commerciaus.nom')
                        ->join('prospects', 'prospects.id', 'prospections.prospect_id')
                        ->join('commerciaus', 'commerciaus.id', 'prospections.commercial_id')
                        ->whereYear('prospections.created_at', $annee)
                        ->whereMonth('prospections.created_at', $top_mois)
                        ->whereDay('prospections.created_at', '>=' ,  date('d',  strtotime($weekday)))
                        ->whereDay('prospections.created_at', '<=' , $weekday_plus4)
            ->orderby('prospections.date', 'asc')
            ->get();
    }
}
