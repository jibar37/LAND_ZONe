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
		}
	}
	public function index()
	{
		$data['username'] = "";
		$data['password'] = "";
		$data['tittle'] = 'LAND ZONe';
		$this->load->view('navbar\header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('navbar\footer');
	}
	function signIn()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = $this->MUser->login($username, $password);
		if ($data != null) {
			$nama = $data['nama'];
			$level = $data['level'];
			$data_session = array(
				'username' => $username,
				'nama' => $nama,
				'level' => $level,
				'status' => 'login'
			);
			$this->session->set_userdata($data_session);
			redirect(base_url("admin"));;
		} else {
			$data['username'] = $username;
			$data['password'] = $password;
			$data['tittle'] = 'LAND ZONe';
			$this->load->view('navbar\header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('navbar\footer');
		}


		// }else{
		// 	echo "Username dan password salah !";
		// }
	}
}
