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
    top: 50px;
    right: 50px;
  }

  .no_doc {
    font-family: 'Montserrat-SemiBold';
    position: absolute;
    top: 50px;
    left: 50px;
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

  .nilai_listening {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 266px;
    left: 167px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .nilai_reading {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 266px;
    left: 379px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .nilai_writing {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 266px;
    left: 591px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .nilai_speaking {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 266px;
    left: 800px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .overall {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 266px;
    left: 1012px;
    /* background-color: red; */
    width: 75px;
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
      <img src="public/assets/sertifikat/sertifikat-ielts.png"
          style="width: 210mm; height: 297mm; margin: 0;" />
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
    <center>Jakarta, <?= date('d/m/y', strtotime($tgl_tes))?></center>
  </div>
  
</body>
</html>

