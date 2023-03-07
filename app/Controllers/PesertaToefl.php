<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaToeflModel;

// library qrcode & pdf 
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use App\Libraries\Pdfgenerator;

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

        // nomor sertifikat 
        $date_year = date('Y', strtotime($tes['tgl_tes']));
        $date_month = date('m', strtotime($tes['tgl_tes']));

        $no_doc = $db->query("SELECT no_doc FROM peserta_toefl as a JOIN tes_toefl as b ON a.id_tes = b.id_tes WHERE YEAR(tgl_tes) = $date_year AND MONTH(tgl_tes) = $date_month ORDER BY no_doc DESC")->getRowArray();

        if(isset($no_doc)) $no = $no_doc['no_doc']+1;
        else $no = 1;

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
            "no_doc" => $no
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

    public function pdfToefl($id_peserta){
        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_toefl as a JOIN tes_toefl as b ON a.id_tes = b.id_tes JOIN client as c ON b.fk_id_client = c.id_client WHERE md5(id) = '$id_peserta'")->getRowArray();

        
        $data['no_doc'] = no_doc($data['no_doc']);
        $data['hari'] = date('d', strtotime($data['tgl_tes']));
        $data['tahun'] = date('y', strtotime($data['tgl_tes']));
        $data['bulan'] = getHurufBulan(date('m', strtotime($data['tgl_tes'])));
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create(base_url()."c/toefl/".$data['url']."/".$id_peserta)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0));

        // Create generic logo
        $logo = Logo::create( FCPATH .'/public/assets/logo-client/'.$data['logo'])
            ->setResizeToWidth(150);

        $result = $writer->write($qrCode, $logo);
        
        $data['barcode'] = $result->getDataUri();

        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('pages/pdfToefl', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        // $dompdf->stream();
        $dompdf->stream("$data[nama] - $data[tgl_tes] - TOEFL.pdf", array("Attachment" => false));
        exit(0);

        // $Pdfgenerator = new Pdfgenerator();
        // // filename dari pdf ketika didownload
        // $file_pdf = "$data[nama] - $data[tgl_tes]";
        // // setting paper
        // $paper = 'A4';
        // //orientasi paper potrait / landscape
        // $orientation = "potrait";

        // $html = view('pages/pdfToefl', $data);

        // // run dompdf
        // $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);

        // return view('pages/pdfIelts', $data);
    }
}
