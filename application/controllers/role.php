<?php
defined('BASEPATH') or exit('No direct script access allowed');
class role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('role_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Role";
        $data['role'] = $this->role_model->get();
        $this->load->view("layout/header");
        $this->load->view("role/vw_role", $data);
        $this->load->view("layout/footer");
    }
    function delete($id)
    {
        $this->role_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berita Berhasil Dihapus!</div>');
        redirect('role');
    }
    
    function tambah() {
		$data['judul']="Halaman Tambah Role";

		$data=[ 
        'nama_role'=>$this->input->post('nama_role'),
		];
		$this->role_model->insert($data);
		redirect('role');
	}

	function edit($id) {
		$data['judul']="Halaman Edit Role";
		$data['berita']=$this->role_model->getById($id);
		$this->load->view("layout/auth_header", $data);
		$this->load->view("role/vw_role_edit", $data);
		$this->load->view("layout/auth_footer", $data);
	}

	function update() {

		$data=[ 
            'nama_role'=>$this->input->post('nama_role'),
		];
		$id=$this->input->post('id');
		$this->role_model->update(['id_role'=> $id], $data);
		redirect('role');
	}
}