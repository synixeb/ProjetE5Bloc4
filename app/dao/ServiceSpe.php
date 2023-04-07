<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

}
