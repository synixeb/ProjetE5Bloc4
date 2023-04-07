@extends('layouts.master')
@section('content')

    <div>
        <br> <br>
        <br> <br>
        <div class="container">
            <div class="blanc">
                <h1>Liste des praticiens</h1>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width:20%">Id</th>
                    <th style="width:20%">Nom</th>
                    <th style="width:20%">Prénom</th>
                    <th style="width:20%">Adresse</th>
                    <th style="width:20%">Code Postal</th>
                    <th style="width:20%">Ville</th>
                    <th style="width:20%">Coefficient</th>
                    <th style="width:20%">Modifier les spécialités</th>
                    <th style="width:20%">Modifier</th>
                    <th style="width:20%">Supprimer</th>
                </tr>
                </thead>
                @foreach($mesPraticiens as $unPraticien)
                    <tr>
                        <td> {{$unPraticien->id_praticien}}</td>
                        <td> {{$unPraticien->nom_praticien}}</td>
                        <td> {{$unPraticien->prenom_praticien}}</td>
                        <td> {{$unPraticien->adresse_praticien}}</td>
                        <td> {{$unPraticien->cp_praticien}}</td>
                        <td> {{$unPraticien->ville_praticien}}</td>
                        <td> {{$unPraticien->coef_notoriete}}</td>
                        @if (Session::get('id')>0)
                            <td>
                                <a href="{{('listerSpe')}}/{{$unPraticien->id_praticien}}"><span class ="glyphicon glyphicon-book" data-toggle="tooltip" data-placement="top" title="ModifierSpe"></span></a>
                            </td>
                        @endif
                        <td style="text-align:center;"><a href="{{ url('/modifierPraticien') }}/{{$unPraticien->id_praticien}}">
                                <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
                        <td style="text-align:center;">
                            <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                               onclick="javascript:if (confirm('Suppression confirmée ?'))
                       { window.location ='{{url('/supprimerPraticien')}}/{{ $unPraticien->id_praticien }}';}">
                            </a>
                        </td>
                    </tr>
                @endforeach
                <BR> <BR>
            </table>
        </div>
    </div>
@stop
