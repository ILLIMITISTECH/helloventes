<?php
namespace App\Imports;
use App\User;
use DB ;
use Auth;
use App\Agent;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $facilitateurs = DB::table('facilitateurs')->where('user_id', Auth::user()->id)->first();
        $entreprises = DB::table('entreprises')->where('facilitateur_id', $facilitateurs->id)->OrderBy('created_at', 'desc')->first();
        
        $user = new User;
        $user->prenom = $row[0];
        $user->nom = $row[1];
        $user->email = $row[2];
        $user->fonction = $row[3];
        // $user->whatshap = $row[4];
        // $user->tel = $row[5];
        // $user->groupe = $row[3];
        // $user->sexe = $row[3];
        // $user->date_naiss = $row[4];
        // $user->age = $row[5];
        // $user->pays_id = $row[6];
        $user->password = Hash::make(123456);
        $user->entreprise = $entreprises->id;
        $user->nom_role = 'entreprise';
        $user->save();
        
        $agent = new Agent;
        $agent->prenom = $user->prenom;
        $agent->nom = $user->nom;
        $agent->email = $user->email;
        $agent->fonction = $user->fonction;
        // $agent->whatshap = $user->whatshap;
        // $agent->tel = $user->tel;
        // $agent->date_naiss = $user->date_naiss;
        // $agent->sexe = $user->sexe;
        // $agent->age = $user->age;
        // $agent->pays_id = $user->pays_id;
        // $agent->groupe = $user->groupe;
        $agent->user_id = $user->id;
        $agent->entreprise = $entreprises->id;
        $agent->nom_role = 'entreprise';
        $agent->save();
       
        /*return new User([
            'prenom'     => $row[0],
            'nom'     => $row[1],
            'email'    => $row[2],
            'password' => Hash::make($row[3])
        ]); */
        
     
    }
    
     
}