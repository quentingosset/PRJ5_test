<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class student extends Model
{
    protected $table = 'students';

    public static function listingStudent($groupe){
        $students = DB::table('students')->where('groupe',$groupe)->orderBy('matricule','ASC')->get();
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

    function dbConnect(
        $serverName="localhost",
        $dbName="ecole",
        $userName  ="root",
        $password  ="") {
            $conn = new PDO( "mysql:host=$serverName;dbname=$dbName;charset=utf8", 
            $userName, $password);
        return $conn;
    }


    public static function addStudent($group, $nom, $prenom, $matricule){
        // $students = DB::table('sceance')->insert(
        //     ["groupe_id" => $group ,"courses_id" => $course, "dates"=>$date]
        // );
        $quert=DB::insert('INSERT INTO STUDENTS(matricule,nom,prenom,groupe) 
        VALUES(?,?,?,?)',[ $matricule,$nom,$prenom,$group]);
        // $serverName="localhost";
        // $dbName="ecole";
        // $userName  ="root";
        // $password  ="";
        //     $conn = new PDO( "mysql:host=$serverName;dbname=$dbName;charset=utf8", 
        //     $userName, $password);
        // $sql = "INSERT INTO STUDENTS(matricule,nom,prenom,group) 
        // VALUES ($matricule,$nom,$prenom,$group)";
        // $request = $conn->prepare($sql);
        // $request->execute();
        // $conn = null;
        return $quert;
    }

}
