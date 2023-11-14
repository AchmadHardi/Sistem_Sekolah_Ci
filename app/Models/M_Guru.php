<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Guru extends Model

{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getAllData()
    {
       return $this->db->table('guru')->get()->getResultArray();

    }

    public function tambah($data)
    {
        return $this->db->table('guru')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('guru')->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->db->table('guru')->update($data, ['id' => $id]);
    }
    
}