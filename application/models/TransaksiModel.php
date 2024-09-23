<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TransaksiModel extends CI_Model {

    public function view_by_date($date){
        $this->db->where('status_checkout',2); // Tambahkan where tanggal nya
        $this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
        
        return $this->db->get('checkout')->result();// Tampilkan data checkout sesuai tanggal yang diinput oleh user pada filter
    }
    
    public function view_by_month($month, $year){
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
        return $this->db->get('checkout')->result(); // Tampilkan data checkout sesuai bulan dan tahun yang diinput oleh user pada filter
    }
    
    public function view_by_year($year){
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
        return $this->db->get('checkout')->result(); // Tampilkan data checkout sesuai tahun yang diinput oleh user pada filter
    }
    
    public function view_all(){
        return $this->db->get('checkout')->result(); // Tampilkan semua data checkout
    }
    
    public function option_tahun(){
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('checkout'); // select ke tabel checkout
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel checkout sesuai kondisi diatas
    }
    function hari_ini($date){
        date_default_timezone_set('ASIA/JAKARTA');
        $this->db->select('*');
        $this->db->order_by('id_transaksi', 'ASC');
        $this->db->join('transaksi','transaksi.id_checkout = checkout.id_checkout');
        // $this->db->join('customer','customer.id_customer = checkout.id_customer');
        $this->db->where('tanggal', $date);
        $query = $this->db->get('checkout')->result();
        return $query;
    }
    function minggu_ini($date){
        date_default_timezone_set('ASIA/JAKARTA');
        $this->db->select('*');
        $this->db->order_by('id_transaksi', 'ASC');
        $this->db->join('transaksi','transaksi.id_checkout = checkout.id_checkout');
        // $this->db->join('customer','customer.id_customer = checkout.id_customer');
        $this->db->like('tanggal', $date);
        $query = $this->db->get('checkout')->result();
        return $query;
    }
    function bulan_ini($date){
        date_default_timezone_set('ASIA/JAKARTA');
        $this->db->select('*');
        $this->db->order_by('id_transaksi', 'ASC');
        $this->db->join('transaksi','transaksi.id_checkout = checkout.id_checkout');
        // $this->db->join('customer','customer.id_customer = checkout.id_customer');
        $this->db->where('tanggal', $date);
        $query = $this->db->get('checkout')->result();
        return $query;
    }

    function antara_tanggal($awal, $akhir){
        date_default_timezone_set('ASIA/JAKARTA');
        $this->db->select('*');
        // $this->db->where('tanggal BETWEEN ' . $awal . ' AND ' . $akhir);
        $this->db->where('tanggal >', $awal);
        $this->db->where('tanggal <', $akhir);
        $this->db->order_by('id_transaksi', 'ASC');
        $this->db->join('transaksi','transaksi.id_checkout = checkout.id_checkout');
        // $this->db->join('customer','customer.id_customer = checkout.id_customer');
        $query = $this->db->get('checkout')->result();
        return $query;
    }

}