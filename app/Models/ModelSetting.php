<?php 
namespace App\Models;
use CodeIgniter\Model;

class ModelSetting extends Model
{
    // tmbhn dwek
    protected $table = 'tbl_setting';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_web', 'coordinat_wilayah', 'zoom_view'];
    //
    

    public function DataWeb()
    {
        //return $this->db->table('tbl_setting')
              // ->where('id', 1)
              // ->get()->getRowArray();

        return $this->db->table('tbl_setting')->get()->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_setting')
        ->where('id', 1)
        ->update($data);
    }
}