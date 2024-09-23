<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	public function __construct(){
        parent::__construct();
        date_default_timezone_set('ASIA/JAKARTA');
        $this->load->model('shopping_cart_model');
		$this->load->library('cart');

		if ($this->session->userdata('is_kasir') == false) {
    		redirect('logout');
    	}
    }
    
    function home(){
		$data = konfigurasi('Dashboard');
        $this->template->load('kasir/template', 'kasir/dashboard', $data);
	}

	function transaksi(){
		$data = konfigurasi('Dashboard');
		$data["meja"] = $this->shopping_cart_model->getmeja();

        $this->template->load('kasir/template', 'kasir/transaksi', $data);
	}

	function listproduk(){
		$data['list']	= $this->shopping_cart_model->fetch_all();
		$this->load->view('kasir/produk', $data);
	}

	function cariproduk(){
		$get = isset($_POST['keyword']);
		if($get){
			$data['count']	= $this->global->searchProduk($_POST['keyword'])->num_rows();
			$data['list']	= $this->global->searchProduk($_POST['keyword'])->result();
		}else{
			$data['list']	= $this->shopping_cart_model->fetch_all();
		}

		$this->load->view('kasir/produk', $data);
	}

	function addpesanan(){
		$where = array('id_produk' => $_POST["product_id"] );
		$cek = $this->db->get_where('keranjang', $where);
		if($cek->num_rows() > 0){
			$data = array(
				"jml"  => $cek->row()->jml + $_POST["quantity"],
			);
			$this->db->update('keranjang', $data, $where);
		}else{
			$data = array(
				"id_produk"	 	=> $_POST["product_id"],
				"jml"  			=> $_POST["quantity"],
				"harga"  		=> $_POST["harga"],
			);
			$this->db->insert('keranjang', $data);
		}
		
	}

	function pesanan(){
		$data['cart']	= $this->global->cart_kasir();
		$this->load->view('kasir/pesanan', $data);
	}
    
    function removeItem($id){
		$this->db->delete('keranjang', array('id' => $id));
    }

	function clear() {
		$this->db->empty_table('keranjang');
  	}

	function checkout(){
		$rows = count($this->input->post('id', true));
		$id_checkout = random_string('basic');

		$datas = array(
				'id_checkout'		=> $id_checkout,
				'nama'				=> $_POST['nama_customer'],
				'meja_checkout'		=> $this->input->post('meja'),
				'waktu_checkout'	=> date('Y-m-d H:i:s'),
				'total_checkout'	=> $this->input->post('total'),
				'sekarang' 			=> 1,
				'waktu' 			=> date('H:i:s'),
				'tanggal' 			=> date('Y-m-d'),
				'member'			=> 0,
		);
		$this->db->insert('checkout',$datas);

		for ($i = 1; $i <= $rows; $i++) {
			$id = 'id[' . $i . ']';
			$qty = 'qty[' . $i . ']';
			$insert[] = [
				'id_checkout'		=> $id_checkout,
		        'id_produk' 		=> $this->input->post($id, true),
		        'jml_checkout' 		=> $this->input->post($qty, true),
			];
		}
		$this->db->insert_batch('checkoutproduk',$insert);

		$trans = array(
			'order_id'	 				=> $id_checkout,
		 	'total_transaksi' 			=> $this->input->post('total'),
		 	'payment_transaksi'			=> "Cash",
		 	'waktu_transaksi' 			=> date('Y-m-d H:i:s'),
		 	'expired_time' 				=> time() + (1 * 60),
		 	'payment_name' 				=> 'Cash',
		 	'merchan_type' 				=> 'Cash',
		 	'id_checkout'				=> $id_checkout,
		 	'jml_bayar'					=> $_POST['jml_bayar'],
		 	'nama_customer'				=> $_POST['nama_customer'],
				
			'status_transaksi'			=> 'PAID',
			'byr_admin'					=> 0,
			'jenis_transaksi' 			=> $_POST['jenis_transaksi'],
		);
		$this->db->insert('transaksi', $trans);
		$this->db->empty_table('keranjang');
		redirect('kasir/detail/'.$id_checkout);
	}

	function detail($orderId = null){
		$data = konfigurasi('Pembayaran');
		$where = array('id_checkout' => $orderId);

		$data ['detailCheckout'] 	= $this->db->get_where('checkout', $where)->row();
		$data['detailTransaksi'] 	= $this->db->get_where('transaksi', $where)->row();
		$data['detailProduk'] 		= $this->db->get_where('checkout', $where)->result();
	
		$this->template->load('kasir/template', 'kasir/konf', $data);
	}

	public function print($nota) {
        $d = $this->db->get_where('checkout', ['id_checkout' => $nota ])->row();
        if( !$d ) die("not found");

        $d->detail  = $this->db->get_where('transaksi', ['id_checkout' => $nota ])->row();
        
        $profile    = $this->db->select("name_kon, alamat_kon, telp_kon")->from("konfigurasi")->get()->row();
        $customer   = $this->db->select('*')->get_where('customer', ['id_customer' => $d->id_customer ])->row();
        echo "<pre>";
        $this->load->view('admin/print', ['d' => $d, 'profile' => $profile, 'customer' => $customer]);
   	}
	
	function menu(){
		$data = konfigurasi('Dashboard');
		$data['data'] = $this->db->get('produk')->result();

        $this->template->load('kasir/template', 'kasir/menu', $data);
		$this->load->view('sw.php');
	}

	function addMenu(){
		$config['upload_path'] = './uploads/produk';
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['encrypt_name']         = FALSE;

        $this->upload->initialize($config);
        if($this->upload->do_upload('image')) {
            $fileData = $this->upload->data();
            $data = array(
            	'jenis_produk'		=> $this->input->post('jenis'),
				'nama_produk'		=> $this->input->post('nama'),
				'harga_produk'		=> $this->input->post('harga'),
				'stok_produk'		=> $this->input->post('stok'),
				'desk_produk'		=> $this->input->post('desk'),
                'gambar_produk'     => $fileData['file_name'],
                'waktu_produk'   	=> date('Y-m-d H:i:s'),
                'by_produk'        	=> $this->session->userdata('id_user'),
                'variasi_produk'  	=> $this->input->post('variasi'),
            );
            
            $this->db->insert('produk',$data);
            $this->session->set_flashdata('sukses',"Data berhasil ditambahkan");
            redirect('kasir/menu');
            
        }else{
            $this->session->set_flashdata('error',$this->upload->display_errors());
            redirect('kasir/menu');
        }
	}
	function hapusMenu($id){
		$where = array('id_produk' => $id);
		$query = $this->db->get_where('produk', $where)->row();

		$this->db->delete('produk', $where);
		$this->session->set_flashdata('sukses',"Data berhasil dihapus");
		redirect('kasir/menu');
	}
	function editmenu($id){
		$data = konfigurasi('Dashboard - Menu');

		$data['data'] = $this->db->get_where('produk', array('id_produk' => $id))->row();

        $this->template->load('kasir/template', 'kasir/editMenu', $data);
	}
	function updateMenu(){
		$id = $this->input->post('id');

		$config['upload_path'] = './uploads/produk';
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['encrypt_name']         = FALSE;

        $this->upload->initialize($config);
        if($this->upload->do_upload('image')) {
            $fileData = $this->upload->data();
            $data = array(
				'nama_produk'		=> $this->input->post('nama'),
				'harga_produk'		=> str_replace(".", "", $this->input->post('harga')),
				'stok_produk'		=> $this->input->post('stok'),
				'desk_produk'		=> $this->input->post('desk'),
                'gambar_produk'     => $fileData['file_name'],
                'variasi_produk'  	=> $this->input->post('variasi'),
            );
            
            $this->db->update('produk',$data, array('id_produk' => $id));
            unlink('uploads/produk/'.$this->input->post('lama'));
            $this->session->set_flashdata('sukses',"Data berhasil diperbarui");
            redirect('kasir/menu');
            
        }else{
            $data = array(
				'nama_produk'		=> $this->input->post('nama'),
				'harga_produk'		=> str_replace(".", "", $this->input->post('harga')),
				'stok_produk'		=> $this->input->post('stok'),
				'desk_produk'		=> $this->input->post('desk'),
                'variasi_produk'  	=> $this->input->post('variasi'),
            );
            
            $this->db->update('produk',$data, array('id_produk' => $id));
            $this->session->set_flashdata('sukses',"Data berhasil diperbarui");
            redirect('kasir/menu');
        }
	}

	public function meja(){
		$data = konfigurasi('Dashboard');
		$data['meja'] = $this->global->getAllorder('meja', 'status_meja', 'ASC');
        $this->template->load('kasir/template', 'kasir/meja', $data);
        $this->load->view('sw.php');
	}
	function addMeja(){
		$cek = $this->db->get_where('meja', array('nomor_meja' => $this->input->post('nomor')))->num_rows();
		if ($cek > 0) {
			$this->session->set_flashdata('error','Nomor Meja - '.$this->input->post('nomor').' sudah ada');
			redirect('kasir/meja');
		}else{
			$data = [
				'nomor_meja' 	=> $this->input->post('nomor'),
				'status_meja' 	=> $this->input->post('status')
			];
			$this->db->insert('meja', $data, true);
			$this->session->set_flashdata('sukses','Nomor Meja - '.$this->input->post('nomor').' berhasil ditambahkan');
			redirect('kasir/meja');
		}
	}
	function mejaupdate(){
		$id = $this->input->get('id');
		$status = $this->input->get('status');

		$this->db->update('meja',array('status_meja' => $status), array('id_meja' => $id));
		$this->session->set_flashdata('sukses','Status berhasil diupdate');
		redirect('kasir/meja');
	}
	function hapusmeja($id){
		$where = array('id_meja' => $id);

		$this->db->delete('meja', $where);

		$this->session->set_flashdata('sukses',"Data berhasil dihapus");
		redirect('kasir/meja');
	}

	public function order(){
		$data = konfigurasi('Dashboard - Order');
		$data['checkout'] = $this->global->getckAdmin();

        $this->template->load('kasir/template', 'kasir/order', $data);
        $this->load->view('sw.php');
	}
	public function orderdetail(){
		$where = array('id_checkout' => $this->input->get('orderId'));
		$data = konfigurasi('Dashboard - Detail Order '.$this->input->get('orderId'));
		$data['checkout'] = $this->db->get_where('checkout', $where)->row();

        $this->template->load('kasir/template', 'kasir/orderDetail', $data);
		$this->load->view('sw.php');
	}
	function hapusorder($id){
		$where = array('id_checkout' => $id);
		$this->db->delete('checkout', $where);
		$this->db->delete('checkoutproduk', $where);
		$this->db->delete('transaksi', $where);

		$this->session->set_flashdata('sukses',"Data berhasil dihapus");
		redirect('kasir/order');
	}

	function updateorder($id){
		$where = array('id_checkout' => $id);
		$data = array(
			'status_transaksi'	=> $_POST['status_transaksi']
		);
		$this->db->update('transaksi', $data, $where);
		$this->session->set_flashdata('sukses',"Status berhasil diperbarui");
		redirect('kasir/orderDetail?orderId='.$id);
	}
}