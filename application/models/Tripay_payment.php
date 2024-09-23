<?php
if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem !! ');

class Tripay_payment extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    
    
	function getTripay($id,$what,$opo="id_transaksi"){
		$this->db->where($opo,$id);
		$this->db->limit(1);
		$res = $this->db->get("transaksi");

		if($res->num_rows() > 0){
			if($what == "semua"){
				foreach($res->result() as $key => $value){
					$result[$key] = $value;
				}
				$result = $result[0];
			}else{
				foreach($res->result() as $re){
					$result = $re->$what;
				}
			}
		}else{
			$result = new stdClass();
			$result->reference = "";
			$result->pay_url = "";
			$result->checkout_url = "";
			$result->tgl = "";
			$result->merchant_ref = "";
			$result->payment_method = "";
			$result->instructions = "";
			$result->paid_at = "";
			$result->status = 0;
			$result->statusbayar = 0;
			$result->amount = 0;
			$result->amount_received = 0;
			$result->expired_time = 0;
			$result->fee = 0;
			$result->paycode = 0;
		}
		return $result;
	}
}