<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class groupe extends Model
{
    protected $table = 'groupe';

    public static function listingGroupe(){
        $groupes = DB::table('groupe')->orderBy('name','ASC')->get();
        return $groupes;
    }

    public static function getName($idGroupe){
        $name = DB::table('groupe')->select('name')->where('idGroupe',$idGroupe)->first();
        return empty($name)? null : $name ;
    }
}
