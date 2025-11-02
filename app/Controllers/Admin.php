<?php

namespace App\Controllers;

use App\Models\ModelSetting;


class Admin extends BaseController
{

    public function __construct()
    {
        $this->ModelSetting = new ModelSetting();
    }


    public function index()
    {
        $data = [
            'judul' =>'Dasboard' ,
            'menu' => 'dashboard' ,
            'page' =>'v_dashboard' ,
        ];
        return view('v_template_back_end', $data);
    }

    public function setting()
    {
        $data = [
            'judul' =>'setting' ,
            'menu' => 'setting' ,
            'page' =>'v_setting' ,
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

  public function UpdateSetting()
{
    $data = [
        'nama_web' => $this->request->getPost('nama_web'),
        'coordinat_wilayah' => $this->request->getPost('coordinat_wilayah'),
        'zoom_view' => $this->request->getPost('zoom_view'),
    ];

    $this->ModelSetting->update(1, $data);
    session()->setFlashdata('pesan', 'Settingan Web Telah Diupdate !!!');
    return redirect()->to(base_url('Admin/setting'));
    
}

}