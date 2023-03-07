<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Feedback <?= $first_name?> <?= $last_name?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<style>

    /* @page { 
      margin: 0; margin-top: 20px;
    } */
    
    .barcode {
      position: absolute;
      top: 50px;
      width: 100%;
    }

    .page_break {
      page-break-after: always; 
      padding: 10px;
    }

</style>
<body>
  <div class="page_break"></div>
    <div class="">
      <h3 class="mb-3"><center>Feedback Writing</center></h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td colspan="3"><center><b>TASK 1</b></center></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th style="width: 15%"><center>Criteria</center></th>
            <th><center>Feedback</center></th>
            <th style="width: 10%"><center>Score</center></th>
          </tr>
          <tr>
            <td><center><b>TA</b></center></td>
            <td><?= $kriteria_ta_1?></td>
            <td><center><b><?= $nilai_ta_1?></b></center></td>
          </tr>
          <tr>
            <td><center><b>CC</b></center></td>
            <td><?= $kriteria_cc_1?></td>
            <td><center><b><?= $nilai_cc_1?></b></center></td>
          </tr>
          <tr>
            <td><center><b>GRA</b></center></td>
            <td><?= $kriteria_gra_1?></td>
            <td><center><b><?= $nilai_gra_1?></b></center></td>
          </tr>
          <tr>
            <td><center><b>LR</b></center></td>
            <td><?= $kriteria_lr_1?></td>
            <td><center><b><?= $nilai_lr_1?></b></center></td>
          </tr>
        </tbody>
      </table>
    </div>

  <div class="page_break"></div>
    <div class="">
      <h3 class="mb-3"><center>Feedback Writing</center></h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td colspan="3"><center><b>TASK 2</b></center></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th style="width: 15%"><center>Criteria</center></th>
            <th><center>Feedback</center></th>
            <th style="width: 10%"><center>Score</center></th>
          </tr>
          <tr>
            <td><center><b>TA</b></center></td>
            <td><?= $kriteria_ta_2?></td>
            <td><center><b><?= $nilai_ta_2?></b></center></td>
          </tr>
          <tr>
            <td><center><b>CC</b></center></td>
            <td><?= $kriteria_cc_2?></td>
            <td><center><b><?= $nilai_cc_2?></b></center></td>
          </tr>
          <tr>
            <td><center><b>GRA</b></center></td>
            <td><?= $kriteria_gra_2?></td>
            <td><center><b><?= $nilai_gra_2?></b></center></td>
          </tr>
          <tr>
            <td><center><b>LR</b></center></td>
            <td><?= $kriteria_lr_2?></td>
            <td><center><b><?= $nilai_lr_2?></b></center></td>
          </tr>
          <tr>
            <td colspan="2"><center><b>OVERALL</b></center></td>
            <td><center><b><?= ielts_writing( $nilai_ta_1, $nilai_cc_1, $nilai_gra_1, $nilai_lr_1, $nilai_ta_2, $nilai_cc_2, $nilai_gra_2, $nilai_lr_2)?></b></center></td>
          </tr>
        </tbody>
      </table>
    </div>

  <div class="page_break"></div>
    <div class="">
      <h3 class="mb-3"><center>Feedback Speaking</center></h3>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th style="width: 15%"><center>Criteria</center></th>
            <th><center>Feedback</center></th>
            <th style="width: 10%"><center>Score</center></th>
          </tr>
          <tr>
            <td><center><b>Topic</b></center></td>
            <td><?= $kriteria_topic?></td>
            <td><center><b><?= $nilai_topic?></b></center></td>
          </tr>
          <tr>
            <td><center><b>Fluency</b></center></td>
            <td><?= $kriteria_fluency?></td>
            <td><center><b><?= $nilai_fluency?></b></center></td>
          </tr>
          <tr>
            <td><center><b>Grammar</b></center></td>
            <td><?= $kriteria_grammar?></td>
            <td><center><b><?= $nilai_grammar?></b></center></td>
          </tr>
          <tr>
            <td><center><b>Vocabulary</b></center></td>
            <td><?= $kriteria_vocabulary?></td>
            <td><center><b><?= $nilai_vocabulary?></b></center></td>
          </tr>
          <tr>
            <td colspan="2"><center><b>OVERALL</b></center></td>
            <td><center><b><?= ielts_speaking( $nilai_topic, $nilai_fluency, $nilai_grammar, $nilai_vocabulary)?></b></center></td>
          </tr>
        </tbody>
      </table>
    </div>
  
</body>
</html>

