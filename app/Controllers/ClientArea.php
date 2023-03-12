<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use \Hermawan\DataTables\DataTable;
use App\Models\TesModel;
use App\Models\PesertaIeltsModel;
use App\Models\PesertaToeflModel;

class ClientArea extends BaseController
{
    public function index()
    {
        $session = session();
        $session->destroy();
        $data['title'] = 'Login';
        return view('client-page/sign-in', $data);
    }

    public function auth()
    {
        $session = session();
        $model = new ClientModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $data = $model->where(['url' => $username, 'hapus' => 0])->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'username'       => $data['url'],
                    'id_client'       => $data['id_client'],
                    'logged_in'      => TRUE,
                    'level'          => 'client'
                ];
                $session->set($ses_data);

                return redirect()->to(base_url('/clientarea/tes'));
            } else {
                $session->setFlashdata('msg', 'Password salah');
                return redirect()->to(base_url('/clientarea'));
            }
        } else {
            $session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to(base_url('/clientarea'));
        }
    }

    // ielts 
    public function tes()
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $data = $db->query("SELECT * FROM client WHERE id_client = $id_client")->getRowArray();

        $data['sidebar'] = "tes";
        $data['title'] = "Tes IELTS";
        $data['breadcrumbs'] = ["Tes"];
        $data['searchButton'] = false;

        return view('client-page/tes', $data);
    }

    // toefl 
    public function testoefl()
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $data = $db->query("SELECT * FROM client WHERE id_client = $id_client")->getRowArray();

        $data['sidebar'] = "testoefl";
        $data['title'] = "Tes TOEFL";
        $data['breadcrumbs'] = ["Tes"];
        $data['searchButton'] = false;

        return view('client-page/tes-toefl', $data);
    }

    // ielts 
    public function getAllTes()
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $builder = $db->table('tes')
            ->where(["tes.hapus" => 0, "client.id_client" => $id_client])
            ->select('id_tes, nama_tes, nama_client, DATE_FORMAT(tgl_tes, "%d-%M-%Y") as tgl_tes, tipe_tes, tipe_soal, kuota, status, url, MD5(id_tes) as tes, tes.password, (SELECT COUNT(id) FROM peserta_ielts WHERE id_tes = tes.id_tes) as peserta')
            ->join('client', 'tes.fk_id_client = client.id_client');

        return DataTable::of($builder)->toJson(true);
    }

    // toefl 
    public function getAllTesToefl()
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $builder = $db->table('tes_toefl')
            ->where(["tes_toefl.hapus" => 0, "client.id_client" => $id_client])
            ->select('id_tes, nama_tes, nama_client, DATE_FORMAT(tgl_tes, "%d-%M-%Y") as tgl_tes, kuota, status, url, MD5(id_tes) as tes, tes_toefl.password, (SELECT COUNT(id) FROM peserta_toefl WHERE id_tes = tes_toefl.id_tes) as peserta')
            ->join('client', 'tes_toefl.fk_id_client = client.id_client');

        return DataTable::of($builder)->toJson(true);
    }

    // ielts 
    public function hasil($id_tes)
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $data = $db->query("SELECT * FROM tes as a JOIN client as b ON a.fk_id_client = b.id_client WHERE md5(id_tes) = '$id_tes' AND id_client = $id_client")->getRowArray();

        $data['sidebar'] = "tes";
        $data['title'] = "Hasil Tes";
        $data['breadcrumbs'] = ["<a class='opacity-5 text-dark' href='".base_url()."clientarea/tes'>Tes</a>", $data['nama_tes']];
        $data['searchButton'] = false;

        return view('client-page/hasilTes', $data);
    }

    // toefl 
    public function hasiltoefl($id_tes)
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $data = $db->query("SELECT * FROM tes_toefl as a JOIN client as b ON a.fk_id_client = b.id_client WHERE md5(id_tes) = '$id_tes' AND id_client = $id_client")->getRowArray();

        $data['sidebar'] = "tes";
        $data['title'] = "Hasil Tes";
        $data['breadcrumbs'] = ["<a class='opacity-5 text-dark' href='".base_url()."clientarea/testoefl'>Tes TOEFL</a>", $data['nama_tes']];
        $data['searchButton'] = false;

        return view('client-page/hasilTes-toefl', $data);
    }

    // ielts 
    public function getHasilTesIelts($id_tes)
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $builder = $db->table('peserta_ielts')->where(["peserta_ielts.id_tes" => $id_tes, "fk_id_client" => $id_client])->select('id, first_name, last_name, email, nilai_speaking, nilai_listening, nilai_reading, nilai_writing, tipe_tes, md5(id) as id_peserta, nilai_ta_1,nilai_cc_1, nilai_gra_1, nilai_lr_1, nilai_ta_2, nilai_cc_2, nilai_gra_2, nilai_lr_2, nilai_topic, nilai_fluency, nilai_grammar, nilai_vocabulary')->join('tes', 'peserta_ielts.id_tes = tes.id_tes');

        return DataTable::of($builder)->toJson(true);
    }

    // toefl 
    public function getHasilTesToefl($id_tes)
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $builder = $db->table('peserta_toefl')->where(["peserta_toefl.id_tes" => $id_tes, "fk_id_client" => $id_client])->select('id, nama, email, nilai_listening, nilai_reading, nilai_structure, md5(id) as id_peserta')->join('tes_toefl', 'peserta_toefl.id_tes = tes_toefl.id_tes');

        return DataTable::of($builder)
        ->add('skor', function($row){
            return skor($row->nilai_listening, $row->nilai_structure, $row->nilai_reading);
        }, 'last')
        ->toJson(true);
    }

    // ielts 
    public function getPeserta($id_peserta)
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes WHERE md5(id) = '$id_peserta' AND fk_id_client = $id_client")->getRowArray();
        return json_encode($data);
    }

    // toefl 
    public function getPesertaToefl($id_peserta)
    {
        $session = session();
        $id_client = $session->get('id_client');

        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_toefl as a JOIN tes_toefl as b ON a.id_tes = b.id_tes WHERE md5(id) = '$id_peserta' AND fk_id_client = $id_client")->getRowArray();
        return json_encode($data);
    }

    // ielts 
    public function simpanPesertaIelts()
    {
        $session = session();
        $id_client = $session->get('id_client');
        
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
            // $searchPeserta = $model->find($id);

            $db = db_connect();
            $searchPeserta = $db->query("SELECT * FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes WHERE b.fk_id_client = $id_client")->getRow();

            if ($searchPeserta) {
                $model->update($id, $data);
                $hasil['sukses'] = "Berhasil mengubah data";
                $hasil['error'] = true;
                $hasil['edit'] = true;
            } else {
                $hasil['sukses'] = false;
                $hasil['error'] = 'Anda tidak memiliki akses untuk mengubah data ini';
            }
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }

    // toefl 
    public function simpanPesertaToefl()
    {
        $session = session();
        $id_client = $session->get('id_client');

        $validasi  = \Config\Services::validation();
        $aturan = [
            'nama' => [
                'label' => 'Nama',
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
            ],
            'jk' => [
                'label' => 'Gender',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'no_wa' => [
                'label' => 'No. WA',
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
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $jk = $this->request->getPost('jk');
            $no_wa = $this->request->getPost('no_wa');
            $t4_lahir = $this->request->getPost('t4_lahir');
            $tgl_lahir = $this->request->getPost('tgl_lahir');
            $alamat = $this->request->getPost('alamat');

            $data = [
                'nama' => $nama,
                'email' => $email,
                'jk' => $jk,
                'no_wa' => $no_wa,
                't4_lahir' => $t4_lahir,
                'tgl_lahir' => $tgl_lahir,
                'alamat' => $alamat
            ];

            $model = new PesertaToeflModel();
            // $searchPeserta = $model->find($id);
            $db = db_connect();
            $searchPeserta = $db->query("SELECT * FROM peserta_toefl as a JOIN tes_toefl as b ON a.id_tes = b.id_tes WHERE b.fk_id_client = $id_client")->getRow();

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
        $session = session();
        $id_client = $session->get('id_client');

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
            // $searchPeserta = $model->find($id);
            $db = db_connect();
            $searchPeserta = $db->query("SELECT * FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes WHERE b.fk_id_client = $id_client")->getRow();

            if ($searchPeserta) {
                $model->update($id, $data);
                $hasil['sukses'] = "Berhasil mengubah data";
                $hasil['error'] = true;
                $hasil['edit'] = true;
            } else {
                $hasil['sukses'] = false;
                $hasil['error'] = 'Anda tidak memiliki akses untuk mengubah data ini';
            }
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }

    public function simpanFeedbackSpeaking()
    {
        $session = session();
        $id_client = $session->get('id_client');

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
            // $searchPeserta = $model->find($id);
            $db = db_connect();
            $searchPeserta = $db->query("SELECT * FROM peserta_ielts as a JOIN tes as b ON a.id_tes = b.id_tes WHERE b.fk_id_client = $id_client")->getRow();
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
}
