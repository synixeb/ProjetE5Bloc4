@extends('layouts.master')
@section('content')

    <div>
        <br> <br>
        <br> <br>
        <div class="container">
            <div class="blanc">
                <h1>Liste des spécialites</h1>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width:10%">Id</th>
                    <th style="width:30%">Libellé</th>
                </tr>
                </thead>
                @foreach($mesSpe as $uneSpe)
                    <tr>
                        <td> {{$uneSpe->id_specialite}}</td>
                        <td> {{$uneSpe->lib_specialite}}</td>
                        <td style="text-align:center;"><a href="{{ url('/modifierSpecialite') }}/{{$uneSpecialite->id_specialite}}">
                                <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
                        <td style="text-align:center;">
                            <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                               onclick="javascript:if (confirm('Suppression confirmée ?'))
                       { window.location ='{{url('/supprimerSpecialite')}}/{{ $uneSpecialite->id_specialite }}';}">
                            </a>
                        </td>
                    </tr>
                @endforeach
                <BR> <BR>
            </table>
        </div>
    </div>
@stop
