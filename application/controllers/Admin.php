<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect(base_url());
        } else {
            $this->load->library('form_validation');
            $this->load->model('MUser');
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
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');
        $this->form_validation->set_rules('level', 'Level', 'required');

        $data['tittle'] = 'TAMBAH USER';
        $data['menu'] = 'Tambah User';

        if ($this->form_validation->run() == FALSE) {
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->input->post('password');
            $data['nama'] = $this->input->post('nama');
            $data['level'] = $this->input->post('level');
            $this->load->view('navbar\header', $data);
            $this->load->view('navbar\admin\__navbar', $data);
            $this->load->view('admin\tambahUser', $data);
            $this->load->view('navbar\footer');
        } else {
            $data = $this->MUser->add_user();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect(base_url('admin/tambahUser'));
        }
    }

    public function signOut()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
