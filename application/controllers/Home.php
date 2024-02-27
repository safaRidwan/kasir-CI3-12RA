<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
    }
	public function index()
	{
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d');
        $this->db->select('sum(total_harga) as total');
        $this->db->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m-%d')", $tanggal);
        $hari_ini = $this->db->get()->row()->total;

        $this->db->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m-%d')", $tanggal);
        $transaksi = $this->db->count_all_results();

        $produk = $this->db->from('produk')->count_all_results();

        $tanggal = date('Y-m');
        $this->db->select('sum(total_harga) as total');
        $this->db->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m')", $tanggal);
        $bulan_ini = $this->db->get()->row()->total;

        //jika tidak ada data maka akan  menampilkan 0
        if($hari_ini==NULL){$hari_ini = 0;}
        if($bulan_ini==NULL){$bulan_ini = 0;}
        if($transaksi==NULL){$transaksi = 0;}
        if($produk==NULL){$produk = 0;}

		$data = array(
            'judul_halaman' => 'Kasir | Home',
            'hari_ini' => $hari_ini,
            'bulan_ini' => $bulan_ini,
            'transaksi' => $transaksi,
            'produk' => $produk,
        );
		$this->template->load('template_admin','home',$data);
	}
}
