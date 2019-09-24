<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
require_once('db/db.php');

class Sceance extends Controller
{
    protected $table = 'students';

    public function addSceance(){
        $date = $_POST['date'];
        $course = $_POST['course'];
        $group = $_POST['group'];
        // $students = DB::table('sceance')->insert(
        //     ["groupe_id" => $group ,"courses_id" => $course, "dates"=>$date]
        // );
        $conn = dbConnect();
        $sql = "INSERT INTO SEANCE(groupe_id,courses_id,dates) 
        VALUES ($group,$course,$date)";
        $request = $conn->prepare($sql);
        $request->execute();
        $result = $request->fetchAll();
        $conn = null;
    }
}
