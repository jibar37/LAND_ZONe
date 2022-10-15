<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Firebase\Firebase;


class CFirebase extends CI_Controller
{
	var $url = 'https://land-zone-default-rtdb.firebaseio.com';
	var $secret = "DZ1F98TXlnnjXqc64NBPi0R6PNA9WyU2tolALmmI";

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('Mdata');


	}
	public function index()
	{
		$this->load->view('firebase');
	}
	public function add_data()
	{
		$fb = Firebase::initialize($this->url, $this->secret);
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$d = [
			"username" => $username,
			"password" => $password,
		];
		$a = $fb->push('/data', $d);
		echo json_encode($a);
	}
	public function get_data()
	{
		$fb = Firebase::initialize($this->url, $this->secret);
		$a = $fb->get('/data');
		echo json_encode($a);
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
