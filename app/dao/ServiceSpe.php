<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Support\Facades\DB;

class ServiceSpe
{
    public function getListeSpecialites() {
        try {
            $lesSpecialites = DB::table('posseder')
                ->Select()
                ->OrderBy('id_specialite')
                ->get();
            return $lesSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}
