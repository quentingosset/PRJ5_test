<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\groupe;
use App\Models\courses;
use App\Models\seance;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(student::listingStudent());
    }

    public function progDetaille($id){
        return response()->json(student::progDetails($id));
    }

    public function accueil(){
        return view('welcome',['page' => 'welcome', 'courses' => courses::listingCourses(), 'groupes' => groupe::listingGroupe()]);
    }

    public function presence(Request $request){
        /**
         *   SELECT * FROM students JOIN groupe ON students.groupe = groupe.id JOIN seance ON students.groupe = seance.groupe_id LEFT JOIN presence ON students.matricule = presence.students_id WHERE groupe.id = 1 AND ((seance.id = presence.id) || presence.id IS NULL) ORDER BY seance.id
        */
        return view('welcome',['page' => 'listings', 'courses' => courses::listingCourses(), 'groupes' => groupe::listingGroupe(), 'etudiant' => student::listingStudent($request->input('groupe')), 'sceance' => count(seance::listingSeance($request->input('groupe'),$request->input('course'))), 'presence' => '', 'name_groupe' => courses::getName($request->input('course'))->name]);
    }

    public function delete(){
        return response()->json(student::removeProg($_POST['id'],$_POST['userId']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(true);
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
