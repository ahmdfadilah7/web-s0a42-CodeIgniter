<?php
defined('BASEPATH') or exit('No direct script access allowed');
class slider extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('slider_model');
        $this->load->model('auth_model');
        $this->load->library('upload');
    }
    function index()
    {
        $data['judul'] = "Halaman Slider";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['slider'] = $this->slider_model->get();
        $this->load->view("layout/header", $data);
        $this->load->view("slider/vw_slider", $data);
        $this->load->view("layout/footer");
    }
    function delete($id)
    {
        $this->slider_model->delete($id);
        redirect('slider');
    }
    
    function tambah() {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'slider Baru gagal ditambahkan!');
            redirect('slider');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['gambar']['name']);
            $ext = end($dname);
            $nama = 'Slider'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
                $foto = NULL;
            } else {
                $upload_data = $this->upload->data();
                $foto = 'assets/images/'.$nama;
            }

            $data=[ 
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'gambar' => $foto,
            ];
            
            $this->slider_model->insert($data);
            $this->session->set_flashdata('berhasil', 'Slider baru berhasil ditambahkan.');
            redirect('slider');
        }
	}

	function edit($id) {
		$data['judul']="Halaman Edit Slider";
		$data['slider']=$this->slider_model->getById($id);
		$this->load->view("layout/header", $data);
		$this->load->view("slider/vw_slider_edit", $data);
		$this->load->view("layout/footer", $data);
	}

	function update() {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'Edit slider Gagal!!');
            redirect('slider');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['gambar']['name']);
            $ext = end($dname);
            $nama = 'slider'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
                $foto = NULL;
            } else {
                $upload_data = $this->upload->data();
                $foto = 'assets/images/'.$nama;
            }

            if ($this->input->post('gambar') <> '') {
                $data = [ 
                    'judul' => $this->input->post('judul'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $foto,
                ];
            } else {
                $data = [ 
                    'judul' => $this->input->post('judul'),
                    'deskripsi' => $this->input->post('deskripsi'),
                ];
            }
            $id=$this->input->post('id');
            $this->slider_model->update(['id'=> $id], $data);
            $this->session->set_flashdata('berhasil', 'Edit slider berhasil.');
            redirect('slider');
        }
	}
}