@extends('canevas')
@section('title','ChatRoom - ESI')
@section('header_css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{csrf_token()}}">
@stop
@section('header_js')
@stop
@section('footer_js')
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

@stop
@section('content')
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">
            @if( $page === 'welcome')
                Choix de l'étudiant :
                @else
            @endif
        </h5>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>
    <main role="main" class="container">

        @if( $page === 'welcome')
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="border-bottom border-gray pb-2 mb-0">Liste des étudiants :
                    <select class="listeChannel" onchange="showDetails(value)">
                        <option>Veuillez choisir un étudiant</option>
                        @foreach($etudiant as $key => $etu)
                            <option value="{{$key}}">{{$etu['name']." - ".$etu['credits']." crédits"}}</option>
                        @endforeach
                    </select>
                </h6>
            </div>
            <div id="detailsBox" class="col-md-12 bg-white rounded" style="height: 400px;">
                <table class="table">
                    <thead style="text-align: center;">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">CREDITS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;" class="programme">
                    </tbody>
                </table>
            </div>
        @endif
    </main>
@stop