<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use App\Models\PesertaIeltsModel;

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

class PesertaIelts extends BaseController
{
    public function cekEmail(){
        $id_tes = $this->request->getPost('id_tes');
        $email = $this->request->getPost('email');

        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_ielts WHERE id_tes = '$id_tes' AND email = '$email'")->getRowArray();
        return json_encode($data);
    }

    public function passwordCheck(){
        $id_tes = $this->request->getPost("id");
        $password = $this->request->getPost("password");

        $db = db_connect();
        $data = $db->query("SELECT * FROM tes WHERE `password` = '$password' AND id_tes = '$id_tes'")->getRowArray();
        return json_encode($data);
    }

    public function addJawabanIelts(){
        $session = session();
        $data = $this->add_jawaban_soal_002();
        $session->setFlashdata('msg', $data['msg']);
        return redirect()->to(base_url("/$data[url]/$data[id_tes]"));
    }

    public function add_jawaban_soal_002(){
        $db = db_connect();
        
        $jawaban_listening = [
            [
                "no" => 1,
                "jawaban" => ["7.50"],
            ],
            [
                "no" => 2,
                "jawaban" => ["Park Square"],
            ],
            [
                "no" => 3,
                "jawaban" => ["Media"],
            ],
            [
                "no" => 4,
                "jawaban" => ["Weather"],
            ],
            [
                "no" => 5,
                "jawaban" => ["First Letter"],
            ],
            [
                "no" => 6,
                "jawaban" => ["social bonds"],
            ],
            [
                "no" => 7,
                "jawaban" => ["brains"],
            ],
            [
                "no" => 8,
                "jawaban" => ["sound"],
            ],
            [
                "no" => 9,
                "jawaban" => ["silent singing"],
            ],
            [
                "no" => 10,
                "jawaban" => ["feet"],
            ],
            [
                "no" => 11,
                "jawaban" => ["the playground", "playground"],
            ],
            [
                "no" => 12,
                "jawaban" => ["feedback"],
            ],
            [
                "no" => 13,
                "jawaban" => ["update"],
            ],
            [
                "no" => 14,
                "jawaban" => ["extra space"],
            ],
            [
                "no" => 15,
                "jawaban" => ["C"],
            ],
            [
                "no" => 16,
                "jawaban" => ["G"],
            ],
            [
                "no" => 17,
                "jawaban" => ["I"],
            ],
            [
                "no" => 18,
                "jawaban" => ["E"],
            ],
            [
                "no" => 19,
                "jawaban" => ["D"],
            ],
            [
                "no" => 20,
                "jawaban" => ["B"],
            ],
            [
                "no" => 21,
                "jawaban" => ["<b>C.</b> she had been inspired by a particular book"],
            ],
            [
                "no" => 22,
                "jawaban" => ["<b>A.</b> the effect of teacher discipline"],
            ],
            [
                "no" => 23,
                "jawaban" => ["<b>B.</b> girls were more negative about school than boys"],
            ],
            [
                "no" => 24,
                "jawaban" => ["<b>A.</b> teachers should be flexible in unpredictable ways"],
            ],
            [
                "no" => 25,
                "jawaban" => ["<b>B.</b> reflect on her own research experience in an interesting way"],
            ],
            [
                "no" => 26,
                "jawaban" => ["E"],
            ],
            [
                "no" => 27,
                "jawaban" => ["G"],
            ],
            [
                "no" => 28,
                "jawaban" => ["A"],
            ],
            [
                "no" => 29,
                "jawaban" => ["D"],
            ],
            [
                "no" => 30,
                "jawaban" => ["B"],
            ],
            [
                "no" => 31,
                "jawaban" => ["<b>C.</b> not be known for many, many years"],
            ],
            [
                "no" => 32,
                "jawaban" => ["<b>A.</b> an existing problem even worse"],
            ],
            [
                "no" => 33,
                "jawaban" => ["3", "three"],
            ],
            [
                "no" => 34,
                "jawaban" => ["Greenland"],
            ],
            [
                "no" => 35,
                "jawaban" => ["snow"],
            ],
            [
                "no" => 36,
                "jawaban" => ["freshwater"],
            ],
            [
                "no" => 37,
                "jawaban" => ["12", "twelve"],
            ],
            [
                "no" => 38,
                "jawaban" => ["cattle"],
            ],
            [
                "no" => 39,
                "jawaban" => ["time"],
            ],
            [
                "no" => 40,
                "jawaban" => ["expensive"],
            ],
        ];

        $jawaban_reading = [
            [
                "no" => 1,
                "jawaban" => ["VIII"],
            ],
            [
                "no" => 2,
                "jawaban" => ["I"],
            ],
            [
                "no" => 3,
                "jawaban" => ["VI"],
            ],
            [
                "no" => 4,
                "jawaban" => ["III"],
            ],
            [
                "no" => 5,
                "jawaban" => ["VII"],
            ],
            [
                "no" => 6,
                "jawaban" => ["IV"],
            ],
            [
                "no" => 7,
                "jawaban" => ["farming"],
            ],
            [
                "no" => 8,
                "jawaban" => ["sea mammals", "fish"],
            ],
            [
                "no" => 9,
                "jawaban" => ["sea mammals", "fish"],
            ],
            [
                "no" => 10,
                "jawaban" => ["thule"],
            ],
            [
                "no" => 11,
                "jawaban" => ["islands"],
            ],
            [
                "no" => 12,
                "jawaban" => ["nomadic"],
            ],
            [
                "no" => 13,
                "jawaban" => ["nature"],
            ],
            [
                "no" => 14,
                "jawaban" => ["imported"],
            ],
            [
                "no" => 15,
                "jawaban" => ["failure"],
            ],
            [
                "no" => 16,
                "jawaban" => ["garage"],
            ],
            [
                "no" => 17,
                "jawaban" => ["anatomy"],
            ],
            [
                "no" => 18,
                "jawaban" => ["puppets"],
            ],
            [
                "no" => 19,
                "jawaban" => ["special service"],
            ],
            [
                "no" => 20,
                "jawaban" => ["sword fight"],
            ],
            [
                "no" => 21,
                "jawaban" => ["FALSE"],
            ],
            [
                "no" => 22,
                "jawaban" => ["TRUE"],
            ],
            [
                "no" => 23,
                "jawaban" => ["NOT GIVEN"],
            ],
            [
                "no" => 24,
                "jawaban" => ["FALSE"],
            ],
            [
                "no" => 25,
                "jawaban" => ["NOT GIVEN"],
            ],
            [
                "no" => 26,
                "jawaban" => ["FALSE"],
            ],
            [
                "no" => 27,
                "jawaban" => ["TRUE"],
            ],
            [
                "no" => 28,
                "jawaban" => ["C. 7.22"],
            ],
            [
                "no" => 29,
                "jawaban" => ["D. Exercise after breakfast"],
            ],
            [
                "no" => 30,
                "jawaban" => ["B. Taking supplements at breakfast"],
            ],
            [
                "no" => 31,
                "jawaban" => ["A. Mid-afternoon"],
            ],
            [
                "no" => 32,
                "jawaban" => ["D. Eat a light meal"],
            ],
            [
                "no" => 33,
                "jawaban" => ["C. To introduce chronobiology and describe some practical applications"],
            ],
            [
                "no" => 34,
                "jawaban" => ["oil content"],
            ],
            [
                "no" => 35,
                "jawaban" => ["fertiliser enhanced"],
            ],
            [
                "no" => 36,
                "jawaban" => ["centrifugation"],
            ],
            [
                "no" => 37,
                "jawaban" => ["floatation"],
            ],
            [
                "no" => 38,
                "jawaban" => ["destabilized"],
            ],
            [
                "no" => 39,
                "jawaban" => ["pulling"],
            ],
            [
                "no" => 40,
                "jawaban" => ["thicker"],
            ],
        ];

        $jawaban_ietls = "";

        $benar_listening = 0;
        foreach ($this->request->getPost('jawaban_listening') as $i => $jawaban) {
            $data_jawaban = [];

            foreach ($jawaban_listening[$i]['jawaban'] as $j => $data_jawaban_listening) {
                $data_jawaban[$j] = strtolower($data_jawaban_listening);
            }

            if (in_array(trim(strtolower($jawaban)), $data_jawaban)){
                $status = "Benar";
                $benar_listening++;
            } else {
                $status = "Salah";
            }

            $jawaban_ietls .= 'Listening&&&'.trim(str_replace('"', "&quot;", $jawaban)).'&&&'.$status.'|||';
        }

        $benar_reading = 0;
        foreach ($this->request->getPost('jawaban_reading') as $i => $jawaban) {
            $data_jawaban = [];

            foreach ($jawaban_reading[$i]['jawaban'] as $j => $data_jawaban_reading) {
                $data_jawaban[$j] = strtolower($data_jawaban_reading);
            }

            if($i == 8){
                if(strtolower($_POST['jawaban_reading'][7]) == 'sea mammals' && strtolower($_POST['jawaban_reading'][8]) == 'fish'){
                    $jawaban_ietls .= 'Reading&&&sea mammals&&&Benar|||Reading&&&fish&&&Benar|||';
                    $benar_reading = $benar_reading + 2;
                } else if(strtolower($_POST['jawaban_reading'][7]) == 'fish' && strtolower($_POST['jawaban_reading'][8]) == 'sea mammals'){
                    $jawaban_ietls .= 'Reading&&&fish&&&Benar|||Reading&&&sea mammals&&&Benar|||';
                    $benar_reading = $benar_reading + 2;
                } else if(strtolower($_POST['jawaban_reading'][7]) == 'fish'){
                    $jawaban_ietls .= 'Reading&&&fish&&&Benar|||Reading&&&'.trim(str_replace('"', "&quot;", $_POST['jawaban_reading'][8])).'&&&Salah|||';
                    $benar_reading++;
                } else if(strtolower($_POST['jawaban_reading'][7]) == 'sea mammals'){
                    $jawaban_ietls .= 'Reading&&&sea mammals&&&Benar|||Reading&&&'.trim(str_replace('"', "&quot;", $_POST['jawaban_reading'][8])).'&&&Salah|||';
                    $benar_reading++;
                } else if(strtolower($_POST['jawaban_reading'][8]) == 'fish'){
                    $jawaban_ietls .= 'Reading&&&'.trim(str_replace('"', "&quot;", $_POST['jawaban_reading'][7])).'&&&Salah|||Reading&&&fish&&&Benar|||';
                    $benar_reading++;
                } else if(strtolower($_POST['jawaban_reading'][8]) == 'sea mammals'){
                    $jawaban_ietls .= 'Reading&&&'.trim(str_replace('"', "&quot;", $_POST['jawaban_reading'][7])).'&&&Salah|||Reading&&&sea mammals&&&Benar|||';
                    $benar_reading++;
                } else {
                    $jawaban_ietls .= 'Reading&&&'.trim(str_replace('"', "&quot;", $_POST['jawaban_reading'][7])).'&&&Salah|||Reading&&&'.trim(str_replace('"', "&quot;", $_POST['jawaban_reading'][8])).'&&&Salah|||';
                }
            } else if($i != 7) {
                if (in_array(trim(strtolower($jawaban)), $data_jawaban)){
                    $status = "Benar";
                    $benar_reading++;
                } else {
                    $status = "Salah";
                }
    
                $jawaban_ietls .= 'Reading&&&'.trim(str_replace('"', "&quot;", $jawaban)).'&&&'.$status.'|||';
            }
        }

        $jawaban_ietls = substr($jawaban_ietls, 0, -3);

        $id_tes = $this->request->getPost("id_tes");

        $tes = $db->query("SELECT * FROM tes WHERE id_tes = '$id_tes'")->getRowArray();
        $client = $db->query("SELECT * FROM client WHERE id_client = $tes[fk_id_client]")->getRowArray();

        $writing_text = $this->request->getPost("text_writing");
        $text_writing = "";

        foreach ($writing_text as $writing_text) {
            $text_writing .= $writing_text . "|||";
        }

        $text_writing = substr($text_writing, 0, -3);

        // nomor sertifikat 
        $date_year = date('Y', strtotime($tes['tgl_tes']));
        $date_month = date('m', strtotime($tes['tgl_tes']));

        $no_doc = $db->query("SELECT no_doc FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes WHERE YEAR(tgl_tes) = $date_year AND MONTH(tgl_tes) = $date_month ORDER BY no_doc DESC")->getRowArray();

        if(isset($no_doc)) $no = $no_doc['no_doc']+1;
        else $no = 1;
        
        $data = [
            "id_tes" => $tes['id_tes'],
            "first_name" => $this->request->getPost("first_name"),
            "last_name" => $this->request->getPost("last_name"),
            "email" => $this->request->getPost("email"),
            "nilai_listening" => $benar_listening,
            "nilai_reading" => $benar_reading,
            "text_listening_reading" => $jawaban_ietls,
            "text_writing" => $text_writing,
            "no_doc" => $no
        ];

        $model = new PesertaIeltsModel();
        $model->save($data);

        $replace_wa = array(
            ' ' => '%20',
            '"' => '%22'
        );
        $tgl_tes = date("d-M-Y", strtotime($tes['tgl_tes']));

        $replacements = array(
            '$first_name' => $this->request->getPost("first_name"),
            '$last_name' => $this->request->getPost("last_name"),
            '$email' => $this->request->getPost("email"),
            '$tes' => $tes['nama_tes']
        );

        $msg = str_replace(array_keys($replacements), $replacements, $tes['message']);

        $result = [
            'url' => $client['url'],
            'id_tes' => md5($tes['id_tes']),
            'msg' => $msg
        ];

        return $result;
    }
    
    public function pdfIelts($id_peserta){
        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes JOIN client as c ON b.fk_id_client = c.id_client WHERE md5(id) = '$id_peserta'")->getRowArray();

        $data['no_doc'] = no_doc($data['no_doc']);
        $data['hari'] = date('d', strtotime($data['tgl_tes']));
        $data['tahun'] = date('y', strtotime($data['tgl_tes']));
        $data['bulan'] = getHurufBulan(date('m', strtotime($data['tgl_tes'])));
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create(base_url()."c/ielts/".$data['url']."/".$id_peserta)
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
        $dompdf->loadHtml(view('pages/pdfIelts', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        // $dompdf->stream();
        $dompdf->stream("$data[first_name] $data[last_name] - $data[tgl_tes] - IELTS.pdf", array("Attachment" => false));
        exit(0);
        // $Pdfgenerator = new Pdfgenerator();
        // // filename dari pdf ketika didownload
        // $file_pdf = "$data[first_name] $data[last_name] - $data[tgl_tes]";
        // // setting paper
        // $paper = 'A4';
        // //orientasi paper potrait / landscape
        // $orientation = "potrait";

        // $html = view('pages/pdfIelts', $data);

        // // run dompdf
        // $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);

        // return view('pages/pdfIelts', $data);
    }

    public function feedbackIelts($id_peserta){
        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes JOIN client as c ON b.fk_id_client = c.id_client WHERE md5(id) = '$id_peserta'")->getRowArray();

        $data['no_doc'] = no_doc($data['no_doc']);
        $data['hari'] = date('d', strtotime($data['tgl_tes']));
        $data['tahun'] = date('y', strtotime($data['tgl_tes']));
        $data['bulan'] = getHurufBulan(date('m', strtotime($data['tgl_tes'])));
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create(base_url()."c/ielts/".$data['url']."/".$id_peserta)
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
        $dompdf->loadHtml(view('pages/feedbackIelts', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        // $dompdf->stream();
        $dompdf->stream("$data[first_name] $data[last_name] - $data[tgl_tes] - IELTS Feedback.pdf", array("Attachment" => false));
        exit(0);

        // $Pdfgenerator = new Pdfgenerator();
        // // filename dari pdf ketika didownload
        // $file_pdf = "$data[first_name] $data[last_name] - $data[tgl_tes]";
        // // setting paper
        // $paper = 'A4';
        // //orientasi paper potrait / landscape
        // $orientation = "potrait";

        // $html = view('pages/feedbackIelts', $data);

        // // run dompdf
        // $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);

        // return view('pages/pdfIelts', $data);
    }
}
