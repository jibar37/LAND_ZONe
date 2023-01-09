<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MUser');
        $this->load->model('MMap');
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


        $temp = [
            [
                [
                    "-8.575810683455602",
                    "116.10691332163063"
                ],
                [
                    "-8.577507329454782",
                    "116.12357831655298"
                ],
                [
                    "-8.56121921525265",
                    "116.10931857862975"
                ],
                [
                    "-8.5729263678695",
                    "116.11704976184113"
                ]
            ]

        ];
        $data['tittle'] = 'ADMIN';
        $data['menu'] = 'Dashboard';
        $i = 0;
        $polygon = array();
        $dt = $this->MMap->getAll_polygon();
        if ($dt !== null) {
            foreach ($dt as $d => $value) {
                // $final[$d][$i] = [$value['coordinate']];
                $polygon[$i] = $value;
                $i++;
            }
        } else {
            $polygon = NULL;
        }

        $data['d'] = $polygon;
        $data['nama'] = $this->session->userdata('nama');

        $this->load->view('navbar/header', $data);
        $this->load->view('navbar/admin/__navbar', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('map/dashboardMap', $data);
        $this->load->view('navbar/footer');
    }

    public function tambahUser()
    {
        if ($this->session->userdata('level') == 2) {
            $list_username = $this->MUser->getAll_user();
            $data['username'] = $this->input->post('username');
            foreach ($list_username as $list => $value) {
                if ($data['username'] == $value['username']) {
                    $data['is_unique'] = false;
                    break;
                } else {
                    $data['is_unique'] = true;
                }
            }
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');
            $this->form_validation->set_rules('level', 'Level', 'required');

            $data['tittle'] = 'ADMIN';
            $data['menu'] = 'Tambah User';

            if ($this->form_validation->run() == FALSE || $data['is_unique'] == FALSE) {

                $data['username'] = $this->input->post('username');
                $data['password'] = $this->input->post('password');
                $data['nama'] = $this->input->post('nama');
                $data['level'] = $this->input->post('level');

                $this->load->view('navbar/header', $data);
                $this->load->view('navbar/admin/__navbar', $data);
                $this->load->view('admin/tambahUser', $data);
                $this->load->view('navbar/footer');
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

                $this->load->view('navbar/header', $data);
                $this->load->view('navbar/admin/__navbar', $data);
                $this->load->view('admin/editUser', $data);
                $this->load->view('navbar/footer');
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
                    $this->load->view('navbar/header', $data);
                    $this->load->view('navbar/admin/__navbar', $data);
                    $this->load->view('admin/edit', $data);
                    $this->load->view('navbar/footer');
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

                $this->load->view('navbar/header', $data);
                $this->load->view('navbar/admin/__navbar', $data);
                $this->load->view('admin/deleteUser', $data);
                $this->load->view('navbar/footer');
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

                $this->load->view('navbar/header', $data);
                $this->load->view('navbar/admin/__navbar', $data);
                $this->load->view('admin/forceLogout', $data);
                $this->load->view('navbar/footer');
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

                $this->load->view('navbar/header', $data);
                $this->load->view('navbar/admin/__navbar', $data);
                $this->load->view('admin/banUser', $data);
                $this->load->view('navbar/footer');
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

                $this->load->view('navbar/header', $data);
                $this->load->view('navbar/admin/__navbar', $data);
                $this->load->view('admin/unbanUser', $data);
                $this->load->view('navbar/footer');
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
        //     $list_username = $this->MUser->getAll_user();
        //     $data['username'] = $this->input->post('username');
        //     foreach ($list_username as $list => $value) {
        //         if ($data['username'] == $value['username']) {
        //             $data['is_unique'] = false;
        //             break;
        //         } else {
        //             $data['is_unique'] = true;
        //         }
        //         echo ($value['username']);
        //         echo (" ");
        //     }
        //     //var_dump($list_username);
        //     var_dump($data['username']);
        //     var_dump($data['is_unique']);
        $username = $this->session->userdata('username');
        $dt = $this->MUser->get_user($username);
        $user['password'] = $dt['password'];
        $oldPassword = $this->input->get('passwordLama');
        if (empty($oldPassword)) {
            echo ($user['password']);
            echo " kosong";
        } else {
            if ($user['password'] == $oldPassword) {
                echo ($user['password']);
                echo " berhasil";
            } else {
                echo ($user['password']);
                echo "password salah";
            }
        }
    }
    public function getAllPolygon()
    {
        $data = $this->MMap->getAll_polygon();
        foreach ($data as $d => $value) {
            $hasil = $value['coordinate'];
        }
        var_dump($hasil);
    }
    public function addPolygon()
    {
        $this->MMap->add_polygon();
        echo "tambah polygon";
    }
    public function editProfile()
    {
        $data['data'] = $this->MUser->getAll_user();
        $data['tittle'] = 'ADMIN';
        $user['nama'] = $this->session->userdata('nama');
        $user['username'] = $this->session->userdata('username');
        $user['level'] = $this->session->userdata('level');
        $username = $this->session->userdata('username');


        $this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('passwordBaru', 'Password Baru', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[passwordBaru]');

        $dt = $this->MUser->get_user($username);
        $user['password'] = $dt['password'];

        $data['menu'] = "Edit Profile";
        $data['user'] = $user;
        $oldPassword = $this->input->post('passwordLama');
        if (empty($oldPassword)) {
            $data['passwordSalah'] = false;
        } else {
            if ($user['password'] == $oldPassword) {
                $data['passwordSalah'] = false;
            } else {
                $data['passwordSalah'] = true;
            }
        }
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('navbar/header', $data);
            $this->load->view('navbar/admin/__navbar', $data);
            $this->load->view('admin/editProfile', $data);
            $this->load->view('navbar/footer');
        } else {
            if ($data['passwordSalah'] == true) {
                $this->load->view('navbar/header', $data);
                $this->load->view('navbar/admin/__navbar', $data);
                $this->load->view('admin/editProfile', $data);
                $this->load->view('navbar/footer');
            } else {
                $newPassword = $this->input->post('passwordBaru');
                $newNama = $this->input->post('nama');
                $d = [
                    "password" => $newPassword,
                    "nama" => $newNama,
                ];
                $this->MUser->update_user($username, $d);

                $this->session->set_flashdata('flash', 'berhasil');
                $this->session->set_userdata('nama', $newNama);
                redirect(base_url('admin/editProfile'));
            }
        }
    }
    public function deleteProfile()
    {
        $data['data'] = $this->MUser->getAll_user();
        $data['tittle'] = 'ADMIN';

        $username = $this->session->userdata('username');
        $data['menu'] = 'Hapus Profile';

        $this->load->view('navbar/header', $data);
        $this->load->view('navbar/admin/__navbar', $data);
        $this->load->view('admin/deleteProfile', $data);
        $this->load->view('navbar/footer');
    }
    public function delete()
    {
        $username = $this->session->userdata('username');
        $this->MUser->delete_user($username);
        $this->session->sess_destroy();
        redirect(base_url());
    }
    public function olahKawasan()
    {
        if ($this->session->userdata('level') == 3) {
            redirect(base_url());
        }

        $data['tittle'] = 'ADMIN';
        $data['menu'] = 'Dashboard';
        $dt = $this->MMap->getAll_polygon();
        $i = 0;
        $polygon = array();
        if ($dt !== null) {
            foreach ($dt as $d => $value) {
                // $final[$d][$i] = [$value['coordinate']];
                $polygon[$i] = $value;
                $i++;
            }
        } else {
            $polygon = NULL;
        }

        $data['d'] = $polygon;
        $data['nama'] = $this->session->userdata('nama');

        $this->load->view('navbar/header', $data);
        $this->load->view('navbar/admin/__navbar', $data);
        $this->load->view('admin/olahKawasan');
        $this->load->view('map/map', $data);
        $this->load->view('navbar/footer');
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
