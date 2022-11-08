<?php

use Firebase\Firebase;

class MMap extends CI_model
{
    var $url = 'https://land-zone-default-rtdb.firebaseio.com';
    var $secret = "DZ1F98TXlnnjXqc64NBPi0R6PNA9WyU2tolALmmI";

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
