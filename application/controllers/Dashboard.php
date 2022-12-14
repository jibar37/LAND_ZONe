<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username')) {
			redirect(base_url('admin'));
		} else {
			$this->load->model('MUser');
			$this->load->model('MMap');
		}
	}
	public function index()
	{
		$data['username'] = "";
		$data['password'] = "";
		$data['status'] = "";
		$dt = $this->MMap->getAll_polygon();
		$dtLength = count($dt);
		for ($i = 0; $i < $dtLength; $i++) {
		}
		$i = 0;
		$polygon = array();
		foreach ($dt as $d => $value) {
			// $final[$d][$i] = [$value['coordinate']];
			$polygon[$i] = $value;
			$i++;
		}

		$data['d'] = $polygon;
		$data['tittle'] = 'LAND ZONe';
		$this->load->view('navbar/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('map/dashboardMap', $data);
		$this->load->view('navbar/footer');
	}
	function signIn()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$dt = $this->MMap->getAll_polygon();
		$dtLength = count($dt);
		for ($i = 0; $i < $dtLength; $i++) {
		}
		$i = 0;
		$polygon = array();
		foreach ($dt as $d => $value) {
			// $final[$d][$i] = [$value['coordinate']];
			$polygon[$i] = $value;
			$i++;
		}

		$data['d'] = $polygon;
		$d = $this->MUser->login($username, $password);
		if ($d != null) {
			if ($d['status'] == "1") {
				$nama = $d['nama'];
				$level = $d['level'];
				$status = $d['status'];
				$login = $d['login'];
				$data_session = array(
					'username' => $username,
					'nama' => $nama,
					'level' => $level,
					'status' => $status,
					'login' => $login
				);
				$this->session->set_userdata($data_session);
				$d = [
					"login" => "1",
				];
				$this->MUser->update_user($username, $d);
				redirect(base_url("admin"));;
			} else {
				$data['username'] = $username;
				$data['password'] = $password;
				$data['status'] = $d['status'];
				$data['tittle'] = 'LAND ZONe';
				$this->load->view('navbar/header', $data);
				$this->load->view('dashboard', $data);
				$this->load->view('map/dashboardMap', $data);
				$this->load->view('navbar/footer');
			}
		} else {
			$data['username'] = $username;
			$data['password'] = $password;
			$data['status'] = "";
			$data['tittle'] = 'LAND ZONe';
			$this->load->view('navbar/header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('map/dashboardMap', $data);
			$this->load->view('navbar/footer');
		}


		// }else{
		// 	echo "Username dan password salah !";
		// }
	}
}
