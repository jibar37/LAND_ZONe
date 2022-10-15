<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect(base_url());
        }
    }

    function index()
    {
        $data['tittle'] = 'ADMIN';
        $data['menu'] = 'Dashboard';
        $data['nama'] = $this->session->userdata('nama');

        $this->load->view('navbar\header', $data);
        $this->load->view('navbar\admin\__navbar', $data);
        $this->load->view('admin\dashboard');
        $this->load->view('navbar\footer');
    }

    public function signIn()
    {
        $data['tittle'] = 'ADMIN';
        $data['nama'] = $this->session->userdata('nama');

        $this->load->view('navbar\header', $data);
        $this->load->view('admin\dashboard', $data);
        $this->load->view('navbar\footer');
    }
    public function tambahUser()
    {
        $data['tittle'] = 'TAMBAH USER';
        $data['menu'] = 'Tambah User';
        $data['nama'] = $this->session->userdata('nama');

        $this->load->view('navbar\header', $data);
        $this->load->view('navbar\admin\__navbar', $data);
        $this->load->view('admin\tambahUser');
        $this->load->view('navbar\footer');
    }

    public function signOut()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
