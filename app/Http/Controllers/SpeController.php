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
            $unServicePraticien = new ServicePraticien();
            $lesSpeDispo = $unServicePraticien->getSpecialite($oldidSpe);
            return view('vues/ModifSpe', compact('lesSpeDispo'));
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
            $idPraticien = Request::input('idPraticien');
            $idSpecialite = Request::input('idSpecialite');

            $uneSpe = new ServiceSpe();
            $uneSpe->modifSpe($idPraticien, $idSpecialite);

            $unPra = new ServicePraticien();
            $mesPra = $unPra->getListePraticien();
            return view('vues/listerSpe', compact('mesPra'));

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

}
