<?php

namespace App\Http\Controllers;

use App\dao\ServiceSpe;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;

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

}
