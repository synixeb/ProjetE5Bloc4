@extends('layouts.master')
@section('content')
    <div>
        <br> <br>
        <br> <br>
        <div class="col-md-12  col-sm-12 well well-md">
            <center><h1>Ajouter une spécialité</h1></center>
                <div class="well">
                    {!! Form::open(['url' => 'postAjouterSpe', 'files' => true]) !!}
                    <div class="col-md-12 well well-sm">
                        <div class="form-group">
                            <select type="text" name="idSpe" value="idSpe" class="form-control" required autofocus />
                            @foreach($AllSpe as $Spe)
                                <option value="{{$Spe->id_specialite}}">{{$Spe->lib_specialite}}</option>
                                @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                            &nbsp
                            <button type="button" class="btn btn-default btn-primary" onclick="{ window.location = '{{url('/')}}';}">
                                <span class="glyphicon glyphicon-remove"></span>Annuler
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
        </div>
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
                    <th style="width:10%">Modifier</th>
                    <th style="width:30%">Supprimer</th>
                </tr>
                </thead>
                @foreach($mesSpe as $uneSpe)
                    <tr>
                        <td>
                            {{$uneSpe->id_specialite}}
                        </td>
                        <td>
                            {{$uneSpe->lib_specialite}}
                        </td>
                            <td style="text-align: center;">
                                <a href="{{url('/modifSpe')}}/{{$uneSpe->id_specialite}}"> <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{url('/supprSpe')}}/{{$uneSpe->id_specialite}}"> <span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Supprimer"></span></a>
                            </td>
                    </tr>
                @endforeach
                <BR> <BR>
            </table>
        </div>
    </div>
@stop
