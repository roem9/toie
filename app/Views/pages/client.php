<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<section class="py-3">
  <div class="row">
    <div class="col-md-8 me-auto text-left">
      <h5>List Client</h5>
      <p>Menu untuk mengelola seluruh data client</p>
    </div>
  </div>
  <div class="row mt-lg-4 mt-2" id="listOfClient">
    
  </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('modal') ?>
<!-- Modal Add Data Program-->
<div class="modal fade" id="modalFormClient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormClientLabel">Tambah Client</h5>
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
        <form id="formTambahClient">
          <input type="hidden" name="id_client" id="id_client">
          <div class="col-12 mb-3">
            <label>Nama Client</label>
            <input name="nama_client" class="multisteps-form__input form-control" type="text" placeholder="nama client">
          </div>
          <div class="col-12 mb-3">
            <label>Nama URL Client</label>
            <input name="url" class="multisteps-form__input form-control" type="text" placeholder="/url_client/">
          </div>
          <div class="col-12 mb-3">
            <label>Password</label>
            <input name="password" class="multisteps-form__input form-control" type="password" placeholder="password">
          </div>
          <div class="form-group">
            <label for="alamat_client">Alamat Client</label>
            <textarea name="alamat" class="form-control" id="alamat_client" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="logo_client" class="form-label">Logo Client</label>
            <div id="logo_client" style="display:none" class="text-center mb-3"></div>
            <input name="logo" class="form-control" type="file" id="logo">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" id="btnSimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js-script') ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Call function showData on loaded content
    showData();

    // kumpulan component
    const btnSimpan = $("#btnSimpan");
    const formSearch = $("#formSearch")

    // kumpulan even listener
    btnSimpan.on("click", tambahClient)
    formSearch.on('keyup', searchClient)
  });


  // kumpulan function
  $("[name='url']").on("keyup", function(){
      const inputValue = $("[name='url']").val();
      const outputValue = removeSpaces(inputValue).toLowerCase();
      $("[name='url']").val(outputValue);
  })

  function showModalFormClient() {
    $('#modalFormClientLabel').html('Tambah Client');
    $("#formTambahClient")[0].reset();
    $(`#formTambahClient [name='id_client']`).val('');
    $("#logo_client").hide();

    $('.alert-error').hide();
    $('.alert-sukses').hide();
  }

  // show data from database
  function showData(nama_client = '') {
    $.ajax({
      url: '<?= base_url()?>/client/getAllClient',
      type: "GET",
      success: function(result) {
        const data = JSON.parse(result)

        if(nama_client != ''){
          listClient = data.filter(data => data.nama_client.toLowerCase().includes(nama_client.toLowerCase()));
        } else {
          listClient = data
        }

        const listOfClient = $("#listOfClient");
        let obj = {};
        let html = `
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body d-flex flex-column justify-content-center text-center">
              <a href="javascript:;" class="btnModalFormClient" data-bs-toggle="modal" data-bs-target="#modalFormClient" onclick="showModalFormClient()">
                <i class="fa fa-plus text-secondary mb-3" aria-hidden="true"></i>
                <h5 class=" text-secondary"> Client Baru </h5>
              </a>
            </div>
          </div>
        </div>
        `;

        for (var i = 0; i < listClient.length; i++) {
          obj = listClient[i];
          html += `
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card">
                <div class="card-body p-3" style="height: 250px;">
                  <div class="d-flex">
                    <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                      <img src="${obj.logo}" alt="gambar ${obj.nama_client}" onerror="this.onerror=null; this.src='public/assets/img/curved-images/white-curved.jpg'">
                    </div>
                    <div class="ms-3 my-auto">
                      <h6>${obj.nama_client}</h6>
                    </div>
                    <div class="ms-auto">
                      <div class="dropdown">
                        <button class="btn btn-link text-secondary ps-0 pe-2" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-lg" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="javascript:;" onclick="editClient(${obj.id_client})">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                          </svg>  
                          Info
                        </a>
                        <a class="dropdown-item text-light" style="background-color: var(--bs-orange)" href="javascript:;" onclick="hapusClient(${obj.id_client}, '${obj.nama_client}')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                          </svg>
                          Hapus
                        </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div style="height: 35%">
                    <p class="text-sm mt-3"><b>Alamat :</b> ${obj.alamat} </p>
                  </div>
                  <hr class="horizontal dark">
                  <p class="text-sm mt-3"><b>URL :</b> ${obj.url} </p>
                </div>
              </div>
            </div>`
        }

        listOfClient.html(html);
      }

    });
  }

  function searchClient() {
    let data = $(this).val();

    showData(data);
  }

  function tambahClient(e) {
    e.preventDefault();

    let id_client = $(`#formTambahClient [name='id_client']`).val();
    let nama_client = $(`#formTambahClient [name='nama_client']`).val();
    let password = $(`#formTambahClient [name='password']`).val();
    let alamat = $(`#formTambahClient [name='alamat']`).val();
    let url = $(`#formTambahClient [name='url']`).val();
    let logo = $(`#formTambahClient #logo`)[0].files;
    var fd = new FormData();

    // Append data 
    fd.append('id_client', id_client);
    fd.append('nama_client', nama_client);
    fd.append('alamat', alamat);
    fd.append('url', url);
    fd.append('password', password);
    fd.append('logo', logo[0]);

    $.ajax({
      url: "<?= base_url()?>client/simpan",
      type: "POST",
      contentType: false,
      processData: false,
      cache: false,
      data: fd,
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
            $("#formTambahClient")[0].reset();
          } else {
            $(`#logo_client`).html(
              `<img src="<?= base_url()?>public/assets/logo-client/${$obj.logo}" alt="" class="img-fluid" width="30%">`
            )
          }

          showData();
          $('html, .modal-body').animate({
            scrollTop: 0
          }, 'slow');
        }
      }
    });
  }

  function editClient($id) {
    $.ajax({
      url: "<?= base_url()?>/client/getClient/" + $id,
      type: "get",
      success: function(hasil) {
        var obj = $.parseJSON(hasil);
        if (obj.id_client != '') {
          $('#modalFormClient').modal('show');
          $('#modalFormClientLabel').html('Edit Client');
          $('.alert-error').hide();
          $('.alert-sukses').hide();

          $(`#formTambahClient [name='id_client']`).val(obj.id_client);
          $(`#formTambahClient [name='nama_client']`).val(obj.nama_client);
          $(`#formTambahClient [name='alamat']`).val(obj.alamat);
          $(`#formTambahClient [name='url']`).val(obj.url);
          $(`#formTambahClient [name='password']`).val('');
          $(`#logo_client`).show();
          $(`#logo_client`).html(
            `<img src="<?= base_url()?>public/assets/logo-client/${obj.logo}" alt="" class="img-fluid" width="30%">`
          )
        }
      }

    });
  }

  function hapusClient(id, nama_client) {
    Swal.fire({
      title: `Apa Anda yakin akan menghapus client ${nama_client}?`,
      text: "Anda tidak akan dapat mengembalikan ini!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "<?= base_url()?>/client/hapusClient/" + id,
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
                title: `Berhasil menghapus client ${nama_client}`
              })

              showData();
            }
          }
        });
      }
    })
  }

</script>
<?= $this->endSection() ?>