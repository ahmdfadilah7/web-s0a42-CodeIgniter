<?php
defined('BASEPATH') or exit('No direct script access allowed');
class firstpage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('slider_model');
        $this->load->model('about_model');
    }
    function index()
    {
        // $data['judul'] = "Halaman Alumni";
        // $data['alumni'] = $this->alumni_model->get();
        $data['slider'] = $this->slider_model->get();
        $data['about'] = $this->about_model->get();
        $this->load->view("layout/first_header");
        $this->load->view("vw_firstpage", $data);
        $this->load->view("layout/first_footer");
    }
}