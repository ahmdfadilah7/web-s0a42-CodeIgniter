<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class user extends CI_Controller
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
        $data['judul'] = "Halaman User";
        $data['user1'] = $this->auth_model->get();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view("layout/header",$data);
        $this->load->view("user/vw_user",$data);
        $this->load->view("layout/footer",$data);
    }
    function tambah()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_message('required', '{field} wajib diisi!!');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->session->set_flashdata('gagal', 'User Baru gagal ditambahkan!');
            redirect('user');
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
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama' => $this->input->post('nama'),
                'role' => $this->input->post('role'),
                'foto' => $foto,
            ];
            $this->auth_model->insert($data);
            $this->session->set_flashdata('berhasil', 'User Baru Berhasil Ditambah!');
            redirect('user');
        }
        
    }
    
	function edit($id)
	{
			$data['user'] = $this->auth_model->getById($id);
			$this->load->view("layout/header", $data);
			$this->load->view("user/edit_user", $data);
			$this->load->view("layout/footer");
    }

    function update(){
       
        $data = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'role' => $this->input->post('role'),
        ];
            $id = $this->input->post('id');
			$this->auth_model->update(['id' => $id], $data);
			$this->session->set_flashdata('message', 'Data User Berhasil Diubah!');
			redirect('user');
    }

    public function delete($id)
    {
        $this->auth_model->delete($id);
        echo 'Deleted successfully.';
    }

    public function import_excel(){
        $file = $_FILES['fileExcel']['name'];
		$dname = explode(".", $_FILES['fileExcel']['name']);
        $ext = end($dname);
        if ($ext == 'xlsx' || $ext == 'xls') {
            if ($ext == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['fileExcel']['tmp_name']);
            $contact = $spreadsheet->getActiveSheet()->toArray();
            foreach ($contact as $key => $value) {
                if ($key == 0 || $key == 1) {
                    continue;
                }
                $data = [
                    'nama' => $value[1],
                    'username' => $value[3],
                    'password' => password_hash($value[3], PASSWORD_DEFAULT),
                    'role' => 'alumni'
                ];
                $this->auth_model->insert($data);
            }
            $this->session->set_flashdata('berhasil', 'Data berhasil diimport!!');
            redirect('user');
        } else {
            $this->session->set_flashdata('gagal', 'Format file tidak didukung.');
            redirect('user');
        }
	}

}