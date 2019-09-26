<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\groupe;
use App\Models\courses;
use App\Models\seance;
use App\Models\presence;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    public function accueil(){
        return view('welcome',['page' => 'welcome', 'courses' => courses::listingCourses(), 'groupes' => groupe::listingGroupe()]);
    }

    public function presence(Request $request){
        //return seance::presenceSeance($request->input('groupe'),$request->input('course'));
        /** formatage en tableau USER => SCEANCE => TYPE  */
        $presence = seance::presenceSeance($request->input('groupe'),$request->input('course'));
        $formatPresence = array();
        foreach ($presence as $key => $value) {
            if(!array_key_exists("".$value->matricule,$formatPresence)){
                $formatPresence[$value->matricule][$value->idSeance] = $value->types;
            }else{
                if(!array_key_exists("".$value->idSeance,$formatPresence[$value->matricule])){
                    $formatPresence[$value->matricule][$value->idSeance] = $value->types;
                }
            }
        }
        return view('welcome',
        ['page' => 'listings', 
        'courses' => courses::listingCourses(), 
        'groupes' => groupe::listingGroupe(), 
        'etudiant' => student::listingStudent($request->input('groupe')), 
        'sceance' => seance::listingSeance($request->input('groupe'),$request->input('course')), 
        'presence' => $formatPresence, 
        'name_groupe' => groupe::getName($request->input('groupe'))->name,
        'name_courses' => courses::getName($request->input('course'))->name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $temp = student::addStudent($request->input("group"),$request->input("nom"),$request->input("prenom"),$request->input("matricule"));
        return response()->json($temp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSeance(Request $request)
    {
        $temp = seance::addSeance($request->input("group"),$request->input("course"),$request->input("date"));
        return response()->json($temp);
    }

    public function createPresence(Request $request){
        
        $pres = presence::updateOrCreate(
            ['seance_id' => $request->input('seance'), 'matricules' => $request->input('matricule')],
            ['types' => $request->input('type')]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        //
    }
}
