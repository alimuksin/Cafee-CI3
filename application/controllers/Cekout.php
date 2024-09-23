<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: GET, OPTIONS');

class Cekout extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') !== TRUE) {
        	$this->session->set_flashdata('pesan', 'Sesi login anda berakhir, <br>silahkan login kembali');
        	redirect('login');
        }
        date_default_timezone_set("Asia/Jakarta");
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('shopping_cart_model');
    }

	public function index()
	{
		$data = konfigurasi('Checkout');
		$data["product"] = $this->shopping_cart_model->fetch_all();
		$data["meja"] = $this->shopping_cart_model->getmeja();
        $this->template->load('template', 'checkout/data', $data);
	}

 	function konfirmasi(){
 		$id_checkout = random_string('basic');
 		if ($this->input->post('id_customer') == 0) {
 			$user_checkout = 0;
 			$id_customer = 0;
 		}else{
 			$user_checkout = 1;
 			$id_customer = $this->session->userdata('id_customer');
 		}
		$cekpesansekarang = isset($_POST['pesansekarang']);
		
		if ($cekpesansekarang){
			$data = array(
				'id_checkout'		=> $id_checkout,
				'id_customer'		=> $this->session->userdata('id_customer'),
				'meja_checkout'		=> $this->input->post('meja'),
				'waktu_checkout'	=> date('Y-m-d H:i:s'),
				'catatan'			=> $this->input->post('catatan'),
				'total_checkout'	=> $this->input->post('total_checkout'),
				'sekarang' 	=> 1,
				'waktu' 	=> date('Y-m-d'),
				'tanggal' 	=> date('H:i:s'),
			);
		}else{
			$data = array(
				'id_checkout'		=> $id_checkout,
				'id_customer'		=> $this->session->userdata('id_customer'),
				'meja_checkout'		=> $this->input->post('meja'),
				'waktu_checkout'	=> date('Y-m-d H:i:s'),
				'catatan'			=> $this->input->post('catatan'),
				'total_checkout'	=> $this->input->post('total_checkout'),
				'sekarang' 	=> 0,
				'waktu' 	=> $this->input->post('waktu'),
				'tanggal' 	=> $this->input->post('tanggal'),
			);
		}
		
		
		$this->db->insert('checkout',$data);
	 	$result = array();

	  	foreach ($_POST['produk'] as $key => $val) {
			$result[] = array(
				'id_checkout'		=> $id_checkout,
		        'id_produk' 		=> $_POST['produk'][$key],
		        'jml_checkout' 		=> $_POST['qty'][$key],
			);      
	    }

	    $this->cart->destroy();
	    $this->session->set_userdata($data);
	    $this->session->set_userdata($result);
	    $this->db->insert_batch('checkoutproduk',$result);
	    $this->session->set_flashdata('sukses', '');
	    redirect('cekout/bayar/'.$id_checkout);
	    $this->session->set_flashdata('sukses', '');
	    redirect('cekout/bayar/'.$id_checkout);
 	}

 	function bayar($order_id){
 		$data = konfigurasi('Pembayaran');
 		$where = array('id_checkout' => $order_id);
 		
		$data['dataorder'] 		= $this->shopping_cart_model->getOrder($where);
		$data['datauser'] 		= $this->shopping_cart_model->getUserOrder($where);
		$data['totalOrder'] 	= $this->db->get_where('checkout', $where)->row();
		$data['ctr'] 			= $this->db->get_where('transaksi', $where)->num_rows();
		$data['tr'] 			= $this->db->get_where('transaksi', $where)->row();

		// server tripay
		$getTripay = $this->db->get('konfigurasi')->row();
    	if ($getTripay->tripay_server == 0){
			$urlMethodPembyaran = 'https://tripay.co.id/api-sandbox/merchant/payment-channel';
		} else{
			$urlMethodPembyaran = 'https://tripay.co.id/api/merchant/payment-channel';
		}

		$apiKey = $getTripay->tripay_api;
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_FRESH_CONNECT  => true,
		  CURLOPT_URL            => $urlMethodPembyaran,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_HEADER         => false,
		  CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
		  CURLOPT_FAILONERROR    => false,
		  CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
		));

		$response = curl_exec($curl);
		$error = curl_error($curl);

		curl_close($curl);

		$data['tp'] = json_decode($response, true);
		
        $this->template->load('template', 'checkout/bayar', $data);

 	}

 	
}
