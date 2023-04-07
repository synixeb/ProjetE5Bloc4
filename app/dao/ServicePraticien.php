<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use App\metier\Praticien;

class ServicePraticien
{
    public function getListePraticien() {
        try {
            $lesPraticiens = DB::table('praticien')
                ->Select()
                ->OrderBy('id_praticien')
                ->get();
            return $lesPraticiens;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getById($id_praticien) {
        try {
            $lesPraticiens = DB::table('praticien')
                ->Select()
                ->where('praticien.id_praticien', '=', $id_praticien)
                ->first();
            return $lesPraticiens;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function insertPraticien($id_type_praticien,
    $nom_praticien, $prenom_praticien, $adresse_praticien, $cp_praticien,
    $ville_praticien, $coef_notoriete) {
        try {
            DB::table('praticien')->insert(
                ['id_type_praticien'=>$id_type_praticien,
                    'nom_praticien'=>$nom_praticien,
                    'prenom_praticien'=>$prenom_praticien,
                    'adresse_praticien'=>$adresse_praticien,
                    'cp_praticien'=>$cp_praticien,
                    'ville_praticien'=>$ville_praticien,
                    'coef_notoriete'=>$coef_notoriete]
            );
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function updatePraticien($id_praticien, $id_type_praticien,
                                    $nom_praticien, $prenom_praticien, $adresse_praticien, $cp_praticien,
                                    $ville_praticien, $coef_notoriete) {
        try {
            DB::table('praticien')
                ->where('id_praticien', '=', $id_praticien)
                ->update(['id_type_praticien'=>$id_type_praticien,
                    'nom_praticien'=>$nom_praticien,
                    'prenom_praticien'=>$prenom_praticien,
                    'adresse_praticien'=>$adresse_praticien,
                    'cp_praticien'=>$cp_praticien,
                    'ville_praticien'=>$ville_praticien,
                    'coef_notoriete'=>$coef_notoriete]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deletePraticien($id_praticien) {
        try {
            DB::table('praticien')->where('id_praticien', '=', $id_praticien)->delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getSpecialite($idSpe){
        $lesSpe = DB::table('specialite')
            ->whereNotExists( function($query) use ($idSpe){
                $idPra=Session::get('idPra');
                $query->select(DB::Raw(1))
                    ->from('posseder')
                    ->whereRaw('posseder.id_specialite = specialite.id_specialite')
                    ->where('id_praticien', '=', $idPra);
            })
            ->get();
        Session::put('idSpe', $idSpe);
        return $lesSpe;
    }
}
