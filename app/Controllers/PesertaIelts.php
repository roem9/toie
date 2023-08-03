<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use App\Models\PesertaIeltsModel;

use \Mpdf\Mpdf;
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
        $db = db_connect();
        
        $data = $this->add_jawaban_soal_002();
        $session->setFlashdata('msg', $data['msg']);
        return redirect()->to(base_url("/$data[url]/$data[id_tes]"));
    }

    public function add_jawaban_soal_002(){
        $db = db_connect();
        helper("kuncijawaban_helper");
        
        $id_tes = $this->request->getPost("id_tes");

        $tes = $db->query("SELECT * FROM tes WHERE id_tes = '$id_tes'")->getRowArray();
        $client = $db->query("SELECT * FROM client WHERE id_client = $tes[fk_id_client]")->getRowArray();

        $jawaban_ietls = "";

        if($tes['tipe_soal'] == "Soal_002"){
            $data_koreksi = soal_002($this->request->getPost('jawaban_listening'), $this->request->getPost('jawaban_reading'));
            $jawaban_ietls = $data_koreksi['jawaban_ietls'];
            $benar_listening = $data_koreksi['benar_listening'];
            $benar_reading = $data_koreksi['benar_reading'];
        } else if($tes['tipe_soal'] == "Soal_GT_002"){
            $data_koreksi = soal_gt_002($this->request->getPost('jawaban_listening'), $this->request->getPost('jawaban_reading'));
            $jawaban_ietls = $data_koreksi['jawaban_ietls'];
            $benar_listening = $data_koreksi['benar_listening'];
            $benar_reading = $data_koreksi['benar_reading'];
        } else if($tes['tipe_soal'] == "Soal_GT_003"){
            $data_koreksi = soal_gt_003($this->request->getPost('jawaban_listening'), $this->request->getPost('jawaban_reading'));
            $jawaban_ietls = $data_koreksi['jawaban_ietls'];
            $benar_listening = $data_koreksi['benar_listening'];
            $benar_reading = $data_koreksi['benar_reading'];
        } else if($tes['tipe_soal'] == "Soal_003"){
            $data_koreksi = soal_003($this->request->getPost('jawaban_listening'), $this->request->getPost('jawaban_reading'));
            $jawaban_ietls = $data_koreksi['jawaban_ietls'];
            $benar_listening = $data_koreksi['benar_listening'];
            $benar_reading = $data_koreksi['benar_reading'];
        } else if($tes['tipe_soal'] == "Soal_Academic_Post_Test"){
            $data_koreksi = soal_academic_post_test($this->request->getPost('jawaban_listening'), $this->request->getPost('jawaban_reading'));
            $jawaban_ietls = $data_koreksi['jawaban_ietls'];
            $benar_listening = $data_koreksi['benar_listening'];
            $benar_reading = $data_koreksi['benar_reading'];
        } else if($tes['tipe_soal'] == "Soal_Academic_Pretest"){
            $data_koreksi = soal_academic_pretest($this->request->getPost('jawaban_listening'), $this->request->getPost('jawaban_reading'));
            $jawaban_ietls = $data_koreksi['jawaban_ietls'];
            $benar_listening = $data_koreksi['benar_listening'];
            $benar_reading = $data_koreksi['benar_reading'];
        } else if($tes['tipe_soal'] == "Soal_General_Post_Test"){
            $data_koreksi = soal_general_post_test($this->request->getPost('jawaban_listening'), $this->request->getPost('jawaban_reading'));
            $jawaban_ietls = $data_koreksi['jawaban_ietls'];
            $benar_listening = $data_koreksi['benar_listening'];
            $benar_reading = $data_koreksi['benar_reading'];
        } else if($tes['tipe_soal'] == "Soal_General_Pretest"){
            $data_koreksi = soal_general_pretest($this->request->getPost('jawaban_listening'), $this->request->getPost('jawaban_reading'));
            $jawaban_ietls = $data_koreksi['jawaban_ietls'];
            $benar_listening = $data_koreksi['benar_listening'];
            $benar_reading = $data_koreksi['benar_reading'];
        }

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
            "t4_lahir" => $this->request->getPost("t4_lahir"),
            "tgl_lahir" => $this->request->getPost("tgl_lahir"),
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
            ->setResizeToWidth(50);

        $result = $writer->write($qrCode, $logo);
        
        $data['barcode'] = $result->getDataUri();

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        if($data['url'] == 'transforme'){
            // Create an instance of the class:
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L',
                'fontDir' => array_merge($fontDirs, [
                    __DIR__ . '/lucida-calligraphy-italic.ttf',
                ]),
                'fontdata' => $fontData + [ // lowercase letters only in font key
                    'lucida-calligraphy-italic' => [
                        'R' => 'lucida-calligraphy-italic.ttf'
                    ],
                    'Montserrat-SemiBold' => [
                        'R' => 'Montserrat-SemiBold.otf'
                    ]
                ],
                'default_font' => 'Montserrat-SemiBold'
            ]);

            $html = view('pages/pdfIelts', $data);
        } else {
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P',
                'fontDir' => array_merge($fontDirs, [
                    __DIR__ . '/lucida-calligraphy-italic.ttf',
                ]),
                'fontdata' => $fontData + [ // lowercase letters only in font key
                    'lucida-calligraphy-italic' => [
                        'R' => 'lucida-calligraphy-italic.ttf'
                    ],
                    'Montserrat-SemiBold' => [
                        'R' => 'Montserrat-SemiBold.otf'
                    ]
                ],
                'default_font' => 'Montserrat-SemiBold'
            ]);

            $html = view('pages/pdfIeltsDinamic', $data);
        }

        // Write some HTML code:
        $mpdf->WriteHTML($html);

        // $mpdf->Output();

        // Output a PDF file directly to the browser
        // return redirect()->to($mpdf->Output());
        $this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output("$data[first_name]-$data[last_name]-$data[tgl_tes]-IELTS.pdf", "I"); // opens in browser
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
            ->setResizeToWidth(50);

        $result = $writer->write($qrCode, $logo);
        
        $data['barcode'] = $result->getDataUri();

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        if($data['url'] == 'transforme'){
            // Create an instance of the class:
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L',
                'fontDir' => array_merge($fontDirs, [
                    __DIR__ . '/lucida-calligraphy-italic.ttf',
                ]),
                'fontdata' => $fontData + [ // lowercase letters only in font key
                    'lucida-calligraphy-italic' => [
                        'R' => 'lucida-calligraphy-italic.ttf'
                    ],
                    'Montserrat-SemiBold' => [
                        'R' => 'Montserrat-SemiBold.otf'
                    ],
                    'GothamBook' => [
                        'R' => 'GothamBook.ttf'
                    ]
                ],
                'default_font' => 'Montserrat-SemiBold'
            ]);

            $html = view('pages/feedback/feedback-writing-1', $data);
            $mpdf->WriteHTML($html);

            $mpdf->AddPage();

            $html = view('pages/feedback/feedback-writing-2', $data);
            $mpdf->WriteHTML($html);

            $mpdf->AddPage();

            $html = view('pages/feedback/feedback-speaking', $data);
            $mpdf->WriteHTML($html);
        } else {
            // Create an instance of the class:
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P',
                'fontDir' => array_merge($fontDirs, [
                    __DIR__ . '/lucida-calligraphy-italic.ttf',
                ]),
                'fontdata' => $fontData + [ // lowercase letters only in font key
                    'lucida-calligraphy-italic' => [
                        'R' => 'lucida-calligraphy-italic.ttf'
                    ],
                    'Montserrat-SemiBold' => [
                        'R' => 'Montserrat-SemiBold.otf'
                    ],
                    'GothamBook' => [
                        'R' => 'GothamBook.ttf'
                    ]
                ],
                'default_font' => 'Montserrat-SemiBold'
            ]);

            $html = view('pages/feedback/dynamic-feedback-writing-1', $data);
            $mpdf->WriteHTML($html);

            $mpdf->AddPage();

            $html = view('pages/feedback/dynamic-feedback-writing-2', $data);
            $mpdf->WriteHTML($html);

            $mpdf->AddPage();

            $html = view('pages/feedback/dynamic-feedback-speaking', $data);
            $mpdf->WriteHTML($html);
        }

        // $mpdf->Output();

        // Output a PDF file directly to the browser
        // return redirect()->to($mpdf->Output());
        $this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output("$data[first_name]-$data[last_name]-$data[tgl_tes]-Feedback.pdf", "I"); // opens in browser
    }
}
