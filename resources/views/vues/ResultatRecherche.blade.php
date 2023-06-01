@extends('layouts.master')
@section('content')
    @if (Session::get('type')!="")
        <h1>Les Praticiens</h1>
        <br>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th style="width:20%">Id</th>
                <th style="width:20%">Nom</th>
                <th style="width:20%">Prénom</th>
                <th style="width:20%">Adresse</th>
                <th style="width:20%">Code Postal</th>
                <th style="width:20%">Ville</th>
                <th style="width:20%">Coefficient</th>

                @if (Session::get('id')>0)
                    <th style="width:20%">Modifier les spécialités</th>
                @endif
            </tr>
            </thead>
            @foreach($SearchPra as $unPraticien)
                <tr>
                    <td> {{$unPraticien->id_praticien}}</td>
                    <td> {{$unPraticien->nom_praticien}}</td>
                    <td> {{$unPraticien->prenom_praticien}}</td>
                    <td> {{$unPraticien->adresse_praticien}}</td>
                    <td> {{$unPraticien->cp_praticien}}</td>
                    <td> {{$unPraticien->ville_praticien}}</td>
                    <td> {{$unPraticien->coef_notoriete}}</td>
                    @if (Session::get('id')>0)
                        <td style="text-align: center;">
                            <a href="{{url('/listerSpe')}}/{{$unPraticien->id_praticien}}"> <span class="glyphicon glyphicon-book" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>

        <h1>Les Spécialités</h1>
        <br>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th style="width:10%">Id</th>
                <th style="width:30%">Libellé</th>
                <th style="width:10%">Modifier</th>
            </tr>
            </thead>
            @foreach($SearchSpe as $lesSpe)
                <tr>
                    <td>
                        {{$lesSpe->id_specialite}}
                    </td>
                    <td>
                        {{$lesSpe->lib_specialite}}
                    </td>
                    <td style="text-align: center;">
                        <a href="{{url('/modifSpe')}}/{{$lesSpe->id_specialite}}"> <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a>
                    </td>

                </tr>
            @endforeach
        </table>
    @endif
@stop
