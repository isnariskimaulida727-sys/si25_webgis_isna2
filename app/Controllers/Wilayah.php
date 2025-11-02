<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;

class Wilayah extends BaseController
{
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
    }

    public function index()
    {
        $data = [
            'judul' => 'Wilayah',
            'menu' => 'wilayah' ,
            'page' => 'wilayah/v_index',
            'wilayah' => $this->ModelWilayah->AllData(),
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function Input()
    {
        $data = [
            'judul' => 'Input Wilayah',
            'menu' => 'wilayah' ,
            'page' => 'wilayah/v_input',
            'validation' => \Config\Services::validation(),
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        $validation = \Config\Services::validation();

        if (!$this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
        ])) {
            return redirect()
                ->to(base_url('Wilayah/Input'))
                ->withInput()
                ->with('validation', $validation);
        }

        $data = [
            'nama_wilayah' => $this->request->getPost('nama_wilayah'),
            'geojson' => $this->request->getPost('geojson'),
            'warna' => $this->request->getPost('warna'),
        ];
        $this->ModelWilayah->InsertData($data);
        session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
        return redirect()->to(base_url('Wilayah'));
    }

     public function Edit($id_wilayah)
    {
         $wilayah = $this->ModelWilayah->DetailData($id_wilayah);

         if ($wilayah === null || $wilayah === false) { //tmbhna dwk
        // Jika ID tidak ada di DB, tampilkan pesan error dan alihkan ke halaman Wilayah
        session()->setFlashdata('error', 'Data Wilayah dengan ID tersebut tidak ditemukan.');
        return redirect()->to(base_url('Wilayah')); //smpe sini
    }
        $data = [
            'judul' => 'Edit Wilayah',
            'menu' => 'wilayah' ,
            'page' => 'wilayah/v_edit',
            'wilayah' => $wilayah,
            //'wilayah' =>$this->ModelWilayah->DetailData('$id_wilayah'),
            'validation' => \Config\Services::validation(),
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_wilayah)
    {
        $validation = \Config\Services::validation();

        if (!$this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
        ])) {
            return redirect()
                ->to(base_url('Wilayah/Input'))
                ->withInput()
                ->with('validation', $validation);
        }

        $data = [
            'id_wilayah' => $id_wilayah,
            'nama_wilayah' => $this->request->getPost('nama_wilayah'),
            'geojson' => $this->request->getPost('geojson'),
            'warna' => $this->request->getPost('warna'),
        ];
        $this->ModelWilayah->UpdateData($data);
        session()->setFlashdata('update', 'Data Berhasil Diupdate !!');
        return redirect()->to(base_url('Wilayah'));
    }

    public function Delete($id_wilayah)
    {
         $data = [
            'id_wilayah' => $id_wilayah,
        ];
        $this->ModelWilayah->DeleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Didelete !!');
        return redirect()->to(base_url('Wilayah'));
    }
}