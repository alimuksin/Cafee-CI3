<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: GET, OPTIONS');
class Bayar extends CI_Controller {
	public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        if ($this->session->userdata('is_login') !== TRUE) {
        	$this->session->set_flashdata('pesan', 'Sesi login anda berakhir, <br>silahkan login kembali');
        	redirect('login');
        }
        $this->load->model('global_model', 'global');
        $this->load->model('shopping_cart_model');
    }


    public function manual(){
    	$data = konfigurasi('Bayar');
		
		$orderId = $this->input->post('orderId');
		$where = array('id_checkout' => $orderId);
		$new_time = time() + (1 * 60);
 		
		$dataorder = $this->shopping_cart_model->getOrder($where);
		$datauser = $this->shopping_cart_model->getUserOrder($where);
		$totalOrder = $this->db->get_where('checkout', $where)->row();
		$simpandata = [
			'order_id'	 				=> $orderId,
			'total_transaksi' 			=> '$totalOrder->total_checkout',
			'payment_transaksi'			=> 'Cash',
			'waktu_transaksi' 			=> date('Y-m-d H:i:s'),
			'expired_time' 				=> $new_time,
			'payment_name' 				=> 'Cash',
			'id_checkout'				=> $orderId,
			'pay_code'					=> 0,
		   
		   'status_transaksi'			=> 'UNPAID',
		   'byr_admin'					=> 0,
		   'merchan_type' 				=> 'Cash',
		   'jenis_transaksi' 			=> 2,
	   ];
	   	$simpan = $this->db->insert('transaksi',$simpandata);
    	
    	$this->template->load('template', 'checkout/manual', $data);
    }


    function otomatis(){
    	$datakonfig = konfigurasi('Pembayaran');
    	$getTripay = $this->db->get('konfigurasi')->row();
    	
    	// server tripay
    	if ($getTripay->tripay_server == 0){
			$urlPembayaran = 'https://tripay.co.id/api-sandbox/transaction/create';
		} else{
			$urlPembayaran = 'https://tripay.co.id/api/transaction/create';
		}

		// ambil data produk
		$orderId = $this->input->post('orderId');
		$where = array('id_checkout' => $orderId);
 		
		$dataorder = $this->shopping_cart_model->getOrder($where);
		$datauser = $this->shopping_cart_model->getUserOrder($where);
		$totalOrder = $this->db->get_where('checkout', $where)->row();

    	$apiKey       		= $getTripay->tripay_api;
		$privateKey   		= $getTripay->tripay_private;
		$merchantCode 		= $getTripay->tripay_code;
		$merchantRef  		= $orderId;
		$amount       		= $totalOrder->total_checkout+$getTripay->byr_admin;

		$nametransaksi 		= 'ORDER - '.$orderId;
		$customerName		= $datauser->nama_customer;
		$customeremail		= $datauser->email_customer;


		// waktu bayar 5 menit dr sekrang
		$new_time = time() + (1 * 60);

		$data = [
		    'method'         => $this->input->post("method"),
		    'merchant_ref'   => $merchantRef,
		    'amount'         => $amount,
		    'customer_name'  => $customerName,
		    'customer_email' => $customeremail,
		    'order_items'    => [
		        [
		            'sku'         => 'FB-00',
		            'name'        => $nametransaksi,
                    'price'       => $totalOrder,
                    'quantity'    => 1,
		        ],
		        [
		            'sku'         => 'AA-00',
                    'name'        => 'Biaya Admin',
                    'price'       =>  $getTripay->byr_admin,
                    'quantity'    =>  1,
		        ]
		    ],
		    'return_url'   => base_url(''),
		    'expired_time' => $new_time, // 24 jam


		    // 'expired_time'	=>  strtotime(date("Y-m-d H:i:s"), strtotime('+2 minutes')),
		    'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
		];

		$curl = curl_init();

		curl_setopt_array($curl, [
		    CURLOPT_FRESH_CONNECT  => true,
		    CURLOPT_URL            => $urlPembayaran,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_HEADER         => false,
		    CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
		    CURLOPT_FAILONERROR    => false,
		    CURLOPT_POST           => true,
		    CURLOPT_POSTFIELDS     => http_build_query($data),
		    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
		]);

		$response = curl_exec($curl);
		$error = curl_error($curl);

		curl_close($curl);

		// echo empty($error) ? $response : $error;
		$response = json_decode($response,TRUE);
		
		
		$ex = [
		 	'jumlah' => $response['data']['amount'],
		 	'payment_method' => $response['data']['payment_method'],
		 	'payment_name' => $response['data']['payment_name'],
		 	'pay_code' => $response['data']['pay_code'],
		 	'expired_time' => $response['data']['expired_time'],
		];
		date_default_timezone_set("Asia/Jakarta");
		$data = [
		 	'order_id'	 				=> $response['data']['reference'],
		 	'total_transaksi' 			=> $response['data']['amount'],
		 	'payment_transaksi'			=> $response['data']['payment_method'],
		 	'waktu_transaksi' 			=> date('Y-m-d H:i:s'),
		 	'expired_time' 				=> $response['data']['expired_time'],
		 	'payment_name' 				=> $response['data']['payment_name'],
		 	'id_checkout'				=> $orderId,
		 	'pay_code'					=> $response['data']['pay_code'],
			
			'status_transaksi'			=> $response['data']['status'],
			'byr_admin'					=> $getTripay->byr_admin,
			'merchan_type' 				=> 'Tripay',
			'jenis_transaksi' 			=>1,
			"instructions"				=> json_encode($response['data']['instructions']),
		];
		$simpan = $this->db->insert('transaksi',$data);
		redirect('bayar/konf/'.$orderId, $datakonfig);
	}

	function konf($orderId = null){
		$data = konfigurasi('Pembayaran');
		$where = array('id_checkout' => $orderId);
		$data ['detailCheckout'] 	= $this->db->get_where('checkout', $where)->row();
		$data['detailTransaksi'] 	= $this->db->get_where('transaksi', $where)->row();
		$data['detailProduk'] 		= $this->db->get_where('checkout', $where)->result();
	
		$this->template->load('template', 'checkout/prosesbayar', $data);
	}
		
}