<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class seance extends Model
{
    protected $table = 'seance';

    public static function listingSeance($groupe,$course){
        $seance = DB::table('seance')
            ->where("groupe_id",$groupe)
            ->where("courses_id",$course)
            ->get();
        return $seance;
    }

}
