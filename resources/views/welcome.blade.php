@extends('canevas')
@section('title','ChatRoom - ESI')
@section('header_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<meta name="csrf-token" content="{{csrf_token()}}">
<style>
    .sceance{
        width:28px;
        height:28px;
    }
    tr, th{
        white-space: nowrap;
    }
    
    @media (min-width: 1200px){
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
        $("#seance").click(function (){
            document.location.href = "https://www.dofactory.com/sql/insert";
        })
    });
    </script>
@stop
@section('content')
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">
            @if( $page === 'listings' || $page === 'welcome')
                Programme des présences  :
                @else
            @endif
        </h5>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>
    <main role="main" class="container">
    <!--<main role="main" style="padding: 50px;padding-top: 0;">-->
        @if( $page === 'listings' || $page === 'welcome')
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="row">
                    <div class="col col-lg-3"> 
                        Groupe :
                            <select class="listeGroupe" onChange="selectedListe()">
                                <option value="0">Selectionner un groupe</option>
                                @foreach($groupes as $key => $groupe)
                                    @if($groupe->id == request()->get('groupe'))
                                        <option value="{{$groupe->id}}" selected>{{$groupe->name}}</option>
                                    @else
                                        <option value="{{$groupe->id}}">{{$groupe->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                    <div class="col col-lg-4"> 
                        Cours :
                            <select class="listeCourse" onChange="selectedListe()">
                                <option value="0">Selectionner un cours </option>
                                @foreach($courses as $key => $course)
                                    @if($course->id == request()->get('course'))
                                        <option value="{{$course->id}}" selected>{{$course->name}}</option>
                                    @else
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                    <div class="col col-lg-5" style="text-align: right;">
                    <button type="button" id="seance" class="btn btn-primary" data-toggle="modal" data-target="#addStudent">Ajouter un étudiant</button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPresence">Faire les présences</button>
                    </div>
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
                            @for ($i = 1; $i <= $sceance; $i++)
                                <th scope="col" class="no-sort sceance">{{$i}}</th>
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
                                @for ($i = 1; $i <= $sceance; $i++)
                                    <td class="sceance bg-danger" onclick="changeTypePresence(event,{{$etu->matricule}})"></td>
                                @endfor
                                <td>1/{{$sceance}}</td>
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
                <h5 class="modal-title" id="exampleModalLabel">Faire les présences</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="formPresence">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Groupe : <b class="input_groupe">{{$name_groupe}}</b></label>
                    <input type="hidden" class="form-control" id="formPresence_groupe">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Cours : <b class="input_courses">X</b></label>
                    <input type="hidden" class="form-control" id="formPresence_course">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Date:</label>
                    <input type="date" class="form-control" id="formPresence_date">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Ajouter</button>
            </div>
            </div>
        </div>
        @endif
</div>
@stop