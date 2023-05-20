<?php

function web_member()
{
    $db = db_connect();

    $result = $db->query("SELECT value FROM config WHERE field = 'web_admin'")->getRowArray();
    return $result['value'];
}

function list_client()
{
    $db = db_connect();

    $result = $db->query("SELECT id_client, nama_client FROM client WHERE hapus = 0")->getResultArray();
    return $result;
}

function list_soal_toefl()
{
    $db = db_connect();

    $result = $db->query("SELECT * FROM soal WHERE hapus = 0")->getResultArray();
    return $result;
}

// soal ielts 
    function soal_isian_ielts($name){
        return '<input type="text" class="form-control form-control-sm form-autosize" style="background: #DBE7F6 !important;width: 50px;display: inline; font-size: 14px" name="'.$name.'" autocomplete="off">';
    }

    function soal_pg_ielts($data_soal){
        return '
            <div class="mb-4">
                <div class="mb-3">
                    <b>'.$data_soal['no'].')</b> '.$data_soal['soal'].'
                    <input type="hidden" name="'.$data_soal['name'].'">
                </div>
                '.pilihan_pg_ielts($data_soal).'
            </div>
        ';
    }

    function pilihan_pg_ielts($data_soal){
        $data_pilihan = "";
        foreach ($data_soal['pilihan'] as $pilihan) {
            $data_pilihan .= '
                <div class="mb-3">
                    <label style="font-size: 14px; font-weight: normal; color: black">
                        <input type="radio" data-id="'.$data_soal['name'].'" name="radio-'.$data_soal['no'].'" value="'.$pilihan.'"> 
                        '.$pilihan.'
                    </label>
                </div>
            ';
        }

        return $data_pilihan;
    }

    function arrowIcon(){
        return '<center>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                    </svg>
                </center>';
    }

    function ielts_listening($benar){
        if($benar >= 39 && $benar <= 40){
            return 9;
        } else if($benar >= 37 && $benar <= 38){
            return 8.5;
        } else if($benar >= 35 && $benar <= 36){
            return 8;
        } else if($benar >= 32 && $benar <= 34){
            return 7.5;
        } else if($benar >= 30 && $benar <= 31){
            return 7;
        } else if($benar >= 26 && $benar <= 29){
            return 6.5;
        } else if($benar >= 23 && $benar <= 25){
            return 6;
        } else if($benar >= 18 && $benar <= 22){
            return 5.5;
        } else if($benar >= 16 && $benar <= 17){
            return 5;
        } else if($benar >= 13 && $benar <= 15){
            return 4.5;
        } else if($benar >= 11 && $benar <= 12){
            return 4;
        } else if($benar >= 8 && $benar <= 10){
            return 3.5;
        } else if($benar >= 6 && $benar <= 7){
            return 3;
        } else if($benar >= 4 && $benar <= 5){
            return 2.5;
        } else {
            return 0;
        }
    }

    function ielts_reading($benar, $tipe_tes){
        if($tipe_tes == "IELTS Academic"){
            if($benar >= 39 && $benar <= 40){
                return 9;
            } else if($benar >= 37 && $benar <= 38){
                return 8.5;
            } else if($benar >= 35 && $benar <= 36){
                return 8;
            } else if($benar >= 33 && $benar <= 34){
                return 7.5;
            } else if($benar >= 30 && $benar <= 32){
                return 7;
            } else if($benar >= 27 && $benar <= 29){
                return 6.5;
            } else if($benar >= 23 && $benar <= 26){
                return 6;
            } else if($benar >= 19 && $benar <= 22){
                return 5.5;
            } else if($benar >= 15 && $benar <= 18){
                return 5;
            } else if($benar >= 13 && $benar <= 14){
                return 4.5;
            } else if($benar >= 10 && $benar <= 12){
                return 4;
            } else if($benar >= 8 && $benar <= 9){
                return 3.5;
            } else if($benar >= 6 && $benar <= 7){
                return 3;
            } else if($benar >= 4 && $benar <= 5){
                return 2.5;
            } else if($benar >= 2 && $benar <= 3){
                return 2;
            } else {
                return 1;
            }
        } else if($tipe_tes == "General Training"){
            if($benar == 40){
                return 9;
            } else if($benar == 39){
                return 8.5;
            } else if($benar >= 37 && $benar <= 38){
                return 8;
            } else if($benar == 36){
                return 7.5;
            } else if($benar >= 34 && $benar <= 35){
                return 7;
            } else if($benar >= 32 && $benar <= 33){
                return 6.5;
            } else if($benar >= 30 && $benar <= 31){
                return 6;
            } else if($benar >= 27 && $benar <= 29){
                return 5.5;
            } else if($benar >= 23 && $benar <= 26){
                return 5;
            } else if($benar >= 19 && $benar <= 22){
                return 4.5;
            } else if($benar >= 15 && $benar <= 18){
                return 4;
            } else if($benar >= 12 && $benar <= 14){
                return 3.5;
            } else if($benar >= 9 && $benar <= 11){
                return 3;
            } else if($benar >= 6 && $benar <= 8){
                return 2.5;
            } else if($benar >= 3 && $benar <= 5){
                return 2;
            } else {
                return 0;
            }
        }
    }

    function skor_ielts( $nilai_listening, $nilai_reading, $nilai_writing, $nilai_speaking) {
        $skor = ($nilai_listening + $nilai_reading + $nilai_writing + $nilai_speaking) / 4;
        
        return $skor;
    }

    function ielts_writing(
        $nilai_ta_1,
        $nilai_cc_1,
        $nilai_gra_1,
        $nilai_lr_1,
        $nilai_ta_2,
        $nilai_cc_2,
        $nilai_gra_2,
        $nilai_lr_2
      ) {
        $task_1 = pembulatan_skor_ielts(
          (floatval($nilai_ta_1) +
            floatval($nilai_cc_1) +
            floatval($nilai_gra_1) +
            floatval($nilai_lr_1)) /
            4
        );
        $task_2 = pembulatan_skor_ielts(
          (floatval($nilai_ta_2) +
            floatval($nilai_cc_2) +
            floatval($nilai_gra_2) +
            floatval($nilai_lr_2)) /
            4
        );
      
        $nilai_writing = pembulatan_skor_ielts((floatval($task_1) + floatval($task_2) + floatval($task_2)) / 3);
      
        return $nilai_writing;
    }

    function ielts_speaking(
        $nilai_topic,
        $nilai_fluency,
        $nilai_grammar,
        $nilai_vocabulary
      ) {
        $nilai_speaking = pembulatan_skor_ielts(
          (floatval($nilai_topic) +
            floatval($nilai_fluency) +
            floatval($nilai_grammar) +
            floatval($nilai_vocabulary)) /
            4
        );
      
        return $nilai_speaking;
    }

    function pembulatan_skor_ielts($angka) {
        $decimal = $angka - floor($angka); // hitung nilai desimal
      
        if ($decimal <= 0.25) {
          // jika desimal < 0.25
          return floor($angka); // bulatkan ke bawah menjadi 0
        } else if ($decimal > 0.25 && $decimal <= 0.75) {
          // jika desimal >= 0.25 dan < 0.75
          return floor($angka) + 0.5; // bulatkan menjadi 0.5
        } else {
          // jika desimal > 0.75
          return ceil($angka); // bulatkan ke atas menjadi 1
        }
    }
// soal ielts 

// soal toefl 
function textReading($id_item){
    $db = db_connect();

    $data = $db->query("SELECT * FROM item_soal WHERE id_item = $id_item")->getRowArray();
    return $data;
}
// soal toefl 

function hari_ini($hari){
    switch($hari){
        case 'Sun':
            $hari_ini = "Minggu";
        break;

        case 'Mon':			
            $hari_ini = "Senin";
        break;

        case 'Tue':
            $hari_ini = "Selasa";
        break;

        case 'Wed':
            $hari_ini = "Rabu";
        break;

        case 'Thu':
            $hari_ini = "Kamis";
        break;

        case 'Fri':
            $hari_ini = "Jumat";
        break;

        case 'Sat':
            $hari_ini = "Sabtu";
        break;
        
        default:
            $hari_ini = "Tidak di ketahui";
        break;
    }
    return $hari_ini;
}

function tgl_indo($tgl, $lengkap = ""){
    $data = explode("-", $tgl);
    $hari = $data[2];
    $bulan = $data[1];
    $tahun = $data[0];

    if($bulan == "01") $bulan = "Januari";
    if($bulan == "02") $bulan = "Februari";
    if($bulan == "03") $bulan = "Maret";
    if($bulan == "04") $bulan = "April";
    if($bulan == "05") $bulan = "Mei";
    if($bulan == "06") $bulan = "Juni";
    if($bulan == "07") $bulan = "Juli";
    if($bulan == "08") $bulan = "Agustus";
    if($bulan == "09") $bulan = "September";
    if($bulan == "10") $bulan = "Oktober";
    if($bulan == "11") $bulan = "November";
    if($bulan == "12") $bulan = "Desember";

    if($lengkap == "lengkap"){
        return hari_ini(date("D", strtotime($tgl))) . ", " . $hari . " " . $bulan . " " . $tahun;
    } else {
        return $hari . " " . $bulan . " " . $tahun;
    }
}

function poin($tipe, $soal){
    $db = db_connect();
    
    $data = $db->query("SELECT * FROM nilai_toefl WHERE tipe = '$tipe' AND soal = '$soal'")->getRowArray();
    return $data['poin'];
}

function skor($nilai_listening, $nilai_structure, $nilai_reading){
    $skor = round(((poin("Listening", $nilai_listening) + poin("Structure", $nilai_structure) + poin("Reading", $nilai_reading)) * 10) / 3);

    if($skor <= 310){
        return 310;
    } else {
        return $skor;
    }
}

// penomoran sertifikat 
function getHurufBulan($bln){
    switch ($bln){
        case 1: 
            return "A";
            break;
        case 2:
            return "B";
            break;
        case 3:
            return "C";
            break;
        case 4:
            return "D";
            break;
        case 5:
            return "E";
            break;
        case 6:
            return "F";
            break;
        case 7:
            return "G";
            break;
        case 8:
            return "H";
            break;
        case 9:
            return "I";
            break;
        case 10:
            return "J";
            break;
        case 11:
            return "K";
            break;
        case 12:
            return "L";
            break;
    }
}

function no_doc($no){
    $no_doc = "";
    if($no > 0 && $no < 10) $no_doc = "00".$no;
    elseif($no >= 10 && $no < 100) $no_doc = "0".$no;
    elseif($no >= 100) $no_doc = $no;

    return $no_doc;
}