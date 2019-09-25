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

    public static function presenceSeance($groupe,$course){
        /**
        *   SELECT * FROM students 
        *   JOIN groupe ON students.groupe = groupe.id
        *   JOIN seance ON students.groupe = seance.groupe_id 
        *   LEFT JOIN presence ON students.matricule = presence.students_id 
        *   WHERE (seance.groupe_id = 1 AND seance.courses_id = 1) 
        *   AND ((seance.id = presence.id) || presence.id IS NULL) ORDER BY seance.id
        *
        *   select * from `students` inner join `groupe` on `students`.`groupe` = `groupe`.`id` inner join `seance` on `students`.`groupe` = `seance`.`groupe_id`  left join `presence` on `seance`.`id` = `presence`.`seance_id` and `students`.`matricule` = presence.students_id  where `seance`.`groupe_id` = 1 and `seance`.`courses_id` = 1  order by `seance`.`id` asc
        *
        *
        */

        //DB::enableQueryLog();
    $results = DB::select('select seance.idSeance, students.matricule, presence.types from `students` inner join `groupe` on `students`.`groupe` = `groupe`.`idGroupe` inner join `seance` on `students`.`groupe` = `seance`.`groupe_id` left join `presence` on `seance`.`idSeance` = `presence`.`seance_id`and `students`.`matricule` = presence.matricules where `seance`.`groupe_id` = '.$groupe.' and `seance`.`courses_id` = '.$course.' order by `seance`.`idSeance` asc');
        
        /*$seance = DB::table('students')
            ->join("groupe",'students.groupe','=','groupe.idGroupe')
            ->join("seance",'students.groupe','=','seance.groupe_id')
            ->rightJoin("presence","presence.seance_id","=","seance.idSeance")
            /*->leftJoin("presence",function($join){
                $join->on('presence.seance_id','=','seance.idSeance');
                $join->where("presence.matricules","students.matricule");
            })*/
            //->join("presence",'presence.seance_id','=','seance.id')
            /*->where("seance.groupe_id",$groupe)
            ->where("seance.courses_id",$course)
            ->orderBy('seance.idSeance')
            //->select("presence.types")
            ->get();
            //->get(['seance.*','students.*','presence.*']);
           *///dd(DB::getQueryLog());
            //->keyBy('matricule');
            return $results;

    }

    public static function addSeance($group,$course,$date){
        
        // $students = DB::table('sceance')->insert(
        //     ["groupe_id" => $group ,"courses_id" => $course, "dates"=>$date]
        // );
        // $conn = dbConnect();
        // $sql = "INSERT INTO SEANCE(groupe_id,courses_id,dates) 
        // VALUES ($group,$course,$date)";
        // $request = $conn->prepare($sql);
        // $request->execute();
        // $result = $request->fetchAll();
        // $conn = null;

        $quert=DB::insert('INSERT INTO SEANCE(groupe_id,courses_id,date) 
        VALUES(?,?,?)',[ $group,$course,$date]);
        return $quert;
    }

    public static function addPresence($matricule, $group, $course){

    }

}
