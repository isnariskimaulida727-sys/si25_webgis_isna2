<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJenjang extends Model
{
    // tmbhn dwk
    public function AllData()
    {
        return $this->db->table('tbl_jenjang')
                        ->get()
                        ->getResultArray();
    }
     public function UpdateAllData($data)
    {
        $this->db->table('tbl_jenjang')
        ->update($data);
    }
    public function InsertData($data)
{
    $this->db->table('tbl_jenjang')->insert($data);
}

public  function DetailData($id_jenjang)
    {
        return $this->db->table('tbl_jenjang')
        ->where('id_jenjang', $id_jenjang)
                        ->get()
                        ->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_jenjang')
        ->where('id_jenjang', $data['id_jenjang'])
        ->update($data);
    }

      public function DeleteData($data)
    {
        $this->db->table('tbl_jenjang')
        ->where('id_jenjang', $data['id_jenjang'])
        ->delete($data);
    }
}
