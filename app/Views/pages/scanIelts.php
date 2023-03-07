<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
  <div class="container py-7">
      <div class="row">
          <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-auto">
              <div class="card">
                  <div class="card-body">
                  <?php if(isset($logo)) :?>
                      <div class="text-center mt-4 mb-4">
                          <a href="javascript:void()"><img src="<?= $logo?>" alt="" class="img-fluid" style="max-height: 60px"></a>
                      </div>
                      <div class="mb-2 mt-3">
                      <h5 class="m-0 font-weight-bold text-dark">No. Sertifikat : </i>im.I.<?= $no_doc?><?= $hari?><?= $bulan?><?= $tahun?></h5><br>
                      <p>
                          Nama : <?= $first_name?> <?= $last_name?>
                          <br>
                      </p>
                      <br>
                      <p>
                          <b>Hasil IELTS Prediction Test</b>
                          <br>
                          Listening : <?= $skor_listening?>
                          <br>
                          Reading : <?= $skor_reading?>
                          <br>
                          Writing : <?= $skor_writing?>
                          <br>
                          Speaking : <?= $skor_speaking?>
                          <br>
                          Overall Score : <?= $overall?>
                      </p>
                      <br>
                      <p>
                          Tanggal Tes : <?= tgl_indo($tgl_tes)?>
                      </p>
                      <br>
                      <p><small class="text-danger"><i>Note: Sertifikat dianggap valid jika data yang tertera pada sertifikat sama dengan data di atas.</i></small></p>
                      </div>
                    <?php else :?>
                      <center><b>Maaf Sertifikat Anda Tidak Ditemukan</b></center>
                    <?php endif;?>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?= $this->endSection() ?>