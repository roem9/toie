<?= $this->extend('client-page/layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="col-12">
  <div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between">
      <div class="d-lg-flex">
        <div>
          <h5 class="mb-0"><?= $title ?></h5>
          <p class="text-sm mb-0">
            <?= $nama_client?> - <?= date('d-M-Y', strtotime($tgl_tes))?> - <?= $nama_tes?>
          </p>
        </div>
      </div>
    </div>
    <div class="card-body p-3">
      <div class="row">
        <div class="card">
          <div class="">
            <table class="table table-hover align-items-center mb-0" id="table-hasil-tes">
              <thead>
                <tr>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama Peserta</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Email</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Score</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('modal') ?>
<!-- Modal Add Data Tes-->
<div class="modal fade" id="modalHasilTes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalHasilTesLabel">Edit Peserta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- KALAU SUKSES -->
        <div class="alert alert-success fade show text-light alert-sukses" role="alert" style="display: none">
          <div class="sukses"></div>
        </div>
        <!-- KALAU ERROR -->
        <div class="alert alert-danger fade show text-light alert-error" role="alert" style="display: none">
          <div class="error"></div>
        </div>
        <form id="formHasilTes">
          <input type="hidden" name="id" id="id">
          <div class="col-12 mb-3">
            <label>Nama</label>
            <input name="nama" class="multisteps-form__input form-control" type="text" placeholder="nama peserta">
          </div>
          <div class="col-12 mb-3">
            <label>Email</label>
            <input name="email" class="multisteps-form__input form-control" type="text" placeholder="email">
          </div>
          <div class="col-12 mb-3">
            <label for="jk">Gender</label>
            <select name="jk" id="jk" class="multisteps-form__input form-control">
              <option value="">Pilih Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-12 mb-3">
            <label>No WA</label>
            <input name="no_wa" class="multisteps-form__input form-control" type="text" placeholder="whatsapp">
          </div>
          <div class="col-12 mb-3">
            <label>Tempat Lahir</label>
            <input name="t4_lahir" class="multisteps-form__input form-control" type="text" placeholder="tempat lahir">
          </div>
          <div class="col-12 mb-3">
            <label>Tgl Lahir</label>
            <input name="tgl_lahir" class="multisteps-form__input form-control" type="date" placeholder="tanggal lahir">
          </div>
          <div class="col-12 mb-3">
            <label>Tgl Lahir</label>
            <input name="tgl_lahir" class="multisteps-form__input form-control" type="date" placeholder="tanggal lahir">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-info" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<script>
  // kumpulan function

  document.addEventListener('DOMContentLoaded', () => {
    showData();
    
    const btnSimpan = $("#btnSimpan");

    btnSimpan.on("click", simpanPesertaToefl);
  });

  // show data from database
  function showData() {
    $('#table-hasil-tes').DataTable({
      processing: true,
      serverSide: true,
      ajax: `<?= base_url()?>clientarea/getHasilTesToefl/<?= $id_tes?>`,
      responsive: {
          details: {
              type: 'column'
          }
      },
      columns: [
        {
          data: 'nama',
          searchable: true,
          className: 'text-xs',
          orderable: true
        },
        {
          data: 'email',
          searchable: true,
          className: 'text-xs w-1',
          orderable: true
        },
        {
          data: 'skor',
          searchable: false,
          className: 'text-center text-xs w-1',
          orderable: false,
        },
        {
          data: null,
          render: function(data, type, row) {
            return `
            <a href="javascript:void(0)" onclick="editPeserta('${row.id_peserta}')" class="me-1">
                <span class="badge bg-gradient-info">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                  </svg>
                </span>
              </a>
              `;
          }
        }
      ],
      language: {
        paginate: {
          first: '<<',
          previous: '<',
          next: '>',
          last: '>>'
        }
      },
      pageLength: 5,
      lengthMenu: [
        [5, 10, 20],
        [5, 10, 20]
      ]
    });
    $.fn.DataTable.ext.pager.numbers_length = 5;
  }

  function editPeserta($id_peserta) {
    $.ajax({
      url: "<?= base_url()?>/clientarea/getPesertaToefl/" + $id_peserta,
      type: "get",
      success: function(hasil) {
        var $obj = $.parseJSON(hasil);
        // console.log($obj);
        if ($obj.id != '') {
          $('#modalHasilTes').modal('show');
          $('#modalHasilTesLabel').html($obj.nama);
          $('.alert-error').hide();
          $('.alert-sukses').hide();

          $(`#formHasilTes [name='id']`).val($obj.id);
          $(`#formHasilTes [name='nama']`).val($obj.nama);
          $(`#formHasilTes [name='email']`).val($obj.email);
          $(`#formHasilTes [name='jk']`).val($obj.jk);
          $(`#formHasilTes [name='no_wa']`).val($obj.no_wa);
          $(`#formHasilTes [name='t4_lahir']`).val($obj.t4_lahir);
          $(`#formHasilTes [name='tgl_lahir']`).val($obj.tgl_lahir);
          $(`#formHasilTes [name='alamat']`).val($obj.alamat);
        }
      }

    });
  }

  function simpanPesertaToefl(e) {
    e.preventDefault();

    let id = $(`#formHasilTes [name='id']`).val();
    let nama = $(`#formHasilTes [name='nama']`).val();
    let email = $(`#formHasilTes [name='email']`).val();
    let jk = $(`#formHasilTes [name='jk']`).val();
    let no_wa = $(`#formHasilTes [name='no_wa']`).val();
    let t4_lahir = $(`#formHasilTes [name='t4_lahir']`).val();
    let tgl_lahir = $(`#formHasilTes [name='tgl_lahir']`).val();
    let alamat = $(`#formHasilTes [name='alamat']`).val();

    $.ajax({
      url: "<?= base_url()?>/clientarea/simpanPesertaToefl",
      type: "POST",
      data: {
        id: id,
        nama: nama,
        email: email,
        jk: jk,
        no_wa: no_wa,
        t4_lahir: t4_lahir,
        tgl_lahir: tgl_lahir,
        alamat: alamat
      },
      success: function(hasil) {
        var $obj = $.parseJSON(hasil);
        if ($obj.sukses == false) {
          $('.alert-sukses').hide();
          $('.alert-error').show();
          $('.error').html($obj.error);
        } else {
          $('.alert-error').hide();
          $('.alert-sukses').show();
          $('.sukses').html($obj.sukses);

          if ($obj.edit == false) {
            $("#formTambahTes")[0].reset();
          }

          $('#table-hasil-tes').DataTable().ajax.reload();
        }

        $('html, .modal-body').animate({
          scrollTop: 0
        }, 'slow');
      }
    });
  }
</script>
<?= $this->endSection() ?>