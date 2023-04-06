<?php

namespace App\Http\Controllers;

use App\dao\ServiceSpe;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;

class SpeController
{
    public function SpeByID() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpe = new ServiceSpe();
            $mesSpecialites = $unServiceSpe->getListeSpecialites();
            return view('Vues/listerSpe', compact('mesSpecialites', 'monErreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

}
