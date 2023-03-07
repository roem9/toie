<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $nama?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<?php
        $path = base_url().'public/assets/sertifikat/sertifikat-toefl.jpg';
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
      top: 649px;
      left: 460px;
      /* background-color: red; */
      width: 240px;
    }

    .nilai_structure {
      font-family: 'times';
      font-size: 24px;
      position: absolute;
      top: 689px;
      left: 460px;
      /* background-color: red; */
      width: 240px;
    }

    .nilai_reading {
      font-family: 'times';
      font-size: 24px;
      position: absolute;
      top: 729px;
      left: 460px;
      /* background-color: red; */
      width: 240px;
    }

    .overall {
      font-family: 'times';
      font-size: 24px;
      position: absolute;
      top: 769px;
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
      im.T.<?= $no_doc?><?= $hari?><?= $bulan?><?= $tahun?>
    </div>
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
    <center><b><?= skor($nilai_listening, $nilai_structure, $nilai_reading)?></b></center>
  </div>

  <div class="tgl_tes">
    <center>Jakarta, <?= date('d M Y', strtotime($tgl_tes))?></center>
  </div>
  
</body>
</html>

