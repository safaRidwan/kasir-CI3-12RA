<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') == NULL) {
            redirect('auth');
        }
    }
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('y-m-d');
        $this->db->select('*');
        $this->db->from('penjualan a')->order_by('a.penjualan_tanggal', 'DESC')->where('a.penjualan_tanggal',$tanggal);
        $this->db->join('pelanggan b','a.pelanggan_id=b.pelanggan_id', 'left');
        $penjualan = $this->db->get()->result_array();

        $this->db->from('pelanggan')->order_by('pelanggan_nama', 'ASC');
        $pelanggan = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Kasir | Penjualan',
            'penjualan' => $penjualan,
            'pelanggan' => $pelanggan,
        );
        $this->template->load('template_admin', 'penjualan', $data);
    }

    public function transaksi($pelanggan_id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m');
        $this->db->from('penjualan');
        $this->db->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m')", $tanggal);
        $this->db->where('pelanggan_id', $pelanggan_id);
        $jumlah = $this->db->count_all_results();
        $nota = date('ymd') . ($jumlah + 1);
    
        $produk = $this->db
            ->from('produk')
            ->where('produk_stok >', 0)
            ->order_by('produk_nama', 'ASC')
            ->get()
            ->result_array();
    
        $namapelanggan = $this->db
            ->from('pelanggan')
            ->where('pelanggan_id', $pelanggan_id)
            ->get()
            ->row()->pelanggan_nama;
    
        $this->db->from('penjualan_detail a');
        $this->db->join('produk b', 'a.produk_id=b.produk_id', 'left');
        $this->db->where('a.kode_penjualan', $nota);
        $detail = $this->db->get()->result_array();

        $this->db->from('temp a');
        $this->db->join('produk b', 'a.produk_id=b.produk_id', 'left');
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $this->db->where('a.pelanggan_id', $pelanggan_id);
        $temp = $this->db->get()->result_array();
    
        $data = array(
            'judul_halaman' => 'Kasir | Transaksi Penjualan',
            'nota' => $nota,
            'produk' => $produk,
            'pelanggan_id' => $pelanggan_id,
            'namapelanggan' => $namapelanggan,
            'detail' => $detail,
            'temp' => $temp,
        );
        $this->template->load('template_admin', 'penjualan_transaksi', $data);
    }
    
    public function addtemp(){
        $this->db->from('produk')->where('produk_id', $this->input->post('produk_id'));
        $stok_lama = $this->db->get()->row()->produk_stok;

        $this->db->from('temp');
        $this->db->where('produk_id', $this->input->post('produk_id'));
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('pelanggan_id', $this->input->post('pelanggan_id'));
        $cek = $this->db->get()->result_array();

        if ($stok_lama<$this->session->userdata('jumlah')) {
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-danger alert-dismissible" role="alert">
                    Stok tidak mencukupi. Stok saat ini: ' . $stok_lama . '
                </div>
            ');
        }else if ($cek <> NULL) {
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    Produk sudah dipilih
                </div>
            ');
        }else{
            $data = array(
                'pelanggan_id' => $this->input->post('pelanggan_id'),
                'user_id' => $this->session->userdata('user_id'),
                'produk_id' => $this->input->post('produk_id'),
                'jumlah' => $this->input->post('jumlah'),
            );
            $this->db->insert('temp', $data);
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-success alert-dismissible" role="alert">
                    Tambah Item Berhasil
                </div>
            ');
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }



    public function tambah_keranjang()
    {
        $this->db->from('penjualan_detail');
        $this->db->where('produk_id', $this->input->post('produk_id'));
        $this->db->where('kode_penjualan', $this->input->post('kode_penjualan'));
        $cek = $this->db->get()->result_array();
    
        if ($cek <> NULL) {
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-warning alert-dismissible" role="alert">
                    Produk sudah dipilih
                </div>
            ');
            redirect($_SERVER["HTTP_REFERER"]);
        }
    
        $this->db->from('produk')->where('produk_id', $this->input->post('produk_id'));
        $harga = $this->db->get()->row()->produk_harga;
        $this->db->from('produk')->where('produk_id', $this->input->post('produk_id'));
        $stok_lama = $this->db->get()->row()->produk_stok;
        $stok_input = $this->input->post('jumlah');
        $stok_sekarang = $stok_lama - $stok_input;
    
        $data = array(
            'kode_penjualan' => $this->input->post('kode_penjualan'),
            'produk_id' => $this->input->post('produk_id'),
            'jumlah' => $stok_input,
            'sub_total' => $stok_input * $harga
        );
    
        if ($stok_lama >= $stok_input) {
            $this->db->insert('penjualan_detail', $data);
            $data2 = array('produk_stok' => $stok_sekarang);
            $where = array('produk_id' => $this->input->post('produk_id'));
            $this->db->update('produk', $data2, $where);
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-success alert-dismissible" role="alert">
                    Tambah Item Berhasil
                </div>
            ');
        } else {
            $this->session->set_flashdata('notifikasi', '
                <div class="alert alert-danger alert-dismissible" role="alert">
                    Stok tidak mencukupi. Stok saat ini: ' . $stok_lama . '
                </div>
            ');
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }
    

    public function delete_data($detail_id, $produk_id)
    {
        $this->db->from('penjualan_detail')->where('detail_id', $detail_id);
        $jumlah = $this->db->get()->row()->jumlah;
        $this->db->from('produk')->where('produk_id', $produk_id);
        $stok_lama = $this->db->get()->row()->produk_stok;
        $stok_sekarang = $jumlah + $stok_lama;
        $data2 = array('produk_stok' => $stok_sekarang);
        $where = array('produk_id' => $produk_id);
        $this->db->update('produk', $data2, $where);
        $where = array('detail_id' => $detail_id);
        $this->db->delete('penjualan_detail', $where);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Hapus Item Berhasil
                </div>
            ');
        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function hapus_temp($temp_id)
    {
        $where = array('temp_id' => $temp_id);
        $this->db->delete('temp', $where);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Hapus Item Berhasil
                </div>
            ');
        redirect($_SERVER["HTTP_REFERER"]);
    }

    public function bayar(){
        $data = array(
            'kode_penjualan' => $this->input->post('kode_penjualan'),
            'pelanggan_id' => $this->input->post('pelanggan_id'),
            'total_harga' => $this->input->post('total_harga'),
            'penjualan_tanggal' => date('Y-m-d'),
            );
            $this->db->insert('penjualan',$data);
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-primary alert-dismissible" role="alert">
                Penjualan berhasil!
            </div>
            ');
            redirect('penjualan/invoice/'.$this->input->post('kode_penjualan'));
    }

    public function bayarv2(){
        
        //bagian pembuatan nota
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m');
        $this->db->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m')", $tanggal);
        $jumlah = $this->db->count_all_results();
        $nota = date('ymd') . ($jumlah + 1);

        $this->db->from('temp a');
        $this->db->join('produk b', 'a.produk_id=b.produk_id', 'left');
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $this->db->where('a.pelanggan_id', $this->input->post('pelanggan_id'));
        $temp = $this->db->get()->result_array();
        $total = 0;
        //bagian input ke tabel penjualan
        foreach($temp as $row){
            if ($row['produk_stok']<$row['jumlah']) {
                $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Stok produk yang dipilih tidak mencukupi
                </div>');
                redirect($_SERVER["HTTP_REFERER"]);
            }
            $total = $total + $row['jumlah'] * $row['produk_harga'];

        //input ke tabel detail penjualan
            $data = array(
                'kode_penjualan' => $nota,
                'produk_id' => $row['produk_id'],
                'jumlah' => $row['jumlah'],
                'sub_total' => $row['jumlah'] * $row['produk_harga'],
            );
            $this->db->insert('penjualan_detail',$data);

            //update tabel produk bagian STOK
            $data2 = array('produk_stok' => $row['produk_stok'] * $row['jumlah']);
            $where = array('produk_id' => $row['produk_id']);
            $this->db->update('produk', $data2, $where);

            //hapus tabel temp
            $where2 = array(
                'pelanggan_id' => $this->input->post('pelanggan_id'),
                'user_id' => $this->session->userdata('user_id'),
            );
            $this->db->delete('temp', $where2);
        }

        //input ke tabel penjualan
        $data = array(
            'kode_penjualan' => $nota,
            'pelanggan_id' => $this->input->post('pelanggan_id'),
            'total_harga' => $total,
            'penjualan_tanggal' => date('Y-m-d'),
            );
            $this->db->insert('penjualan',$data);
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-primary alert-dismissible" role="alert">
                Penjualan berhasil!
            </div>
            ');
            redirect('penjualan/invoice/'.$nota);
    }

    public function invoice($kode_penjualan){
            $this->db->select('*');
            $this->db->from('penjualan a')->order_by('a.penjualan_tanggal', 'DESC')->where('a.kode_penjualan',$kode_penjualan);
            $this->db->join('pelanggan b','a.pelanggan_id=b.pelanggan_id', 'left');
            $penjualan = $this->db->get()->row();

            $this->db->from('penjualan_detail a');
            $this->db->join('produk b', 'a.produk_id=b.produk_id', 'left');
            $this->db->where('a.kode_penjualan', $kode_penjualan);
            $detail = $this->db->get()->result_array();

        $data = array(
            'judul_halaman' => 'Kasir | Cek Invoice',
            'nota'          => $kode_penjualan,
            'penjualan'     => $penjualan,
            'detail'     => $detail,
        );
        $this->template->load('template_admin', 'invoice', $data);
    }

}
