<html lang="en">
<head>
  <title><?= $first_name?> <?= $last_name?></title>
</head>

<style>

  @page { margin: 0; }

  body {
  }

  .barcode {
    position: absolute;
    bottom: 140px;
    left: 132px;
  }

  .no_doc {
    font-family: 'Montserrat-SemiBold';
    position: absolute;
    bottom: 240px;
    left: 135px;
  }

  .nama {
    font-family: 'lucida-calligraphy-italic';
    font-size: 40px;
    position: absolute;
    top: 340px;
    left: 0px;
    right: 0px;
    text-align: center;
  }

  .description {
    font-family: 'Montserrat-SemiBold';
    font-size: 18px;
    position: absolute;
    top: 460px;
    left: 0px;
    right: 0px;
    text-align: center;
    /* background-color: white; */
  }

  .nilai_listening {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 515px;
    left: 348px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .nilai_reading {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 455px;
    left: 348px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .nilai_writing {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 395px;
    left: 348px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .nilai_speaking {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 335px;
    left: 348px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .overall {
    font-family: 'Montserrat-SemiBold';
    font-size: 50px;
    position: absolute;
    bottom: 365px;
    right: 80px;
    /* background-color: red; */
    width: 215px;
    /* height: 50px; */
    text-align: center;
  }

  .tgl_tes {
    font-family: 'Montserrat-SemiBold';
    font-size: 20px;
    position: absolute;
    bottom: 205px;
    left: 0px;
    right: 0px;
    text-align: center;
  }

</style>
<body>

  <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
      <img src="public/assets/pdf/ielts/<?= $ielts_pdf?>"
          style="width: 297mm; height: 210mm; margin: 0;" />
  </div>

  <div class="barcode">
    <img src="<?= $barcode?>" alt="" width="100px">
  </div>

  <div class="no_doc">
    im.I.<?= $no_doc?><?= $hari?><?= $bulan?><?= $tahun?>
  </div>

  <div class="nama">
    <center><b><?= $first_name?> <?= $last_name?></b></center>
  </div>

  <?php
    $skor_listening = ielts_listening($nilai_listening, date("Y-m-d", strtotime($created_at)));
    $skor_reading = ielts_reading($nilai_reading, $tipe_tes);
    $skor_writing = ielts_writing( $nilai_ta_1, $nilai_cc_1, $nilai_gra_1, $nilai_lr_1, $nilai_ta_2, $nilai_cc_2, $nilai_gra_2, $nilai_lr_2, date("Y-m-d", strtotime($created_at)));
    $skor_speaking = ielts_speaking( $nilai_topic, $nilai_fluency, $nilai_grammar, $nilai_vocabulary, date("Y-m-d", strtotime($created_at)));
    $overall = pembulatan_skor_ielts(skor_ielts( $skor_listening, $skor_reading, $skor_writing, $skor_speaking), date("Y-m-d", strtotime($created_at)));
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
      <b><?= $overall?></b>
  </div>

  <div class="description">
    Achieved the following scores on the <?= $tipe_tes?> Prediction Test<br>
    held on <?= date('d M Y', strtotime($tgl_tes))?>
  </div>
  
</body>
</html>

