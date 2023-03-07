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

    public function ielts($url, $id_peserta){
        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes JOIN client as c ON b.fk_id_client = c.id_client WHERE md5(id) = '$id_peserta' AND c.url = '$url'")->getRowArray();

        if(isset($data)){
            $data['title'] = 'Sertifikat';
            $data['no_doc'] = no_doc($data['no_doc']);
            $data['hari'] = date('d', strtotime($data['tgl_tes']));
            $data['tahun'] = date('y', strtotime($data['tgl_tes']));
            $data['bulan'] = getHurufBulan(date('m', strtotime($data['tgl_tes'])));

            $data['skor_listening'] = ielts_listening($data['nilai_listening']);
            $data['skor_reading'] = ielts_reading($data['nilai_reading'], $data['tipe_tes']);
            $data['skor_writing'] = ielts_writing( $data['nilai_ta_1'], $data['nilai_cc_1'], $data['nilai_gra_1'], $data['nilai_lr_1'], $data['nilai_ta_2'], $data['nilai_cc_2'], $data['nilai_gra_2'], $data['nilai_lr_2']);
            $data['skor_speaking'] = ielts_speaking( $data['nilai_topic'], $data['nilai_fluency'], $data['nilai_grammar'], $data['nilai_vocabulary']);
            $data['overall'] = pembulatan_skor_ielts(skor_ielts( $data['skor_listening'], $data['skor_reading'], $data['skor_writing'], $data['skor_speaking']));

            $data['tgl_tes'] = date('Y-m-d', strtotime($data['tgl_tes']));
            $data['tgl_berakhir'] = date('Y-m-d', strtotime('+1 year', strtotime($data['tgl_tes'])));
            $data['logo'] = base_url().'/public/assets/logo-client/'.$data['logo'];
        } else {
            $data['title'] = 'Sertifikat';
        }


        return view('pages/scanIelts', $data);
    }
}
