<?= $this->extend('client-page/layout/page_layout') ?>

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
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">Kuota</th>
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

<?= $this->section('content') ?>
<script>
  // kumpulan function

  document.addEventListener('DOMContentLoaded', () => {
    showData();
  });

  // show data from database
  function showData() {
    $('#table-tes').DataTable({
      processing: true,
      serverSide: true,
      ajax: `<?= base_url()?>clientarea/getAllTesToefl`,
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
          data: 'kuota',
          searchable: false,
          className: 'text-xs w-1 text-right text-md-center',
          orderable: false,
          render: function(data, type, row) {
            return `${row.peserta} / ${row.kuota}`
          }
        },
        {
          data: null,
          render: function(data, type, row) {
            return `
              <a href="<?= base_url()?>clientarea/hasiltoefl/${row.tes}" class="me-1">
                <span class="badge bg-gradient-success">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
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
              <button class="copy btn btn-success" data-clipboard-text="<?= base_url()?>toefl/${row.url}/${row.tes}">
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
      order: [3, 'desc'],
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