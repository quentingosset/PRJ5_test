@extends('canevas')
@section('title','ChatRoom - ESI')
@section('header_css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<meta name="csrf-token" content="{{csrf_token()}}">
<style>
    .sceance {
        width: 28px;
        height: 28px;
    }

    tr,
    th {
        white-space: nowrap;
    }

    .programme>tr>td {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .sticky {
        position: sticky;
        z-index: 1;
        top: 0;
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 1700px;
        }
    }
</style>
@stop
@section('header_js')
@stop
@section('footer_js')
@if( $page === 'listings' || $page === 'welcome')
<script src="{{ asset('js/scriptListings.js') }}"></script>
@endif
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@stop
@section('content')
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        @if( $page === 'listings' || $page === 'welcome')
        Programme des présences :
        @else
        @endif
    </h5>
    </div>
<main role="main" class="container">
    <!--<main role="main" style="padding: 50px;padding-top: 0;">-->
    @if( $page === 'listings' || $page === 'welcome')
    <div class="my-3 p-3 bg-white rounded shadow-sm sticky">
        <div class="row">
            <div class="col col-lg-3">
                Groupe :
                <select class="form-control listeGroupe" onChange="selectedListe()">
                    <option value="0" selected disabled>Selectionner un groupe</option>
                    @foreach($groupes as $key => $groupe)
                    @if($groupe->idGroupe == request()->get('groupe'))
                    <option value="{{$groupe->idGroupe}}" selected>{{$groupe->name}}</option>
                    @else
                    <option value="{{$groupe->idGroupe}}">{{$groupe->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col col-lg-4">
                Cours :
                <select class="form-control listeCourse" onChange="selectedListe()">
                    <option value="0" selected disabled>Selectionner un cours </option>
                    @foreach($courses as $key => $course)
                    @if($course->idCourses == request()->get('course'))
                    <option value="{{$course->idCourses}}" selected>{{$course->name}}</option>
                    @else
                    <option value="{{$course->idCourses}}">{{$course->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @if( $page === 'listings')
                <div class="col col-lg-5" style="text-align: right;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudent">Ajouter un étudiant</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPresence">Ajouter une séance</button>
                </div>
            @endif
        </div>
    </div>
    @if( $page === 'listings')
    <div id="detailsBox" class="col-md-12 p-3 bg-white rounded">
        <table id="table_id" class="table table-striped table-bordered">
            <thead style="text-align: center;">
                <tr>
                    <th scope="col">MATRICULE</th>
                    <th scope="col">NOM</th>
                    <th scope="col" class="no-sort">PRENOM</th>
                    @for ($i = 0; $i < count($sceance); $i++) <th scope="col" class="no-sort sceance">{{date("d/m", strtotime($sceance[$i]->date))}}</th>
                        @endfor
                        <th scope="col" class="no-sort">PRESENCE</th>
                </tr>
            </thead>
            <tbody style="text-align: center;" class="programme">
                @foreach($etudiant as $key => $etu)
                <tr class="">
                    <td>{{strtoupper($etu->matricule)}}</td>
                    <td>{{strtoupper($etu->nom)}}</td>
                    <td>{{strtoupper($etu->prenom)}}</td>
                    @php
                    $counter = count($presence[$etu->matricule]);
                    @endphp
                    @for ($i = 1; $i <= count($sceance); $i++)
                    @php $test=$presence[$etu->matricule][$i];

                        @endphp
                        @switch($test)
                        @case(1)
                        <td class="sceance bg-success" data-presence="1" onclick="changeTypePresence(event,{{$etu->matricule}},{{$i}})"></td>
                        @break
                        @case(2)
                        @php
                         $counter--;
                        @endphp
                        <td class="sceance bg-warning" data-presence="2" onclick="changeTypePresence(event,{{$etu->matricule}},{{$i}})"></td>
                        @break
                        @case(0)
                        @default
                        @php
                         $counter--;
                        @endphp
                        <td class="sceance bg-danger" data-presence="3" onclick="changeTypePresence(event,{{$etu->matricule}},{{$i}})"></td>
                        @endswitch
                        @endfor
                <td>{{$counter}}/{{count($sceance)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table" style="width: auto;max-width: min-content;">
            <thead>
                <tr>
                    <th scope="col">Legende :</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr style="/* width:20% */">
                    <td style="width: 20%;">Présent</td>
                    <td class="sceance bg-success"></td>
                </tr>
                <tr>
                    <td>Malade</td>
                    <td class="sceance bg-warning"></td>
                </tr>
                <tr>
                    <td>Absent</td>
                    <td class="sceance bg-danger"></td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    @endif
</main>
@if( $page === 'listings')
<div class="modal fade" id="addPresence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une séance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="formPresence">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Groupe : <b class="input_groupe">{{$name_groupe}}</b></label>
                        <input type="hidden" class="form-control" value="{{request()->get('groupe')}}" id="formPresence_groupe">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Cours : <b class="input_courses">{{$name_courses}}</b></label>
                        <input type="hidden" class="form-control" value="{{request()->get('course')}}" id="formPresence_course">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date:</label>
                        <input type="date" class="form-control" id="formPresence_date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary dismissAddPresence" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary buttonAddPresence" onclick="addPresence()">Ajouter</button>
                <button class="btn btn-primary buttonAddPresenceWait" style="display:none" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Veuillez patienter...
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un étudiant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="formPresence">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nom : </label>
                            <input type="text" class="form-control" placeholder="Nom de l'étudiant" id="formEtudiantNom" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Prénom : </label>
                            <input type="text" class="form-control" placeholder="Prénom de l'étudiant" id="formEtudiantPrenom" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Matricule :</label>
                            <input type="number" class="form-control" placeholder="00000" id="formEtudiantMatricule" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Groupe :</label>
                            <select class="form-control" id="formEtudiantGroupe" required>
                                <option value="0" selected disabled>Selectionner un cours </option>
                                @foreach($groupes as $key => $groupe)
                                    <option value="{{$groupe->idGroupe}}">{{$groupe->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary dismissAddStudent" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary buttonAddStudent" onclick="addStudent()">Ajouter</button>
                    <button class="btn btn-primary buttonAddStudentWait" style="display:none" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Veuillez patienter...
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
   @stop
