<?php

namespace App\metier;

class Praticien
{
    protected $table = 'praticien';
    public $timestamps = false;
    public $fillable = [
        'id_praticien',
        'id_type_praticien',
        'nom_praticien',
        'prenom_praticien',
        'adresse_praticien',
        'cp_praticien',
        'ville_praticien',
        'coef_notoriete',
    ];
}
