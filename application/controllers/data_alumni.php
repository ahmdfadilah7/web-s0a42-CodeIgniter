<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class data_alumni extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != TRUE) {
            redirect('auth');
        }
        $this->load->model('data_alumni_model');
        $this->load->model('jurusan_model');
        $this->load->model('auth_model');
    }
    
    public function index()
    {
        $data['judul'] = "Halaman Alumni";

        $id_jurusan = $this->input->post('jurusan');
        $tahun = $this->input->post('tahun_lulus');
        $submit = $this->input->post('submit');
        if ($submit == 'Filter') {
            if ($this->input->post('jurusan') <> '' && $this->input->post('tahun_lulus') <> '') {
                $data['alumni'] = $this->db->query(
                        "SELECT 
                            alumni.*, jurusan.nama_jurusan as jurusan 
                        FROM alumni 
                        JOIN jurusan ON alumni.id_jurusan=jurusan.id_jurusan 
                        WHERE alumni.id_jurusan = '$id_jurusan' AND tahun_lulus = '$tahun'
                    ")->result_array();
            } elseif ($this->input->post('jurusan') <> '') {
                $data['alumni'] = $this->db->query(
                    "SELECT 
                        alumni.*, jurusan.nama_jurusan as jurusan 
                    FROM alumni 
                    JOIN jurusan ON alumni.id_jurusan=jurusan.id_jurusan 
                    WHERE alumni.id_jurusan = '$id_jurusan'
                ")->result_array();
            } elseif ($this->input->post('tahun_lulus') <> '') {
                $data['alumni'] = $this->db->query(
                    "SELECT 
                        alumni.*, jurusan.nama_jurusan as jurusan 
                    FROM alumni 
                    JOIN jurusan ON alumni.id_jurusan=jurusan.id_jurusan 
                    WHERE tahun_lulus = '$tahun'
                ")->result_array();
            } else {
                $data['alumni'] = $this->data_alumni_model->get();
            }
        } elseif ($submit == 'Export') {
            if ($this->input->post('jurusan') <> '' && $this->input->post('tahun_lulus') <> '') {
                $alumni = $this->db->query(
                        "SELECT 
                            alumni.*, jurusan.nama_jurusan as jurusan 
                        FROM alumni 
                        JOIN jurusan ON alumni.id_jurusan=jurusan.id_jurusan 
                        WHERE alumni.id_jurusan = '$id_jurusan' AND tahun_lulus = '$tahun'
                    ")->result_array();
            } elseif ($this->input->post('jurusan') <> '') {
                $alumni = $this->db->query(
                    "SELECT 
                        alumni.*, jurusan.nama_jurusan as jurusan 
                    FROM alumni 
                    JOIN jurusan ON alumni.id_jurusan=jurusan.id_jurusan 
                    WHERE alumni.id_jurusan = '$id_jurusan'
                ")->result_array();
            } elseif ($this->input->post('tahun_lulus') <> '') {
                $alumni = $this->db->query(
                    "SELECT 
                        alumni.*, jurusan.nama_jurusan as jurusan 
                    FROM alumni 
                    JOIN jurusan ON alumni.id_jurusan=jurusan.id_jurusan 
                    WHERE tahun_lulus = '$tahun'
                ")->result_array();
            } else {
                $alumni = $this->data_alumni_model->get();
            }

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="DataAlumni.xls"');
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama');
            $sheet->setCellValue('C1', 'NISN');
            $sheet->setCellValue('D1', 'Jurusan');
            $sheet->setCellValue('E1', 'Angkatan');
            $sheet->setCellValue('F1', 'Tahun Lulus');
            $sheet->setCellValue('G1', 'Status');

            $i=2;
            $no=1;
            foreach ($alumni as $row) {
                $status = str_replace('_', ' ',$row['status']);
                $sheet->setCellValue('A'.$i, $no);
                $sheet->setCellValue('B'.$i, $row['nama_alumni']);
                $sheet->setCellValue('C'.$i, $row['nisn']);
                $sheet->setCellValue('D'.$i, $row['jurusan']);
                $sheet->setCellValue('E'.$i, $row['angkatan']);
                $sheet->setCellValue('F'.$i, $row['tahun_lulus']);
                $sheet->setCellValue('G'.$i, $status);
                $i++;
                $no++;
            }

            $writer = new Xls($spreadsheet);
            $writer->save("php://output");

        } else {
            $data['alumni'] = $this->data_alumni_model->get();
        }


        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['jurusan'] = $this->jurusan_model->get();
        $this->load->view("layout/header", $data);
        $this->load->view("data_alumni/vw_data_alumni", $data);
        $this->load->view("layout/footer");
    }

    public function view($id)
    {
        $alumni = $this->data_alumni_model->getById($id);
        $data = [
            'nisn' => $alumni['nisn'],
            'nama' => $alumni['nama_alumni'],
            'jk' => $alumni['jk'],
            'jurusan' => $alumni['jurusan'],
            'angkatan' => $alumni['angkatan'],
            'tahun' => $alumni['tahun_lulus'],
            'status' => str_replace('_', ' ', $alumni['status']),
        ];

        $status = str_replace('_', ' ', $alumni['status']);
        $kusioner = $this->db->query("SELECT * FROM kusioner WHERE status = '$status'")->result_array();
        foreach ($kusioner as $row) {
            $data['kusioner'.$row['urutan']] = $row['kusioner'];
            $data['c'.$row['urutan']] = $alumni['c'.$row['urutan']];
        }

        echo json_encode($data);
    }

    public function delete($id)
    {
        $this->data_alumni_model->delete($id);
        $this->session->set_flashdata('berhasil', 'Data Alumni berhasil dihapus!!');
        redirect('data_alumni');
    }
}
