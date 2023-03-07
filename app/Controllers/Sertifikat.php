<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Sertifikat extends BaseController
{
    public function toefl($url, $id_peserta){
        $db = db_connect();
        $data = $db->query("SELECT no_doc, tgl_tes, nilai_listening, nilai_reading, nilai_structure, a.alamat, nama, t4_lahir, tgl_lahir, logo FROM peserta_toefl as a JOIN tes_toefl as b ON a.id_tes = b.id_tes JOIN client as c ON b.fk_id_client = c.id_client WHERE md5(id) = '$id_peserta' AND c.url = '$url'")->getRowArray();

        if(isset($data)){
            $data['title'] = 'Sertifikat';
            $data['no_doc'] = no_doc($data['no_doc']);
            $data['hari'] = date('d', strtotime($data['tgl_tes']));
            $data['tahun'] = date('y', strtotime($data['tgl_tes']));
            $data['bulan'] = getHurufBulan(date('m', strtotime($data['tgl_tes'])));
            $data['listening'] = poin("Listening", $data['nilai_listening']);
            $data['structure'] = poin("Structure", $data['nilai_structure']);
            $data['reading'] = poin("Reading", $data['nilai_reading']);
            $data['tgl_tes'] = date('Y-m-d', strtotime($data['tgl_tes']));
            $data['tgl_berakhir'] = date('Y-m-d', strtotime('+1 year', strtotime($data['tgl_tes'])));
            $data['skor'] = skor($data['nilai_listening'], $data['nilai_structure'], $data['nilai_reading']);
            $data['logo'] = base_url().'/public/assets/logo-client/'.$data['logo'];
        } else {
            $data['title'] = 'Sertifikat';
        }


        return view('pages/scanToefl', $data);
    }
}
