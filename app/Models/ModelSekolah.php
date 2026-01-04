<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSekolah extends Model
{
    // tmbhn dwk
    public function AllData()
    {
        return $this->db->table('tbl_sekolah')
                        ->get()
                        ->getResultArray();
    }
     public function UpdateAllData($data)
    {
        $this->db->table('tbl_sekolah')
        ->update($data);
    }
    public function InsertData($data)
{
    $this->db->table('tbl_sekolah')->insert($data);
}

public  function DetailData($id_sekolah)
    {
        return $this->db->table('tbl_sekolah')
        ->where('id_sekolah', $id_sekolah)
                        ->get()
                        ->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_sekolah')
        ->where('id_sekolah', $data['id_sekolah'])
        ->update($data);
    }

      public function DeleteData($data)
    {
        $this->db->table('tbl_sekolah')
        ->where('id_sekolah', $data['id_sekolah'])
        ->delete($data);
    }
}
