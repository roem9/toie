<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="col-12">
  <div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between">
      <div class="d-lg-flex">
        <div>
          <h5 class="mb-0"><?= $title ?></h5>
          <p class="text-sm mb-0">
            List Tes
          </p>
        </div>
      </div>
      <div class="d-lg-flex">
        <div>
          <div class="ms-auto my-auto d-none d-md-none d-lg-block">
            <button type="button" class="btn bg-gradient-info btn-sm mb-0 btnModalFormTes" data-bs-toggle="modal" data-bs-target="#modalFormTes">+&nbsp; Tes Baru</a>
          </div>
          <div class="ms-auto my-auto d-block d-md-block d-lg-none">
            <button type="button" class="btn bg-gradient-info btn-sm mb-0 btnModalFormTes" data-bs-toggle="modal" data-bs-target="#modalFormTes">+&nbsp;</a>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body p-3">
      <div class="row">
        <div class="card">
          <div class="">
            <table class="table table-hover align-items-center mb-0" id="table-tes">
              <thead>
                <tr>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all"></th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama Tes</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama Lembaga</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Tgl Tes</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Tipe Tes</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Soal</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Kuota</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder none">Status</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Action</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder none">Link</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder none">Password</th>
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
<div class="modal fade" id="modalFormTes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormTesLabel">Tambah Tes</h5>
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
        <form id="formTambahTes">
          <input type="hidden" name="id_tes" id="id_tes">
          <div class="col-12 mb-3">
            <label for="id_client">Nama Client</label>
            <select name="id_client" id="id_client" class="multisteps-form__input form-control">
              <option value="">Pilih Client</option>
              <?php $clients = list_client();
              foreach ($clients as $client) : ?>
                <option value="<?= $client['id_client'] ?>"><?= $client['nama_client'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-12 mb-3">
            <label>Tgl Tes</label>
            <input name="tgl_tes" class="multisteps-form__input form-control" type="date">
          </div>
          <div class="col-12 mb-3">
            <label>Nama Tes</label>
            <input name="nama_tes" class="multisteps-form__input form-control" type="text" placeholder="nama tes">
          </div>
          <div class="col-12 mb-3">
            <label for="tipe_tes">Tipe Tes</label>
            <select name="tipe_tes" id="tipe_tes" class="multisteps-form__input form-control">
              <option value="">Pilih Tipe Tes</option>
              <option value="IELTS Academic">IELTS Academic</option>
              <option value="General Training">General Training</option>
            </select>
          </div>
          <div class="col-12 mb-3">
            <label for="tipe_soal">Tipe Soal</label>
            <select name="tipe_soal" id="tipe_soal" class="multisteps-form__input form-control">
              <option value="">Pilih Tipe Soal</option>
              <option value="Soal_002">Soal_002</option>
              <option value="Soal_GT_002">Soal_GT_002</option>
              <option value="Soal_003">Soal_003</option>
              <option value="Soal_GT_003">Soal_GT_003</option>
              <option value="Soal_Academic_Post_Test">Soal_Academic_Post_Test</option>
              <option value="Soal_Academic_Pretest">Soal_Academic_Pretest</option>
              <option value="Soal_General_Post_Test">Soal_General_Post_Test</option>
              <option value="Soal_General_Pretest">Soal_General_Pretest</option>
              <option value="Transforme_GT_03">Transforme_GT_03</option>
              <option value="Transforme_AC_03">Transforme_AC_03</option>
            </select>
          </div>
          <div class="col-12 mb-3">
            <label>Kuota Peserta</label>
            <input name="kuota" class="multisteps-form__input form-control" type="text" placeholder="kuota peserta">
          </div>
          <div class="col-12 mb-3">
            <label>Password</label>
            <input name="password" class="multisteps-form__input form-control" type="text" placeholder="password tes">
          </div>
          <div class="form-group">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" class="form-control" id="catatan" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="message">Pesan Setelah Submit Tes</label>
            <textarea name="message" class="form-control" id="message" rows="3"></textarea>
            <div class="mt-3">
              <p class='text-xs'><b>*BERIKUT CARA MENGGUNAKAN VARIABEL YANG BISA DITAMPILKAN PADA PESAN.</b></p>
              <p class='text-xs'>
                Tes IELTS : <br>
                $first_name = first name, $last_name = last name, $email = email, $tes = Nama Tes
              </p>
  
              <p class='text-xs'>
                <b>Contoh Pesan :</b><br>
                Selamat Anda Telah Menyelesaikan $tes, Berikut Ini Data Diri Anda :<br>
                Nama : $first_name $last_name<br>
                Email : $email
              </p>
  
              <p class='text-xs'>
                <b>Contoh Pesan</b><br>
                Thank you for submitting your test, our admin will proceed the test result.
              </p>
            </div>
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

    const btnModalFormTes = $(".btnModalFormTes");
    const btnSimpan = $("#btnSimpan");

    btnModalFormTes.on("click", showModalFormKelas);
    btnSimpan.on("click", tambahTes);

    CKEDITOR.replace('message');
  });

  function showModalFormKelas() {
    $('#modalFormTesLabel').html('Tambah Tes');
    $("#formTambahTes")[0].reset();
    $(`#formTambahTes [name='id_tes']`).val('');
    CKEDITOR.instances['message'].setData('');

    $('.alert-error').hide();
    $('.alert-sukses').hide();
  }

  // show data from database
  function showData() {
    $('#table-tes').DataTable({
      processing: true,
      serverSide: true,
      ajax: `<?= base_url()?>/tes/getAllTes`,
      responsive: {
          details: {
              type: 'column'
          }
      },
      columns: [
        {
          className: 'dtr-control w-1',
          searchable: false,
          orderable: false,
          data: null,
          defaultContent: '',
        },
        {
          data: 'nama_tes',
          searchable: true,
          className: 'text-xs',
          orderable: true
        },
        {
          data: 'nama_client',
          searchable: true,
          className: 'text-xs w-1',
          orderable: true
        },
        {
          data: 'tgl_tes',
          searchable: true,
          className: 'text-xs w-1',
          orderable: true
        },
        {
          data: 'tipe_tes',
          searchable: true,
          className: 'text-xs w-1',
          orderable: true
        },
        {
          data: 'tipe_soal',
          searchable: true,
          className: 'text-xs w-1',
          orderable: true
        },
        {
          data: 'kuota',
          searchable: false,
          className: 'text-xs w-1 text-right text-md-center',
          orderable: false,
          render: function(data, type, row) {
            return `${row.peserta} / ${row.kuota}`
          }
        },
        {
          data: 'status',
          searchable: false,
          className: 'text-xs w-1 text-right text-md-center',
          orderable: false,
          render: function(data, type, row) {
            if (row.status == 1) {
              return `
                <a href="javascript:void(0)" class="me-1" onclick="editStatusTes(${row.id_tes}, '0', '${row.nama_tes}')">
                  <span class="badge" style="color: #2152ff">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle-on" viewBox="0 0 16 16">
                      <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10H5zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                    </svg>
                  </span>
                </a>
              `
            } else {
              return `
                <a href="javascript:void(0)" class="me-1" onclick="editStatusTes(${row.id_tes}, '1', '${row.nama_tes}')">
                  <span class="badge text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggle-off" viewBox="0 0 16 16">
                      <path d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4h3zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zM0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5z"/>
                    </svg>
                  </span>
                </a>
              `
            }
          }
        },
        {
          data: null,
          render: function(data, type, row) {
            return `
            <a href="<?= base_url()?>tes/hasil/${row.tes}" class="me-1">
                <span class="badge bg-gradient-success">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                  </svg>
                </span>
              </a>
              <a href="javascript:void(0)" class="me-1" onclick="editTes(${row.id_tes})">
                <span class="badge bg-gradient-info">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                  </svg>
                </span>
              </a>
              <a href="javascript:void(0)" onclick="hapusTes(${row.id_tes}, '${row.nama_tes}')">
                <span class="badge bg-gradient-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                  </svg>
                </span>
              </a>
              `;
          },
          searchable: false,
          orderable: false,
          className: 'text-xs w-1 text-right text-md-center'
        },
        {
          data: null,
          searchable: false,
          className: 'text-xs w-1 text-md-center',
          orderable: false,
          render: function(data, type, row) {
            return `
              <button class="copy btn btn-success" data-clipboard-text="<?= base_url()?>${row.url}/${row.tes}">
                  Salin Link
              </button>`
          }
        },
        {
          data: 'password',
          searchable: false,
          className: 'text-xs w-1 text-md-center',
          orderable: false
        },
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

  function tambahTes(e) {
    e.preventDefault();

    let id_tes = $(`#formTambahTes [name='id_tes']`).val();
    let id_client = $(`#formTambahTes [name='id_client']`).val();
    let tgl_tes = $(`#formTambahTes [name='tgl_tes']`).val();
    let nama_tes = $(`#formTambahTes [name='nama_tes']`).val();
    let tipe_tes = $(`#formTambahTes [name='tipe_tes']`).val();
    let tipe_soal = $(`#formTambahTes [name='tipe_soal']`).val();
    let kuota = $(`#formTambahTes [name='kuota']`).val();
    let password = $(`#formTambahTes [name='password']`).val();
    let catatan = $(`#formTambahTes [name='catatan']`).val();
    let message = CKEDITOR.instances['message'].getData();

    // console.log(id_tes, id_client, tgl_tes, nama_tes, tipe_tes, tipe_soal, kuota, catatan)
    $.ajax({
      url: "<?= base_url()?>/tes/simpan",
      type: "POST",
      data: {
        id_tes: id_tes,
        id_client: id_client,
        tgl_tes: tgl_tes,
        nama_tes: nama_tes,
        tipe_tes: tipe_tes,
        tipe_soal: tipe_soal,
        kuota: kuota,
        password: password,
        catatan: catatan,
        message: message
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
            CKEDITOR.instances['message'].setData('');
          }

          $('#table-tes').DataTable().ajax.reload();
        }

        $('html, .modal-body').animate({
          scrollTop: 0
        }, 'slow');
      }
    });
  }

  function editTes($id_tes) {
    $.ajax({
      url: "<?= base_url()?>/tes/getTes/" + $id_tes,
      type: "get",
      success: function(hasil) {
        var $obj = $.parseJSON(hasil);
        if ($obj.id_tes != '') {
          $('#modalFormTes').modal('show');
          $('#modalFormTesLabel').html($obj.nama_tes);
          $('.alert-error').hide();
          $('.alert-sukses').hide();

          $(`#formTambahTes [name='id_tes']`).val($obj.id_tes);
          $(`#formTambahTes [name='id_client']`).val($obj.fk_id_client);
          $(`#formTambahTes [name='tgl_tes']`).val($obj.tgl_tes);
          $(`#formTambahTes [name='nama_tes']`).val($obj.nama_tes);
          $(`#formTambahTes [name='tipe_tes']`).val($obj.tipe_tes);
          $(`#formTambahTes [name='tipe_soal']`).val($obj.tipe_soal);
          $(`#formTambahTes [name='kuota']`).val($obj.kuota);
          $(`#formTambahTes [name='password']`).val($obj.password);
          $(`#formTambahTes [name='catatan']`).val($obj.catatan);
          CKEDITOR.instances['message'].setData($obj.message);
        }
      }

    });
  }

  function hapusTes(id_tes, nama_tes) {
    Swal.fire({
      title: `Apa Anda yakin akan menghapus tes ${nama_tes}?`,
      text: "Anda tidak akan dapat mengembalikan ini!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "<?= base_url()?>/tes/hapusTes/" + id_tes,
          type: "get",
          success: function(hasil) {
            if (result.isConfirmed) {
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'success',
                title: `Berhasil menghapus tes ${nama_tes}`
              })

              $('#table-tes').DataTable().ajax.reload();
            }
          }
        });
      }
    })
  }

  function editStatusTes(id_tes, status, nama_tes) {
    $.ajax({
      url: "<?= base_url()?>/tes/editStatusTes",
      type: "POST",
      data: {
        id_tes: id_tes,
        status: status
      },
      success: function(result) {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        status = (status == "1") ? 'mengaktifkan' : 'menonaktifkan';

        Toast.fire({
          icon: 'success',
          title: `Berhasil ${status} tes ${nama_tes}`
        })

        $('#table-tes').DataTable().ajax.reload();
      }
    })
  }

    // Clipboard
  var clipboard = new ClipboardJS('.copy');

  clipboard.on('success', function(e) {
      Swal.fire({
          icon: "success",
          text: "Berhasil menyalin link",
          showConfirmButton: false,
          timer: 1500
      })
  });
</script>
<?= $this->endSection() ?>