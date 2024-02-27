<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
    }
	public function index(){
        $this->db->from('produk');
        $produk = $this->db->get()->result_array();

		$data = array(
            'judul_halaman' => 'Kasir | Produk',
            'produk'        => $produk,
        );
		$this->template->load('template_admin','produk',$data);
	}

    public function simpan(){
        $data = array(
            'produk_kode' => $this->input->post('produk_kode'),
            'produk_nama' => $this->input->post('produk_nama'),
            'produk_harga' => $this->input->post('produk_harga'),
            'produk_stok' => $this->input->post('produk_stok')

        );
        $this->db->insert('produk',$data);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Tambah Produk Berhasil
                </div>
            ');
        redirect('produk');
    }

    public function delete_data($id)
    {
        $where = array('produk_id' => $id);
        $this->db->delete('produk', $where);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Hapus Produk Berhasil
                </div>
            ');
        redirect('produk');

    }

    public function update(){
        $where = array(
            'produk_id'   => $this->input->post('produk_id')
        );
        $data = array(
            'produk_kode'      => $this->input->post('produk_kode'),
            'produk_nama'      => $this->input->post('produk_nama'),
            'produk_harga'      => $this->input->post('produk_harga'),
            'produk_stok'      => $this->input->post('produk_stok')
        );
        $this->db->update('produk',$data,$where);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Update Produk Berhasil
                </div>
            ');
        redirect('produk');
    }
}
