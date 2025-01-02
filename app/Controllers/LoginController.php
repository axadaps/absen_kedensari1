<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;
use CodeIgniter\HTTP\IncomingRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin/login', ['config' => config('Auth')]);
    }

    public function loginProcess()
    {
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required'
        ])) {
            session()->setFlashdata('error', 'Semua bidang harus diisi.');
            return redirect()->back()->withInput();
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)
                            ->first();        
        if (!$user) {
            session()->setFlashdata('error', 'Pengguna Tidak Ditemukan.');
            return redirect()->back()->withInput();
        }

        if (!Password::verify($password, $user->password_hash)) {
            session()->setFlashdata('error', 'Password salah.');
            return redirect()->back()->withInput();
        }

        session()->set([
            'user_id' => $user->id,
            'username' => $user->username,
            'is_superadmin' => $user->is_superadmin,
            'logged_in' => true
        ]);
   
        return redirect()->to('/admin/dashboard')->with('message', 'Selamat datang, ' . $user->username . '!');
    }
    

}
