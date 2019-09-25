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

}
