<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Feedback <?= $first_name?> <?= $last_name?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>


<?php
        $path = base_url().'public/assets/logo-client/'.$logo;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $path = base_url().'public/assets/header-footer/transforme.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $headerfooter = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>

<style>

    @page { 
      margin: 0;
    }
    
    body {
        /* display: block;
        position: fixed; */
        background-image: url('<?= $headerfooter?>');
        background-size: cover;
        background-repeat: no-repeat;
        padding: 100px 20px 20px 20px;
    }

    .barcode {
      position: absolute;
      top: 50px;
      width: 100%;
    }

    .page_break {
      page-break-after: always; 
      padding: 10px;
    }

    table {
        border-left: 1 solid black;
        border-right: 0;
        border-top: 1 solid black;
        border-bottom: 0;
        border-collapse: collapse;
        padding: 5px 5px 5px 5px;
    }
    table td,
    table th {
        border-left: 0;
        border-right: 1 solid black;
        border-top: 0;
        border-bottom: 1 solid black;
        padding: 5px 5px 5px 5px;
    }

    table th {
      background-color: #B1B6BA;
    }

    .cover {
      width: 100%;
    }

</style>
<body>
  <div class="cover">
    <center><h3>IELTS PREDICTION TEST REPORT</h3></center>
    <table style="width: 50%; margin: 0 auto; margin-bottom: 50px">
      <tr>
        <th style="width: 30%; text-align: left">Name</th>
        <td style="width: 70%"><?= $first_name?> <?= $last_name?></td>
      </tr>
      <tr>
        <th style="width: 30%;text-align: left">Date Of Birth</th>
        <td style="width: 70%">Bogor, 07 Maret 2023</td>
      </tr>
      <tr>
        <th style="width: 30%;text-align: left">Test Date</th>
        <td style="width: 70%"><?= date('d M Y', strtotime($tgl_tes))?></td>
      </tr>
    </table>

    <?php
      $skor_listening = ielts_listening($nilai_listening);
      $skor_reading = ielts_reading($nilai_reading, $tipe_tes);
      $skor_writing = ielts_writing( $nilai_ta_1, $nilai_cc_1, $nilai_gra_1, $nilai_lr_1, $nilai_ta_2, $nilai_cc_2, $nilai_gra_2, $nilai_lr_2);
      $skor_speaking = ielts_speaking( $nilai_topic, $nilai_fluency, $nilai_grammar, $nilai_vocabulary);
      $overall = pembulatan_skor_ielts(skor_ielts( $skor_listening, $skor_reading, $skor_writing, $skor_speaking));
    ?>

    <center>
      <table style="width: 50%; margin: 0 auto;">
        <tr>
          <th>Section</th>
          <th>Band Score</th>
        </tr>
        <tr>
          <td><center>Listening</center></td>
          <td><center><b><?= $skor_listening?></b></center></td>
        </tr>
        <tr>
          <td><center>Reading</center></td>
          <td><center><b><?= $skor_reading?></b></center></td>
        </tr>
        <tr>
          <td><center>Writing</center></td>
          <td><center><b><?= $skor_writing?></b></center></td>
        </tr>
        <tr>
          <td><center>Speaking</center></td>
          <td><center><b><?= $skor_speaking?></b></center></td>
        </tr>
        <tr>
          <th>Overall</th>
          <th><center><b><?= $overall?></b></center></th>
        </tr>
      </table>
    </center>
  </div>
  <div class="page_break"></div>
    <div class="">
      <h3 class="mb-3"><center>FEEDBACK WRITING</center></h3>
      <table>
        <thead>
          <tr>
            <th colspan="3"><center><b>TASK 1</b></center></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th style="width: 15%"><center>Criteria</center></th>
            <th><center>Feedback</center></th>
            <th style="width: 10%"><center>Score</center></th>
          </tr>
          <tr>
            <th><center><b>TA</b></center></th>
            <td><?= $kriteria_ta_1?></td>
            <td><center><b><?= $nilai_ta_1?></b></center></td>
          </tr>
          <tr>
            <th><center><b>CC</b></center></th>
            <td><?= $kriteria_cc_1?></td>
            <td><center><b><?= $nilai_cc_1?></b></center></td>
          </tr>
          <tr>
            <th><center><b>GRA</b></center></th>
            <td><?= $kriteria_gra_1?></td>
            <td><center><b><?= $nilai_gra_1?></b></center></td>
          </tr>
          <tr>
            <th><center><b>LR</b></center></th>
            <td><?= $kriteria_lr_1?></td>
            <td><center><b><?= $nilai_lr_1?></b></center></td>
          </tr>
        </tbody>
      </table>
    </div>

  <div class="page_break"></div>
    <div class="">
      <h3 class="mb-3"><center>FEEDBACK WRITING</center></h3>
      <table>
        <thead>
          <tr>
            <th colspan="3"><center><b>TASK 2</b></center></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th style="width: 15%"><center>Criteria</center></th>
            <th><center>Feedback</center></th>
            <th style="width: 10%"><center>Score</center></th>
          </tr>
          <tr>
            <th><center><b>TA</b></center></th>
            <td><?= $kriteria_ta_2?></td>
            <td><center><b><?= $nilai_ta_2?></b></center></td>
          </tr>
          <tr>
            <th><center><b>CC</b></center></th>
            <td><?= $kriteria_cc_2?></td>
            <td><center><b><?= $nilai_cc_2?></b></center></td>
          </tr>
          <tr>
            <th><center><b>GRA</b></center></th>
            <td><?= $kriteria_gra_2?></td>
            <td><center><b><?= $nilai_gra_2?></b></center></td>
          </tr>
          <tr>
            <th><center><b>LR</b></center></th>
            <td><?= $kriteria_lr_2?></td>
            <td><center><b><?= $nilai_lr_2?></b></center></td>
          </tr>
          <tr>
            <th colspan="2"><center><b>OVERALL</b></center></th>
            <th><center><b><?= ielts_writing( $nilai_ta_1, $nilai_cc_1, $nilai_gra_1, $nilai_lr_1, $nilai_ta_2, $nilai_cc_2, $nilai_gra_2, $nilai_lr_2)?></b></center></th>
          </tr>
        </tbody>
      </table>
    </div>

  <div class="page_break"></div>
    <div class="">
      <h3 class="mb-3"><center>FEEDBACK SPEAKING</center></h3>
      <table>
        <tbody>
          <tr>
            <th style="width: 15%"><center>Criteria</center></th>
            <th><center>Feedback</center></th>
            <th style="width: 10%"><center>Score</center></th>
          </tr>
          <tr>
            <th><center><b>FC</b></center></th>
            <td><?= $kriteria_topic?></td>
            <td><center><b><?= $nilai_topic?></b></center></td>
          </tr>
          <tr>
            <th><center><b>LR</b></center></th>
            <td><?= $kriteria_fluency?></td>
            <td><center><b><?= $nilai_fluency?></b></center></td>
          </tr>
          <tr>
            <th><center><b>GRA</b></center></th>
            <td><?= $kriteria_grammar?></td>
            <td><center><b><?= $nilai_grammar?></b></center></td>
          </tr>
          <tr>
            <th><center><b>P</b></center></th>
            <td><?= $kriteria_vocabulary?></td>
            <td><center><b><?= $nilai_vocabulary?></b></center></td>
          </tr>
          <tr>
            <th colspan="2"><center><b>OVERALL</b></center></th>
            <th><center><b><?= ielts_speaking( $nilai_topic, $nilai_fluency, $nilai_grammar, $nilai_vocabulary)?></b></center></th>
          </tr>
        </tbody>
      </table>
    </div>
  
</body>
</html>

