<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaToeflModel;

class PesertaToefl extends BaseController
{
    public function cekEmail(){
        $id_tes = $this->request->getPost('id_tes');
        $email = $this->request->getPost('email');

        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_toefl WHERE id_tes = $id_tes AND email = '$email'")->getRowArray();
        return json_encode($data);
    }

    public function passwordCheck(){
        $id_tes = $this->request->getPost("id_tes");
        $password = $this->request->getPost("password");

        $db = db_connect();
        $data = $db->query("SELECT * FROM tes_toefl WHERE `password` = '$password' AND id_tes = $id_tes")->getRowArray();
        return json_encode($data);
    }

    public function addJawabanToefl(){
        $db = db_connect();

        $id_tes = $this->request->getPost("id_tes");
        $tes = $db->query("SELECT * FROM tes_toefl WHERE id_tes = $id_tes")->getRowArray();
        $client = $db->query("SELECT * FROM client WHERE id_client = $tes[fk_id_client]")->getRowArray();
        $soal = $db->query("SELECT * FROM soal WHERE id_soal = $tes[id_soal]")->getRowArray();
        $sesi = COUNT($db->query("SELECT * FROM sesi_soal WHERE id_soal = $soal[id_soal]")->getResultArray());
        $id_sub = $this->request->getPost("kunci_sesi");
        
        $text = "";
        
        for ($i=1; $i < $sesi+1; $i++) {
            $benar = 0;
            $salah = 0;
            $nilai = "";
            $id = $id_sub[$i-1];
            $sub_soal = $db->query("SELECT * FROM item_soal WHERE id_sub = $id AND item = 'soal' ORDER BY urutan")->getResultArray();
            $jawaban = $this->request->getPost("jawaban_sesi_".$i);
            // $jum_soal = COUNT($sub_soal);
            foreach ($sub_soal as $j => $sub_soal) {
                // from json to array 
                $string = trim(preg_replace('/\s+/', ' ', $sub_soal['data']));
                $txt_soal = json_decode($string, true );

                $sub_soal = $txt_soal['jawaban'];
                $jawaban_soal = $jawaban[$j];
                $jawaban_soal = str_replace('"', "&quot;", $jawaban_soal);

                if($sub_soal == $jawaban_soal){
                    $status = "benar";
                    $benar++;
                } else {
                    $status = "salah";
                    $salah++;
                }
                $no = $j+1;
                $text .= '['.$i.','.$no.',"'.$jawaban_soal.'","'.$status.'"],';
            }

            if($i == 1){
                $nilai_listening = $benar;
            } elseif ($i == 2) {
                $nilai_structure = $benar;
            } elseif ($i == 3) {
                $nilai_reading = $benar;
            }
        }

        
        $text = substr($text, 0, -1);
        $text = '{"jawaban":['.$text.']}';

        $data = [
            "id_tes" => $tes['id_tes'],
            "nama" => $this->request->getPost("nama"),
            "t4_lahir" => $this->request->getPost("t4_lahir"),
            "tgl_lahir" => $this->request->getPost("tgl_lahir"),
            "alamat" => $this->request->getPost("alamat"),
            "no_wa" => $this->request->getPost("no_wa"),
            "email" => $this->request->getPost("email"),
            "jk" => $this->request->getPost("jk"),
            "nilai_listening" => $nilai_listening,
            "nilai_structure" => $nilai_structure,
            "nilai_reading" => $nilai_reading,
            "text" => $text,
        ];

        $model = new PesertaToeflModel();
        $model->save($data);
        
        $skor = skor($nilai_listening, $nilai_structure, $nilai_reading);

        $tgl_tes = date("d-M-Y", strtotime($tes['tgl_tes']));

        $replacements = array(
            '$nama' => $this->request->getPost("nama"),
            '$t4_lahir' => $this->request->getPost("t4_lahir"),
            '$tgl_lahir' => tgl_indo($this->request->getPost("tgl_lahir")),
            '$alamat' => $this->request->getPost("alamat"),
            '$no_wa' => $this->request->getPost("no_wa"),
            '$email' => $this->request->getPost("email"),
            '$jk' => $this->request->getPost("jk"),
            // '$nilai_listening' => poin("Listening", $nilai_listening),
            // '$nilai_structure' => poin("Structure", $nilai_structure),
            // '$nilai_reading' =>poin("Reading", $nilai_reading),
            '$tes' => $tes['nama_tes'],
            '$skor' => $skor,
            '$tgl_tes' => tgl_indo($tes["tgl_tes"], "lengkap"),
            // '$tgl_pengumuman' => tgl_indo($tes["tgl_pengumuman"], "lengkap"),
            // '$link' => "<a target='_blank' href='https://wa.me/+".$config[3]['value']."?text=Hi%20admin%2C%20saya%20ingin%20mengambil%20sertifikat%20hasil%20test%20TOEFL%20Prediction%20saya....%0A%0ANama%20%3A%20".$nama."%0ATanggal%20tes%20%3A%20".$tgl_tes."'>Ambil Sertifikat</a>",
            // '$pretest' => "<a target='_blank' href='https://wa.me/+".$config[5]['value']."?text=Hai%20admin%2C%20saya%20ingin%20konfirmasi%20bahwa%20saya%20sudah%20mengerjakan%20soal%20Pretest.%0A%0ANama%20%3A%20".$nama."%0ATanggal%20tes%20%3A%20".$tgl_tes."'>Konfirmasi</a>",
            // '$progress_test' => "<a target='_blank' href='https://wa.me/+".$config[6]['value']."?text=Hai%20admin%2C%20saya%20ingin%20konfirmasi%20bahwa%20saya%20sudah%20mengerjakan%20soal%20Progress%20Test.%0A%0ANama%20%3A%20".$nama."%0ATanggal%20tes%20%3A%20".$tgl_tes."'>Konfirmasi</a>",
            // '$post_test' => "<a target='_blank' href='https://wa.me/+".$config[7]['value']."?text=Hai%20admin%2C%20saya%20ingin%20konfirmasi%20bahwa%20saya%20sudah%20mengerjakan%20soal%20Post%20Test.%0A%0ANama%20%3A%20".$nama."%0ATanggal%20tes%20%3A%20".$tgl_tes."'>Konfirmasi</a>",
        );

        $msg = str_replace(array_keys($replacements), $replacements, $tes['message']);

        $session = session();
        $session->setFlashdata('msg', $msg);

        $id_tes = md5($data['id_tes']);
        return redirect()->to(base_url("toefl/$client[url]/$id_tes"));
    }
}
