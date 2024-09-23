<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: GET, OPTIONS');
class Snap extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
		$this->load->helper('url');
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('shopping_cart_model');
    }

    public function index()
    {
    	redirect('/');
    }

    public function token()
    {
    	$conn = $this->db->get('konfigurasi')->result();
		foreach ($conn as $p){}

		if ($p->typeKey == 0){
			$params = array('server_key' => $p->serverKey, 'production' => false);
		} else{
			$params = array('server_key' => $p->serverKey, 'production' => true);
		}

		$this->load->library('midtrans');
		$this->midtrans->config($params);

		$orderId 	= $this->input->post('orderId');
 		$amount 	= $this->input->post('amount');
		
		$tabel_data	= $this->db->get_where('checkout', array('id_checkout' => $orderId))->result();
		foreach ($tabel_data as $checkout){}
		$email = $checkout->email_checkout;

		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $amount,
		);

		$tabel_produk	= $this->shopping_cart_model->getctranskasiProduk($orderId);
		foreach ($tabel_produk as $produk){}

		// Optional
		$item1_details = array(
		  'id' => $orderId,
		  'price' => $amount,
		  'quantity' => 1,
		  'name' => "ORDER - ".$orderId,
		);

		// Optional
		$item_details = array ($item1_details);
		
		// Optional
		$billing_address = array(
		  'first_name'    => $checkout->nama_checkout,
		  'address'       => "MEJA NO - ".$checkout->meja_checkout,
		  'city'          => "",
		  'postal_code'   => "",
		  'phone'         => $checkout->telp_checkout,
		  'country_code'  => 'IDN'
		);
		// Optional
		$customer_details = array(
		  'first_name'    => $checkout->nama_checkout,
		  'email'         => $email,
		  'phone'         => $checkout->telp_checkout,
		  'billing_address'  => $billing_address,
		);


        $credit_card['secure'] = true;
        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute',
            'duration'  => 10
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
    	$conn = $this->db->get('konfigurasi')->result();
		foreach ($conn as $c){}
    	$result 		= json_decode($this->input->post('result_data'), true);
    	var_dump($result);
    	$tabel_data	= $this->db->get_where('checkout', array('id_checkout' => $orderId))->result();
		foreach ($tabel_data as $checkout){}	
			var_dump($checkout->id_checkout);
		// id_transaksi	id_checkout	total_transaksi	payment_transaksi	status_transaksi	bukti_transaksi	waktu_transaksi	
    	$data = [
			'total_transaksi' 	=>$result['gross_amount'],
			'payment_transaksi'	=>$result['payment_type'],
			'waktu_transaksi' 	=>$result['transaction_time'],
			'bukti_transaksi' 	=>$result['pdf_url'],
			'status_transaksi'	=>$result['status_code'],
			'id_checkout'		=>$result['order_id'],
		];
		echo "<pre>";
		var_dump($result );
		echo "<br>";
		
		var_dump($data);


		$this->db->insert('transaksi',$data);
		// redirect('/','refresh');
    }
}
