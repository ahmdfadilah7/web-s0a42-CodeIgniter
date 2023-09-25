<?php 
defined ('BASEPATH') or exit ('No direct script access allowed!');

class data_alumni_model extends CI_Model
{
    
    public $table = 'alumni';
    public $id = 'id';

    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {   $this->db->select('alumni.* , jurusan.nama_jurusan as jurusan');
        $this->db->from('alumni');
        $this->db->join('jurusan','alumni.id_jurusan = jurusan.id_jurusan');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getById($id)
    {
        $this->db->select('alumni.* , jurusan.nama_jurusan as jurusan');
        $this->db->from($this->table);
        $this->db->join('jurusan','alumni.id_jurusan = jurusan.id_jurusan');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getByjurusan($nama_jurusan)
    {
        $this->db->from($this->table);
        $this->db->where('nama_jurusan', $nama_jurusan);
        $query = $this->db->get();
        return $query->row_array(); 
    }
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}