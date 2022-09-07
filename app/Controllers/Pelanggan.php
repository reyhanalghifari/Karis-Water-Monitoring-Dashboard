<?php
 
namespace App\Controllers;
 
class Pelanggan extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->pelanggan_model = new \App\Models\Pelanggan();
    }

    public function index()
    {
        $datapelanggan = $this->pelanggan_model->getDataPelanggan();
        return view('pelanggan/list_pelanggan', ['datapelanggan' => $datapelanggan]);
    }

    public function add()
    {
        return view('pelanggan/tambah_pelanggan');
    }

    public function process_add()
    {

        $this->validation->setRules(
            [
                'nama_pelanggan' => 'required',
                'alamat_pelanggan' => 'required',
                'no_telepon' => 'required|integer',
                'email' => 'required',
                
            ],
            
            [   // Errors
                'nama_pelanggan' => [
                    'required' => 'Nama pelanggan tidak boleh kosong',
                    
                ],
                'alamat_pelanggan' => [
                    'required' => 'Alamat pelanggan tidak boleh kosong',
                    
                ],

                'no_telepon' => [
                    'required' => 'Nomor telepon pelanggan tidak boleh kosong',
                    'integer' => 'Nomor telepon pelanggan harus diisi dengan angka'
                ],
                    
            
                'email' => [
                    'required' => 'Email pelanggan tidak boleh kosong',
                    
                ],

            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_tambah_pelanggan_error_message', $this->validation->getErrors());
            return redirect()->to('/pelanggan/add');
        }
        else {

            $pelanggan_data = [
                'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
                'alamat_pelanggan' => $this->request->getVar('alamat_pelanggan'),
                'no_telepon' => $this->request->getVar('no_telepon'),
                'email' => $this->request->getVar('email'),
            
            ];

            $result = $this->pelanggan_model->insert($pelanggan_data);
            $this->session->setFlashdata('form_tambah_pelanggan_success_message', 'Tambah pelanggan berhasil');
            return redirect()->to('/pelanggan');    
        }
    }

    public function edit($pelanggan_id)
    {
        $pelanggan = $this->pelanggan_model->getPelanggan($pelanggan_id);

        return view('pelanggan/edit_pelanggan', ['pelanggan' => $pelanggan]);
    }

    public function process_edit()
    {
        $pelanggan_id = $this->request->getVar('pelanggan_id');

        $this->validation->setRules(
            [
                'nama_pelanggan' => 'required',
                'alamat_pelanggan' => 'required',
                'no_telepon' => 'required|integer',
                'email' => 'required',
                
            ],
            
            [   // Errors
                'nama_pelanggan' => [
                    'required' => 'Nama pelanggan tidak boleh kosong',
                    
                ],
                'alamat_pelanggan' => [
                    'required' => 'Alamat pelanggan tidak boleh kosong',
                    
                ],

                'no_telepon' => [
                    'required' => 'Nomor telepon pelanggan tidak boleh kosong',
                    'integer' => 'Nomor telepon pelanggan harus diisi dengan angka'
                ],
                    
            
                'email' => [
                    'required' => 'Email pelanggan tidak boleh kosong',
                    
                ],

            ]
        );

        if (! $this->validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('form_edit_pelanggan_error_message', $this->validation->getErrors());
            return redirect()->to('/pelanggan/edit/4');
        }
        else {

            $pelanggan_data = [
                'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
                'alamat_pelanggan' => $this->request->getVar('alamat_pelanggan'),
                'no_telepon' => $this->request->getVar('no_telepon'),
                'email' => $this->request->getVar('email'),
            
            ];

            $result = $this->pelanggan_model->update($pelanggan_id, $pelanggan_data);
            $this->session->setFlashdata('form_edit_pelanggan_success_message', 'Edit pelanggan berhasil');
            return redirect()->to('/pelanggan');    
        }
    }

    public function delete($pelanggan_id)
    {
        $pelanggan = $this->pelanggan_model->delete($pelanggan_id);

           return redirect()->to('/pelanggan');
    }
}
