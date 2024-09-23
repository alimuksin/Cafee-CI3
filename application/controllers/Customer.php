<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if ($this->session->userdata('is_login') !== TRUE) {
        	$this->session->set_flashdata('pesan', 'Sesi login anda berakhir, <br>silahkan login kembali');
        	redirect('login');
        }
        $this->load->model('shopping_cart_model');
    }

	public function home()
	{
		// $this->load->view('welcome_message');
		$data = konfigurasi('Pesan');
		$data["product"] = $this->shopping_cart_model->fetch_all();
        $this->template->load('template', 'home', $data);
	}

	function akun(){
		$data = konfigurasi('Akun');
		$data["product"] = $this->shopping_cart_model->fetch_all();
		$data["transaksiproduk"] = $this->shopping_cart_model->orderUser($this->session->userdata('id_customer'));
		$data['profile'] = $this->db->get_where('customer', array('id_customer' => $this->session->userdata('id_customer')))->row();
        $this->template->load('template', 'akun', $data);
        $this->load->view('sw.php');
	}

	function profile(){
		$where = array('id_customer'=> $this->input->post('id'));
		if ($this->input->post('password') == null) {
			$data = [
				'nama_customer' => $this->input->post('nama'),
				'email_customer' => $this->input->post('email'),
				'telp_customer' => $this->input->post('telp'),
			];
		}else{
			$data = [
				'nama_customer' => $this->input->post('nama'),
				'email_customer' => $this->input->post('email'),
				'telp_customer' => $this->input->post('telp'),
				'password_customer' => $this->input->post('password'),
			];
		}
		$this->db->update('customer', $data, $where);
		
		$this->session->set_flashdata('sukses',"Profile berhasil diperbarui");
        redirect('customer/akun');
	}

	// function bayar(){
	// 	$where = array('' => , );
	// }

	
}
