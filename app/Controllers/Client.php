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

        if ($logo != null) {
            // menentukan aturan jika form logo terisi
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
                ],
                'logo' => 'uploaded[logo]|max_size[logo,1024]|ext_in[logo,png,jpg,jpeg],'
            ];
        } else {
            // menentukan aturan jika form logo tidak terisi
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
        }
        
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

                            $model->update($id_client, $data);
                            $hasil['sukses'] = "Berhasil mengubah data";
                            $hasil['error'] = true;
                            $hasil['edit'] = true;
                            $hasil['logo'] = $data['logo'];
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";
                    }
                } else {
                    $model->update($id_client, $data);
                    $hasil['sukses'] = "Berhasil mengubah data";
                    $hasil['error'] = true;
                    $hasil['edit'] = true;
                    $hasil['logo'] = $searchClient['logo'];
                }
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

                            $model->save($data);
                            $hasil['sukses'] = "Berhasil memasukkan data";
                            $hasil['error'] = true;
                            $hasil['edit'] = false;
                        } else {
                            // Response
                            $hasil['sukses'] = false;
                            $hasil['error'] = "Gagal mengupload file";
                        }
                    } else {
                        // Response
                        $hasil['sukses'] = false;
                        $hasil['error'] = "Gagal mengupload file";
                    }
                } else {
                    $model->save($data);
                    $hasil['sukses'] = "Berhasil memasukkan data";
                    $hasil['error'] = true;
                    $hasil['edit'] = false;
                }
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
