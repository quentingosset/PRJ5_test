<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class student extends Model
{
    protected $table = 'student';

    public static function listingStudent(){
        $students = DB::table('students')->orderBy('matricule','ASC')->get();

        $arrayUser = array();
        /*foreach ($students as $value ){
            $arrayUser[$value->student]['name'] = $value->name;
            if(array_key_exists('credits',$arrayUser[$value->student])){
                $arrayUser[$value->student]['credits'] += $value->credits;
            }else{
                $arrayUser[$value->student]['credits'] = $value->credits;
            }
        }*/
        return $students;
    }

    public static function progDetails($id){
        $students = DB::table('student')
            ->join('program','student.id', "=", "program.student")
            ->join('course','program.course','=','course.id')
            ->select('course.id','course.title','course.credits')
            ->where('student.id',$id)
            ->orderBy('course.id')
            ->get();
        return $students;
    }

    public static function removeProg($id,$userID){
    $students = DB::table('program')
        ->join('course','program.course','=','course.id')
        ->where('program.student',$userID)
        ->where('program.course',$id)
        ->delete();
    return $students;
    }
}
