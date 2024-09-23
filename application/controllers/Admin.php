<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
        parent::__construct();
        date_default_timezone_set('ASIA/JAKARTA');
        $this->load->model('shopping_cart_model');
        $this->load->model('m_login');
        $this->load->model('global_model', 'global');
        $this->load->model('TransaksiModel');
    }
    
    function cek_admin(){
    	if (!$this->session->userdata('is_admin') == true) {
    		redirect('kasir');
    	}
    }

	public function home(){
		$data = konfigurasi('Dashboard');
        $this->cek_admin();

        $this->template->load('template_admin', 'admin/dashboard', $data);
	}
	public function order(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Order');
		$data['checkout'] = $this->global->getckAdmin();

        $this->template->load('template_admin', 'admin/order', $data);
        $this->load->view('sw.php');
	}
	public function orderdetail(){
		$this->cek_admin();
		$where = array('id_checkout' => $this->input->get('orderId'));
		$data = konfigurasi('Dashboard - Detail Order '.$this->input->get('orderId'));
		$data['checkout'] = $this->db->get_where('checkout', $where)->row();

        $this->template->load('template_admin', 'admin/orderDetail', $data);
	}
	function hapusorder($id){
		$where = array('id_checkout' => $id);
		$this->db->delete('checkout', $where);
		$this->db->delete('checkoutproduk', $where);
		$this->db->delete('transaksi', $where);

		$this->session->set_flashdata('sukses',"Data berhasil dihapus");
		redirect('admin/order');
	}
	public function transaksi(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Transaksi');
		$data['data'] = $this->global->getTransadmin();

        $this->template->load('template_admin', 'admin/transaksi', $data);
        $this->load->view('sw.php');
	}
	function transaksiDetail(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Detail Transaksi');
		$where = array('id_checkout' => $this->input->get('orderId'));
		$data['data'] = $this->db->get_where('checkout', $where)->row();

        $this->template->load('template_admin', 'admin/transaksiDetail', $data);
	}
	function hapustransaksi($id){
		$where = array('id_transaksi' => $id);

		$this->db->delete('transaksi', $where);

		$this->session->set_flashdata('sukses',"Data berhasil dihapus");
		redirect('admin/transaksi');
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
	public function stok(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Stok');
        $this->template->load('template_admin', 'admin/stok', $data);
	}
	public function makanan(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Menu');
		$data['data'] = $this->db->get_where('produk', array('jenis_produk' => 'makanan'))->result();

        $this->template->load('template_admin', 'admin/makanan', $data);
        $this->load->view('sw.php');
	}
	public function minuman(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Menu');
		$data['data'] = $this->db->get_where('produk', array('jenis_produk' => 'minuman'))->result();

        $this->template->load('template_admin', 'admin/minuman', $data);
        $this->load->view('sw.php');
	}
	function hapusMenu($id){
		$where = array('id_produk' => $id);
		$query = $this->db->get_where('produk', $where)->row();

		if ($query->jenis_produk == 'makanan') {
			$this->db->delete('produk', $where);
			$this->session->set_flashdata('sukses',"Data berhasil dihapus");
			redirect('admin/makanan');
		}else {
			$this->db->delete('produk', $where);
			$this->session->set_flashdata('sukses',"Data berhasil dihapus");
			redirect('admin/minuman');
		}	
	}
	function editmenu($id){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Menu');

		$data['data'] = $this->db->get_where('produk', array('id_produk' => $id))->row();

        $this->template->load('template_admin', 'admin/editMenu', $data);
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
            if ($this->input->post('jenis') == 'makanan') {
            	redirect('admin/makanan');
            }else{
            	redirect('admin/minuman');
            }
            
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
            if ($this->input->post('jenis') == 'makanan') {
            	redirect('admin/makanan');
            }else{
            	redirect('admin/minuman');
            }
        }
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
                'by_produk'        	=> 1,
                'variasi_produk'  	=> $this->input->post('variasi'),
            );
            
            $this->db->insert('produk',$data);
            $this->session->set_flashdata('sukses',"Data berhasil ditambahkan");
            if ($this->input->post('jenis') == 'makanan') {
            	redirect('admin/makanan');
            }else{
            	redirect('admin/minuman');
            }
            
        }else{
            $this->session->set_flashdata('error',$this->upload->display_errors());
            if ($this->input->post('jenis') == 'makanan') {
            	redirect('admin/makanan');
            }else{
            	redirect('admin/minuman');
            }
        }
	}
	public function meja(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard');
		$data['meja'] = $this->global->getAllorder('meja', 'status_meja', 'ASC');
        $this->template->load('template_admin', 'admin/meja', $data);
        $this->load->view('sw.php');
	}
	function addMeja(){
		$cek = $this->db->get_where('meja', array('nomor_meja' => $this->input->post('nomor')))->num_rows();
		if ($cek > 0) {
			$this->session->set_flashdata('error','Nomor Meja - '.$this->input->post('nomor').' sudah ada');
			redirect('admin/meja');
		}else{
			$data = [
				'nomor_meja' 	=> $this->input->post('nomor'),
				'status_meja' 	=> $this->input->post('status')
			];
			$this->db->insert('meja', $data, true);
			$this->session->set_flashdata('sukses','Nomor Meja - '.$this->input->post('nomor').' berhasil ditambahkan');
			redirect('admin/meja');
		}
	}
	function mejaupdate(){
		$id = $this->input->get('id');
		$status = $this->input->get('status');

		$this->db->update('meja',array('status_meja' => $status), array('id_meja' => $id));
		$this->session->set_flashdata('sukses','Status berhasil diupdate');
		redirect('admin/meja');
	}
	function hapusmeja($id){
		$where = array('id_meja' => $id);

		$this->db->delete('meja', $where);

		$this->session->set_flashdata('sukses',"Data berhasil dihapus");
		redirect('admin/meja');
	}
	public function member(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard');
		$data['customer'] = $this->global->getAll('customer');
        $this->template->load('template_admin', 'admin/member', $data);
        $this->load->view('sw.php');
	}
	function editMember($id){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Member');
		$data['data'] = $this->db->get_where('customer', array('id_customer' => $id))->row();
        $this->template->load('template_admin', 'admin/editMember', $data);
	}
	function updateMember(){
		$where = array('id_customer' => $this->input->post('id'));
		$data = [
			'nama_customer'	=> $this->input->post('nama'),
			'email_customer'=> $this->input->post('email'),
			'status_customer'	=> $this->input->post('status'),
			'telp_customer'	=> $this->input->post('telp'),
		];

		$this->db->update('customer', $data, $where);
		$this->session->set_flashdata('sukses','Member berhasil diperbarui');
		redirect('admin/member');	
	}
	function resetMember($id){
		$where = array('id_customer' => $id);
		$password = array('password_customer' => 'password');
		$this->db->update('customer', $password, $where);
		$this->session->set_flashdata('sukses','Reset password berhasil');
		redirect('admin/member');
	}
	function hapusmember($id){
		$where = array('id_customer' => $id);
		$this->db->delete('customer', $where);
		$this->session->set_flashdata('sukses','Member berhasil dihapus');
		redirect('admin/member');
	}
	public function pengguna(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Pengguna');
		$data['data'] = $this->db->get('user');
        $this->template->load('template_admin', 'admin/pengguna', $data);
        $this->load->view('sw.php');
	}
	function penggunaAdd(){
		$cek = $this->db->get_where('user', array('email_user' => $this->input->post('email')))->num_rows();
		if ($cek > 0) {
			$this->session->set_flashdata('error','Email '.$this->input->post('email').' sudah ada');
			redirect('admin/pengguna');
		}else{
			$data = [
				'name_user' 	=> $this->input->post('nama'),
				'email_user' 	=> $this->input->post('email'),
				'role_user' 	=> $this->input->post('role'),
				'pass_user' 	=> md5($this->input->post('pass')),
			];
			$this->db->insert('user', $data, true);
			$this->session->set_flashdata('sukses','User berhasil ditambahkan');
			redirect('admin/pengguna');
		}
	}
	function editpengguna($id){
		$this->cek_admin();
		$data = konfigurasi('Dashboard - Pengguna');
		$data['data'] = $this->db->get_where('user', array('id_user' => $id))->row();
        $this->template->load('template_admin', 'admin/editPengguna', $data);
	}
	function updatePengguna(){
		$where = array('id_user' => $this->input->post('id'));
		if ($this->input->post('password') == NULL) {
			$data = [
				'name_user'	=> $this->input->post('nama'),
				'email_user'=> $this->input->post('email'),
				'role_user'	=> $this->input->post('role'),
			];
		}else{
			$data = [
				'name_user'	=> $this->input->post('nama'),
				'email_user'=> $this->input->post('email'),
				'pass_user'	=> md5($this->input->post('password')),
				'role_user'	=> $this->input->post('role'),
			];
		}
		$this->db->update('user', $data, $where);
		$this->session->set_flashdata('sukses','User berhasil diperbarui');
		redirect('admin/pengguna');	
	}
	function hapuspengguna($id){
		$where = array('id_user' => $id);
		$this->db->delete('user', $where);
		$this->session->set_flashdata('sukses','User berhasil dihapus');
		redirect('admin/pengguna');
	}
	public function setting(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard');
        $this->template->load('template_admin', 'admin/setting', $data);
        $this->load->view('sw.php');
	}

	function updateinfo(){
		$where = array('id_kon' => $this->input->post('id'));
		$data = [
			'name_kon' => $this->input->post('name_kon'),
			'alamat_kon' => $this->input->post('alamat_kon'),
			'telp_kon' => $this->input->post('telp'),
		];
		$this->db->update('konfigurasi', $data, $where);
		$this->session->set_flashdata('sukses','Data berhasil diperbarui');
		redirect('admin/setting');	
	}
	function updateTf(){
		$where = array('id_kon' => $this->input->post('id'));
		$data = [
			'rek_kon' => $this->input->post('rek_kon'),
			'bank_kon' => $this->input->post('bank_kon'),
			'pemilik_kon' => $this->input->post('pemilik_kon'),
		];
		$this->db->update('konfigurasi', $data, $where);
		$this->session->set_flashdata('sukses','Data berhasil diperbarui');
		redirect('admin/setting');	
	}
	function updateTripay(){
		$where = array('id_kon' => $this->input->post('id'));
		$data = [
			'tripay_server' => $this->input->post('mode'),
			'tripay_code' => $this->input->post('tripay_code'),
			'tripay_private' => $this->input->post('tripay_private'),
			'tripay_api' => $this->input->post('tripay_api'),
			'byr_admin' => $this->input->post('byr_admin'),
		];
		$this->db->update('konfigurasi', $data, $where);
		$this->session->set_flashdata('sukses','Data berhasil diperbarui');
		redirect('admin/setting');	
	}

	function laporan(){
		$this->cek_admin();
		$data = konfigurasi('Dashboard');

        $this->template->load('template_admin', 'admin/laporan', $data);
        $this->load->view('sw.php');
	}

	function cetak_harian(){
		$tgl = date('Y-m-d');
		$data['transaksi'] = $this->TransaksiModel->hari_ini($tgl);
		var_dump($data['transaksi']);
		// $data['ket'] = "Laporan Transaksi Harian (".format_tanggal($tgl).")";
		// ob_start();
	    // $this->load->view('print', $data);
	    // $html = ob_get_contents();
	    //     ob_end_clean();
	        
	    // require './assets/html2pdf/autoload.php'; // Load plugin html2pdfnya
	    // $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');  // Settingan PDFnya
	    // $pdf->WriteHTML($html);
	    // $pdf->Output('Data_Transaksi_Hari ini_'.$tgl.'.pdf', 'D');
	}

	public function cetak(){
        $awal 	= $this->input->post('tgl_awal');
        $akhir 	= $this->input->post('tgl_akhir');
        $jenis 	= $this->input->post('jenis');

        $data['transaksi'] = $this->TransaksiModel->antara_tanggal($awal, $akhir);
        $data['ket'] = "Laporan Transaksi (".format_tanggal($awal)." - ".format_tanggal($akhir).")";
        if ($jenis == 'pdf') {
        	ob_start();
		    $this->load->view('print', $data);
		    $html = ob_get_contents();
		        ob_end_clean();
		        
		    require './assets/html2pdf/autoload.php'; // Load plugin html2pdfnya
		    $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');  // Settingan PDFnya
		    $pdf->WriteHTML($html);
		    $tr = $pdf->Output('Data Transaksi'.format_tanggal($awal)." - ".format_tanggal($akhir).'.pdf', 'D');
		}else{

	        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	        header("Content-Disposition: attachment; filename=Data Transaksi".format_tanggal($awal)." - ".format_tanggal($akhir).".xls");
	        header('Cache-Control: max-age=0');
	        $this->load->view('print', $data);
		}

		redirect('admin/laporan');
	}
}