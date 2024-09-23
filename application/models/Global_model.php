<?php
if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem !! ');

class Global_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

	public function getKonfigurasi() {
        $this->db->select('*');
        $this->db->from('konfigurasi');
        $query = $this->db->get();
        return $query->row_array();
    }

    function getAll($table){
        $this->db->select('*');
        $query = $this->db->get($table)->result();
        return $query;
    }

    function getAllwhere($table, $where){
        $this->db->select('*');
        $query = $this->db->get($table)->result();
        return $query;
    }

    function getAllorder($table, $fk, $data){
        $this->db->select('*');
        $this->db->order_by($fk, $data);
        $query = $this->db->get($table)->result();
        return $query;
    }

    function getckAdmin(){
        $this->db->select('*');
        // $this->db->join('customer','customer.id_customer = checkout.id_customer');
        $query = $this->db->get('checkout')->result();
        return $query;
    }

    function getTransadmin(){
        $this->db->select('*');
        $this->db->order_by('id_transaksi', 'DESC');
        $this->db->join('checkout','transaksi.id_checkout = checkout.id_checkout');
        // $this->db->join('customer','customer.id_customer = checkout.id_customer');
        $query = $this->db->get('transaksi')->result();
        return $query;
    }

    function getRow($table){
        $this->db->select('*');
        $this->db->get($table);
        $query = $this->db->get()->row();
        return $query;
    }

    function getWhere($table, $where){
        $this->db->select('*');
        $this->db->where($where);
        $this->db->get($table);
        $query = $this->db->get()->row();
        return $query;
    }

    
    function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function searchProduk($dd){
        $this->db->select('*');
        $this->db->like('nama_produk', $dd);
        $query = $this->db->get('produk');
        return $query;
    }

    public function getRows($id = ''){
        $this->db->select('*');
        $this->db->from('produk');
        if($id){
            $this->db->where('id_produk', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('nama_produk', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        
        // Return fetched data
        return !empty($result)?$result:false;
    }


    // Kasir
    function cart_kasir(){
        $this->db->select('*, (jml*harga) AS juml_bayar');
        $this->db->join('produk', 'produk.id_produk = keranjang.id_produk');
        $query = $this->db->get('keranjang');
        return $query->result();
    }
    
    function kasir_transaksi($id){
        $this->db->select('*');
        $this->db->where('id_checkout', $id);
        $query = $this->db->get('transaksi');
        return $query->row();
    }
}