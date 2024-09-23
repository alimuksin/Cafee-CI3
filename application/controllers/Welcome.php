<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('m_login');
    }

	public function index()
	{
		// $this->load->view('welcome_message');
		$data = konfigurasi('Aplikasi Kasir Cafe');
        $this->template->load('template', 'welcome', $data);
	}

	function pesan(){
		$data = konfigurasi('Aplikasi Kasir Cafe');
        $this->template->load('template', 'cara-pesan', $data);
	}

	function booking(){
		$data = konfigurasi('Aplikasi Kasir Cafe');
        $this->template->load('template', 'cara-booking', $data);
	}

	public function login(){
		$data = konfigurasi('Login');
        $this->template->load('auth/template', 'auth/login', $data);
	}

	// id_customer	nama_cutomer email_customer	telp_customer password_customer	status_customer	
	function proses_login(){
		$email = $this->input->post('email');
		$pswd = $this->input->post('pswd');
		$where = array(
			'email_customer' => $email,
			'password_customer' => $pswd
			);
		$cek = $this->m_login->cek_login("customer",$where)->num_rows();
		$db=$this->m_login->cek_login("customer",$where)->row();
		if($cek > 0){
			if($pswd == $db->password_customer) {
				$data_session = array(
					'email_customer' => $db->email_customer,
					'nama_customer' => $db->nama_customer,
					'telp_customer' => $db->telp_customer,
					'status_customer' => $db->status_customer,
					'id_customer' => $db->id_customer,
					'is_login'=>TRUE,
				);
	 
				$this->session->set_userdata($data_session);
	 			$this->session->set_flashdata('pesan', 'Selamat datang kembali <strong>'.$db->nama_customer.'</strong>');
				redirect("customer/home");
				
			}else{
				$this->session->set_flashdata('pesan', 'Login gagal: password salah!');
                redirect('login','refresh');
			}
		}else{
			$this->session->set_flashdata('pesan', 'Login gagal: Email salah !');
            redirect('login','refresh');
		}
	}

	public function daftar(){
		$data = konfigurasi('Dashboard');
        $this->template->load('auth/template', 'auth/daftar', $data);
	}

	public function proses_daftar(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$telp = $this->input->post('telp');
		$pswd = $this->input->post('pswd');

		$simpan = array(
			'nama_customer'		=> $name,
			'email_customer'	=> $email,
			'telp_customer'		=> $telp,
			'password_customer'	=> $pswd,
			'status_customer'	=> 1,
		);
		$this->db->insert('customer', $simpan);
		$this->session->set_flashdata('pesan', 'Pendaftaran Berhasil');
        redirect('login','refresh');

	}
 
	function logout(){
		if ($this->session->userdata('is_login') == TRUE) {
			$this->session->sess_destroy();
		}else{
			$this->session->sess_destroy();
		}
		redirect(base_url('login'));
	}
}
