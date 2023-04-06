@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'validerInsertPraticien']) !!}
<div class="col-md-12  col-sm-12 well well-md">
    <center><h1>Ajouter un praticien</h1></center>
    <div class="form-horizontal">



        <div class="form-group">
            <label class="col-md-3 col-sm-3 control-label">Type de praticien : </label>
            <div class="col-md-2  col-sm-2">
                <input type="number" name="typepraticien" value=" {{$unPraticien->id_type_praticien ?? 0}} "  class="form-control" placeholder="ID" required autofocus>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 col-sm-3 control-label">Nom : </label>
            <div class="col-md-2 col-sm-2">
                <input type="text" name="nompraticien" value="{{$unPraticien->nom_praticien ?? ""}} " class="form-control" placeholder="Le nom" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 col-sm-3 control-label">Prénom : </label>
            <div class="col-md-2 col-sm-2">
                <input type="text" name="prenompraticien" value="{{$unPraticien->prenom_praticien ?? ""}} " class="form-control" placeholder="Le prénom" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 col-sm-3 control-label">Adresse : </label>
            <div class="col-md-2 col-sm-2">
                <input type="text" name="adressepraticien" value="{{$unPraticien->adresse_praticien ?? ""}} " class="form-control" placeholder="L'adresse" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 col-sm-3 control-label">Code postal : </label>
            <div class="col-md-2 col-sm-2">
                <input type="text" name="cppraticien" value="{{$unPraticien->cp_praticien ?? ""}} " class="form-control" placeholder="00000" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 col-sm-3 control-label">Ville : </label>
            <div class="col-md-2 col-sm-2">
                <input type="text" name="villepraticien" value="{{$unPraticien->ville_praticien ?? ""}} " class="form-control" placeholder="La ville" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 col-sm-3 control-label">Coefficient de notoriété : </label>
            <div class="col-md-2 col-sm-2">
                <input type="number" name="adressepraticien" value="{{$unPraticien->coef_notoriete ?? ""}} " class="form-control" placeholder="Le coefficient" required>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <button type="submit" class="btn btn-default btn-primary">
                    <span class="glyphicon glyphicon-ok"></span> Valider
                </button>
                &nbsp;
                <button type="button" class="btn btn-default btn-primary"
                        onclick="javascript: window.location = '';">
                    <span class="glyphicon glyphicon-remove"></span> Annuler</button>
            </div>
        </div>
    </div>
</div>
    @stop
