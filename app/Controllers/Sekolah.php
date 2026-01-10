<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelSekolah;
use CodeIgniter\HTTP\ResponseInterface;

class Sekolah extends BaseController
{
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
         $this->ModelSekolah = new ModelSekolah();
    }
    public function index()
    {
        $data = [
            'judul' => 'Sekolah',
            'menu' => 'sekolah' ,
            'page' => 'sekolah/v_index',
            'sekolah' => $this->ModelSekolah->AllData(),
        ];
        return view('v_template_back_end', $data);
    }
    
    public function Input()
    {
        $data = [
            'judul' => 'Input Sekolah',
            'menu' => 'sekolah' ,
            'page' => 'sekolah/v_input',
            'validation' => \Config\Services::validation(),
            'web' => $this->ModelSetting->DataWeb(),
            'provinsi' =>$this->ModelSekolah->allProvinsi(),
            'wilayah' => $this->ModelWilayah->AllData(),
            
        ];
        return view('v_template_back_end', $data);
    }

    //kabupaten, kecamatan
    public function Kabupaten()
    {
        $id_provinsi = $this->request->getPost('id_provinsi');
        $kab = $this->ModelSekolah->allKabupaten($id_provinsi);
        echo ' <option value="">--Pilih Kabupaten--</option>';
        foreach ($kab as $key => $value) {
            echo '<option value='.$value['id_kabupaten'].'>'.$value['nama_kabupaten'].'</option>';
        }
    }

     public function kecamatan()
    {
        $id_kabupaten = $this->request->getPost('id_kabupaten');
        $kec = $this->ModelSekolah->allKecamatan($id_kabupaten);
        echo ' <option value="">--Pilih Kecamatan--</option>';
        foreach ($kec as $key => $value) {
            echo '<option value='.$value['id_kecamatan'].'>'.$value['nama_kecamatan'].'</option>';
        }
    }

}
