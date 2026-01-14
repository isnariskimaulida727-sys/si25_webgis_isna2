<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    // tmbhn dwk
    public function AllData()
    {
        return $this->db->table('tbl_user')
                        ->get()
                        ->getResultArray();
    }
     public function UpdateAllData($data)
    {
        $this->db->table('tbl_user')
        ->update($data);
    }
    public function InsertData($data)
{
    $this->db->table('tbl_user')->insert($data);
}

public  function DetailData($id_user)
    {
        return $this->db->table('tbl_user')
        ->where('id_user', $id_user)
        ->get()
        ->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_user')
        ->where('id_user', $data['id_user'])
        ->update($data);
    }

      public function DeleteData($data)
    {
        $this->db->table('tbl_user')
        ->where('id_user', $data['id_user'])
        ->delete($data);
    }
}
