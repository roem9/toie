<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use App\Models\TesToeflModel;
use App\Models\PesertaToeflModel;

class TesToefl extends BaseController
{
    public function index()
    {
        $data['sidebar'] = "testoefl";
        $data['title'] = "Tes TOEFL";
        $data['breadcrumbs'] = ["Tes"];
        $data['searchButton'] = false;

        return view('pages/tes-toefl', $data);
    }

    public function getAllTes(){
        $db = db_connect();
        $builder = $db->table('tes_toefl')
            ->where(["tes_toefl.hapus" => 0, "client.hapus" => 0])
            // ->select('id_tes, nama_tes, nama_client, DATE_FORMAT(tgl_tes, "%d-%M-%Y") as tgl_tes, nama_soal, kuota, status, url, MD5(id_tes) as tes, tes_toefl.password, (SELECT COUNT(id) FROM peserta_toefl WHERE id_tes = tes_toefl.id_tes) as peserta')
            ->select('id_tes, nama_tes, nama_client, tgl_tes, nama_soal, kuota, status, url, MD5(id_tes) as tes, tes_toefl.password, (SELECT COUNT(id) FROM peserta_toefl WHERE id_tes = tes_toefl.id_tes) as peserta')
            ->join('client', 'tes_toefl.fk_id_client = client.id_client')
            ->join('soal', 'tes_toefl.id_soal = soal.id_soal');

        return DataTable::of($builder)->toJson(true);
    }

    // Get Tes
    public function getTes($id)
    {
        $model = new TesToeflModel();
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
            'id_soal' => [
                'label' => 'Soal',
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
            $id_soal = $this->request->getPost('id_soal');
            $catatan = $this->request->getPost('catatan');
            $kuota = $this->request->getPost('kuota');
            $password = $this->request->getPost('password');
            $message = $this->request->getPost('message');

            $data = [
                'fk_id_client' => $id_client,
                'tgl_tes' => $tgl_tes,
                'nama_tes' => $nama_tes,
                'id_soal' => $id_soal,
                'catatan' => $catatan,
                'kuota' => $kuota,
                'password' => $password,
                'message' => $message
            ];

            $model = new TesToeflModel();

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
        $model = new TesToeflModel();
        $model->update($id_tes, ['status' => $status]);
    }

    // hapus tes 
    public function hapusTes($id)
    {
        $model = new TesToeflModel();
        $model->update($id, ["hapus" => 1]);
    }

    public function soalTes($url, $id_tes){
        // var_dump($url, $id_tes);
        $db = db_connect();
        $peserta = COUNT($db->query("SELECT id FROM peserta_toefl WHERE md5(id_tes) = '$id_tes'")->getResultArray());
        $tes = $db->query("SELECT id_tes, logo, nama_tes, id_soal, kuota, `status` FROM tes_toefl as a JOIN client as b ON a.fk_id_client = b.id_client WHERE md5(id_tes) = '$id_tes' AND `url` = '$url' AND a.status = 1")->getRowArray();

        if(is_null($tes)){
            
            $data = [
                'title' => '404 Not Found',
                'logo' => ''
            ];

            return view('pages/404', $data);
        } else {
            if($peserta < $tes['kuota']){
                $data['full_kuota'] = false;
            } else {
                $data['full_kuota'] = true;
            }
    
            $data['title'] = $tes['nama_tes'];
            $data['logo'] = base_url().'/public/assets/logo-client/'.$tes['logo'];
            
            // soal toefl 
            // $data['id'] = $id_tes;
            $data['id'] = $tes['id_tes'];

            $soal = $db->query("SELECT * FROM soal WHERE id_soal = $tes[id_soal]")->getRowArray();
            $sesi = $db->query("SELECT * FROM sesi_soal WHERE id_soal = $tes[id_soal]")->getResultArray();

            $data['form'] = "
                <div class=\"form-floating mb-3\">
                    <input type=\"text\" name=\"email\" class=\"form form-control required\">
                    <label for=\"email\">Email</label>
                </div>
                <div class=\"form-floating mb-3\">
                    <input type=\"text\" name=\"nama\" class=\"form form-control required\">
                    <label for=\"nama\">Full Name</label>
                </div>
                <div class=\"form-floating mb-3\">
                    <select name=\"jk\" class=\"form form-control required\">
                        <option value=\"\">Choose Gender</option>
                        <option value=\"Male\">Male</option>
                        <option value=\"Female\">Female</option>
                    </select>
                    <label for=\"jk\">Gender</label>
                </div>
                <div class=\"form-floating mb-3\">
                    <input type=\"text\" name=\"no_wa\" class=\"form form-control required number\">
                    <label for=\"no_wa\">Whatsapp Number</label>
                </div>
                <div class=\"form-floating mb-3\">
                    <input type=\"text\" name=\"t4_lahir\" class=\"form form-control required\">
                    <label for=\"t4_lahir\">Place Of Birth</label>
                </div>
                <div class=\"form-floating mb-3\">
                    <input type=\"date\" name=\"tgl_lahir\" class=\"form form-control required\">
                    <label for=\"tgl_lahir\">Date Of Birth</label>
                </div>
                <div class=\"form-floating mb-3\">
                    <textarea name=\"alamat\" class=\"form form-control required\"></textarea>
                    <label for=\"alamat\">Address</label>
                </div>
            ";

            $data['tes'] = $tes;
            $data['soal'] = $soal;
            foreach ($sesi as $i => $sesi) {
                // $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub']], 'urutan');
                $sub_soal = $db->query("SELECT * FROM item_soal WHERE id_sub = $sesi[id_sub] ORDER BY urutan")->getResultArray();
                $data['sesi'][$i] = [];
                $number = 1;
                foreach ($sub_soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        // from json to array 
                        // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                        $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                        // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                        $txt_soal = json_decode($string, true );
                        
                        $no = $number.". ";
                        $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);

                        $data['sesi'][$i]['soal'][$j]['id_item'] = $soal['id_item'];
                        $data['sesi'][$i]['soal'][$j]['item'] = $soal['item'];
                        $data['sesi'][$i]['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                        $data['sesi'][$i]['soal'][$j]['data']['pilihan'] = $txt_soal['pilihan'];
                        $data['sesi'][$i]['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                        $data['sesi'][$i]['soal'][$j]['id_text'] = $soal['id_text'];
                        $data['sesi'][$i]['soal'][$j]['tampil'] = $soal['tampil'];
                        
                        $number++;

                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio"){
                        $data['sesi'][$i]['soal'][$j] = $soal;
                    }

                    // $data['sesi'][$i]['jumlah_soal'] = COUNT($this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub'], "item" => "soal"]));
                    $data['sesi'][$i]['jumlah_soal'] = COUNT($db->query("SELECT * FROM item_soal WHERE id_sub = $sesi[id_sub] AND item = 'soal'")->getResultArray());
                    $data['sesi'][$i]['id_sub'] = $sesi['id_sub'];
                }
            }

            $data['reload_page'] = $db->query("
                SELECT
                    *
                FROM config
                WHERE field = 'reload_page'
            ")->getRowArray();

            $data['time_reload'] = $db->query("
                SELECT
                    *
                FROM config
                WHERE field = 'time_reload'
            ")->getRowArray();

            return view('pages/soal/soal-toefl', $data);
        }
    }

    public function hasil($id_tes)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM tes_toefl as a JOIN client as b ON a.fk_id_client = b.id_client WHERE md5(id_tes) = '$id_tes'")->getRowArray();

        $data['sidebar'] = "testoefl";
        $data['title'] = "Hasil Tes";
        $data['breadcrumbs'] = ["<a class='opacity-5 text-dark' href='".base_url()."/testoefl'>Tes TOEFL</a>", $data['nama_tes']];
        $data['searchButton'] = false;

        return view('pages/hasilTes-toefl', $data);
    }

    public function getHasilTesToefl($id_tes){
        $db = db_connect();
        $builder = $db->table('peserta_toefl')->where(["peserta_toefl.id_tes" => $id_tes])->select('id, nama, email, nilai_listening, nilai_reading, nilai_structure, md5(id) as id_peserta')->join('tes_toefl', 'peserta_toefl.id_tes = tes_toefl.id_tes');

        // return DataTable::of($builder)->toJson(true);
        return DataTable::of($builder)
        ->add('skor', function($row){
            return skor($row->nilai_listening, $row->nilai_structure, $row->nilai_reading);
        }, 'last')
        ->toJson(true);
    }

    public function getPeserta($id_peserta)
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM peserta_toefl as a JOIN tes_toefl as b ON a.id_tes = b.id_tes WHERE md5(id) = '$id_peserta'")->getRowArray();
        return json_encode($data);
    }

    public function simpanPesertaToefl()
    {
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
}
