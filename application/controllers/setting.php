<?php
defined('BASEPATH') or exit('No direct script access allowed');
class setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('setting_model');
        $this->load->model('auth_model');
        $this->load->library('upload');
    }
    function index()
    {
        $data['judul'] = "Halaman Setting";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['setting'] = $this->setting_model->get();
        $data['cek_setting'] = $this->db->query("SELECT * FROM setting")->num_rows();
        $this->load->view("layout/header", $data);
        $this->load->view("setting/vw_setting", $data);
        $this->load->view("layout/footer");
    }
    function delete($id)
    {
        $this->setting_model->delete($id);
        redirect('setting');
    }
    
    function tambah() {
        $this->form_validation->set_rules('nama_website', 'Nama Website', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'setting Baru gagal ditambahkan!');
            redirect('setting');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['logo']['name']);
            $ext = end($dname);
            $nama = 'Logo'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('logo')) {
                $foto = NULL;
            } else {
                $upload_data = $this->upload->data();
                $foto = 'assets/images/'.$nama;
            }

            $config2['upload_path'] = "assets/images/";
            $config2['overwrite'] = TRUE;
            
            $config2['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname2 = explode(".", $_FILES['favicon']['name']);
            $ext2 = end($dname2);
            $nama2 = 'Favicon'."-".time().'-'.rand(100,999).".".$ext2;
            $config2['file_name'] = $nama2;
            $config2['remove_spaces'] = FALSE;
            $this->upload->initialize($config2);
            if (!$this->upload->do_upload('favicon')) {
                $favicon = NULL;
            } else {
                $upload_data = $this->upload->data();
                $favicon = 'assets/images/'.$nama2;
            }

            $data=[ 
                'nama_website' => $this->input->post('nama_website'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'alamat' => $this->input->post('alamat'),
                'logo' => $foto,
                'favicon' => $favicon,
            ];
            
            $this->setting_model->insert($data);
            $this->session->set_flashdata('berhasil', 'Setting baru berhasil ditambahkan.');
            redirect('setting');
        }
	}

	function edit($id) {
		$data['judul']="Halaman Edit Setting";
		$data['setting']=$this->setting_model->getById($id);
		$this->load->view("layout/header", $data);
		$this->load->view("setting/vw_setting_edit", $data);
		$this->load->view("layout/footer", $data);
	}

	function update() {
        $this->form_validation->set_rules('nama_website', 'Nama Website', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'Edit setting Gagal!!');
            redirect('setting');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['logo']['name']);
            $ext = end($dname);
            $nama = 'Logo'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('logo')) {
                $foto = NULL;
            } else {
                $upload_data = $this->upload->data();
                $foto = 'assets/images/'.$nama;
            }

            $config2['upload_path'] = "assets/images/";
            $config2['overwrite'] = TRUE;
            
            $config2['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname2 = explode(".", $_FILES['favicon']['name']);
            $ext2 = end($dname2);
            $nama2 = 'Favicon'."-".time().'-'.rand(100,999).".".$ext2;
            $config2['file_name'] = $nama2;
            $config2['remove_spaces'] = FALSE;
            $this->upload->initialize($config2);
            if (!$this->upload->do_upload('favicon')) {
                $favicon = NULL;
            } else {
                $upload_data = $this->upload->data();
                $favicon = 'assets/images/'.$nama2;
            }

            if ($_FILES['logo']['name'] <> '') {
                if ($_FILES['favicon']['name'] <> '') {
                    $data = [ 
                        'nama_website' => $this->input->post('nama_website'),
                        'email' => $this->input->post('email'),
                        'no_telp' => $this->input->post('no_telp'),
                        'alamat' => $this->input->post('alamat'),
                        'logo' => $foto,
                        'favicon' => $favicon,
                    ];
                } else {
                    $data = [ 
                        'nama_website' => $this->input->post('nama_website'),
                        'email' => $this->input->post('email'),
                        'no_telp' => $this->input->post('no_telp'),
                        'alamat' => $this->input->post('alamat'),
                        'logo' => $foto,
                    ];
                }
            } else {
                if ($_FILES['favicon']['name'] <> '') {
                    $data = [ 
                        'nama_website' => $this->input->post('nama_website'),
                        'email' => $this->input->post('email'),
                        'no_telp' => $this->input->post('no_telp'),
                        'alamat' => $this->input->post('alamat'),
                        'favicon' => $favicon
                    ];
                } else {
                    $data = [ 
                        'nama_website' => $this->input->post('nama_website'),
                        'email' => $this->input->post('email'),
                        'no_telp' => $this->input->post('no_telp'),
                        'alamat' => $this->input->post('alamat')
                    ];
                }
            }
            $id=$this->input->post('id');
            $this->setting_model->update(['id'=> $id], $data);
            $this->session->set_flashdata('berhasil', 'Edit setting berhasil.');
            redirect('setting');
        }
	}
}