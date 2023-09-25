<?php
defined('BASEPATH') or exit('No direct script access allowed');
class kusioner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('kusioner_model');
        $this->load->model('auth_model');
        $this->load->library('upload');
    }
    function index()
    {
        $data['judul'] = "Halaman Kusioner";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kusioner'] = $this->kusioner_model->get();
        $data['taginput'] = $this->db->query("SELECT * FROM taginput GROUP BY tag_input")->result_array();

        $this->load->view("layout/header", $data);
        $this->load->view("kusioner/vw_kusioner", $data);
        $this->load->view("layout/footer");
    }
    function delete($id)
    {
        $this->kusioner_model->delete($id);
        redirect('kusioner');
    }
    
    function tambah() {
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('kusioner', 'Kusioner', 'required');
        $this->form_validation->set_rules('tag_input', 'Tag Input', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'kusioner Baru gagal ditambahkan!');
            redirect('kusioner');
        } else {

            $data=[ 
                'status' => $this->input->post('status'),
                'urutan' => $this->input->post('urutan'),
                'kusioner' => $this->input->post('kusioner'),
                'tag_input' => $this->input->post('tag_input'),
            ];
            
            $this->kusioner_model->insert($data);
            $this->session->set_flashdata('berhasil', 'kusioner baru berhasil ditambahkan.');
            redirect('kusioner');
        }
	}

	function edit($id) {
		$data['judul']="Halaman Edit kusioner";
		$data['kusioner']=$this->kusioner_model->getById($id);
        $data['taginput'] = $this->db->query("SELECT * FROM taginput GROUP BY tag_input")->result_array();

		$this->load->view("layout/header", $data);
		$this->load->view("kusioner/vw_kusioner_edit", $data);
		$this->load->view("layout/footer", $data);
	}

	function update() {
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required');
        $this->form_validation->set_rules('kusioner', 'Kusioner', 'required');
        $this->form_validation->set_rules('tag_input', 'Tag Input', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'Edit kusioner Gagal!!');
            redirect('kusioner');
        } else {
            
            $data = [ 
                'status' => $this->input->post('status'),
                'urutan' => $this->input->post('urutan'),
                'kusioner' => $this->input->post('kusioner'),
                'tag_input' => $this->input->post('tag_input'),
            ];
            
            $id=$this->input->post('id');
            $this->kusioner_model->update(['id'=> $id], $data);
            $this->session->set_flashdata('berhasil', 'Edit kusioner berhasil.');
            redirect('kusioner');
        }
	}
}