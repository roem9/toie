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
                      <h5 class="m-0 font-weight-bold text-dark">No. Sertifikat : </i>im.T.<?= $no_doc?><?= $hari?><?= $bulan?><?= $tahun?></h5><br>
                      <p>
                          Nama : <?= $nama?>
                          <br>
                          TTL : <?= $t4_lahir?>, <?= tgl_indo($tgl_lahir)?>
                          <br>
                          Alamat : <?= $alamat?>
                      </p>
                      <br>
                      <p>
                          <b>Hasil TOEFL Prediction Test</b>
                          <br>
                          Listening : <?= $listening?>
                          <br>
                          Structure : <?= $structure?>
                          <br>
                          Reading : <?= $reading?>
                          <br>
                          Total Score : <?= $skor?>
                      </p>
                      <br>
                      <p>
                          Tanggal Tes : <?= tgl_indo($tgl_tes)?>
                          <br>
                          Berlaku Sampai : <?= tgl_indo($tgl_berakhir)?>
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