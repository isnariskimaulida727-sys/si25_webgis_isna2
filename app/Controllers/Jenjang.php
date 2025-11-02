<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Jenjang extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Jenjang',
            'menu' => 'jenjang' , //variabel menu aktif
            'page' => 'v_jenjang',
        ];
        return view('v_template_back_end', $data);
    }
}
