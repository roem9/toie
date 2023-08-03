<html lang="en">
<head>
  <title><?= $nama?></title>
</head>

<style>

  @page { margin: 0; }

  body {
  }

  .barcode {
    position: absolute;
    bottom: 140px;
    left: 135px;
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
    top: 455px;
    left: 0px;
    right: 0px;
    text-align: center;
    background-color: white;
  }

  .nilai_listening {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 525px;
    left: 348px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .nilai_structure {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 455px;
    left: 348px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .nilai_reading {
    font-family: 'Montserrat-SemiBold';
    font-size: 24px;
    position: absolute;
    bottom: 375px;
    left: 348px;
    /* background-color: red; */
    width: 75px;
    text-align: center;
  }

  .overall {
    font-family: 'Montserrat-SemiBold';
    font-size: 50px;
    position: absolute;
    bottom: 400px;
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
      <img src="public/assets/pdf/toefl/<?= $toefl_pdf?>"
          style="width: 297mm; height: 210mm; margin: 0;" />
  </div>

  <div class="barcode">
    <img src="<?= $barcode?>" alt="" width="100px">
  </div>

  <div class="no_doc">
    im.I.<?= $no_doc?><?= $hari?><?= $bulan?><?= $tahun?>
  </div>

  <div class="nama">
    <center><b><?= $nama?></b></center>
  </div>

  <div class="nilai_listening">
    <center><b><?= poin('listening', $nilai_listening)?></b></center>
  </div>

  <div class="nilai_structure">
    <center><b><?= poin('structure', $nilai_structure)?></b></center>
  </div>

  <div class="nilai_reading">
    <center><b><?= poin('reading', $nilai_reading)?></b></center>
  </div>

  <div class="overall">
      <b><?= skor($nilai_listening, $nilai_structure, $nilai_reading)?></b>
  </div>

  <div class="description">
    Achieved the following scores on the TOEFL Prediction Test <br>
    held on <?= date('d M Y', strtotime($tgl_tes))?>
  </div>
  
</body>
</html>

