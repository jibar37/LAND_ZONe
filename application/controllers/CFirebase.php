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
		$this->load->model('MUser');
	}
	public function index()
	{
		$this->load->view('firebase');
	}
	public function add_data()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->MUser->add_user($username, $password);
	}
	public function get_data()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = $this->MUser->get_user($username);
		if ($data == null) {
			// redirect(base_url());
		} else {
			$cek = $this->MUser->validation($username, $password, $data);
			if ($cek == true) {
				$data_session = array(
					'username' => $username,
					'status' => 'login'
				);
				$this->session->set_userdata($data_session);
				redirect(base_url("admin"));
			} else {
				var_dump($data);
				// redirect(base_url());
			}
		}
		var_dump($data);
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
