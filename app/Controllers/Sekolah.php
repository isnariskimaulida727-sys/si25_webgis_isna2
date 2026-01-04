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
            
        ];
        return view('v_template_back_end', $data);
    }

}
