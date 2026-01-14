<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function __construct() 
    {
        $this->ModelUser = new ModelUser;
    }

    public function index()
    {
         $data = [
            'judul' => 'User',
            'menu' => 'user' ,
            'page' => 'user/v_index',
            'user' => $this->ModelUser->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

     public function Input()
    {
        $data = [
            'judul' => 'Input User',
            'menu' => 'user' ,
            'page' => 'user/v_input',
            
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
         if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                    ]
            ],
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'permit_empty|max_size[foto,2000]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} max 2000 kb !!',
                    'mime_in' => 'format {field} Harus JPG, JPEG, PNG !!',
                ]
            ],
        ])) {
         $foto = $this->request->getFile('foto');
            $nama_file_foto = $foto->getRandomName();
            // //jika validasi berhasil
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => sha1($this->request->getPost('password')),
            'foto' => $nama_file_foto,
        ];
        $foto->move('foto', $nama_file_foto);
        $this->ModelUser->InsertData($data);
        session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
        return redirect()->to(base_url('User'));
    
     }else{
        //jika validasi gagal
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }

     public function Edit($id_user)
    {
        $data = [
            'judul' => 'Edit User',
            'menu' => 'user' ,
            'page' => 'user/v_edit',
            'user' => $this->ModelUser->DetailData($id_user),
        ];
        return view('v_template_back_end', $data);
    }

    public function UpdateData($id_user)
    {
         if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                    ]
            ],
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'permit_empty|max_size[foto,2000]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran {field} max 2000 kb !!',
                    'mime_in' => 'format {field} Harus JPG, JPEG, PNG !!',
                ]
            ],
        ])) {
            $foto = $this->request->getFile('foto');
            $user = $this->ModelUser->DetailData($id_user);
            
            if ($foto->getError()== 4) {
               $nama_file_foto = $user['foto'];
            }else {
                $nama_file_foto = $foto->getRandomName();
                 $foto->move('foto', $nama_file_foto);
            }
            // //jika validasi berhasil
        $data = [
            'id_user' => $id_user,
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => sha1($this->request->getPost('password')),
            'foto' => $nama_file_foto,
        ];
        $this->ModelUser->UpdateData($data);
        session()->setFlashdata('update', 'Data Berhasil DiUpdate !!');
        return redirect()->to(base_url('User'));
    
     }else{
        //jika validasi gagal
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }
    }

     //delete
    public function Delete($id_user)
    {
        //delete foto
         $user = $this->ModelUser->DetailData($id_user);
         if ($user['foto']<>'') {
            unlink('foto/'.$user['foto']);
         }
         $data = [
            'id_user' => $id_user,
         ];
        $this->ModelUser->DeleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil DiDelete !!');
        return redirect()->to(base_url('User'));
    }

}
