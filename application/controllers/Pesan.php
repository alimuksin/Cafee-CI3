<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('shopping_cart_model');
    }

	public function index()
	{
		// $this->load->view('welcome_message');
		$data = konfigurasi('Pesan Menu');
		$data["product"] = $this->shopping_cart_model->fetch_all();

        $this->template->load('template', 'pesan', $data);
	}

	function reservasi(){
		// $this->load->view('welcome_message');
		$data = konfigurasi('Reservasi');
		$data["mejas"] = $this->db->get('meja')->result();

        $this->template->load('template', 'reservasi', $data);
	}

	function add(){
  		$this->load->library("cart");
	  	$data = array(
		   "id"  => $_POST["product_id"],
		   "name"  => $_POST["product_name"],
		   "qty"  => $_POST["quantity"],
		   "price"  => $_POST["product_price"],
		   "variasi"  => $_POST["variasi"],
	  	);
	  	$this->cart->insert($data); //return rowid 
	  	echo $this->view();
	}

	function load() {
		echo $this->view();
	}

	function countbelanja(){
		$output = count($this->cart->contents());
		return $output;
	}

	function remove() {
	  	$this->load->library("cart");
	  	$row_id = $_POST["row_id"];
	  	$data = array(
		   	'rowid'  => $row_id,
		   	'qty'  => 0
	  	);
	  	$this->cart->update($data);
	  	echo $this->view();
	  	echo $this->udpateCount();
	}

	function clear() {
	  	$this->load->library("cart");
	  	$this->cart->destroy();
	  	echo $this->view();
	  	echo $this->udpateCount();
	}

	function udpateCount(){
		$output = $this->cart->total_items();
		return $output;
	}
 
 	function view() {
	  	$this->load->library("cart");
	  	$output = '';
	  	$output .= '
		  	<h3 class="home-judul text-center">KERANJANG BELANJA</h3>
		  	<div class="table-responsive">
		   	<table class="table table-bordered border-dark table-hover table-striped table-sm">
			    <tr class="bg-utama text-white">
			     	<th>Item</th>
			     	<th>Harga</th>
			     	<th>QTY</th>
			     	<th></th>
			     	<th width="10%">Action</th>
			    </tr>
		';
	  	$count = 0;
	  	foreach($this->cart->contents() as $items) {
		   	$count++;
		   	$output .= '
		   	<tr> 
			    <td>'.$items["name"].' ('.$items["variasi"].')</td>
			    <td>'.rupiah($items["price"]).'</td>
			    <td>'.$items["qty"].' x</td>
			    <td class="text-nowrap">'.rupiah($items["subtotal"]).'</td>
			    <td><button type="button" name="remove" class="btn btn-xs text-danger remove_inventory" id="'.$items["rowid"].'"><i class="fa fa-trash"></i></button></td>
		   	</tr>
		   	';
  		}
  		$output .= '
			   	<tr>
				    <td colspan="4" align="right">Total</td>
				    <td style="background-color: #6D3202; color: white; text-align:right; font-weight: 600">'.rupiah($this->cart->total()).'</td>
				</tr>
	  		</table>
  			</div>
  			<div align="right">
		   		<a href="'.base_url('cekout').'" class="btn btn-utama">Lanjut Bayar</a>
		    	<button type="button" id="clear_cart" class="btn btn-danger"><i class="fa fa-close"></i> Hapus Semua</button>
		   	</div>
  		';

	  	if($count == 0)
	  	{
	   		$output = '<h3 class="home-judul text-center mt-4"> KERANJANG BELANJA KOSONG</h3>';
	  	}
	  	return $output;
	}

	function product_detail_cart_count(){
		echo number_format($this->cart->total_items());
	}

	function srvLoad_pilih(){
		$user=$this->m_master->getSiswaById(array($this->input->post('id')));
    ?>

		echo "<div class='row'>
                    <div class='col-md-6 d-none d-md-block d-lg-block'>
                    </div>
                    <div class='col-md-6 d-none d-md-block d-lg-block'>
                    <div id='cart_details'></div>";
	<?php }
}
