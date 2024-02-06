<?= $this->extend('client-page/layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="col-12">
  <div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between">
      <div class="d-lg-flex">
        <div>
          <h5 class="mb-0"><?= $title ?></h5>
          <p class="text-sm mb-0">
            <?= $tipe_tes?> - <?= date('d-M-Y', strtotime($tgl_tes))?> - <?= $nama_tes?>
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
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all"></th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Nama Peserta</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Email</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">L</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">R</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">W</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">S</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder desktop">OVERALL</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder all">Action</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder none">FW 1</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder none">FW 2</th>
                  <th class="text-uppercase text-dark text-xxs font-weight-bolder none">FS</th>
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
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button> -->
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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
            <label>First Name</label>
            <input name="first_name" class="multisteps-form__input form-control" type="text" placeholder="first name">
          </div>
          <div class="col-12 mb-3">
            <label>Last Name</label>
            <input name="last_name" class="multisteps-form__input form-control" type="text" placeholder="last name">
          </div>
          <div class="col-12 mb-3">
            <label>Tempat Lahir</label>
            <input name="t4_lahir" class="multisteps-form__input form-control" type="text" placeholder="tempat lahir">
          </div>
          <div class="col-12 mb-3">
            <label>Tgl Lahir</label>
            <input name="tgl_lahir" class="multisteps-form__input form-control" type="date" placeholder="tgl lahir">
          </div>
          <div class="col-12 mb-3">
            <label>Email</label>
            <input name="email" class="multisteps-form__input form-control" type="text" placeholder="email">
          </div>
          <div class="col-12 mb-3">
            <label>Link Speaking</label>
            <textarea name="link_speaking" class="form-control" id="link_speaking" rows="3"></textarea>
          </div>
          <div class="col-12 mb-3">
            <label>Nilai Listening</label>
            <input name="nilai_listening" class="multisteps-form__input form-control" type="text" placeholder="nilai listening" disabled>
          </div>
          <div class="col-12 mb-3">
            <label>Nilai Reading</label>
            <input name="nilai_reading" class="multisteps-form__input form-control" type="text" placeholder="nilai reading" disabled>
          </div>
          <div class="col-12 mb-3">
            <label>Nilai Writing</label>
            <input name="nilai_writing" class="multisteps-form__input form-control" type="text" placeholder="nilai writing" disabled>
          </div>
          <div class="col-12 mb-3">
            <label>Nilai Speaking</label>
            <input name="nilai_speaking" class="multisteps-form__input form-control" type="text" placeholder="nilai speaking" disabled>
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

<!-- Modal FeedBack Writing-->
<div class="modal fade" id="modalFeedbackWriting" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFeedbackWritingLabel">Edit Peserta</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card">
              <div class="card-body ps-4 text-sm" style="height: 480px; overflow: scroll" id="text-writing">
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12" id="feedbackWriting">
            <div class="card">
              <div class="card-body ps-4" style="height: 480px; overflow: scroll">
                <!-- KALAU SUKSES -->
                <div class="alert alert-success fade show text-light alert-sukses" role="alert" style="display: none">
                  <div class="sukses"></div>
                </div>
                <!-- KALAU ERROR -->
                <div class="alert alert-danger fade show text-light alert-error" role="alert" style="display: none">
                  <div class="error"></div>
                </div>
                <form id="formFeedbackWriting">
                  <input type="hidden" name="id" id="id">
                  <input type="hidden" name="task" id="task">
                  <div class="form-group">
                    <label for="kriteria_ta"><span class="kriteria_ta">Evaluation TA (Task Achievement)</span></label>
                    <textarea name="kriteria_ta" class="form-control autoSaveWriting" id="kriteria_ta" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label><span class="score_ta">Score TA (Task Achievement)</span></label>
                    <input name="nilai_ta" class="multisteps-form__input form-control autoSaveWriting" type="text" placeholder="score task achievement">
                  </div>
                  <div class="form-group">
                    <label for="kriteria_cc">Evaluation CC (Coherence and Cohesion)</label>
                    <textarea name="kriteria_cc" class="form-control autoSaveWriting" id="kriteria_cc" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Score CC (Coherence and Cohesion)</label>
                    <input name="nilai_cc" class="multisteps-form__input form-control autoSaveWriting" type="text" placeholder="score task achievement">
                  </div>
                  <div class="form-group">
                    <label for="kriteria_gra">Evaluation GRA (Grammar)</label>
                    <textarea name="kriteria_gra" class="form-control autoSaveWriting" id="kriteria_gra" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Score GRA (Grammar)</label>
                    <input name="nilai_gra" class="multisteps-form__input form-control autoSaveWriting" type="text" placeholder="score task achievement">
                  </div>
                  <div class="form-group">
                    <label for="kriteria_lr">Evaluation LR (Lexical Resource)</label>
                    <textarea name="kriteria_lr" class="form-control autoSaveWriting" id="kriteria_lr" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Score LR (Lexical Resource)</label>
                    <input name="nilai_lr" class="multisteps-form__input form-control autoSaveWriting" type="text" placeholder="score task achievement">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-info" id="btnSimpanFeedbackWriting">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal FeedBack Speaking-->
<div class="modal fade" id="modalFeedbackSpeaking" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFeedbackSpeakingLabel">Edit Peserta</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card">
              <div class="card-body ps-4 text-sm" style="height: 480px; overflow: scroll" id="link-speaking">
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12" id="feedbackSpeaking">
            <div class="card">
              <div class="card-body ps-4" style="height: 480px; overflow: scroll">
                <!-- KALAU SUKSES -->
                <div class="alert alert-success fade show text-light alert-sukses" role="alert" style="display: none">
                  <div class="sukses"></div>
                </div>
                <!-- KALAU ERROR -->
                <div class="alert alert-danger fade show text-light alert-error" role="alert" style="display: none">
                  <div class="error"></div>
                </div>
                <form id="formFeedbackSpeaking">
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                    <label for="kriteria_topic">Fluency and Coherence</label>
                    <textarea name="kriteria_topic" class="form-control autoSaveSpeaking" id="kriteria_topic" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Score Fluency and Coherence</label>
                    <input name="nilai_topic" class="multisteps-form__input form-control autoSaveSpeaking" type="text" placeholder="score task achievement">
                  </div>
                  <div class="form-group">
                    <label for="kriteria_fluency">Lexical Resource</label>
                    <textarea name="kriteria_fluency" class="form-control autoSaveSpeaking" id="kriteria_fluency" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Score Lexical Resource</label>
                    <input name="nilai_fluency" class="multisteps-form__input form-control autoSaveSpeaking" type="text" placeholder="score task achievement">
                  </div>
                  <div class="form-group">
                    <label for="kriteria_grammar">Grammatical Range and Accuracy</label>
                    <textarea name="kriteria_grammar" class="form-control autoSaveSpeaking" id="kriteria_grammar" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Score Grammatical Range and Accuracy</label>
                    <input name="nilai_grammar" class="multisteps-form__input form-control autoSaveSpeaking" type="text" placeholder="score task achievement">
                  </div>
                  <div class="form-group">
                    <label for="kriteria_vocabulary">Pronunciation</label>
                    <textarea name="kriteria_vocabulary" class="form-control autoSaveSpeaking" id="kriteria_vocabulary" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Score Pronunciation</label>
                    <input name="nilai_vocabulary" class="multisteps-form__input form-control autoSaveSpeaking" type="text" placeholder="score task achievement">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-info" id="btnSimpanFeedbackSpeaking">Simpan</button>
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

    btnSimpan.on("click", simpanPesertaIelts);
    // $("#btnSimpanFeedbackWriting").on("click", simpanFeedbackWriting)
    // $("#btnSimpanFeedbackSpeaking").on("click", simpanFeedbackSpeaking)

    $("#btnSimpanFeedbackWriting").on("click", function() {
        simpanFeedbackWriting(true);
    });
    // $("#btnSimpanFeedbackSpeaking").on("click", simpanFeedbackSpeaking)
    $("#btnSimpanFeedbackSpeaking").on("click", function() {
        simpanFeedbackSpeaking(true);
    });

    $(".autoSaveWriting").on("keyup", function(){
        simpanFeedbackWriting(false)
    })

    // autoSaveSpeaking
    $(".autoSaveSpeaking").on("keyup", function(){
        simpanFeedbackSpeaking(false)
    })

    CKEDITOR.replace('kriteria_ta');
    CKEDITOR.replace('kriteria_cc');
    CKEDITOR.replace('kriteria_gra');
    CKEDITOR.replace('kriteria_lr');
    CKEDITOR.replace('kriteria_topic');
    CKEDITOR.replace('kriteria_fluency');
    CKEDITOR.replace('kriteria_grammar');
    CKEDITOR.replace('kriteria_vocabulary');

    // $('html, .modal-body').animate({
    //     scrollTop: 0
    //   }, 'slow');

        $('[id^="kriteria_"]').each(function () {
            var editorId = $(this).attr('id');

            if(editorId == 'kriteria_ta' || editorId == 'kriteria_cc' || editorId == 'kriteria_gra' || editorId == 'kriteria_lr'){
                CKEDITOR.instances[editorId].on('change', function () {
                    // Your functionality on CKEditor change
                    simpanFeedbackWriting(false)
                });
            } else if(editorId == 'kriteria_topic' || editorId == 'kriteria_fluency' || editorId == 'kriteria_grammar' || editorId == 'kriteria_vocabulary'){
                CKEDITOR.instances[editorId].on('change', function () {
                    // Your functionality on CKEditor change
                    simpanFeedbackSpeaking(false)
                });
            }
        });
  });

  // show data from database
  function showData() {
    $('#table-hasil-tes').DataTable({
      processing: true,
      serverSide: true,
      ajax: `<?= base_url()?>clientarea/getHasilTesIelts/<?= $id_tes?>`,
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
          data: 'first_name',
          searchable: true,
          className: 'text-xs',
          orderable: true,
          render: function(data, type, row) {
            return `${row.first_name} ${row.last_name}`
          }
        },
        {
          data: 'email',
          searchable: true,
          className: 'text-xs w-1',
          orderable: true
        },
        {
          data: 'nilai_listening',
          searchable: false,
          className: 'text-center text-xs w-1',
          orderable: false,
          render: function(data, type, row) {
            return ielts_listening(row.nilai_listening, row.created_at);
          }
        },
        {
          data: 'nilai_reading',
          searchable: false,
          className: 'text-center text-xs w-1',
          orderable: false,
          render: function(data, type, row) {
            return ielts_reading(row.nilai_reading, row.tipe_tes);
          }
        },
        {
          data: 'nilai_writing',
          searchable: false,
          orderable: false,
          className: 'text-center text-xs w-1',
          render: function(data, type, row) {
            return ielts_writing(row.nilai_ta_1,row.nilai_cc_1, row.nilai_gra_1, row.nilai_lr_1, row.nilai_ta_2, row.nilai_cc_2, row.nilai_gra_2, row.nilai_lr_2, row.created_at);
          }
        },
        {
          data: 'nilai_speaking',
          searchable: false,
          orderable: false,
          className: 'text-center text-xs w-1',
          render: function(data, type, row) {
            return ielts_speaking(row.nilai_topic, row.nilai_fluency, row.nilai_grammar, row.nilai_vocabulary, row.created_at);
          }
        },
        {
          data: null,
          searchable: false,
          className: 'text-center text-xs w-1',
          orderable: false,
          render: function(data, type, row) {
            let skor = skor_ielts(ielts_listening(row.nilai_listening, row.created_at), ielts_reading(row.nilai_reading, row.tipe_tes), ielts_writing(row.nilai_ta_1,row.nilai_cc_1, row.nilai_gra_1, row.nilai_lr_1, row.nilai_ta_2, row.nilai_cc_2, row.nilai_gra_2, row.nilai_lr_2, row.created_at), ielts_speaking(row.nilai_topic, row.nilai_fluency, row.nilai_grammar, row.nilai_vocabulary, row.created_at));
            return  skor + " / " + pembulatan_skor_ielts(skor, row.created_at);
          }
        },
        {
          data: null,
          searchable: false,
          orderable: false,
          render: function(data, type, row) {
            return `
            <a href="javascript:void(0)" onclick="editPeserta('${row.id_peserta}')" class="me-1">
                <span class="badge bg-gradient-info">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                  </svg>
                </span>
              </a>
              <a href="<?= base_url()?>hasilielts/${row.id_peserta}" target="_blank" class="me-1">
                <span class="badge bg-gradient-warning">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                    <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                  </svg>
                </span>
              </a><a href="<?= base_url()?>feedbackielts/${row.id_peserta}" target="_blank" class="me-1">
                <span class="badge bg-gradient-success">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z"/>
                  </svg>
                </span>
              </a>
              `;
          }
        },
        {
          data: null,
          searchable: false,
          orderable: false,
          className: 'text-xs w-1',
          render: function(data, type, row) {
            return `
            <a href="javascript:void(0)" onclick="feedbackWriting('${row.id_peserta}', 1)" class="me-1">
                <span class="badge bg-gradient-info">
                  Feedback Writing Task 1
                </span>
              </a>
              `;
          }
        },
        {
          data: null,
          searchable: false,
          orderable: false,
          className: 'text-xs w-1',
          render: function(data, type, row) {
            return `
            <a href="javascript:void(0)" onclick="feedbackWriting('${row.id_peserta}', 2)" class="me-1">
                <span class="badge bg-gradient-info">
                  Feedback Writing Task 2
                </span>
              </a>
              `;
          }
        },
        {
          data: null,
          searchable: false,
          orderable: false,
          className: 'text-xs w-1',
          render: function(data, type, row) {
            return `
            <a href="javascript:void(0)" onclick="feedbackSpeaking('${row.id_peserta}')" class="me-1">
                <span class="badge bg-gradient-info">
                  Feedback Speaking
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
      url: "<?= base_url()?>clientarea/getPeserta/" + $id_peserta,
      type: "get",
      success: function(hasil) {
        var $obj = $.parseJSON(hasil);
        // console.log($obj);
        if ($obj.id != '') {
          $('#modalHasilTes').modal('show');
          $('#modalHasilTesLabel').html($obj.first_name + " " + $obj.last_name);
          $('.alert-error').hide();
          $('.alert-sukses').hide();

          $(`#formHasilTes [name='id']`).val($obj.id);
          $(`#formHasilTes [name='first_name']`).val($obj.first_name);
          $(`#formHasilTes [name='last_name']`).val($obj.last_name);
          $(`#formHasilTes [name='t4_lahir']`).val($obj.t4_lahir);
          $(`#formHasilTes [name='tgl_lahir']`).val($obj.tgl_lahir);
          $(`#formHasilTes [name='email']`).val($obj.email);
          $(`#formHasilTes [name='link_speaking']`).val($obj.link_speaking);
          $(`#formHasilTes [name='nilai_speaking']`).val(ielts_speaking($obj.nilai_topic,$obj.nilai_fluency,$obj.nilai_grammar,$obj.nilai_vocabulary));
          $(`#formHasilTes [name='nilai_listening']`).val(ielts_listening($obj.nilai_listening));
          $(`#formHasilTes [name='nilai_reading']`).val(ielts_reading($obj.nilai_reading, $obj.tipe_tes));
          $(`#formHasilTes [name='nilai_writing']`).val(ielts_writing($obj.nilai_ta_1,$obj.nilai_cc_1,$obj.nilai_gra_1,$obj.nilai_lr_1,$obj.nilai_ta_2,$obj.nilai_cc_2,$obj.nilai_gra_2,$obj.nilai_lr_2));
        }
      }

    });
  }

  function simpanPesertaIelts(e) {
    e.preventDefault();

    let id = $(`#formHasilTes [name='id']`).val();
    let first_name = $(`#formHasilTes [name='first_name']`).val();
    let last_name = $(`#formHasilTes [name='last_name']`).val();
    let t4_lahir = $(`#formHasilTes [name='t4_lahir']`).val();
    let tgl_lahir = $(`#formHasilTes [name='tgl_lahir']`).val();
    let email = $(`#formHasilTes [name='email']`).val();
    let link_speaking = $(`#formHasilTes [name='link_speaking']`).val();

    // console.log(id_tes, id_client, tgl_tes, nama_tes, tipe_tes, tipe_soal, kuota, catatan)
    $.ajax({
      url: "<?= base_url()?>clientarea/simpanPesertaIelts",
      type: "POST",
      data: {
        id: id,
        first_name: first_name,
        last_name: last_name,
        t4_lahir: t4_lahir,
        tgl_lahir: tgl_lahir,
        email: email,
        link_speaking: link_speaking
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

          $('#table-hasil-tes').DataTable().ajax.reload();
        }

        $('html, .modal-body').animate({
          scrollTop: 0
        }, 'slow');
      }
    });
  }

  function feedbackWriting($id_peserta, task) {
    $.ajax({
      url: "<?= base_url()?>clientarea/getPeserta/" + $id_peserta,
      type: "get",
      success: function(hasil) {
        var $obj = $.parseJSON(hasil);
        if ($obj.id != '') {
          let text_writing = $obj.text_writing;
          text_writing = text_writing.split('|||');

          console.log(text_writing)

          $('#modalFeedbackWriting').modal('show');
          $('#modalFeedbackWritingLabel').html($obj.first_name + ' ' + $obj.last_name + ' Task ' + task);
          $('.alert-error').hide();
          $('.alert-sukses').hide();

          $(`#formFeedbackWriting [name='id']`).val($obj.id);
          $(`#formFeedbackWriting [name='task']`).val(task);

          let base_url = '<?= base_url()?>'
          if(task == 1){
            var formattedText = text_writing[0].replace(/\t/g, '&#9;').replace(/\n/g, '<br>');
            var wordCount = $.trim(text_writing[0]).length ? text_writing[0].match(/\S+/g).length : 0;
            
            $("#text-writing").html(
              writing($obj.tipe_soal, task, base_url) + '<br>' + '<b>Answer</b> <br>' +
              `<b>Word Count : ${wordCount}</b> <br><br> ${formattedText}`
            );
            CKEDITOR.instances['kriteria_ta'].setData($obj.kriteria_ta_1);
            $(`#formFeedbackWriting [name='nilai_ta']`).val($obj.nilai_ta_1);
            CKEDITOR.instances['kriteria_cc'].setData($obj.kriteria_cc_1);
            $(`#formFeedbackWriting [name='nilai_cc']`).val($obj.nilai_cc_1);
            CKEDITOR.instances['kriteria_gra'].setData($obj.kriteria_gra_1);
            $(`#formFeedbackWriting [name='nilai_gra']`).val($obj.nilai_gra_1);
            CKEDITOR.instances['kriteria_lr'].setData($obj.kriteria_lr_1);
            $(`#formFeedbackWriting [name='nilai_lr']`).val($obj.nilai_lr_1);

            $(".kriteria_ta").html('Evaluation TA (Task Achievement)');
            $(".score_ta").html('Score TA (Task Achievement)');
          } else if(task == 2){
            var formattedText = text_writing[1].replace(/\t/g, '&#9;').replace(/\n/g, '<br>');
            var wordCount = $.trim(text_writing[1]).length ? text_writing[1].match(/\S+/g).length : 0;

            $("#text-writing").html(
              writing($obj.tipe_soal, task, base_url) + '<br>' + '<b>Answer</b> <br>' +
              `<b>Word Count : ${wordCount}</b> <br><br> ${formattedText}`
            );
            CKEDITOR.instances['kriteria_ta'].setData($obj.kriteria_ta_2);
            $(`#formFeedbackWriting [name='nilai_ta']`).val($obj.nilai_ta_2);
            CKEDITOR.instances['kriteria_cc'].setData($obj.kriteria_cc_2);
            $(`#formFeedbackWriting [name='nilai_cc']`).val($obj.nilai_cc_2);
            CKEDITOR.instances['kriteria_gra'].setData($obj.kriteria_gra_2);
            $(`#formFeedbackWriting [name='nilai_gra']`).val($obj.nilai_gra_2);
            CKEDITOR.instances['kriteria_lr'].setData($obj.kriteria_lr_2);
            $(`#formFeedbackWriting [name='nilai_lr']`).val($obj.nilai_lr_2);

            $(".kriteria_ta").html('Evaluation TR (Task Response)');
            $(".score_ta").html('Score TR (Task Response)');
          }
        }
      }

    });
  }

  function feedbackSpeaking($id_peserta) {
    $.ajax({
      url: "<?= base_url()?>clientarea/getPeserta/" + $id_peserta,
      type: "get",
      success: function(hasil) {
        var $obj = $.parseJSON(hasil);
        if ($obj.id != '') {
          let text_writing = $obj.text_writing;
          text_writing = text_writing.split('|||');

          $('#modalFeedbackSpeaking').modal('show');
          $('#modalFeedbackSpeakingLabel').html($obj.first_name + ' ' + $obj.last_name + ' Speaking');
          $('.alert-error').hide();
          $('.alert-sukses').hide();

          $(`#formFeedbackSpeaking [name='id']`).val($obj.id);
          $(`#formFeedbackSpeaking [name='task']`).val(task);

          if($obj.link_speaking != ""){
            $("#link-speaking").html(`
              <div class="ratio ratio-16x9">
                ${$obj.link_speaking}
              </div>
            `);
          } else {
            $("#link-speaking").html(`
              Upload link speaking terlebih dahulu
            `);
          }

          CKEDITOR.instances['kriteria_topic'].setData($obj.kriteria_topic);
          $(`#formFeedbackSpeaking [name='nilai_topic']`).val($obj.nilai_topic);
          CKEDITOR.instances['kriteria_fluency'].setData($obj.kriteria_fluency);
          $(`#formFeedbackSpeaking [name='nilai_fluency']`).val($obj.nilai_fluency);
          CKEDITOR.instances['kriteria_grammar'].setData($obj.kriteria_grammar);
          $(`#formFeedbackSpeaking [name='nilai_grammar']`).val($obj.nilai_grammar);
          CKEDITOR.instances['kriteria_vocabulary'].setData($obj.kriteria_vocabulary);
          $(`#formFeedbackSpeaking [name='nilai_vocabulary']`).val($obj.nilai_vocabulary);
        }
      }

    });
  }

  // function simpanFeedbackWriting(e) {
  //   e.preventDefault();

  //   let id = $(`#formFeedbackWriting [name='id']`).val();
  //   let task = $(`#formFeedbackWriting [name='task']`).val();
  //   let kriteria_ta = CKEDITOR.instances['kriteria_ta'].getData();
  //   let kriteria_cc = CKEDITOR.instances['kriteria_cc'].getData();
  //   let kriteria_gra = CKEDITOR.instances['kriteria_gra'].getData();
  //   let kriteria_lr = CKEDITOR.instances['kriteria_lr'].getData();
  //   let nilai_ta = $(`#formFeedbackWriting [name='nilai_ta']`).val();
  //   let nilai_cc = $(`#formFeedbackWriting [name='nilai_cc']`).val();
  //   let nilai_gra = $(`#formFeedbackWriting [name='nilai_gra']`).val();
  //   let nilai_lr = $(`#formFeedbackWriting [name='nilai_lr']`).val();

  //   $.ajax({
  //     url: "<?= base_url()?>clientarea/simpanFeedbackWriting",
  //     type: "POST",
  //     data: {
  //       id: id,
  //       task: task,
  //       kriteria_ta: kriteria_ta,
  //       kriteria_cc: kriteria_cc,
  //       kriteria_gra: kriteria_gra,
  //       kriteria_lr: kriteria_lr,
  //       nilai_ta: nilai_ta,
  //       nilai_cc: nilai_cc,
  //       nilai_gra: nilai_gra,
  //       nilai_lr: nilai_lr
  //     },
  //     success: function(hasil) {
  //       var $obj = $.parseJSON(hasil);
  //       if ($obj.sukses == false) {
  //         $('.alert-sukses').hide();
  //         $('.alert-error').show();
  //         $('.error').html($obj.error);
  //       } else {
  //         $('.alert-error').hide();
  //         $('.alert-sukses').show();
  //         $('.sukses').html($obj.sukses);

  //         if ($obj.edit == false) {
  //           $("#formTambahTes")[0].reset();
  //           CKEDITOR.instances['message'].setData('');
  //         }

  //         $('#table-hasil-tes').DataTable().ajax.reload();
  //       }

  //       $('#feedbackWriting .card-body').animate({
  //         scrollTop: 0
  //       }, 'slow');
  //     }
  //   });
  // }

  // function simpanFeedbackSpeaking(e) {
  //   e.preventDefault();

  //   let id = $(`#formFeedbackSpeaking [name='id']`).val();
  //   let kriteria_topic = CKEDITOR.instances['kriteria_topic'].getData();
  //   let kriteria_fluency = CKEDITOR.instances['kriteria_fluency'].getData();
  //   let kriteria_grammar = CKEDITOR.instances['kriteria_grammar'].getData();
  //   let kriteria_vocabulary = CKEDITOR.instances['kriteria_vocabulary'].getData();
  //   let nilai_topic = $(`#formFeedbackSpeaking [name='nilai_topic']`).val();
  //   let nilai_fluency = $(`#formFeedbackSpeaking [name='nilai_fluency']`).val();
  //   let nilai_grammar = $(`#formFeedbackSpeaking [name='nilai_grammar']`).val();
  //   let nilai_vocabulary = $(`#formFeedbackSpeaking [name='nilai_vocabulary']`).val();

  //   $.ajax({
  //     url: "<?= base_url()?>clientarea/simpanFeedbackSpeaking",
  //     type: "POST",
  //     data: {
  //       id: id,
  //       kriteria_topic: kriteria_topic,
  //       kriteria_fluency: kriteria_fluency,
  //       kriteria_grammar: kriteria_grammar,
  //       kriteria_vocabulary: kriteria_vocabulary,
  //       nilai_topic: nilai_topic,
  //       nilai_fluency: nilai_fluency,
  //       nilai_grammar: nilai_grammar,
  //       nilai_vocabulary: nilai_vocabulary
  //     },
  //     success: function(hasil) {
  //       var $obj = $.parseJSON(hasil);
  //       if ($obj.sukses == false) {
  //         $('.alert-sukses').hide();
  //         $('.alert-error').show();
  //         $('.error').html($obj.error);
  //       } else {
  //         $('.alert-error').hide();
  //         $('.alert-sukses').show();
  //         $('.sukses').html($obj.sukses);

  //         if ($obj.edit == false) {
  //           $("#formTambahTes")[0].reset();
  //           CKEDITOR.instances['message'].setData('');
  //         }

  //         $('#table-hasil-tes').DataTable().ajax.reload();
  //       }

  //       $('#feedbackSpeaking .card-body').animate({
  //         scrollTop: 0
  //       }, 'slow');
  //     }
  //   });
  // }

    function simpanFeedbackWriting(showMsg) {

        let id = $(`#formFeedbackWriting [name='id']`).val();
        let task = $(`#formFeedbackWriting [name='task']`).val();
        let kriteria_ta = CKEDITOR.instances['kriteria_ta'].getData();
        let kriteria_cc = CKEDITOR.instances['kriteria_cc'].getData();
        let kriteria_gra = CKEDITOR.instances['kriteria_gra'].getData();
        let kriteria_lr = CKEDITOR.instances['kriteria_lr'].getData();
        let nilai_ta = $(`#formFeedbackWriting [name='nilai_ta']`).val();
        let nilai_cc = $(`#formFeedbackWriting [name='nilai_cc']`).val();
        let nilai_gra = $(`#formFeedbackWriting [name='nilai_gra']`).val();
        let nilai_lr = $(`#formFeedbackWriting [name='nilai_lr']`).val();

        $.ajax({
        url: "<?= base_url()?>/clientarea/simpanFeedbackWriting",
        type: "POST",
        data: {
            id: id,
            task: task,
            kriteria_ta: kriteria_ta,
            kriteria_cc: kriteria_cc,
            kriteria_gra: kriteria_gra,
            kriteria_lr: kriteria_lr,
            nilai_ta: nilai_ta,
            nilai_cc: nilai_cc,
            nilai_gra: nilai_gra,
            nilai_lr: nilai_lr
        },
        success: function(hasil) {
            var $obj = $.parseJSON(hasil);
            if ($obj.sukses == false) {
            $('.alert-sukses').hide();
            $('.alert-error').show();
            $('.error').html($obj.error);
            } else {
            //   $('.alert-error').hide();
            //   $('.alert-sukses').show();
            //   $('.sukses').html($obj.sukses);

            if ($obj.edit == false) {
                $("#formTambahTes")[0].reset();
                CKEDITOR.instances['message'].setData('');
            }

            $('#table-hasil-tes').DataTable().ajax.reload();
            }

            // $('#feedbackWriting .card-body').animate({
            //   scrollTop: 0
            // }, 'slow');

            if(showMsg){
                Toast.fire({
                    icon: "success",
                    title: "Berhasil mengubah data"
                });
            }
        }
        });
    }

    function simpanFeedbackSpeaking(showMsg) {
        // e.preventDefault();

        let id = $(`#formFeedbackSpeaking [name='id']`).val();
        let kriteria_topic = CKEDITOR.instances['kriteria_topic'].getData();
        let kriteria_fluency = CKEDITOR.instances['kriteria_fluency'].getData();
        let kriteria_grammar = CKEDITOR.instances['kriteria_grammar'].getData();
        let kriteria_vocabulary = CKEDITOR.instances['kriteria_vocabulary'].getData();
        let nilai_topic = $(`#formFeedbackSpeaking [name='nilai_topic']`).val();
        let nilai_fluency = $(`#formFeedbackSpeaking [name='nilai_fluency']`).val();
        let nilai_grammar = $(`#formFeedbackSpeaking [name='nilai_grammar']`).val();
        let nilai_vocabulary = $(`#formFeedbackSpeaking [name='nilai_vocabulary']`).val();

        $.ajax({
        url: "<?= base_url()?>/clientarea/simpanFeedbackSpeaking",
        type: "POST",
        data: {
            id: id,
            kriteria_topic: kriteria_topic,
            kriteria_fluency: kriteria_fluency,
            kriteria_grammar: kriteria_grammar,
            kriteria_vocabulary: kriteria_vocabulary,
            nilai_topic: nilai_topic,
            nilai_fluency: nilai_fluency,
            nilai_grammar: nilai_grammar,
            nilai_vocabulary: nilai_vocabulary
        },
        success: function(hasil) {
            var $obj = $.parseJSON(hasil);
            if ($obj.sukses == false) {
            $('.alert-sukses').hide();
            $('.alert-error').show();
            $('.error').html($obj.error);
            } else {
            //   $('.alert-error').hide();
            //   $('.alert-sukses').show();
            //   $('.sukses').html($obj.sukses);

            if ($obj.edit == false) {
                $("#formTambahTes")[0].reset();
                CKEDITOR.instances['message'].setData('');
            }

            $('#table-hasil-tes').DataTable().ajax.reload();
            }

            // $('#feedbackSpeaking .card-body').animate({
            //   scrollTop: 0
            // }, 'slow');

            if(showMsg){
                Toast.fire({
                    icon: "success",
                    title: "Berhasil mengubah data"
                });
            }
        }
        });
    }

</script>
<?= $this->endSection() ?>