@extends('layouts.master')
@section('content')
    @if (Session::get('type')!="")
        <h1>Les Praticiens qui ne possèdent pas la spécialité</h1>
        <br>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th style="width:20%">Id</th>
                <th style="width:20%">Nom</th>
                <th style="width:20%">Prénom</th>
            </tr>
            </thead>
            @foreach($resultNonPraSpe as $unPraticien)
                <tr>
                    <td> {{$unPraticien->id_praticien}}</td>
                    <td> {{$unPraticien->nom_praticien}}</td>
                    <td> {{$unPraticien->prenom_praticien}}</td>
                </tr>
            @endforeach
        </table>
    @endif
@stop
