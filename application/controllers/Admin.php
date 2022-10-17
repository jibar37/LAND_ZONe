<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MUser');
        $this->load->library('form_validation');
        if (!$this->session->userdata('level')) {
            redirect(base_url());
        } else {
            $d_username = $this->session->userdata('username');
            $d = $this->MUser->get_user($d_username);

            if ($d['login'] == "0" || $d['status'] == "0") {
                $this->session->sess_destroy();
                redirect(base_url());
            }
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
        $this->load->view('map\map', $data);
        $this->load->view('navbar\footer');
    }

    public function tambahUser()
    {
        if ($this->session->userdata('level') == 2) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');
            $this->form_validation->set_rules('level', 'Level', 'required');

            $data['tittle'] = 'ADMIN';
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
                $this->session->set_flashdata('flash', 'berhasil');
                redirect(base_url('admin/tambahUser'));
            }
        } else {
            redirect(base_url('admin'));
        }
    }
    public function editUser()
    {
        if ($this->session->userdata('level') == 2) {
            $data['data'] = $this->MUser->getAll_user();
            $data['tittle'] = 'ADMIN';
            $data['nama'] = $this->session->userdata('nama');
            $username = $this->input->get('username');
            if ($username == "") {
                $data['menu'] = 'Edit User';

                $this->load->view('navbar\header', $data);
                $this->load->view('navbar\admin\__navbar', $data);
                $this->load->view('admin\editUser', $data);
                $this->load->view('navbar\footer');
            } else {
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric_spaces');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');
                $this->form_validation->set_rules('level', 'Level', 'required');

                $user = $this->MUser->get_user($username);
                $data['menu'] = $user['nama'];
                $data['user'] = $user;

                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('navbar\header', $data);
                    $this->load->view('navbar\admin\__navbar', $data);
                    $this->load->view('admin\edit', $data);
                    $this->load->view('navbar\footer');
                } else {
                    $d = [
                        "username" => $this->input->post('username'),
                        "password" => $this->input->post('password'),
                        "nama" => $this->input->post('nama'),
                        "level" => $this->input->post('level'),
                    ];
                    $this->MUser->update_user($username, $d);

                    $this->session->set_flashdata('flash', 'berhasil');
                    redirect(base_url('admin/editUser?username=') . $username);
                }
            }
        } else {
            redirect(base_url('admin'));
        }
    }
    public function deleteUser()
    {
        if ($this->session->userdata('level') == 2) {
            $data['data'] = $this->MUser->getAll_user();
            $data['tittle'] = 'ADMIN';

            $username = $this->input->get('username');
            if ($username == "") {
                $data['menu'] = 'Hapus User';

                $this->load->view('navbar\header', $data);
                $this->load->view('navbar\admin\__navbar', $data);
                $this->load->view('admin\deleteUser', $data);
                $this->load->view('navbar\footer');
            } else {
                $d = $this->MUser->delete_user($username);
                $this->session->set_flashdata('flash', 'berhasil');
                redirect(base_url('admin/deleteUser') . $d);
            }
        } else {
            redirect(base_url('admin'));
        }
    }
    public function forceLogout()
    {
        if ($this->session->userdata('level') == 2) {
            $data['data'] = $this->MUser->getAll_user();
            $data['tittle'] = 'ADMIN';

            $username = $this->input->get('username');
            if ($username == "") {
                $data['menu'] = 'Force Logout';

                $this->load->view('navbar\header', $data);
                $this->load->view('navbar\admin\__navbar', $data);
                $this->load->view('admin\forceLogout', $data);
                $this->load->view('navbar\footer');
            } else {
                $d = [
                    "login" => "0",
                ];
                $this->MUser->update_user($username, $d);
                $this->session->set_flashdata('flash', 'berhasil');
                redirect(base_url('admin/forceLogout'));
            }
        } else {
            redirect(base_url('admin'));
        }
    }
    public function banUser()
    {
        if ($this->session->userdata('level') == 2) {
            $data['data'] = $this->MUser->getAll_user();
            $data['tittle'] = 'ADMIN';

            $username = $this->input->get('username');
            if ($username == "") {
                $data['menu'] = 'BAN USER';

                $this->load->view('navbar\header', $data);
                $this->load->view('navbar\admin\__navbar', $data);
                $this->load->view('admin\banUser', $data);
                $this->load->view('navbar\footer');
            } else {
                $d = [
                    "status" => "0",
                ];
                $this->MUser->update_user($username, $d);
                $this->session->set_flashdata('flash', 'berhasil');
                redirect(base_url('admin/banUser'));
            }
        } else {
            redirect(base_url('admin'));
        }
    }
    public function unbanUser()
    {
        if ($this->session->userdata('level') == 2) {
            $data['data'] = $this->MUser->getAll_user();
            $data['tittle'] = 'ADMIN';

            $username = $this->input->get('username');
            if ($username == "") {
                $data['menu'] = 'UNBAN USER';

                $this->load->view('navbar\header', $data);
                $this->load->view('navbar\admin\__navbar', $data);
                $this->load->view('admin\unbanUser', $data);
                $this->load->view('navbar\footer');
            } else {
                $d = [
                    "status" => "1",
                ];
                $this->MUser->update_user($username, $d);
                $this->session->set_flashdata('flash', 'berhasil');
                redirect(base_url('admin/unbanUser'));
            }
        } else {
            redirect(base_url('admin'));
        }
    }
    public function test()
    {
        // $d = $this->MUser->delete_user('q');
        $d = true;
        echo $d;
    }
    public function signOut()
    {
        $username = $this->session->userdata('username');
        $d = [
            "login" => "0",
        ];
        $this->MUser->update_user($username, $d);
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
