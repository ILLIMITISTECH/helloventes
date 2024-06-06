<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

use DB ;
use Auth;
use App\Commerciau;
use App\Bdd_prospect;
use App\Prospect_a_appeller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportBdd implements ToModel
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

        
        $prospect = new Bdd_prospect;
        $prospect->pays = $row[0];
        $prospect->ville = $row[1];
        $prospect->nom_entreprise = $row[2];
        $prospect->adresse = $row[3];
        // $prospect->phone = $row[4];
        $prospect->email_entreprise = $row[4];
        $prospect->site_web = $row[5]; 
        $prospect->secteur = $row[6];
        $prospect->taille_prospect = $row[7];
        $prospect->type_prospect = $row[8];
        $prospect->commercial1 = $row[9];
        $prospect->commercial2 = $row[10];
        $prospect->nom_contact1 = $row[11];
        $prospect->prenom_contact1 = $row[12];
        $prospect->email_contact1 = $row[13]; 
        $prospect->fonction_contact1 = $row[13];
        $prospect->mobile_contact1 = $row[14];
        $prospect->whatshap_contact1 = $row[15];
        $prospect->nom_contact2 = $row[16];
        $prospect->prenom_contact2 = $row[17];
        $prospect->email_contact2 = $row[18]; 
        $prospect->fonction_contact2 = $row[19];
        $prospect->mobile_contact2 = $row[20];
        $prospect->whatshap_contact2 = $row[21];
        //$prospect->email_1 = $row[22];
        //$prospect->email_2 = $row[23];
        //$prospect->commercial_id = $commercial->id;
        //$prospect->superieur_id = $commercial->superieur_id;
       
        if($row[0] != null){
            if($row[0] != null){
        $prospect->save();
        }
        }
       
    
    }
}
