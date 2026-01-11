<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelSekolah;
use App\Models\ModelJenjang;
use CodeIgniter\HTTP\ResponseInterface;

class Sekolah extends BaseController
{
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
        $this->ModelSekolah = new ModelSekolah();
        $this->ModelJenjang = new ModelJenjang();
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
           // 'validation' => \Config\Services::validation(), // 'validation' => session()->get('validation'), 
            'web' => $this->ModelSetting->DataWeb(),
            'provinsi' =>$this->ModelSekolah->allProvinsi(),
            'wilayah' => $this->ModelWilayah->AllData(),
            'jenjang' => $this->ModelJenjang->AllData(),
            
        ];
        return view('v_template_back_end', $data);
    }

public function InsertData()
    {
         if (!$this->validate([
            'nama_sekolah' => [
                'label' => 'Nama Sekolah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                    ]
            ],
            'akreditasi' => [
                'label' => 'Akreditasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
             'id_jenjang' => [
                'label' => 'Jenjang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'coordinat' => [
                'label' => 'Coordinat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'id_provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
             'id_kabupaten' => [
                'label' => 'Kabupaten',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
             'id_kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
             'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'id_wilayah' => [
                'label' => 'Wilayah Administrasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'foto' => [
                'label' => 'Foto Sekolah',
                'rules' => 'max_size[foto,2000]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} max 2000 kb !!',
                    'mime_in' => 'format {field} Harus JPG, JPEG, PNG !!',
                ]
            ],
        ])) {
           

            //jika validasi berhasil
            return redirect()
               ->back() //  ->to(base_url('Sekolah/Input'))  //->to(base_url('Wilayah/Input')) 
                ->withInput(); //; ilng
                  // ->with('validation', $this->validator);  
        }
         $foto = $this->request->getFile('foto');
            $nama_file_foto = $foto->getRandomName();
            // //jika validasi berhasil
        $data = [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'akreditasi' => $this->request->getPost('akreditasi'),
            'status' => $this->request->getPost('status'),
            'coordinat' => $this->request->getPost('coordinat'),
            'id_jenjang' => $this->request->getPost('id_jenjang'),
            'id_provinsi' => $this->request->getPost('id_provinsi'),
            'id_kabupaten' => $this->request->getPost('id_kabupaten'),
            'id_kecamatan' => $this->request->getPost('id_kecamatan'),
            'alamat' => $this->request->getPost('alamat'),
            'id_wilayah' => $this->request->getPost('id_wilayah'),
            'foto' => $nama_file_foto,
        ];
        $foto->move('foto', $nama_file_foto);
        $this->ModelSekolah->InsertData($data);
        session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
        return redirect()->to(base_url('Sekolah'));
    

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