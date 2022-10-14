<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $isSession = $this->session->userdata('nama');
        if (empty($isSession)) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data_session = array(
                'nama' => $username,
                'status' => "login"
            );
            $this->session->set_userdata($data_session);
            $data['nama'] = $this->session->userdata('nama');

            $data['tittle'] = 'ADMIN';
            $this->load->view('navbar\header', $data);
            $this->load->view('admin\dashboard', $data);
            $this->load->view('navbar\footer');
        } else {
            $data['tittle'] = 'ADMIN';
            $data['nama'] = $this->session->userdata('nama');

            $this->load->view('navbar\header', $data);
            $this->load->view('admin\dashboard', $data);
            $this->load->view('navbar\footer');
        }
    }
    public function signIn()
    {
        // $username = $this->input->post('username');
        // $password = $this->input->post('password');
        // $where = array(
        // 	'username' => $username,
        // 	'password' => md5($password)
        // 	);
        // $cek = $this->m_login->cek_login("admin",$where)->num_rows();
        // if($cek > 0){

        // $data_session = array(
        //     'nama' => $username,
        //     'status' => "login"
        // );

        // $this->session->set_userdata($data_session);

        // 	redirect(base_url("admin"));

        // }else{
        // 	echo "Username dan password salah !";
        // }
        $data['tittle'] = 'ADMIN';
        $data['nama'] = $this->session->userdata('nama');

        $this->load->view('navbar\header', $data);
        $this->load->view('admin\dashboard', $data);
        $this->load->view('navbar\footer');
    }

    public function signOut()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
