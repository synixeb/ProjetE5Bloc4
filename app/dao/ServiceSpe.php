<?php

namespace App\dao;

use App\Exceptions\MonException;
use App\metier\Praticien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

class ServiceSpe
{
    public function getListeSpe($id)
    {
        try{
            $mesPra= DB::table('posseder')
                ->Select(    'praticien.id_praticien','praticien.nom_praticien','specialite.lib_specialite','diplome','specialite.id_specialite')
                ->From('posseder')
                ->join('praticien', 'praticien.id_praticien' ,'=' ,'posseder.id_praticien')
                ->join('specialite', 'specialite.id_specialite' ,'=' ,'posseder.id_specialite')
                ->where('posseder.id_praticien', '=', $id)
                ->OrderBy('lib_specialite')
                ->get();
            return $mesPra;
        }catch (Exception $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getSuppr($id)
    {
        try{
            $mesPra= DB::table('posseder')
                ->where('posseder.id_specialite','=',$id)
                ->where('posseder.id_praticien','=' ,Session::get('idPra'))
                ->delete();
        }catch (Exception $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function AllSpe()
    {
        try{
            $mesPra= DB::table('specialite')
                ->select('id_specialite', 'lib_specialite')
                ->get();
            return $mesPra;
        }catch (Exception $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function SpeByID($id_Spe){
        try {
            $id_pra=Session::get('idPra');
            $lesSpe = DB::table('specialite')
                ->whereNotExists(function ($query) use ($id_pra) {
                    $query->select(DB::raw(1))
                        ->from('posseder')
                        ->whereRaw('specialite.id_specialite = posseder.id_specialite')
                        ->where('posseder.id_praticien', '=', $id_pra);
                })
                ->get();
            Session::put('idSpe', $id_Spe);
            return $lesSpe;
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function modifSpe($idPra, $idSpe){
        try {
            $oldidSpe = Session::get('idSpe');
            DB::table('posseder')
                ->where('id_praticien', '=', $idPra)
                ->where('id_specialite','=',$oldidSpe)
                ->update(['id_specialite'=> $idSpe]);
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getAjout($idPra ,$idSpe)
    {
        try{
            DB::table('posseder')->insert(
                ['id_praticien'=>$idPra,
                    'id_specialite'=>$idSpe,
                    'diplome'=>'canis canis',
                    'coef_prescription'=>49.3]
            );
        }catch (Exception $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getSpeSearch($nom){
        $results = DB::table('specialite')
            ->where('lib_specialite', 'LIKE', $nom.'%')
            ->get();
        return $results;
    }

    public function getListePraSpe($id)
    {
        try{
            $mesPraSpe= DB::table('posseder')
                ->Select(    'praticien.id_praticien','praticien.nom_praticien', 'praticien.prenom_praticien')
                ->From('posseder')
                ->join('praticien', 'praticien.id_praticien' ,'=' ,'posseder.id_praticien')
                ->join('specialite', 'specialite.id_specialite' ,'=' ,'posseder.id_specialite')
                ->where('posseder.id_specialite', '=', $id)
                ->OrderBy('praticien.id_praticien')
                ->get();
            return $mesPraSpe;
        }catch (Exception $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getListeNonPraSpe($id){
        try {
            $mesNonPraSpe = DB::table('praticien')->whereNotIn('id_praticien', function ($query) {
                $query->select('id_praticien')
                    ->from('posseder')
                    ->where('id_specialite', 2);
            })
                ->get(['id_praticien', 'nom_praticien', 'prenom_praticien']);
            return $mesNonPraSpe;
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }
}
