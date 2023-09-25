<?php
defined('BASEPATH') or exit('No direct script access allowed');
class taginput extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('taginput_model');
        $this->load->model('auth_model');
        $this->load->library('upload');
    }
    function index()
    {
        $data['judul'] = "Halaman Tag input";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['taginput'] = $this->taginput_model->get();
        $data['tag_input'] = array('input', 'radio', 'select');

        $this->load->view("layout/header", $data);
        $this->load->view("taginput/vw_taginput", $data);
        $this->load->view("layout/footer");
    }
    function delete($id)
    {
        $this->taginput_model->delete($id);
        redirect('taginput');
    }
    
    function tambah() {
        $this->form_validation->set_rules('tag_input', 'Tag Input', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'taginput Baru gagal ditambahkan!');
            redirect('taginput');
        } else {

            $data=[ 
                'tag_input' => $this->input->post('tag_input'),
                'isi' => $this->input->post('isi'),
            ];
            
            $this->taginput_model->insert($data);
            $this->session->set_flashdata('berhasil', 'Tag input baru berhasil ditambahkan.');
            redirect('taginput');
        }
	}

	function edit($id) {
		$data['judul']="Halaman Edit taginput";
		$data['taginput']=$this->taginput_model->getById($id);
        $data['tag_input'] = array('input', 'radio', 'select');

		$this->load->view("layout/header", $data);
		$this->load->view("taginput/vw_taginput_edit", $data);
		$this->load->view("layout/footer", $data);
	}

	function update() {
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        $this->form_validation->set_rules('tag_input', 'Tag Input', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'Edit taginput Gagal!!');
            redirect('taginput');
        } else {
            
            $data = [ 
                'isi' => $this->input->post('isi'),
                'tag_input' => $this->input->post('tag_input'),
            ];
            
            $id=$this->input->post('id');
            $this->taginput_model->update(['id'=> $id], $data);
            $this->session->set_flashdata('berhasil', 'Edit Tag input berhasil.');
            redirect('taginput');
        }
	}
}