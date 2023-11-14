<?php

namespace App\Controllers;

use App\Models\M_Siswa;
use CodeIgniter\Controller;

class Siswa extends BaseController
{
    protected $model; // Deklarasikan properti $model

    public function __construct()
    {
        $this->model = new M_Siswa();
        helper('sn');

        $this->session = service('session');
        $this->auth   = service('authentication');
    }

    public function index()
    
    {
        session()->setFlashdata('success', "Siswa Berhasil ditambah!");
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? '/login';
            unset($_SESSION['redirect_url']);

            return redirect()
                ->to($redirectURL);
        }

        $data = [
            'judul' => 'Data Siswa',
            'siswa' => $this->model->getAllData()
        ];
        //load view
        tampilan('siswa/index', $data);
    }

    public function tambah()

    {
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'nisn' => [
                    'label' => 'Nomor induk siswa Nasional',
                    'rules' => 'required|numeric|max_length[10]|is_unique[siswa.nisn]'
                ],
                'nama' => [
                    'label' => 'Nama Siswa',
                    'rules' => 'required'
                ]
            ]);

            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('siswa'));
            } else {
                $data = [
                    'nisn' => $this->request->getPost('nisn'),
                    'nama' => $this->request->getPost('nama')
                ];

                $success = $this->model->tambah($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('siswa'));
                }
            }
        } else {
            return redirect()->to(base_url('siswa'));
        }
    }

    public function ubah()
    {
            $val = $this->validate([
                'nisn' => [
                    'label' => 'Nomor induk siswa Nasional',
                    'rules' => 'required'
                ],
                'nama' => [
                    'label' => 'Nama Siswa',
                    'rules' => 'required'
                ]
            ]);
    
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('siswa'));
            } else {
                $id = $this->request->getPost('id');
                $data = [
                    'nisn' => $this->request->getPost('nisn'),
                    'nama' => $this->request->getPost('nama')
                ];
    
                $success = $this->model->ubah($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' DiUbah');
                    return redirect()->to(base_url('siswa'));
                }
            }
        
    }
    
    
    public function edit($id)
    {
        $data = [
            'judul' => 'Edit Data Siswa',
            'siswa' => $this->model->getDataById($id)
        ];

        tampilan('siswa/edit', $data);
    }

    public function update()
    {
        if ($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('id');
            
            $val = $this->validate([
                'nisn' => [
                    'label' => 'Nomor induk siswa Nasional',
                    'rules' => "required|numeric|max_length[10]|is_unique[siswa.nisn,id,$id]",
                ],
                'nama' => [
                    'label' => 'Nama Siswa',
                    'rules' => 'required',
                ],
            ]);

            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url("siswa/edit/$id"));
            }

            $data = [
                'nisn' => $this->request->getPost('nisn'),
                'nama' => $this->request->getPost('nama'),
            ];

            $success = $this->model->updateData($id, $data);

            if ($success) {
                session()->setFlashdata('message', ' Diubah');
            } else {
                session()->setFlashdata('err', ' Gagal Diubah');
            }

            return redirect()->to(base_url('siswa'));
        }
    }

    function hapus($id)
    {
        session()->setFlashdata('success', "Siswa Berhasil Dihapus!");
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', ' DiHapus');
            return redirect()->to(base_url('siswa'));
        }
    }
}
