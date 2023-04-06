<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Exceptions\MonException;
use Request;
use App\metier\Visiteur;
use App\dao\ServiceCompte;

class CompteController
{
    public function getLogin() {
        try {
            $erreur="";
            return view ('vues/formLogin', compact('erreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/pageEmploye', compact('mesEmployes'));
    }

    public function signIn() {
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceCompte();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                if (Session::get('type') === 'P') {
                    return view('vues/homePraticien');
                } else {
                    return view('home');
                }
            } else {
                $erreur = "Login ou mot de passe inconnu";
                return view('vues/formLogin', compact('erreur'));
            }
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/pageEmploye', compact('mesEmployes'));
    }

    public function signOut() {
        $unVisiteur = new ServiceCompte();
        $unVisiteur->logout();
        return view('home');
    }

}
