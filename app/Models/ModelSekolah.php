<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSekolah extends Model
{
    // tmbhn dwk
    public function AllData()
    {
        return $this->db->table('tbl_sekolah')
         ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang = tbl_sekolah.id_jenjang', 'left')
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
        ->join('tbl_jenjang', 'tbl_jenjang.id_jenjang = tbl_sekolah.id_jenjang', 'left')
        ->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_sekolah.id_provinsi', 'left')
        ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_sekolah.id_kabupaten', 'left')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_sekolah.id_kecamatan', 'left')
         ->join('tbl_wilayah', 'tbl_wilayah.id_wilayah = tbl_sekolah.id_wilayah', 'left')
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

    //provinsi
    public function allProvinsi()
    {
         return $this->db->table('tbl_provinsi')
         ->orderBy('id_provinsi','ASC')
                        ->get()
                        ->getResultArray();
    }

    public function allKabupaten($id_provinsi)
    {
        return $this->db->table('tbl_kabupaten')
         ->where('id_provinsi', $id_provinsi)
                        ->get()
                        ->getResultArray();
    }

    public function allKecamatan($id_kabupaten)
    {
        return $this->db->table('tbl_kecamatan')
         ->where('id_kabupaten', $id_kabupaten)
                        ->get()
                        ->getResultArray();
    }
}
