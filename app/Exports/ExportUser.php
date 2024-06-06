<?php

namespace App\Exports;

use App\User;
use App\Prospect_a_appeller;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUser implements FromCollection
{
    
    protected $id;

 function __construct($id) {
        $this->id = $id;
 }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prospect_a_appeller::where('commercial_id', $this->id)->get();
    }
}
