<?php
defined('BASEPATH') or exit('No direct script access allowed');

class profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('auth_model');
        $this->load->library('upload');
    }

    function index()
    {
        $data['judul'] = "Halaman Profile";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profile'] = $this->auth_model->getByUser($this->session->userdata('id'));
        $this->load->view("layout/header", $data);
        $this->load->view("profile/vw_profile", $data);
        $this->load->view("layout/footer");
    }

	function edit($id) {
		$data['judul']="Halaman Edit Profile";
		$data['profile']=$this->auth_model->getById($id);
		$this->load->view("layout/header", $data);
		$this->load->view("profile/vw_profile_edit", $data);
		$this->load->view("layout/footer", $data);
	}

	function update() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'Edit Profile Gagal!!');
            redirect('profile');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['foto']['name']);
            $ext = end($dname);
            $nama = 'User'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                $foto = NULL;
            } else {
                $upload_data = $this->upload->data();
                $foto = 'assets/images/'.$nama;
            }

            if ($_FILES['foto']['name'] <> '') {
                if ($this->input->post('password') <> '') {
                    $data = [ 
                        'nama' => $this->input->post('nama'),
                        'username' => $this->input->post('username'),
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'foto' => $foto,
                    ];
                } else {
                    $data = [ 
                        'nama' => $this->input->post('nama'),
                        'username' => $this->input->post('username'),
                        'foto' => $foto,
                    ];
                }
            } else {
                if ($this->input->post('password') <> '') {
                    $data = [ 
                        'nama' => $this->input->post('nama'),
                        'username' => $this->input->post('username'),
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    ];
                } else {
                    $data = [ 
                        'nama' => $this->input->post('nama'),
                        'username' => $this->input->post('username')
                    ];
                }
            }
            $id=$this->input->post('id');
            $this->auth_model->update(['id'=> $id], $data);
            $this->session->set_flashdata('berhasil', 'Edit Profile berhasil.');
            redirect('profile');
        }
	}
}