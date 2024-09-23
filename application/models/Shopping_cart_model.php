<?php
class Shopping_cart_model extends CI_Model
{
    function fetch_all(){
        $this->db->where('stok_produk', 1);
        return $this->db->get('produk')->result();
    }

    function getmeja(){
        $this->db->where('status_meja', '0');
        $query = $this->db->get("meja");
        return $query->result();
    }

    public function getOrder($where) {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->join('checkoutproduk','checkoutproduk.id_produk = produk.id_produk');
        $this->db->from('produk');
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserOrder($where) {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->join('customer','customer.id_customer = checkout.id_customer');
        $this->db->from('checkout');
        $query = $this->db->get();
        return $query->row();
    }

    function get_total_biaya($where){
        $this->db->select_sum('harga_produk');
        $this->db->join('checkoutproduk','checkoutproduk.id_produk = produk.id_produk');
        $this->db->where($where);
        $this->db->from('produk');
        $query = $this->db->get();
        return $query->row()->harga_produk;
    }


    function getctranskasiProduk($where){
        $this->db->select('*');
        $this->db->where('checkoutproduk.id_checkout', $where);
        $this->db->join('checkoutproduk','checkoutproduk.id_produk = produk.id_produk');
        $this->db->from('produk');
        $query = $this->db->get();
        return $query->result();
    }


    function orderUser($where){
        $this->db->select('*');
        $this->db->where('checkout.id_customer', $where);
        $this->db->order_by('checkout.waktu_checkout', 'DESC');
        $this->db->from('checkout');
        $query = $this->db->get();
        return $query->result();
    }



}
