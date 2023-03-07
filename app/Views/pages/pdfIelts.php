<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $first_name?> <?= $last_name?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<?php
        $path = base_url().'public/assets/sertifikat/sertifikat-ielts.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>
<style>

    @page { margin: 0; }

    body {
      background-image: url('<?= $base64?>');
      background-size: cover;
      background-repeat: no-repeat;
    }
    
    .barcode {
      position: absolute;
      top: 50px;
      right: 50px;
    }

    .no_doc {
      position: absolute;
      top: 50px;
      left: 50px;
    }

    .nama {
      font-family: 'times';
      font-size: 40px;
      position: absolute;
      top: 430px;
      /* background-color: red; */
      width: 100%;
    }

    .nilai_listening {
      font-family: 'times';
      font-size: 24px;
      position: absolute;
      top: 652px;
      left: 460px;
      /* background-color: red; */
      width: 240px;
    }

    .nilai_reading {
      font-family: 'times';
      font-size: 24px;
      position: absolute;
      top: 694px;
      left: 460px;
      /* background-color: red; */
      width: 240px;
    }

    .nilai_writing {
      font-family: 'times';
      font-size: 24px;
      position: absolute;
      top: 734px;
      left: 460px;
      /* background-color: red; */
      width: 240px;
    }

    .nilai_speaking {
      font-family: 'times';
      font-size: 24px;
      position: absolute;
      top: 775px;
      left: 460px;
      /* background-color: red; */
      width: 240px;
    }

    .overall {
      font-family: 'times';
      font-size: 24px;
      position: absolute;
      top: 821px;
      left: 460px;
      /* background-color: red; */
      width: 240px;
    }

    .tgl_tes {
      font-family: 'times';
      font-size: 20px;
      position: absolute;
      bottom: 225px;
      /* background-color: red; */
      width: 100%;
    }

</style>
<body>

  <div>
    <div class="barcode">
      <img src="<?= $barcode?>" alt="" width="100px">
    </div>

    <div class="no_doc">
      im.I.<?= $no_doc?><?= $hari?><?= $bulan?><?= $tahun?>
    </div>
  </div>

  <div class="nama">
    <center><b><?= $first_name?> <?= $last_name?></b></center>
  </div>

  <?php
    $skor_listening = ielts_listening($nilai_listening);
    $skor_reading = ielts_reading($nilai_reading, $tipe_tes);
    $skor_writing = ielts_writing( $nilai_ta_1, $nilai_cc_1, $nilai_gra_1, $nilai_lr_1, $nilai_ta_2, $nilai_cc_2, $nilai_gra_2, $nilai_lr_2);
    $skor_speaking = ielts_speaking( $nilai_topic, $nilai_fluency, $nilai_grammar, $nilai_vocabulary);
    $overall = pembulatan_skor_ielts(skor_ielts( $skor_listening, $skor_reading, $skor_writing, $skor_speaking));
  ?>

  <div class="nilai_listening">
    <center><b><?= $skor_listening?></b></center>
  </div>

  <div class="nilai_reading">
    <center><b><?= $skor_reading?></b></center>
  </div>

  <div class="nilai_writing">
    <center><b><?= $skor_writing?></b></center>
  </div>

  <div class="nilai_speaking">
    <center><b><?= $skor_speaking?></b></center>
  </div>

  <div class="overall">
    <center><b><?= $overall?></b></center>
  </div>

  <div class="tgl_tes">
    <center>Jakarta, <?= date('d M Y', strtotime($tgl_tes))?></center>
  </div>
  
</body>
</html>

