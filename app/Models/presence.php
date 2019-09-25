<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class presence extends Model
{
    protected $table = 'presence';
    protected $fillable = ['seance_id','matricules','types'];
    public $timestamps = false;

}
