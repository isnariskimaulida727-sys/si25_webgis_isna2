<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Sekolah extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Sekolah',
            'menu' => 'sekolah' ,
            'page' => 'sekolah/v_index',
        ];
        return view('v_template_back_end', $data);
    }
}
