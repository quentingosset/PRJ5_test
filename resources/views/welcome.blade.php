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
</style>
@stop
@section('header_js')
@stop
@section('footer_js')
    @if( $page === 'listings')
        <script src="{{ asset('js/scriptListings.js') }}"></script>
    @endif
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@stop
@section('content')
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">
            @if( $page === 'listings')
                Liste des etudiants :
                @else
            @endif
        </h5>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>
    <main role="main" class="container">

        @if( $page === 'listings')
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="row">
                    <div class="col col-lg-7"> 
                        Groupe :
                            <select class="listeChannel" onchange="showDetails()">
                                <option>E12</option>
                                @foreach($etudiant as $key => $etu)
                                    <option value="{{$key}}">{{$etu->nom." - ".$etu->prenom." crédits"}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col col-lg-5" style="text-align: right;">
                    <button type="button" class="btn btn-primary">Ajouter un étudiant</button>
                        <button type="button" class="btn btn-success">Faire les présences</button>
                    </div>
                </div>
            </div>
            <div id="detailsBox" class="col-md-12 p-3 bg-white rounded">
                <table id="table_id" class="table table-striped table-bordered">
                    <thead style="text-align: center;">
                        <tr>
                            <th scope="col">MATRICULE</th>
                            <th scope="col">NOM</th>
                            <th scope="col" class="no-sort">PRENOM</th>
                            <th scope="col" class="no-sort sceance">1</th>
                            <th scope="col" class="no-sort sceance">2</th>
                            <th scope="col" class="no-sort sceance">3</th>
                            <th scope="col" class="no-sort sceance">4</th>
                            <th scope="col" class="no-sort sceance">5</th>
                            <th scope="col" class="no-sort sceance">6</th>
                            <th scope="col" class="no-sort sceance">7</th>
                            <th scope="col" class="no-sort sceance">8</th>
                            <th scope="col" class="no-sort sceance">9</th>
                            <th scope="col" class="no-sort sceance">10</th>
                            <th scope="col" class="no-sort sceance">11</th>
                            <th scope="col" class="no-sort sceance">12</th>
                            <th scope="col" class="no-sort sceance">13</th>
                            <th scope="col" class="no-sort sceance">14</th>
                            <th scope="col" class="no-sort">PRESENCE</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;" class="programme">
                        @foreach($etudiant as $key => $etu)
                            <tr class="">
                                <td>{{strtoupper($etu->matricule)}}</td>
                                <td>{{strtoupper($etu->nom)}}</td>
                                <td>{{strtoupper($etu->prenom)}}</td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td class="sceance"></td>
                                <td>1/2</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>
@stop