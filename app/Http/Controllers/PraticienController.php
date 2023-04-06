<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Exceptions\MonException;
use Request;
use App\metier\Praticien;
use App\dao\ServicePraticien;


class PraticienController
{
    public function getPraticienListe() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServicePraticien = new ServicePraticien();
            $mesPraticiens = $unServicePraticien->getListePraticien();
            return view('Vues/listerPraticien', compact('mesPraticiens', 'monErreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function addPraticien() {
        try {
            $unPraticien = new Praticien();
            $monErreur = "";
            $titreVue = "Ajout d'un praticien";
            return view('Vues/AjoutPraticien', compact('unPraticien', 'titreVue', 'monErreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('Vues/error', compact('monErreur'));
        }
    }

    public function supprimePraticien($id_praticien) {
        $unServicePraticien = new ServicePraticien();
        try {
            $unServicePraticien->deletePraticien($id_praticien);
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('Vues/error', compact('monErreur'));
        } catch (Exception $e) {
            Session::put('monErreur', $e->getMessage());
        } finally {
            return redirect('/getPraticienListe');
        }

    }

    public function updatePraticien($id_praticien) {
        try {
            $monErreur = "";
            $unServicePraticien = new ServicePraticien();
            $unPraticien = $unServicePraticien->getById($id_praticien);
            $titreVue = "Modification d'un praticien";
            return view('vues/ModifPraticien', compact('unPraticien', 'titreVue', 'monErreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function validateUpdatePraticien() {
        try {
            $id_praticien = Request::input('idpraticien');
            $id_type_praticien = Request::input('typepraticien');
            $nom_praticien = Request::input('nompraticien');
            $prenom_praticien = Request::input('prenompraticien');
            $adresse_praticien = Request::input('adressepraticien');
            $cp_praticien = Request::input('cppraticien');
            $ville_praticien = Request::input('villepraticien');
            $coef_notoriete = Request::input('coefnotoriete');
            $unServicePraticien = new ServicePraticien();
            $unServicePraticien->updatePraticien($id_praticien, $id_type_praticien, $nom_praticien, $prenom_praticien, $adresse_praticien, $cp_praticien, $ville_praticien, $coef_notoriete);
            return redirect('/getPraticienListe');
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function validateInsertPraticien() {
        try {
            $id_type_praticien = Request::input('typepraticien');
            $nom_praticien = Request::input('nompraticien');
            $prenom_praticien = Request::input('prenompraticien');
            $adresse_praticien = Request::input('adressepraticien');
            $cp_praticien = Request::input('cppraticien');
            $ville_praticien = Request::input('villepraticien');
            $coef_notoriete = Request::input('coefnotoriete');

            $unServicePraticien = new ServicePraticien();
            $unServicePraticien->insertPraticien($id_type_praticien, $nom_praticien, $prenom_praticien,
                $adresse_praticien, $cp_praticien, $ville_praticien, $coef_notoriete);
            return redirect('/getPraticienListe');
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }
}
