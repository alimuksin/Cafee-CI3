<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tripay extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
	}

	function webhook(){
		$json = file_get_contents("php://input");
		$set = $this->db->get('konfigurasi')->row();
		
		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';
		$signature = hash_hmac('sha256', $json, $set->tripay_private);

		if( $callbackSignature !== $signature ) {
			echo json_encode(array("success"=>false,"msg"=>"Forbidden Access"));
			exit();
		}

		$data = json_decode($json);
		$event = $_SERVER['HTTP_X_CALLBACK_EVENT'];

		if( $event == 'payment_status' ){
			if( $data->status == 'PAID' ){
				$datas = array(
                    "status_transaksi"=> $data->status,
                    "statusbayar"=> 1
                );
                $this->db->where("order_id",$data->reference);
                $this->db->update("transaksi",$datas);
				
			}else if ($data->status == 'EXPIRED'){
				$datas = array(
                    "status_transaksi"=> $data->status,
                    "statusbayar"=> 1
                );
                $this->db->where("order_id",$data->reference);
                $this->db->update("transaksi",$datas);
			}else if ($data->status == 'FAILED'){
				$datas = array(
                    "status_transaksi"=> $data->status,
                    "statusbayar"=> 1
                );
                $this->db->where("order_id",$data->reference);
                $this->db->update("transaksi",$datas);
			}
			echo json_encode(["success"=>true,"status_transaksi"=>$data->status]);
		}else{
			echo json_encode(["success"=>false,"msg"=>"transaction not found"]);
		}
	}
}
