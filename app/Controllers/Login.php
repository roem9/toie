<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Login extends BaseController
{
    public function index()
    {
        $session = session();
        $session->destroy();
        $data['title'] = 'Login';
        return view('pages/sign-in', $data);
    }

    public function auth()
    {
        $session = session();
        $model = new AdminModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $data = $model->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'username'       => $data['username'],
                    'id_admin'       => $data['id_admin'],
                    'logged_in'      => TRUE,
                    'level'          => 'admin'
                ];
                $session->set($ses_data);

                return redirect()->to(base_url('/client'));
            } else {
                $session->setFlashdata('msg', 'Password salah');
                return redirect()->to(base_url('/login'));
            }
        } else {
            $session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
