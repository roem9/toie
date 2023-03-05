<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Soal extends BaseController
{
    public function index()
    {
        //
    }

    public function getSoal($id_soal)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM soal WHERE id_soal = $id_soal")->getRowArray();
        return json_encode($data);
    }
}
