<?php
defined('BASEPATH') or exit('No direct script access allowed');
class beranda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('jurusan_model');
        $this->load->model('auth_model');
        $this->load->library('upload');
    }
    function index()
    {
        $data['judul'] = "Halaman Beranda";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['jurusan'] = $this->jurusan_model->get();
        $data['provinsi'] = $this->db->query("SELECT * FROM provinsi")->result();
        
        $this->load->view("layout/header", $data);
        $this->load->view("beranda/vw_beranda", $data);
        $this->load->view("layout/footer");
    }
}