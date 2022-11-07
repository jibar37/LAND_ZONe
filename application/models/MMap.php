<?php

use Firebase\Firebase;

class MMap extends CI_model
{
    var $url = 'https://land-zone-default-rtdb.firebaseio.com';
    var $secret = "DZ1F98TXlnnjXqc64NBPi0R6PNA9WyU2tolALmmI";


    public function validation($username, $password, $data)
    {
        $dUsername = $data['username'];
        $dPassword = $data['password'];

        if ($username == $dUsername && $password == $dPassword) {
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
            "status" => "1",
            "login" => "0",
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
    public function update_user($username, $d)
    {
        $fb = Firebase::initialize($this->url, $this->secret);
        $a = $fb->update('/user/' . $username, $d);
    }
    public function delete_user($username)
    {
        $key = $this->input->get("key");
        $fb = Firebase::initialize($this->url, $this->secret);

        $a = $fb->delete('/user/' . $username);
        return $a;
    }
    public function add_polygon()
    {
        $fb = Firebase::initialize($this->url, $this->secret);
        $data = $this->input->post('data');
        var_dump($data);
        $fb->delete('/map');
        foreach ($data as $dt => $value) {
            $d = $value;
            $fb->set('/map/polygon/' . $d['id'], $d);
        }
        // var_dump($a);
    }
    public function getAll_polygon()
    {
        $fb = Firebase::initialize($this->url, $this->secret);
        $a = $fb->get('/map/polygon');
        function myFilter($var)
        {
            return ($var !== NULL && $var !== FALSE && $var !== "");
        }
        $a = array_filter($a, "myFilter");
        return $a;
    }
}
