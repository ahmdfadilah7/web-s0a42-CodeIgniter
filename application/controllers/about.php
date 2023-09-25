<?php
defined('BASEPATH') or exit('No direct script access allowed');
class about extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('about_model');
        $this->load->model('auth_model');
        $this->load->library('upload');
    }
    function index()
    {
        $data['judul'] = "Halaman about";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['about'] = $this->about_model->get();
        $data['cek_about'] = $this->db->query("SELECT * FROM about")->num_rows();
        $this->load->view("layout/header", $data);
        $this->load->view("about/vw_about", $data);
        $this->load->view("layout/footer");
    }
    function delete($id)
    {
        $this->about_model->delete($id);
        redirect('about');
    }
    
    function tambah() {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'about Baru gagal ditambahkan!');
            redirect('about');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['gambar']['name']);
            $ext = end($dname);
            $nama = 'about'."-".time().'-'.rand(100,999).".".$ext;
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
            
            $this->about_model->insert($data);
            $this->session->set_flashdata('berhasil', 'about baru berhasil ditambahkan.');
            redirect('about');
        }
	}

	function edit($id) {
		$data['judul']="Halaman Edit about";
		$data['about']=$this->about_model->getById($id);
		$this->load->view("layout/header", $data);
		$this->load->view("about/vw_about_edit", $data);
		$this->load->view("layout/footer", $data);
	}

	function update() {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'Edit about Gagal!!');
            redirect('about');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['gambar']['name']);
            $ext = end($dname);
            $nama = 'about'."-".time().'-'.rand(100,999).".".$ext;
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
            $this->about_model->update(['id'=> $id], $data);
            $this->session->set_flashdata('berhasil', 'Edit about berhasil.');
            redirect('about');
        }
	}
}