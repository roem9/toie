<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Soal extends BaseController
{
    public function index()
    {
        $data['sidebar'] = "soal";
        $data['title'] = "Soal TOEFL";
        $data['breadcrumbs'] = ["Soal TOEFL"];
        $data['searchButton'] = false;

        return view('pages/tes', $data);
    }

    public function getAllSoal(){
        $db = db_connect();
        $builder = $db->table('soal')
            ->where(["hapus" => 0])
            ->select('id_soal, nama_soal, catatan, DATE_FORMAT(tgl_pembuatan, "%d-%M-%Y") as tgl_pembuatan');

        return DataTable::of($builder)->toJson(true);
    }
}
