<?php
defined('BASEPATH') or exit('No direct script access allowed');
class jurusan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('jurusan_model');
        $this->load->model('auth_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Jurusan";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['jurusan'] = $this->jurusan_model->get();
        $this->load->view("layout/header", $data);
        $this->load->view("jurusan/vw_jurusan", $data);
        $this->load->view("layout/footer");
    }
    function delete($id)
    {
        $this->jurusan_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berita Berhasil Dihapus!</div>');
        redirect('jurusan');
    }
    
    function tambah() {
		$data['judul']="Halaman Tambah jurusan";

		$data=[ 
        'nama_jurusan'=>$this->input->post('nama_jurusan'),
		];
		$this->jurusan_model->insert($data);
		redirect('jurusan');
	}

	function edit($id) {
		$data['judul']="Halaman Edit jurusan";
		$data['jurusan']=$this->jurusan_model->getById($id);
		$this->load->view("layout/header", $data);
		$this->load->view("jurusan/vw_jurusan_edit", $data);
		$this->load->view("layout/footer", $data);
	}

	function update() {

		$data=[ 
            'nama_jurusan'=>$this->input->post('nama_jurusan'),
		];
		$id=$this->input->post('id');
		$this->jurusan_model->update(['id_jurusan'=> $id], $data);
		redirect('jurusan');
	}
}