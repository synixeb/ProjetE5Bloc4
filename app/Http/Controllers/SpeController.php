<?php

namespace App\Http\Controllers;

use App\dao\ServiceSpe;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use App\DAO\ServicePraticien;
use App\DAO\ServiceSpecialite;
use Illuminate\Support\Facades\Request;

class SpeController
{
    public function SpebyID($id){
        try {
            $uneSpe = new ServiceSpe();
            $mesSpe = $uneSpe->getListeSpe($id);
            $AllSpe = $uneSpe->SpeByID($id);
            Session::put('idPra', $id);
            return view('vues/listerSpe', compact('mesSpe' ,'AllSpe'));
        } catch (monException $e) {
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        } catch (Exception $e) {
            $Erreur = $e->getMessage();
            return view('vues/pageErreur', compact('Erreur'));
        }
    }

    // supprime une specialite d'un praticien
    public function suppr($id){
        try {
            $idPra=Session::get('idPra');
            $uneSuppr = new ServiceSpe();
            $uneSuppr->getSuppr($id);

            $unServiceSpe = new ServiceSpe();
            $mesSpe = $unServiceSpe->getListeSpe($idPra);

            $unServiceSpe = new ServiceSpe();
            $AllSpe = $unServiceSpe->AllSpe();
            return view('vues/listerSpe', compact('mesSpe', 'AllSpe'));
        } catch (monException $e) {
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        } catch (Exception $e) {
            $Erreur = $e->getMessage();
            return view('vues/pageErreur', compact('Erreur'));
        }
    }

    // change la specialite d'un praticien
    public function modifSpe($oldidSpe){
        try {
            Session::put('idSpe',$oldidSpe);
            $unServiceSpe = new ServiceSpe();
            $lesSpeDispo = $unServiceSpe->AllSpe();
            return view('vues/formModifSpe', compact('lesSpeDispo'));
        } catch (monException $e) {
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        } catch (Exception $e) {
            $Erreur = $e->getMessage();
            return view('vues/pageErreur', compact('Erreur'));
        }
    }

    // envoie les données de la specialite modifié
    public function postmodifSpe(){
        try {
            $idPraticien = Session::get('idPra');
            $idSpecialite = Request::input('idSpecialite');

            $uneSpe = new ServiceSpe();
            $AllSpe = $uneSpe->AllSpe();


            $moSpe = new ServiceSpe();
            $laSpe = $moSpe->modifSpe($idPraticien, $idSpecialite);

            $lesSpe = new ServiceSpe();
            $mesSpe = $lesSpe->SpeById($idPraticien);
            return redirect()->to('listerSpe/'.$idPraticien);

        } catch (monException $e) {
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        } catch (Exception $e) {
            $Erreur = $e->getMessage();
            return view('vues/pageErreur', compact('Erreur'));
        }
    }

    // envoie les données de la specialite ajouté
    public function postAjout(){
        try {

            $idPra = Session::get('idPra');
            $idSpe = Request::input('idSpe');

            $unServiceSpe = new ServiceSpe();
            $unServiceSpe->getAjout($idPra ,$idSpe);

            $mesSpe = $unServiceSpe->getListeSpe($idPra);
            $AllSpe = $unServiceSpe->AllSpe();
            return view('vues/listerSpe', compact('mesSpe','AllSpe'));
        } catch (monException $e) {
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        } catch (Exception $e) {
            $Erreur = $e->getMessage();
            return view('vues/pageErreur', compact('Erreur'));
        }
    }

    public function getListePraSpe() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpe = new ServiceSpe();
            $mesSpe = $unServiceSpe->AllSpe();
            return view('Vues/ListePraSpe', compact('mesSpe', 'monErreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function postListePraSpe()
    {
        try {
            $id = Request::input("idSpe");

            $uneSpe = new ServiceSpe();
            $resultPraSpe = $uneSpe->getListePraSpe($id);


            return view('vues/resultatPraSpe', compact('resultPraSpe', 'resultPraSpe'));
        } catch (monException $e) {
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        }
    }


}
