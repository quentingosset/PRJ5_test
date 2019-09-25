<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class courses extends Model
{
    protected $table = 'courses';

    public static function listingCourses(){
        $courses = DB::table('courses')->orderBy('name','ASC')->get();
        return $courses;
    }

    public static function getName($idCourse){
        $name = DB::table('courses')->select('name')->where('idCourses',$idCourse)->first();
        return empty($name)? null : $name ;
    }

}
