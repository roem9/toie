<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use App\Models\TesModel;
use App\Models\PesertaIeltsModel;

class Tes extends BaseController
{
    public function index()
    {
        $data['sidebar'] = "tes";
        $data['title'] = "Tes IELTS";
        $data['breadcrumbs'] = ["Tes"];
        $data['searchButton'] = false;

        return view('pages/tes', $data);
    }

    public function hasil($id_tes)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM tes as a JOIN client as b ON a.fk_id_client = b.id_client WHERE md5(id_tes) = '$id_tes'")->getRowArray();

        $data['sidebar'] = "tes";
        $data['title'] = "Hasil Tes";
        $data['breadcrumbs'] = ["<a class='opacity-5 text-dark' href='".base_url()."/tes'>Tes</a>", $data['nama_tes']];
        $data['searchButton'] = false;

        return view('pages/hasilTes', $data);
    }

    public function getAllTes(){
        $db = db_connect();
        $builder = $db->table('tes')
            ->where(["tes.hapus" => 0, "client.hapus" => 0])
            ->select('id_tes, nama_tes, nama_client, DATE_FORMAT(tgl_tes, "%d-%M-%Y") as tgl_tes, tipe_tes, tipe_soal, kuota, status, url, MD5(id_tes) as tes, tes.password, (SELECT COUNT(id) FROM peserta_ielts WHERE id_tes = tes.id_tes) as peserta')
            ->join('client', 'tes.fk_id_client = client.id_client');

        return DataTable::of($builder)->toJson(true);
    }

    public function getHasilTesIelts($id_tes){
        $db = db_connect();
        $builder = $db->table('peserta_ielts')->where(["peserta_ielts.id_tes" => $id_tes])->select('id, first_name, last_name, email, nilai_speaking, nilai_listening, nilai_reading, nilai_writing, tipe_tes, md5(id) as id_peserta, nilai_ta_1,nilai_cc_1, nilai_gra_1, nilai_lr_1, nilai_ta_2, nilai_cc_2, nilai_gra_2, nilai_lr_2, nilai_topic, nilai_fluency, nilai_grammar, nilai_vocabulary')->join('tes', 'peserta_ielts.id_tes = tes.id_tes');

        return DataTable::of($builder)->toJson(true);
    }

    // Get Peserta Tes
    public function getPeserta($id_peserta)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes WHERE md5(id) = '$id_peserta'")->getRowArray();
        return json_encode($data);
    }

    public function simpanPesertaIelts()
    {
        $validasi  = \Config\Services::validation();
        $aturan = [
            'first_name' => [
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'last_name' => [
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            't4_lahir' => [
                'label' => 'Tempat Lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'tgl_lahir' => [
                'label' => 'Tgl Lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');
            $first_name = $this->request->getPost('first_name');
            $last_name = $this->request->getPost('last_name');
            $t4_lahir = $this->request->getPost('t4_lahir');
            $tgl_lahir = $this->request->getPost('tgl_lahir');
            $email = $this->request->getPost('email');
            $link_speaking = $this->request->getPost('link_speaking');

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                't4_lahir' => $t4_lahir,
                'tgl_lahir' => $tgl_lahir,
                'email' => $email,
                'link_speaking' => $link_speaking,
            ];

            $model = new PesertaIeltsModel();

            $searchPeserta = $model->find($id);
            if ($searchPeserta) {
                $model->update($id, $data);
                $hasil['sukses'] = "Berhasil mengubah data";
                $hasil['error'] = true;
                $hasil['edit'] = true;
            }
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }

    public function simpanFeedbackWriting()
    {
        $validasi  = \Config\Services::validation();
        $aturan = [
            'kriteria_ta' => [
                'label' => 'Evaluation TA (Task Achievement)',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nilai_ta' => [
                'label' => 'Score TA (Task Achievement)',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'kriteria_cc' => [
                'label' => 'Evaluation CC (Coherence and Cohesion)',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nilai_cc' => [
                'label' => 'Score CC (Coherence and Cohesion)',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'kriteria_gra' => [
                'label' => 'Evaluation GRA (Grammar)',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nilai_gra' => [
                'label' => 'Score GRA (Grammar)',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'kriteria_lr' => [
                'label' => 'Evaluation LR (Lexical Resource)',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nilai_lr' => [
                'label' => 'Score LR (Lexical Resource)',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');
            $task = $this->request->getPost('task');
            $kriteria_ta = $this->request->getPost('kriteria_ta');
            $nilai_ta = $this->request->getPost('nilai_ta');
            $kriteria_cc = $this->request->getPost('kriteria_cc');
            $nilai_cc = $this->request->getPost('nilai_cc');
            $kriteria_gra = $this->request->getPost('kriteria_gra');
            $nilai_gra = $this->request->getPost('nilai_gra');
            $kriteria_lr = $this->request->getPost('kriteria_lr');
            $nilai_lr = $this->request->getPost('nilai_lr');
            
            if($task == 1){
                $data = [
                    'kriteria_ta_1' => $kriteria_ta,
                    'nilai_ta_1' => $nilai_ta,
                    'kriteria_cc_1' => $kriteria_cc,
                    'nilai_cc_1' => $nilai_cc,
                    'kriteria_gra_1' => $kriteria_gra,
                    'nilai_gra_1' => $nilai_gra,
                    'kriteria_lr_1' => $kriteria_lr,
                    'nilai_lr_1' => $nilai_lr
                ];
            } else if($task == 2){
                $data = [
                    'kriteria_ta_2' => $kriteria_ta,
                    'nilai_ta_2' => $nilai_ta,
                    'kriteria_cc_2' => $kriteria_cc,
                    'nilai_cc_2' => $nilai_cc,
                    'kriteria_gra_2' => $kriteria_gra,
                    'nilai_gra_2' => $nilai_gra,
                    'kriteria_lr_2' => $kriteria_lr,
                    'nilai_lr_2' => $nilai_lr
                ];
            }

            $model = new PesertaIeltsModel();

            $searchPeserta = $model->find($id);
            if ($searchPeserta) {
                $model->update($id, $data);
                $hasil['sukses'] = "Berhasil mengubah data";
                $hasil['error'] = true;
                $hasil['edit'] = true;
            }
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }

    public function simpanFeedbackSpeaking()
    {
        $validasi  = \Config\Services::validation();
        $aturan = [
            'kriteria_topic' => [
                'label' => 'Evaluation Topic',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nilai_topic' => [
                'label' => 'Score Topic',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'kriteria_fluency' => [
                'label' => 'Evaluation Fluency',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nilai_fluency' => [
                'label' => 'Score Fluency',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'kriteria_grammar' => [
                'label' => 'Evaluation Grammar',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nilai_grammar' => [
                'label' => 'Score Grammar',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'kriteria_vocabulary' => [
                'label' => 'Evaluation Vocabulary',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nilai_vocabulary' => [
                'label' => 'Score Vocabulary',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');
            $kriteria_topic = $this->request->getPost('kriteria_topic');
            $nilai_topic = $this->request->getPost('nilai_topic');
            $kriteria_fluency = $this->request->getPost('kriteria_fluency');
            $nilai_fluency = $this->request->getPost('nilai_fluency');
            $kriteria_grammar = $this->request->getPost('kriteria_grammar');
            $nilai_grammar = $this->request->getPost('nilai_grammar');
            $kriteria_vocabulary = $this->request->getPost('kriteria_vocabulary');
            $nilai_vocabulary = $this->request->getPost('nilai_vocabulary');
            
            $data = [
                'kriteria_topic' => $kriteria_topic,
                'nilai_topic' => $nilai_topic,
                'kriteria_fluency' => $kriteria_fluency,
                'nilai_fluency' => $nilai_fluency,
                'kriteria_grammar' => $kriteria_grammar,
                'nilai_grammar' => $nilai_grammar,
                'kriteria_vocabulary' => $kriteria_vocabulary,
                'nilai_vocabulary' => $nilai_vocabulary
            ];

            $model = new PesertaIeltsModel();

            $searchPeserta = $model->find($id);
            if ($searchPeserta) {
                $model->update($id, $data);
                $hasil['sukses'] = "Berhasil mengubah data";
                $hasil['error'] = true;
                $hasil['edit'] = true;
            }
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }

    // Get Tes
    public function getTes($id)
    {
        $model = new TesModel();
        $data = $model->where(['hapus' => 0])->find($id);
        return json_encode($data);
    }

    public function simpan()
    {
        $validasi  = \Config\Services::validation();
        $aturan = [
            'id_client' => [
                'label' => 'Client',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'tgl_tes' => [
                'label' => 'Tanggal Tes',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'nama_tes' => [
                'label' => 'Nama Tes',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'tipe_tes' => [
                'label' => 'Tipe Tes',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'tipe_soal' => [
                'label' => 'Tipe Soal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'kuota' => [
                'label' => 'Kuota',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'catatan' => [
                'label' => 'Catatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'message' => [
                'label' => 'Pesan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $id_tes = $this->request->getPost('id_tes');
            $id_client = $this->request->getPost('id_client');
            $tgl_tes = $this->request->getPost('tgl_tes');
            $nama_tes = $this->request->getPost('nama_tes');
            $tipe_tes = $this->request->getPost('tipe_tes');
            $tipe_soal = $this->request->getPost('tipe_soal');
            $catatan = $this->request->getPost('catatan');
            $kuota = $this->request->getPost('kuota');
            $password = $this->request->getPost('password');
            $message = $this->request->getPost('message');

            $data = [
                'fk_id_client' => $id_client,
                'tgl_tes' => $tgl_tes,
                'nama_tes' => $nama_tes,
                'tipe_tes' => $tipe_tes,
                'tipe_soal' => $tipe_soal,
                'catatan' => $catatan,
                'kuota' => $kuota,
                'password' => $password,
                'message' => $message
            ];

            $model = new TesModel();

            $searchTes = $model->where(['hapus' => 0])->find($id_tes);
            if ($searchTes) {
                $model->update($id_tes, $data);
                $hasil['sukses'] = "Berhasil mengubah data";
                $hasil['error'] = true;
                $hasil['edit'] = true;
            } else {
                $model->save($data);
                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['error'] = true;
                $hasil['edit'] = false;
            }
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }

    // edit status tes
    public function editStatusTes()
    {
        $id_tes = $this->request->getPost('id_tes');
        $status = $this->request->getPost('status');
        $model = new TesModel();
        $model->update($id_tes, ['status' => $status]);
    }

    // hapus tes 
    public function hapusTes($id)
    {
        $model = new TesModel();
        $model->update($id, ["hapus" => 1]);
    }

    public function soalTes($url, $id_tes){
        // var_dump($url, $id_tes);
        $db = db_connect();
        $peserta = COUNT($db->query("SELECT id FROM peserta_ielts WHERE md5(id_tes) = '$id_tes'")->getResultArray());
        $data = $db->query("SELECT id_tes, logo, nama_tes, tipe_soal, kuota, `status` FROM tes as a JOIN client as b ON a.fk_id_client = b.id_client WHERE md5(id_tes) = '$id_tes' AND `url` = '$url' AND a.status = 1")->getRowArray();

        if(is_null($data)){
            
            $data = [
                'title' => '404 Not Found',
                'logo' => ''
            ];

            return view('pages/404', $data);
        } else {
            if($peserta < $data['kuota']){
                $data['full_kuota'] = false;
            } else {
                $data['full_kuota'] = true;
            }
    
            $data['title'] = $data['nama_tes'];
            $data['logo'] = base_url().'/public/assets/logo-client/'.$data['logo'];
            
            if($data['tipe_soal'] == "Soal_002"){
                return view('pages/soal/soal-ielts-002', $data);
            } else if($data['tipe_soal'] == "Soal_GT_002"){
                return view('pages/soal/soal-ielts-gt-002', $data);
            } else if($data['tipe_soal'] == "Soal_GT_003"){
                return view('pages/soal/soal-ielts-gt-003', $data);
            } else if($data['tipe_soal'] == "Soal_003"){
                return view('pages/soal/soal-ielts-003', $data);
            } else if($data['tipe_soal'] == "Soal_Academic_Post_Test"){
                return view('pages/soal/soal-ielts-academic-post-test', $data);
            } else if($data['tipe_soal'] == "Soal_Academic_Pretest"){
                return view('pages/soal/soal-ielts-academic-pretest', $data);
            } else if($data['tipe_soal'] == "Soal_General_Post_Test"){
                return view('pages/soal/soal-ielts-general-post-test', $data);
            } else if($data['tipe_soal'] == "Soal_General_Pretest"){
                return view('pages/soal/soal-ielts-general-pretest', $data);
            }
        }
    }
}
