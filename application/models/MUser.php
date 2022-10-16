<?php

use Firebase\Firebase;

class MUser extends CI_model
{
    var $url = 'https://land-zone-default-rtdb.firebaseio.com';
    var $secret = "DZ1F98TXlnnjXqc64NBPi0R6PNA9WyU2tolALmmI";

    public function validation($username, $password, $data)
    {
        $dUsername = $data['username'];
        $dPassword = $data['password'];

        if ($username == $dUsername && $password == $dPassword) {
            echo ('berhasil login');
            return true;
        } else {
            return false;
        }
    }
    public function add_user()
    {
        $fb = Firebase::initialize($this->url, $this->secret);

        $d = [
            "username" => $this->input->post('username'),
            "password" => $this->input->post('password'),
            "nama" => $this->input->post('nama'),
            "level" => $this->input->post('level'),
        ];
        $a = $fb->set('/user/' . $this->input->post('username'), $d);
        var_dump($a);
    }
    public function login($username, $password)
    {
        $fb = Firebase::initialize($this->url, $this->secret);
        $a = $fb->get('/user/' . $username);
        $hasil = null;

        if ($a == null) {
            $hasil = null;
        } else {
            $cek = $this->validation($username, $password, $a);
            if ($cek == true) {
                $hasil = $a;
            } else {
                $hasil = null;
            }
        }
        return $hasil;
    }
    public function getAll_user()
    {
        $fb = Firebase::initialize($this->url, $this->secret);
        $a = $fb->get('/user');
        return $a;
    }
    public function get_user($username)
    {
        $fb = Firebase::initialize($this->url, $this->secret);
        $a = $fb->get('/user/' . $username);
        return $a;
    }
    public function update_user($username)
    {
        $fb = Firebase::initialize($this->url, $this->secret);
        $d = [
            "username" => $this->input->post('username'),
            "password" => $this->input->post('password'),
            "nama" => $this->input->post('nama'),
            "level" => $this->input->post('level'),
        ];
        $a = $fb->update('/user/' . $username, $d);
    }
    public function delete_user($username)
    {
        $key = $this->input->get("key");
        $fb = Firebase::initialize($this->url, $this->secret);

        $a = $fb->delete('/user/' . $username);
        return $a;
    }
}
