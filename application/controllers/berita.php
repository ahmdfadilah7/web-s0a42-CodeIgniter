<?php
defined('BASEPATH') or exit('No direct script access allowed');
class berita extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('berita_model');
        $this->load->model('auth_model');
        $this->load->library('upload');
    }
    function index()
    {
        $data['judul'] = "Halaman Berita";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['berita'] = $this->berita_model->get();
        $this->load->view("layout/header", $data);
        $this->load->view("berita/vw_berita", $data);
        $this->load->view("layout/footer");
    }
    public function view($id)
    {
        $berita = $this->berita_model->getById($id);
        $data = [
            'judul' => $berita['judul_berita'],
            'tanggal' => date('d M Y', strtotime($berita['tanggal_posting'])),
            'deskripsi' => $berita['deskripsi'],
            'gambar' => '<img src="'.base_url($berita['gambar']).'" style="width:100%;">',
        ];
        echo json_encode($data);
    }
    function delete($id)
    {
        $this->berita_model->delete($id);
        redirect('berita');
    }
    
    function tambah() {
        $this->form_validation->set_rules('judul_berita', 'Judul Berita', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Berita', 'required');
        $this->form_validation->set_rules('tanggal_posting', 'Tanggal Posting Berita', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'Berita Baru gagal ditambahkan!');
            redirect('berita');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['gambar']['name']);
            $ext = end($dname);
            $nama = 'Berita'."-".time().'-'.rand(100,999).".".$ext;
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
                'judul_berita' => $this->input->post('judul_berita'),
                'deskripsi' => $this->input->post('deskripsi'),
                'tanggal_posting' => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_posting'))),
                'gambar' => $foto,
            ];
            
            $this->berita_model->insert($data);
            $this->session->set_flashdata('berhasil', 'Berita baru berhasil ditambahkan.');
            redirect('berita');
        }
	}

	function edit($id) {
		$data['judul']="Halaman Edit Berita";
		$data['berita']=$this->berita_model->getById($id);
		$this->load->view("layout/header", $data);
		$this->load->view("berita/vw_berita_edit", $data);
		$this->load->view("layout/footer", $data);
	}

	function update() {
        $this->form_validation->set_rules('judul_berita', 'Judul Berita', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Berita', 'required');
        $this->form_validation->set_rules('tanggal_posting', 'Tanggal Posting Berita', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'Edit Berita Gagal!!');
            redirect('berita');
        } else {
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;
            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
            $dname = explode(".", $_FILES['gambar']['name']);
            $ext = end($dname);
            $nama = 'Berita'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
                $foto = NULL;
            } else {
                $upload_data = $this->upload->data();
                $foto = 'assets/images/'.$nama;
            }

            if ($_FILES['gambar']['name'] <> '') {
                $data = [ 
                    'judul_berita' => $this->input->post('judul_berita'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'tanggal_posting' => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_posting'))),
                    'gambar' => $foto,
                ];
            } else {
                $data = [ 
                    'judul_berita' => $this->input->post('judul_berita'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'tanggal_posting' => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_posting'))),
                ];
            }
            $id=$this->input->post('id');
            $this->berita_model->update(['id_berita'=> $id], $data);
            $this->session->set_flashdata('berhasil', 'Edit Berita berhasil.');
            redirect('berita');
        }
	}
}