<?php
defined('BASEPATH') or exit('No direct script access allowed');
class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
    }
    function index()
    {
        
        $this->load->view("layout/auth_header");
        $this->load->view("auth/login");
        $this->load->view("layout/auth_footer");
    }
    function cek_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'nama' => $user['nama'],
                    'username' => $user['username'],
                    'foto' => $user['foto'],
                    'role' => $user['role'],
                    'id' => $user['id'],
                    'status' => TRUE
                ];
                
                $coba=$this->session->set_userdata($data);

                if ($user['role'] == 'admin') {
                    redirect('data_alumni');
                } else {
                    $id_user = $user['id'];
                    $cek_alumni = $this->db->query("SELECT * FROM alumni WHERE id_user = '$id_user'")->num_rows();
                    if ($cek_alumni==0) {
                        redirect('alumni/tambah');
                    } else {
                        redirect('alumni');
                    }
                }
            } else {
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NISN belum terdaftar!</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil logout! </div>');
        redirect('auth');
    }
}