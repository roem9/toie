<?= $this->extend('pages/soal/layout/page_layout') ?>

<?= $this->section('content') ?>
    <?php if($full_kuota) :?>
        <div class="container py-7">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mt-4 mb-4">
                                <a href="javascript:void()"><img src="<?= $logo?>" alt="" class="img-fluid" style="max-height: 60px"></a>
                            </div>
                            <div class="mb-2 mt-3">
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <?= session()->getFlashdata('msg'); ?>
                                <?php else :?>
                                    <b>The quota of participants in this test is full. Please contact admin for more info</b>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else :?>
        <div class="d-none d-lg-block">
            <form action="<?= base_url()?>PesertaIelts/addJawabanIelts" method="post" id="formIelts">
                <div class="page page-center" id="login">
                    <div class="container py-7">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center mt-4 mb-4">
                                            <a href="javascript:void()"><img src="<?= $logo?>" alt="" class="img-fluid" style="max-height: 60px"></a>
                                        </div>
                                        <?php if (session()->getFlashdata('msg')) : ?>
                                            <?= session()->getFlashdata('msg'); ?>
                                        <?php else: ?>
                                            <div id="formLogin">
                                                <div class="mb-2 mt-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" name="password" class="form form-control">
                                                        <label for="">Password</label>
                                                    </div>
                                                </div>
                                                <div class="form-footer">
                                                    <button type="button" class="btn bg-gradient-info w-100 btnSignIn">Log In</button>
                                                </div>
                                            </div>
                                            <div id="formData" style="display: none">
                                                <div class="mb-2 mt-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="first_name" class="form form-control required">
                                                                <label for="">First Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="last_name" class="form form-control required">
                                                                <label for="">Last Name</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="t4_lahir" class="form form-control required">
                                                        <label for="">Place of Birth</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="tgl_lahir" class="form form-control required">
                                                        <label for="">Date of Birth</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="email" class="form form-control required">
                                                        <label for="">Email</label>
                                                    </div>
                                                </div>
                                                <div class="form-footer">
                                                    <button type="button" class="btn bg-gradient-info w-100 btnTransisiSatu">Start</button>
                                                </div>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
    
                <div id="worksheet">
                    <div class="page page-center transisi-sesi-1 session" id="transisi-sesi-1" style="display: none">
                        <div class="container py-7">
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center mb-4">
                                                <a href="javascript:void()"><img src="<?= $logo?>" alt="" class="img-fluid" style="max-height: 60px"></a>
                                            </div>
                                            <center>
                                                <p><b><span class="urutanSession">First</span> Session : LISTENING</b></p>
                                                <p><i>Time : 40 Minutes</i></p>
                                            </center>
                                            <div class="form-footer">
                                                <button type="button" class="btn bg-gradient-info w-100 btnListening" >Start</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="page page-center transisi-sesi-2 session" id="transisi-sesi-2" style="display: none">
                        <div class="container py-7">
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center mb-4">
                                                <a href="javascript:void()"><img src="<?= $logo?>" alt="" class="img-fluid" style="max-height: 60px"></a>
                                            </div>
                                            <center>
                                                <p><b><span class="urutanSession">Second</span> Session : READING</b></p>
                                                <p><i>Time : 60 Minutes</i></p>
                                            </center>
                                            <div class="form-footer">
                                                <button type="button" class="btn bg-gradient-info w-100 btnReading">Start</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="page page-center transisi-sesi-3 session" id="transisi-sesi-3" style="display: none">
                        <div class="container py-7">
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center mb-4">
                                                <a href="javascript:void()"><img src="<?= $logo?>" alt="" class="img-fluid" style="max-height: 60px"></a>
                                            </div>
                                            <center>
                                                <p><b><span class="urutanSession">Third</span> Session : WRITING</b></p>
                                                <p><i>Time : 60 Minutes</i></p>
                                            </center>
                                            <div class="form-footer">
                                                <button type="button" class="btn bg-gradient-info w-100 btnWriting">Start</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div id="soal_tes" style="display: none; color: black;">
                        <div class="wrapper" id="elementtoScrollToID">
                            <div class="page-wrapper" id="">
                                <div class="page-body">
                                    <!-- <div class="container-xl"> -->
                                        <input type="hidden" name="id_tes" value="<?= $id_tes?>">
            
                                        <div class="sesi-listening session" style="display: none">
                                            
                                            <?= $this->renderSection('sesi-listening') ?>
            
                                            <div class="d-flex justify-content-end">
                                                <a href="javascript:void(0)" class="btn btn-success btnTransisiDua" id="btnTransisiDua">Next</a>
                                            </div>
                                        </div>
            
                                        <div class="sesi-reading session" style="display: none">
                                            
                                            <?= $this->renderSection('sesi-reading') ?>
            
                                            <div class="d-flex justify-content-end">
                                                <a href="javascript:void(0)" class="btn btn-success btnTransisiTiga" id="btnTransisiTiga">Next</a>
                                            </div>
                                        </div>
            
                                        <div class="sesi-writing session" style="display: none">
                                            <?= $this->renderSection('sesi-writing') ?>
            
                                            <div class="d-flex justify-content-end">
                                                <a href="javascript:void(0)" class="btn bg-gradient-info btnSimpan">Save</a>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
            </form>
        </div>
        <div class="d-block d-lg-none">
            <div class="container py-7">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 d-flex flex-column mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-4 mb-4">
                                    <a href="javascript:void()"><img src="<?= $logo?>" alt="" class="img-fluid" style="max-height: 60px"></a>
                                </div>
                                <div class="mb-2 mt-3">
                                    <b>Your device screen is too small to take the test. Please replace your device first</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>

    <div class="modal modal-blur bg-danger" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Leaving the worksheet is not allowed. You'll lose your progress and your test result will be unvalid</p>
                    <p>You will lose your progress in <span id="count">10</span> seconds</p>
                </div>
                <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-auto mr-3 btn-primary" data-bs-dismiss="modal">Stay on the Worksheet</button>
                </div>
            </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('js-script') ?>
<script>
    let start = false;

    // localStorage
    var audioArray = [];

    let listening = <?= $listening?>;
    let reading = <?= $reading?>;
    let writing = <?= $writing?>;

    $(document).ready(function() {
        // localStorage digunakan untuk menghitung lama peserta meninggalkan page
        let now = new Date();
        let hours = now.getHours() * 60 * 60;
        let minutes = now.getMinutes() * 60;
        let seconds = now.getSeconds();
        let totalTime = parseInt(hours + minutes + seconds);

        if(totalTime - localStorage.getItem('currentTime') >=  <?= $time_reload['value']?>){
            localStorage.clear();
        }
        // localStorage digunakan untuk menghitung lama peserta meninggalkan page


        // localStorage menghitung waktu sekarang
        if (!localStorage.getItem('currentTime')) {
            updateTimeInLocalStorage();
        }
        
        setInterval(updateTimeInLocalStorage, 1000);
        // localStorage menghitung waktu sekarang

        // localStorage jumlah reload dan proses yang terjadi ketika reload
        let reloadCount = localStorage.getItem('reload');
    
        if (reloadCount === null) {
            // Jika tidak ada nilai localStorage reload, atur ke 3
            localStorage.setItem('reload', <?= $reload_page['value']?>);
        } else {
            if(localStorage.getItem('sesi')){
                // Jika ada nilai localStorage reload, kurangi 1
                reloadCount = parseInt(reloadCount);
                localStorage.setItem('reload', reloadCount - 1);
            }

            // Hapus localStorage jika reload = 0
            if (localStorage.getItem('reload') < 0) {
                localStorage.clear();
                localStorage.setItem('reload', <?= $reload_page['value']?>);
            }
        }
        // localStorage jumlah reload dan proses yang terjadi ketika reload
        
        // localStorage jika data sudah berhasil diinput maka lakukan clear storage
        <?php if( session()->getFlashdata('msg') ) : ?>
            localStorage.clear();
        <?php endif;?>
        // localStorage jika data sudah berhasil diinput maka lakukan clear storage

        // localStorage untuk menyimpan semua hasil input
        $('form input, form select, form textarea').on('input change', function() {
            // Simpan nilai elemen ke localStorage
            localStorage.setItem($(this).attr('name'), $(this).val());
        });
        // localStorage untuk menyimpan semua hasil input

        // localStorage untuk mengambil semua hasil input
        $('form input:not([type="radio"]), form select, form textarea').each(function() {
            // Ambil nilai dari localStorage berdasarkan id elemen
            const storedValue = localStorage.getItem($(this).attr('name'));
            if (storedValue !== null) {
                // Setel nilai elemen dari localStorage jika ada
                $(this).val(storedValue);
            }
        });
        // localStorage untuk mengambil semua hasil input

        // localStorage untuk mengambil semua hasil input jawaban
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            
            // Periksa apakah kunci mengandung kata 'jawaban_sesi_'
            if (key.includes('jawaban_')) {
                const value = localStorage.getItem(key);
                
                // Temukan elemen form yang sesuai dengan kunci (name attribute)
                // Misalnya, jika key adalah 'jawaban_sesi_1', maka cari elemen dengan name='jawaban_sesi_1[]'
                // atau sesuaikan dengan struktur name attribute Anda
                const $element = $(`[name="${key}"]`);
                
                // Periksa apakah elemen ditemukan
                if ($element.length > 0) {
                    // Setel nilai elemen form dari localStorage
                    $element.val(value);

                    var radios = $(`[data-id="${key}"]`) // list of radio buttons
                    for(var r=0;r<radios.length;r++){
                        if(radios[r].value == value){
                            radios[r].checked = true; // marking the required radio as checked
                        }
                    }

                }
            }
        }
        // localStorage untuk mengambil semua hasil input jawaban

        // localStorage mengatur semua yang terjadi jika terset localStorage item
        if(localStorage.getItem('sesi')){
            let id = localStorage.getItem('sesi');
            start = true;

            $("#login").hide();
            $("#soal_tes").show();
            $(".session").hide();
            $("."+id).show();

            // audio 
            if(localStorage.getItem('audioArray') && localStorage.getItem('audioTime')){

                // Retrieve the array from localStorage
                const storedAudioArray = localStorage.getItem('audioArray');
    
                // Parse the JSON string back into a JavaScript array
                const storedAudio = JSON.parse(storedAudioArray) || []; // Initialize as empty array if no data found
    
                audioArray = storedAudio;
    
                // Get the last item from the array
                const lastItem = storedAudio[storedAudio.length - 1];
    
                storedAudio.forEach(audio => {
                    if(audio != lastItem){
                        $(`button[data-id="${audio}"]`).hide();
                    }
                });
    
                const audioElement = $('#audio-'+lastItem)[0]; // Select audio element by ID
    
                const audioTime = localStorage.getItem('audioTime');
                audioElement.currentTime = audioTime;
            }

            if(id != 'transisi-sesi-1' && id != 'transisi-sesi-2' && id != 'transisi-sesi-3'){
                sec = localStorage.getItem('time');
                countDiv = document.getElementById("waktu"),
                secpass,
                countDown = setInterval(function () {
                    'use strict';
                    secpass(id);
                }, 1000);

                $("#navbarTes").show();
            } else {
                $("#navbarTes").hide();
            }

            if (listening != 1 || reading != 1 || writing != 1) {
                $(".urutanSession").hide();
            }

            if(listening == 1 && reading == 0 && writing == 0){
                $('#btnTransisiDua').removeClass('btnTransisiDua');
                $('#btnTransisiDua').removeClass('btn-success');
                $('#btnTransisiDua').addClass('btnSimpan');
                $('#btnTransisiDua').addClass('bg-gradient-info');
                $('#btnTransisiDua').html('Save');
            } else if((listening == 1 || listening == 0) && reading == 1 && writing == 0){
                $('#btnTransisiTiga').removeClass('btnTransisiTiga');
                $('#btnTransisiTiga').removeClass('btn-success');
                $('#btnTransisiTiga').addClass('btnSimpan');
                $('#btnTransisiTiga').addClass('bg-gradient-info');
                $('#btnTransisiTiga').html('Save');
            } else if(listening == 1 && reading == 0 && writing == 1){
                $('#btnTransisiDua').removeClass('btnTransisiDua');
                $('#btnTransisiDua').removeClass('btn-success');
                $('#btnTransisiDua').addClass('btnTransisiTiga');
                $('#btnTransisiDua').addClass('btn-success');
                $('#btnTransisiDua').html('Next');
            }

            $('#count-textarea-1').text(localStorage.getItem('word-text-1'));
            $('#count-textarea-2').text(localStorage.getItem('word-text-2'));
        }
        // localStorage mengatur semua yang terjadi jika terset localStorage item

        $(document).mouseleave(function () {
            showAlertWithCountdown(10)
        });

        $(document).mouseenter(function () {
            returnWorkSheet()
        });

        $(".btnSignIn").click(function(){
            let id_tes = $("input[name='id_tes']").val();
            let password = $("input[name='password']").val();

            $.ajax({
                url: "<?= base_url()?>PesertaIelts/passwordCheck",
                data: {id: id_tes, password: password},
                type: "post",
                success: function(hasil) {
                    var $obj = $.parseJSON(hasil);

                    if($obj === null){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Invalid password. Try again.'
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: '',
                            text: 'Success!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#formLogin").hide();
                        $("#formData").show();

                        listening = $obj.listening;
                        reading = $obj.reading;
                        writing = $obj.writing;

                        if (listening != 1 || reading != 1 || writing != 1) {
                            $(".urutanSession").hide();
                        }

                        if(listening == 1 && reading == 0 && writing == 0){
                            $('#btnTransisiDua').removeClass('btnTransisiDua');
                            $('#btnTransisiDua').removeClass('btn-success');
                            $('#btnTransisiDua').addClass('btnSimpan');
                            $('#btnTransisiDua').addClass('bg-gradient-info');
                            $('#btnTransisiDua').html('Save');
                        } else if((listening == 1 || listening == 0) && reading == 1 && writing == 0){
                            $('#btnTransisiTiga').removeClass('btnTransisiTiga');
                            $('#btnTransisiTiga').removeClass('btn-success');
                            $('#btnTransisiTiga').addClass('btnSimpan');
                            $('#btnTransisiTiga').addClass('bg-gradient-info');
                            $('#btnTransisiTiga').html('Save');
                        } else if(listening == 1 && reading == 0 && writing == 1){
                            $('#btnTransisiDua').removeClass('btnTransisiDua');
                            $('#btnTransisiDua').removeClass('btn-success');
                            $('#btnTransisiDua').addClass('btnTransisiTiga');
                            $('#btnTransisiDua').addClass('btn-success');
                            $('#btnTransisiDua').html('Next');
                        }
                    }
                }

            });
        })

        $("#textarea-1").on('keyup', function(e) {
            var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
            $('#count-textarea-1').text(words);

            localStorage.setItem('word-text-1', words);
        });

        $("#textarea-2").on('keyup', function(e) {
            var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
            $('#count-textarea-2').text(words);

            localStorage.setItem('word-text-2', words);
        });

        // autosize 
        $('.form-autosize').on('input', function () {
            this.style.width = '50px';
            this.style.width = (this.scrollWidth + 5) + 'px';
        });

        $(document).on("click", ".btnTransisiSatu", function(){
            var first_name = $("[name='first_name']").val();
            var last_name = $("[name='last_name']").val();
            var email = $("[name='email']").val();
            var t4_lahir = $("[name='t4_lahir']").val();
            var tgl_lahir = $("[name='tgl_lahir']").val();
            var id_tes = $("[name='id_tes']").val();

            if(first_name == "" || last_name == "" || email == "" || t4_lahir == "" || tgl_lahir == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Lengkapi data terlebih dahulu',
                })
            } else {
                // cek email 
                $.ajax({
                    url: "<?= base_url()?>PesertaIelts/cekEmail",
                    data: {id_tes: id_tes, email: email},
                    type: "post",
                    success: function(hasil) {
                        var $obj = $.parseJSON(hasil);

                        if($obj !== null){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Email Anda telah digunakan',
                            })
                        } else {
                            $("#login").hide();
                            $("#soal_tes").show();
                            $(".session").hide();
                            $("#navbarTes").hide();

                            if(listening == 0 && reading == 1){
                                $("#transisi-sesi-2").show();
                                // localStorage menympan data sesi
                                localStorage.setItem('sesi', 'transisi-sesi-2');
                                // localStorage menympan data sesi
                            } else if(listening == 0 && reading == 0 && writing == 1){
                                $("#transisi-sesi-3").show();
                                // localStorage menympan data sesi
                                localStorage.setItem('sesi', 'transisi-sesi-3');
                                // localStorage menympan data sesi
                            } else {
                                $("#transisi-sesi-1").show();
                                // localStorage menympan data sesi
                                localStorage.setItem('sesi', 'transisi-sesi-1');
                                // localStorage menympan data sesi
                            }
                            start = true;

                            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                                $([document.documentElement, document.body]).animate({
                                    scrollTop: $("#elementtoScrollToID").offset().top
                                }, 1000);
                            }
                        }
                    }

                });
            }

        })

        $(document).on("click", ".btnTransisiDua", function(){
            Swal.fire({
                icon: 'question',
                html: 'Once you close, you cannot open the previous section',
                showCloseButton: true,
                showCancelButton: true,
                target: '#worksheet',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function (result) {
                if (result.value) {
                    if (typeof countDown !== 'undefined' && countDown !== null) {
                        clearInterval(countDown);
                    }
                    $(".session").hide();
                    $("#navbarTes").hide();
                    $("#transisi-sesi-2").show();

                    // localStorage menympan data sesi
                    localStorage.setItem('sesi', 'transisi-sesi-2');
                    // localStorage menympan data sesi

                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#elementtoScrollToID").offset().top
                        }, 1000);
                    }

                    var audios = document.getElementsByTagName('audio');  
                    for(var i = 0, len = audios.length; i < len;i++){  
                        if(audios[i]){  
                            audios[i].pause();  
                        }  
                    }
                }
            })
        })

        $(document).on("click", ".btnTransisiTiga", function(){
            Swal.fire({
                icon: 'question',
                html: 'Once you close, you cannot open the previous section',
                showCloseButton: true,
                showCancelButton: true,
                target: '#worksheet',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function (result) {
                if (result.value) {
                    if (typeof countDown !== 'undefined' && countDown !== null) {
                        clearInterval(countDown);
                    }

                    $(".session").hide();
                    $("#navbarTes").hide();
                    $("#transisi-sesi-3").show();

                    // localStorage menympan data sesi
                    localStorage.setItem('sesi', 'transisi-sesi-3');
                    // localStorage menympan data sesi

                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#elementtoScrollToID").offset().top
                        }, 1000);
                    }
                }
            })
        })

        $(".btnListening").click(function(){
            Swal.fire({
                icon: 'question',
                html: 'Start the session now?',
                showCloseButton: true,
                showCancelButton: true,
                target: '#worksheet',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then(function (result) {
                if (result.value) {
                    $(".session").hide();
                    $("#navbarTes").show();
                    $(".sesi-listening").show();

                    // localStorage menympan data sesi
                    localStorage.setItem('sesi', 'sesi-listening');
                    // localStorage menympan data sesi
            
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#elementtoScrollToID").offset().top
                        }, 1000);
                    }
            
                    // clearInterval(countDown);
                    
                    sec = 40 * 60;
                    // sec = 30;
            
                    countDiv = document.getElementById("waktu"),
                    secpass,
                    countDown = setInterval(function () {
                        'use strict';
                        secpass("sesi-listening");
                    }, 1000);
                }
            })
        })

        $(".btnReading").click(function(){
            Swal.fire({
                icon: 'question',
                html: 'Start the session now?',
                showCloseButton: true,
                showCancelButton: true,
                target: '#worksheet',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function (result) {
                if (result.value) {
                    $(".session").hide();
                    $("#navbarTes").show();
                    $(".sesi-reading").show();

                    // localStorage menympan data sesi
                    localStorage.setItem('sesi', 'sesi-reading');
                    // localStorage menympan data sesi
            
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#elementtoScrollToID").offset().top
                        }, 1000);
                    }
            
                    // clearInterval(countDown);
                    if(listening == 1){
                        if (typeof countDown !== 'undefined' && countDown !== null) {
                            clearInterval(countDown);
                        }
                    }

                    sec = 60 * 60;
                    // sec = 40;
            
                    countDiv = document.getElementById("waktu"),
                    secpass,
                    countDown = setInterval(function () {
                        'use strict';
                        secpass("sesi-reading");
                    }, 1000);
                }
            })
        })

        $(".btnWriting").click(function(){
            Swal.fire({
                icon: 'question',
                html: 'Start the session now?',
                showCloseButton: true,
                showCancelButton: true,
                target: '#worksheet',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function (result) {
                if (result.value) {
                    $(".session").hide();
                    $("#navbarTes").show();
                    $(".sesi-writing").show();
            
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#elementtoScrollToID").offset().top
                        }, 1000);
                    }
            
                    // clearInterval(countDown);
                    if(reading == 1){
                        if (typeof countDown !== 'undefined' && countDown !== null) {
                            clearInterval(countDown);
                        }
                    }

                    // localStorage menympan data sesi
                    localStorage.setItem('sesi', 'sesi-writing');
                    // localStorage menympan data sesi

                    sec = 60 * 60;
                    // sec = 40;
            
                    countDiv = document.getElementById("waktu"),
                    secpass,
                    countDown = setInterval(function () {
                        'use strict';
                        secpass("sesi-writing");
                    }, 1000);
                }
            })
        })

        $(document).on("click", ".btnSimpan", function(){
            Swal.fire({
                icon: 'question',
                html: 'Finish the test?',
                showCloseButton: true,
                showCancelButton: true,
                target: '#worksheet',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function (result) {
                if (result.value) {
                    swal.fire({
                        html: '<h4>Submit your answer ...</h4>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                    $(".btnSimpan").html("Saving...");
                    $(".btnSimpan").prop("disabled", true);
                    $("#formIelts").submit()
                }
            })
        })

        $('input:radio').click(function () {
            let id = $(this).data("id");
            let value = $(this).val();

            $(`[name="`+id+`"]`).val(value);
            localStorage.setItem(id, value);
        });

        for (let i = 1; i < 54; i++) {
            // var words = $( ".reading-"+i).first().text().split( /\s+/ );
            var words = $( ".reading-"+i).first().text().split(" ");
            var text = words.join( "</span> <span>" );

            text = text.replace("()", "<i>");
            text = text.replace("(*)", "</i>");

            text = text.replace("((b))", "<b>");
            text = text.replace("((/b))", "</b>");
            
            text = text.replace("((u))", "<u>");
            text = text.replace("((/u))", "</u>");

            text = text.replace("((p))", "<p>");
            text = text.replace("((/p))", "</p>");

            text = text.replace("((br))", "</br>");
            text = text.replace("((hr))", "</hr>");

            for (let z = 0; z < 50; z++) {
                text = text.replace("((i"+z+"))", "<i>");
                text = text.replace("((/i"+z+"))", "</i>");
        
                text = text.replace("((b"+z+"))", "<b>");
                text = text.replace("((/b"+z+"))", "</b>");
                
                text = text.replace("((u"+z+"))", "<u>");
                text = text.replace("((/u"+z+"))", "</u>");
        
                text = text.replace("((p"+z+"))", "<p>");
                text = text.replace("((/p"+z+"))", "</p>");

                
                text = text.replace("((sup"+z+"))", "<sup>");
                text = text.replace("((/sup"+z+"))", "</sup>");
        
                text = text.replace("((br"+z+"))", "</br>");
                text = text.replace("((hr"+z+"))", "</hr>");
            }

            $( ".reading-"+i ).first().html( "<span>" + text + "</span>" );
        }

        $( "span" ).on( "click", function() {
            $( this ).toggleClass( "highlight" );
            return false;
        });

        // audio
            $('.audio').on('timeupdate', function() {
                let id = $(this).data("id");
                $('#seekbar-'+id).attr("value", this.currentTime / this.duration);

                localStorage.setItem('audioTime', this.currentTime);
            });

            $(".btnAudio").click(function(){
                id = $(this).data("id");
                $("#audio-"+id)[0].play();
                $(this).hide();

                // localStorage mengatur audio
                audioArray.push(id)
                const arrayString = JSON.stringify(audioArray);
                localStorage.setItem('audioArray', arrayString);
                // localStorage mengatur audio
            })

            document.addEventListener('play', function(e){  
                var audios = document.getElementsByTagName('audio');  
                for(var i = 0, len = audios.length; i < len;i++){  
                    if(audios[i] != e.target){  
                        audios[i].pause();  
                    }  
                }  
            }, true);
        // audio 

        $("textarea").keydown(function(e) {
            if(e.keyCode === 9) { // tab was pressed
                // get caret position/selection
                var start = this.selectionStart;
                    end = this.selectionEnd;

                var $this = $(this);

                // set textarea value to: text before caret + tab + text after caret
                $this.val($this.val().substring(0, start)
                            + "\t"
                            + $this.val().substring(end));

                // put caret at right position again
                this.selectionStart = this.selectionEnd = start + 1;

                // prevent the focus lose
                return false;
            }
        });
    })

    function secpass(id) {
        'use strict';
        var min = Math.floor(sec / 60),
        remSec  = sec % 60;
        if (remSec < 10) {
            remSec = '0' + remSec;
        }
        if (min < 10) {
            min = '0' + min;
        }

        countDiv.innerHTML = min + ":" + remSec;
        if (sec > 0) {
            sec = sec - 1;

            // localStorage store data waktu
            localStorage.setItem('time', sec);
            // localStorage store data waktu
        } else {
            if(id == 'sesi-listening'){
                if (typeof countDown !== 'undefined' && countDown !== null) {
                    clearInterval(countDown);
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Time out',
                    allowOutsideClick: false,
                    target: '#worksheet'
                }).then(function (result) {
                    
                    $(".session").hide();
                    $("#navbarTes").hide();
                    $("#transisi-sesi-2").show();

                    // localStorage menympan data sesi
                    localStorage.setItem('sesi', 'transisi-sesi-2');
                    // localStorage menympan data sesi

                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#elementtoScrollToID").offset().top
                        }, 1000);
                    }
                    
                })
            } else if(id == 'sesi-reading'){
                if (typeof countDown !== 'undefined' && countDown !== null) {
                    clearInterval(countDown);
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Time out',
                    allowOutsideClick: false,
                    target: '#worksheet'
                }).then(function (result) {
                    
                    $(".session").hide();
                    $("#navbarTes").hide();
                    $("#transisi-sesi-3").show();

                    // localStorage menympan data sesi
                    localStorage.setItem('sesi', 'transisi-sesi-3');
                    // localStorage menympan data sesi

                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#elementtoScrollToID").offset().top
                        }, 1000);
                    }
                    
                })
            } else if(id == 'sesi-writing'){
                clearInterval(countDown);

                // scroll to top 
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#elementtoScrollToID").offset().top
                    }, 1000);
                }

                swal.fire({
                    title: 'Time out',
                    html: '<h4>Submit your answer ...</h4>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    target: '#worksheet',
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });

                $(".btnSimpan").html("Saving...");
                $(".btnSimpan").prop("disabled", true);
                $(".btnBack").prop("disabled", true);
                $("#formIelts").submit()
            }
        }
    }

    let countdownInterval;

    function showAlertWithCountdown(seconds) {
        if(start){
            clearInterval(countdownInterval);
            $("#count").html(`<b>10</b>`);
            $("#alertModal").modal('show');
            countdownInterval = setInterval(() => {
                $("#count").html(`<b>${seconds}</b>`);
                seconds--;
    
                if(seconds === 0){
                    clearInterval(countdownInterval);
                    location.reload();
                }
            }, 1000);
        }
    }

    function returnWorkSheet() {
        if(start){
            // $("#alertModal").modal('hide');
            clearInterval(countdownInterval);
        }
    }

    // localStorage function untuk menentukan current time
    function getCurrentTime() {
        let now = new Date();
        let hours = now.getHours() * 60 * 60;
        let minutes = now.getMinutes() * 60;
        let seconds = now.getSeconds();
        return parseInt(hours + minutes + seconds);
    }

    function updateTimeInLocalStorage() {
        let currentTime = getCurrentTime();
        localStorage.setItem('currentTime', currentTime);
    }
    // localStorage function untuk menentukan current time

</script>
<?= $this->endSection() ?>