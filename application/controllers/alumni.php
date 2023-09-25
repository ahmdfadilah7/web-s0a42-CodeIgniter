<?php
defined('BASEPATH') or exit('No direct script access allowed');
class alumni extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('alumni_model');
        $this->load->model('jurusan_model');
        $this->load->model('auth_model');
    }
    function index()
    {
        $id_user = $this->session->userdata('id');
        $data['cek_alumni'] = $this->db->query("SELECT * FROM alumni WHERE id_user = '$id_user'")->num_rows();
        if ($data['cek_alumni'] <> 0) {
            redirect('alumni/edit/'.$this->session->userdata('id'));
        } else {
            redirect('alumni/tambah');
            // $data['judul'] = "Halaman Alumni";
            // $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            // $data['alumni'] = $this->alumni_model->getById($id_user);
            // $this->load->view("layout/header", $data);
            // $this->load->view("alumni/vw_alumni", $data);
            // $this->load->view("layout/footer");
        }
    }
    function delete($id)
    {
        $this->alumni_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Alumni Berhasil Dihapus!</div>');
        redirect('alumni');
    }

    function tambah()
    {
        $data['judul'] = "Halaman Tambah Alumni";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['alumni'] = $this->alumni_model->get();
        $data['jurusan'] = $this->jurusan_model->get();
        $data['status'] = $this->db->query("SELECT * FROM kusioner GROUP BY status")->result_array();

        $this->form_validation->set_rules('nama_alumni', 'Nama alumni', 'required', [
            'required' => 'Nama alumni Wajib diisi',
        ]);
        $this->form_validation->set_rules('nisn', 'nisn', 'required', [
            'required' => 'NISN Wajib diisi',
        ]);
        $this->form_validation->set_rules('jk', 'jk', 'required', [
            'required' => 'Jenis Kelamin Wajib diisi',
        ]);
        $this->form_validation->set_rules('id_jurusan', 'Nama jurusan', 'required', [
            'required' => 'jurusan Wajib diisi',
        ]);
        $this->form_validation->set_rules('angkatan', 'angkatan', 'required', [
            'required' => ' Angkatan Wajib diisi',
        ]);
        $this->form_validation->set_rules('tahun_lulus', 'tahun_lulus', 'required', [
            'required' => ' tahun lulus Wajib diisi',
        ]);
        $this->form_validation->set_rules('status', 'status', 'required', [
            'required' => 'Status Wajib diisi',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("alumni/vw_tambah_alumni", $data);
            $this->load->view("layout/footer");
        } else {
            $data = [
                'id_user' => $this->session->userdata('id'),
                'nama_alumni' => $this->input->post('nama_alumni'),
                'nisn' => $this->input->post('nisn'),
                'jk' => $this->input->post('jk'),
                'id_jurusan' => $this->input->post('id_jurusan'),
                'angkatan' => $this->input->post('angkatan'),
                'tahun_lulus' => $this->input->post('tahun_lulus'),
                'status' => $this->input->post('status'),
            ];

            $status = $this->input->post('status');
            $kusioner = $this->db->query("SELECT * FROM kusioner WHERE status = '$status'")->result_array();
            foreach ($kusioner as $row) {
                $data['c'.$row['urutan']] = $this->input->post('c'.str_replace('/','_', str_replace(' ', '_', $status)).$row['urutan']);
            }
           
            $this->alumni_model->insert($data);
            $this->session->set_flashdata('berhasil', 'Alumni');
            redirect('alumni');
        }
    }

	function edit($id)
    {
        $data['judul'] = "Halaman Edit Alumni";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['alumni'] = $this->db->query("SELECT * FROM alumni WHERE id_user = '$id'")->row_array();
        $data['jurusan'] = $this->jurusan_model->get();
        $data['status'] = $this->db->query("SELECT * FROM kusioner GROUP BY status")->result_array();

        $this->form_validation->set_rules('nama_alumni', 'Nama alumni', 'required', [
            'required' => 'Nama alumni Wajib diisi',
        ]);
        $this->form_validation->set_rules('nisn', 'nisn', 'required', [
            'required' => 'nisn Wajib diisi',
        ]);
        $this->form_validation->set_rules('jk', 'jk', 'required', [
            'required' => 'Jenis Kelamin Wajib diisi',
        ]);
        $this->form_validation->set_rules('id_jurusan', 'Nama jurusan', 'required', [
            'required' => 'jurusan Wajib diisi',
        ]);
        $this->form_validation->set_rules('angkatan', 'angkatan', 'required', [
            'required' => ' angkatan Wajib diisi',
        ]);
        $this->form_validation->set_rules('tahun_lulus', 'tahun_lulus', 'required', [
            'required' => ' tahun_lulus Wajib diisi',
        ]);
        $this->form_validation->set_rules('status', 'status', 'required', [
            'required' => 'Status Wajib diisi',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("alumni/vw_alumni_edit", $data);
            $this->load->view("layout/footer");
        } else {
            $data = [
                'id_user' => $this->session->userdata('id'),
                'nama_alumni' => $this->input->post('nama_alumni'),
                'nisn' => $this->input->post('nisn'),
                'jk' => $this->input->post('jk'),
                'id_jurusan' => $this->input->post('id_jurusan'),
                'angkatan' => $this->input->post('angkatan'),
                'tahun_lulus' => $this->input->post('tahun_lulus'),
                'status' => $this->input->post('status'),
            ];

            $status = str_replace('_', ' ', $this->input->post('status'));
            $kusioner = $this->db->query("SELECT * FROM kusioner WHERE status = '$status'")->result_array();
            foreach ($kusioner as $row) {
                $data['c'.$row['urutan']] = $this->input->post('c'.$this->input->post('status').$row['urutan']);
            }

            $id = $this->input->post('id');
            $this->alumni_model->update(['id' => $id], $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data
            siswa Berhasil DiUbah!</div>');
            redirect('alumni');
        }
    } 

	function update() {

        $data = [
            'nama_alumni' => $this->input->post('nama_alumni'),
            'nisn' => $this->input->post('nisn'),
            'jk' => $this->input->post('jk'),
            'id_jurusan' => $this->input->post('id_jurusan'),
            'angkatan' => $this->input->post('angkatan'),
            'tahun_lulus' => $this->input->post('tahun_lulus'),
            'status' => $this->input->post('status'),
        ];
        $status = $this->input->post('status');
        $kusioner = $this->db->query("SELECT * FROM kusioner WHERE status = '$status'")->result_array();
        foreach ($kusioner as $row) {
            $data['c'.$row['urutan']] = $this->input->post('c'.str_replace('/','_', str_replace(' ', '_', $status)).$row['urutan']);
        }
		$id=$this->input->post('id');
		$this->alumni_model->update(['id'=> $id], $data);
        $this->session->set_flashdata('berhasil', 'Berhasil mengubah data.');
		redirect('alumni');
	}
}
