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
            echo ('login gagal');
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
    public function update_data()
    {
        $key = $this->input->get("key");
        $fb = Firebase::initialize($this->url, $this->secret);
        $d = [
            "notif" => "1",
            "tipe" => "0",
        ];
        $a = $fb->update('/data/' . $key, $d);
        echo json_encode($a);
    }
    public function delete_data()
    {
        $key = $this->input->get("key");
        $fb = Firebase::initialize($this->url, $this->secret);
        $d = [
            "notif" => "1",
            "tipe" => "0",
        ];
        $a = $fb->delete('/data/' . $key, $d);
        echo json_encode($a);
    }
}
