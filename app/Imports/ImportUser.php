<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

use DB ;
use Auth;
use App\Commerciau;
use App\Prospect_a_appeller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUser implements ToModel
{
    
    public function  __construct(string $commercial_id, $superieur_id) {
    $this->commercial_id= $commercial_id;
     $this->superieur_id= $superieur_id;
}
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $commercial = DB::table('commerciaus')->where('user_id', Auth::user()->id)->first();

        
        $prospect = new Prospect_a_appeller;
        $prospect->nom_entreprise = $row[0];
        $prospect->secteur_activite = $row[1];
        $prospect->nom_contact = $row[2];
        $prospect->tel_contact = $row[3];
        $prospect->solution_a_vendre = $row[4];
        //$prospect->email_entreprise = $row[5];
        //$prospect->email_contact = $row[6]; 
        //$prospect->secteur_activite = $row[7];
        $prospect->commercial_id = $this->commercial_id;
        $prospect->superieur_id = $this->superieur_id; //$commercial->superieur_id;
        if($row[0] != null){
            if($row[0] != null){
        $prospect->save();
        }
        }
       
    
    }
}
