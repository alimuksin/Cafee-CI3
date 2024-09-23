<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();
        date_default_timezone_set('ASIA/JAKARTA');
        $this->load->model('m_login');
        $this->load->model('global_model', 'global');
    }
    function login(){
    	if ($this->session->userdata('is_admin') == true && $this->session->userdata('role_user') == 1) {
    		redirect('admin/home');
    	}else if ($this->session->userdata('is_kasir') == true && $this->session->userdata('role_user') == 2) {
    		redirect('kasir/home');
    	}else {
        	$data = konfigurasi('Dashboard');
        	$this->template->load('auth/template', 'auth/login-admin', $data);
        }
    }
    
    function proses_login(){
    	$email = $this->input->post('email');
		$pswd = $this->input->post('pswd');
		$where = array(
			'email_user' => $email,
			'pass_user' => md5($pswd)
			);
		$cek = $this->m_login->cek_login("user",$where)->num_rows();
		$db=$this->m_login->cek_login("user",$where)->row();
		
		if($cek > 0){
			if($pswd !== $db->pass_user) {
				$data_session['email_user']     = $db->email_user ;
                $data_session['name_user']      = $db->name_user ;
                $data_session['role_user']      = $db->role_user ;
                $data_session['id_user']        = $db->id_user ;

                if ($db->role_user == 2){
                    $data_session['is_kasir'] = TRUE;
                }else{
                    $data_session['is_admin'] = TRUE;
                }
	 
				$this->session->set_userdata($data_session);
	 			$this->session->set_flashdata('pesan', 'Selamat datang kembali <strong>'.$db->name_user.'</strong>');
	 			if ($db->role_user == 1) {
	 				redirect('admin');
	 			}else{
	 				redirect('admin');
	 			}
				
			}else{
				$this->session->set_flashdata('pesan', 'Login gagal: password salah!');
                redirect('admin','refresh');
			}
		}else{
			$this->session->set_flashdata('pesan', 'Login gagal: Email / password salah !');
            redirect('admin','refresh');
		}
    }
    function cek_admin(){
    	if (!$this->session->userdata('is_admin') == true) {
    		redirect('login');
    	}
    }
}