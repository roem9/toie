<html>
<head>
  <title>Feedback <?= $first_name?> <?= $last_name?></title>
</head>

<style>
  .name {
    font-family: 'lucida-calligraphy-italic';
    font-size: 25px;
    position: absolute;
    top: 205px;
    left: 170px;
    width: 553px;
    /* background-color: red; */
  }
  
  .nilai_ta {
    font-family: 'Montserrat-SemiBold';
    font-size: 25px;
    position: absolute;
    top: 365px;
    left: 648px;
    width: 50px;
    /* background-color: red; */
    text-align: center;
  }

  .kriteria_ta {
    font-family: 'GothamBook';
    font-size: 14px;
    position: absolute;
    top: 263px;
    left: 68px;
    width: 540px;
    height: 170px;
    /* background-color: red; */
    padding: 3px;
  }

  .nilai_cc {
    font-family: 'Montserrat-SemiBold';
    font-size: 25px;
    position: absolute;
    top: 535px;
    /* left: 420px; + 250 */
    left: 648px;
    width: 50px;
    /* background-color: red; */
    text-align: center;
  }

  .kriteria_cc {
    font-family: 'GothamBook';
    font-size: 14px;
    position: absolute;
    top: 435px;
    left: 68px;
    width: 540px;
    height: 170px;
    /* background-color: red; */
    padding: 3px;
  }

  .nilai_lr {
    font-family: 'Montserrat-SemiBold';
    font-size: 25px;
    position: absolute;
    top: 705px;
    /* left: 420px; + 250 */
    left: 648px;
    width: 50px;
    /* background-color: red; */
    text-align: center;
  }

  .kriteria_lr {
    font-family: 'GothamBook';
    font-size: 14px;
    position: absolute;
    top: 607px;
    left: 68px;
    width: 540px;
    height: 170px;
    /* background-color: red; */
    padding: 3px;
  }

  .nilai_gra {
    font-family: 'Montserrat-SemiBold';
    font-size: 25px;
    position: absolute;
    top: 875px;
    /* left: 420px; + 250 */
    left: 648px;
    width: 50px;
    /* background-color: red; */
    text-align: center;
  }

  .kriteria_gra {
    font-family: 'GothamBook';
    font-size: 14px;
    position: absolute;
    top: 779px;
    left: 68px;
    width: 540px;
    height: 170px;
    /* background-color: red; */
    padding: 3px;
  }

  .tgl_tes {
      font-family: 'Montserrat-SemiBold';
      font-size: 20px;
      position: absolute;
      bottom: 165px;
      left: 0px;
      right: 0px;
      text-align: center;
    }

  /* GothamBook */
</style>
<body>
    <?php
      $skor_listening = ielts_listening($nilai_listening);
      $skor_reading = ielts_reading($nilai_reading, $tipe_tes);
      $skor_writing = ielts_writing( $nilai_ta_1, $nilai_cc_1, $nilai_gra_1, $nilai_lr_1, $nilai_ta_2, $nilai_cc_2, $nilai_gra_2, $nilai_lr_2);
      $skor_speaking = ielts_speaking( $nilai_topic, $nilai_fluency, $nilai_grammar, $nilai_vocabulary);
      $overall = pembulatan_skor_ielts(skor_ielts( $skor_listening, $skor_reading, $skor_writing, $skor_speaking));
    ?>

  <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
    <img src="public/assets/pdf/fw1/<?= $fw_1_pdf?>" style="width: 297mm; height: 210mm; margin: 0;" />
  </div>
  
  <div class="name">
    <?= $first_name .' '. $last_name?>
  </div>

  <div class="nilai_ta">
    <b><?= $nilai_ta_1?></b>
  </div>

  <div class="kriteria_ta">
    <?= $kriteria_ta_1?>
  </div>

  <div class="nilai_cc">
    <b><?= $nilai_cc_1?></b>
  </div>

  <div class="kriteria_cc">
    <?= $kriteria_cc_1?>
  </div>

  <div class="nilai_lr">
    <b><?= $nilai_lr_1?></b>
  </div>
  
  <div class="kriteria_lr">
    <?= $kriteria_lr_1?>
  </div>
  
  <div class="nilai_gra">
    <b><?= $nilai_gra_1?></b>
  </div>
  
  <div class="kriteria_gra">
    <?= $kriteria_gra_1?>
  </div>

</body>
</html>

