@extends('layouts.master')
@section('content')
    <div>
        <br> <br>
        <br> <br>
        <div class="col-md-12  col-sm-12 well well-md">
            <center><h1>Ajouter une spécialité</h1></center>
            <div class="well">
                {!! Form::open(['url' => 'postListeNonPraSpe', 'files' => true]) !!}
                <div class="col-md-12 well well-sm">
                    <div class="form-group">
                        <select type="text" name="idSpe" value="idSpe" class="form-control" required autofocus />
                        @foreach($mesSpe as $uneSpe)
                            <option value="{{$uneSpe->id_specialite}}">{{$uneSpe->lib_specialite}}</option>
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
@stop
