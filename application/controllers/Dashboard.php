<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		$data['tittle'] = 'LAND ZONe';
		$this->load->view('navbar\header', $data);
		$this->load->view('dashboard');
		$this->load->view('navbar\footer');
	}
	public function login()
	{
		// $username = $this->input->post('username');
		// $password = $this->input->post('password');
		// $where = array(
		// 	'username' => $username,
		// 	'password' => md5($password)
		// 	);
		// $cek = $this->m_login->cek_login("admin",$where)->num_rows();
		// if($cek > 0){

		// 	$data_session = array(
		// 		'nama' => $username,
		// 		'status' => "login"
		// 		);

		// 	$this->session->set_userdata($data_session);

		// 	redirect(base_url("admin"));

		// }else{
		// 	echo "Username dan password salah !";
		// }
	}
}
