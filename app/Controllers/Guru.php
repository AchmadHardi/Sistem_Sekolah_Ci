<?php

namespace App\Controllers;

use App\Models\M_Guru;
use CodeIgniter\Controller;

class Guru extends BaseController
{
    protected $model; // Deklarasikan properti $model

    public function __construct()
    {
        $this->model = new M_Guru();
        helper('sn');
    }

    public function index()
    
    {
        $data = [
            'judul' => 'Data Guru',
            'guru' => $this->model->getAllData()
        ];
        //load view
        tampilan('guru/index', $data);
    }

    public function tambah()

    {
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'nip' => [
                    'label' => 'Nomor induk Guru Nasional',
                    'rules' => 'required|numeric|max_length[10]|is_unique[guru.nip]'
                ],
                'nama' => [
                    'label' => 'Nama Guru',
                    'rules' => 'required'
                ]
            ]);

            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('siswa'));
            } else {
                $data = [
                    'nip' => $this->request->getPost('nip'),
                    'nama' => $this->request->getPost('nama')
                ];

                $success = $this->model->tambah($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('guru'));
                }
            }
        } else {
            return redirect()->to(base_url('guru'));
        }
    }

    public function ubah()
    {
            $val = $this->validate([
                'nip' => [
                    'label' => 'Nomor induk Guru Nasional',
                    'rules' => 'required'
                ],
                'nama' => [
                    'label' => 'Nama Guru',
                    'rules' => 'required'
                ]
            ]);
    
            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('guru'));
            } else {
                $id = $this->request->getPost('id');
                $data = [
                    'nip' => $this->request->getPost('nip'),
                    'nama' => $this->request->getPost('nama')
                ];
    
                $success = $this->model->ubah($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' DiUbah');
                    return redirect()->to(base_url('guru'));
                }
            }
        
    }
    
    
    public function edit($id)
    {
        $data = [
            'judul' => 'Edit Data Guru',
            'guru' => $this->model->getDataById($id)
        ];

        tampilan('guru/edit', $data);
    }

    public function update()
    {
        if ($this->request->getMethod(true) === 'post') {
            $id = $this->request->getPost('id');
            
            $val = $this->validate([
                'nip' => [
                    'label' => 'Nomor induk Guru Nasional',
                    'rules' => "required|numeric|max_length[10]|is_unique[guru.nip,id,$id]",
                ],
                'nama' => [
                    'label' => 'Nama Guru',
                    'rules' => 'required',
                ],
            ]);

            if (!$val) {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url("guru/edit/$id"));
            }

            $data = [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
            ];

            $success = $this->model->updateData($id, $data);

            if ($success) {
                session()->setFlashdata('message', ' Diubah');
            } else {
                session()->setFlashdata('err', ' Gagal Diubah');
            }

            return redirect()->to(base_url('guru'));
        }
    }

    function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', ' DiHapus');
            return redirect()->to(base_url('guru'));
        }
    }
}
