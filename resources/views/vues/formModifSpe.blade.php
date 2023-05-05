@extends('layouts.master')
@section('content')
    <h1>Modifier une specialité</h1>
    {!! Form::open(['url' => 'postModifSpe', 'files' => true]) !!}
    <label for="newNomSpe">Nouvel Spécialité: </label>
    <select name="idSpecialite" id="idSpecialite">
        @foreach($lesSpeDispo as $uneSpe)
            <option value="{{$uneSpe->id_specialite}}">{{$uneSpe->lib_specialite}}</option>
        @endforeach
    </select><br>
    <input type="submit" value="Modifier la specialite">
    {!! Form::close() !!}
@stop
