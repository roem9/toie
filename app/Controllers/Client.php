<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class Client extends BaseController
{
    public function index()
    {
        $data['sidebar'] = "client";
        $data['title'] = "Client";
        $data['breadcrumbs'] = ["Client"];
        $data['searchButton'] = true;

        return view('pages/client', $data);
    }

    public function getAllClient(){
        $db = db_connect();
        $result = $db->query("SELECT * FROM client WHERE hapus = 0")->getResultArray();

        $data = [];
        foreach ($result as $key => $result) {
            $data[$key] = $result;
            $data[$key]['logo'] = base_url()."public/assets/logo-client/" . $result['logo'];
        }

        return json_encode($data);
    }

    // Get Client
    public function getClient($id)
    {
        $model = new ClientModel();
        $data = $model->where(['hapus' => 0])->find($id);
        return json_encode($data);
    }

    // simpan data client
    public function simpan()
    {
        $validasi  = \Config\Services::validation();
        $logo = $this->request->getFile('logo');
        $toefl_pdf = $this->request->getFile('toefl_pdf');
        $ielts_pdf = $this->request->getFile('ielts_pdf');
        $fs_pdf = $this->request->getFile('fs_pdf');
        $fw_1_pdf = $this->request->getFile('fw_1_pdf');
        $fw_2_pdf = $this->request->getFile('fw_2_pdf');

        if ($logo != null) {
            $aturan = [
                'logo' => 'uploaded[logo]|max_size[logo,1024]|ext_in[logo,png,jpg,jpeg],'
            ];
        }

        if ($toefl_pdf != null) {
            $aturan = [
                'toefl_pdf' => 'uploaded[toefl_pdf]|max_size[toefl_pdf,20480]|ext_in[toefl_pdf,png,jpg,jpeg],'
            ];
        }

        if ($ielts_pdf != null) {
            $aturan = [
                'ielts_pdf' => 'uploaded[ielts_pdf]|max_size[ielts_pdf,20480]|ext_in[ielts_pdf,png,jpg,jpeg],'
            ];
        }

        if ($fs_pdf != null) {
            $aturan = [
                'fs_pdf' => 'uploaded[fs_pdf]|max_size[fs_pdf,20480]|ext_in[fs_pdf,png,jpg,jpeg],'
            ];
        }

        if ($fw_1_pdf != null) {
            $aturan = [
                'fw_1_pdf' => 'uploaded[fw_1_pdf]|max_size[fw_1_pdf,20480]|ext_in[fw_1_pdf,png,jpg,jpeg],'
            ];
        }

        if ($fw_2_pdf != null) {
            $aturan = [
                'fw_2_pdf' => 'uploaded[fw_2_pdf]|max_size[fw_2_pdf,20480]|ext_in[fw_2_pdf,png,jpg,jpeg],'
            ];
        }

        $aturan = [
            'nama_client' => [
                'label' => 'Nama Client',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'url' => [
                'label' => 'URL Client',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat Client',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ];
        
        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $id_client = $this->request->getPost('id_client');
            $nama_client = $this->request->getPost('nama_client');
            $url = $this->request->getPost('url');
            $password = $this->request->getPost('password');
            $alamat = $this->request->getPost('alamat');

            if($password == ""){
                $data = [
                    'nama_client' => $nama_client,
                    'url' => $url,
                    'alamat' => $alamat
                ];
            } else {
                $data = [
                    'nama_client' => $nama_client,
                    'url' => $url,
                    'alamat' => $alamat,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];
            }

            $model = new ClientModel();

            $searchClient = $model->where(['hapus' => 0])->find($id_client);
            if ($searchClient) {
                if ($logo != null) {
                    if ($logo = $this->request->getFile('logo')) {
                        if ($logo->isValid() && !$logo->hasMoved()) {
                            // Get random file name
                            $newName = $logo->getRandomName();

                            // Store file in public/uploads/ folder
                            $logo->move('public/assets/logo-client', $newName);
                            $data['logo'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                } 

                if ($toefl_pdf != null) {
                    if ($toefl_pdf = $this->request->getFile('toefl_pdf')) {
                        if ($toefl_pdf->isValid() && !$toefl_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $toefl_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $toefl_pdf->move('public/assets/pdf/toefl', $newName);
                            $data['toefl_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($ielts_pdf != null) {
                    if ($ielts_pdf = $this->request->getFile('ielts_pdf')) {
                        if ($ielts_pdf->isValid() && !$ielts_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $ielts_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $ielts_pdf->move('public/assets/pdf/ielts', $newName);
                            $data['ielts_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($fs_pdf != null) {
                    if ($fs_pdf = $this->request->getFile('fs_pdf')) {
                        if ($fs_pdf->isValid() && !$fs_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $fs_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $fs_pdf->move('public/assets/pdf/fs', $newName);
                            $data['fs_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($fw_1_pdf != null) {
                    if ($fw_1_pdf = $this->request->getFile('fw_1_pdf')) {
                        if ($fw_1_pdf->isValid() && !$fw_1_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $fw_1_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $fw_1_pdf->move('public/assets/pdf/fw1', $newName);
                            $data['fw_1_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($fw_2_pdf != null) {
                    if ($fw_2_pdf = $this->request->getFile('fw_2_pdf')) {
                        if ($fw_2_pdf->isValid() && !$fw_2_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $fw_2_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $fw_2_pdf->move('public/assets/pdf/fw2', $newName);
                            $data['fw_2_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                $model->update($id_client, $data);
                $hasil['sukses'] = "Berhasil mengubah data";
                $hasil['error'] = true;
                $hasil['edit'] = true;
            } else {
                if ($logo != null) {
                    if ($logo = $this->request->getFile('logo')) {
                        if ($logo->isValid() && !$logo->hasMoved()) {
                            // Get file name and extension
                            $name = $logo->getName();
                            $ext = $logo->getClientExtension();

                            // Get random file name
                            $newName = $logo->getRandomName();

                            // Store file in public/uploads/ folder
                            $logo->move('public/assets/logo-client', $newName);
                            $data['logo'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";

                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($toefl_pdf != null) {
                    if ($toefl_pdf = $this->request->getFile('toefl_pdf')) {
                        if ($toefl_pdf->isValid() && !$toefl_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $toefl_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $toefl_pdf->move('public/assets/pdf/toefl', $newName);
                            $data['toefl_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($ielts_pdf != null) {
                    if ($ielts_pdf = $this->request->getFile('ielts_pdf')) {
                        if ($ielts_pdf->isValid() && !$ielts_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $ielts_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $ielts_pdf->move('public/assets/pdf/ielts', $newName);
                            $data['ielts_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($fs_pdf != null) {
                    if ($fs_pdf = $this->request->getFile('fs_pdf')) {
                        if ($fs_pdf->isValid() && !$fs_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $fs_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $fs_pdf->move('public/assets/pdf/fs', $newName);
                            $data['fs_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($fw_1_pdf != null) {
                    if ($fw_1_pdf = $this->request->getFile('fw_1_pdf')) {
                        if ($fw_1_pdf->isValid() && !$fw_1_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $fw_1_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $fw_1_pdf->move('public/assets/pdf/fw1', $newName);
                            $data['fw_1_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

                if ($fw_2_pdf != null) {
                    if ($fw_2_pdf = $this->request->getFile('fw_2_pdf')) {
                        if ($fw_2_pdf->isValid() && !$fw_2_pdf->hasMoved()) {
                            // Get random file name
                            $newName = $fw_2_pdf->getRandomName();

                            // Store file in public/uploads/ folder
                            $fw_2_pdf->move('public/assets/pdf/fw2', $newName);
                            $data['fw_2_pdf'] = $newName;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                            
                            return json_encode($hasil);
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";

                        return json_encode($hasil);
                    }
                }

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

    public function hapusClient($id_client)
    {
        $model = new ClientModel();
        $model->update($id_client, ["hapus" => 1]);
    }
}
