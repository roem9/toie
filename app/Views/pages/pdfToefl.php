<html>
<head>
  <title><?= $nama?></title>
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
      bottom: 260px;
      left: 235px;
      /* background-color: red; */
      width: 75px;
      text-align: center;
    }

    .nilai_structure {
      font-family: 'Montserrat-SemiBold';
      font-size: 24px;
      position: absolute;
      bottom: 260px;
      left: 508px;
      /* background-color: red; */
      width: 75px;
      text-align: center;
    }

    .nilai_reading {
      font-family: 'Montserrat-SemiBold';
      font-size: 24px;
      position: absolute;
      bottom: 260px;
      left: 779px;
      /* background-color: red; */
      width: 75px;
      text-align: center;
    }

    .overall {
      font-family: 'Montserrat-SemiBold';
      font-size: 24px;
      position: absolute;
      bottom: 260px;
      left: 995px;
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
      <img src="public/assets/sertifikat/sertifikat-toefl.png"
          style="width: 210mm; height: 297mm; margin: 0;" />
  </div>

  <div class="barcode">
    <img src="<?= $barcode?>" alt="" width="100px">
  </div>

  <div class="no_doc">
    im.T.<?= $no_doc?><?= $hari?><?= $bulan?><?= $tahun?>
  </div>

  <div class="nama" text-align="center">
    <b><?= $nama?></b>
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
    <center><b><?= skor($nilai_listening, $nilai_structure, $nilai_reading)?></b></center>
  </div>

  <div class="tgl_tes">
    <center>Jakarta, <?= date('d/m/Y', strtotime($tgl_tes))?></center>
  </div>
</body>
</html>
  
  