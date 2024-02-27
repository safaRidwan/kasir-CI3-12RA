<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
    }
	public function index(){
        $this->db->from('pelanggan');
        $pelanggan = $this->db->get()->result_array();

		$data = array(
            'judul_halaman' => 'Kasir | pelanggan',
            'pelanggan'        => $pelanggan,
        );
		$this->template->load('template_admin','pelanggan',$data);
	}

    public function simpan(){
        $data = array(
            'pelanggan_nama' => $this->input->post('pelanggan_nama'),
            'pelanggan_alamat' => $this->input->post('pelanggan_alamat'),
            'pelanggan_telp' => $this->input->post('pelanggan_telp')

        );
        $this->db->insert('pelanggan',$data);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Tambah Pelanggan Berhasil
                </div>
            ');
        redirect('pelanggan');
    }

    
    public function delete_data($id)
    {
        $where = array('pelanggan_id' => $id);
        $this->db->delete('pelanggan', $where);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Hapus Produk Berhasil
                </div>
            ');
        redirect('pelanggan');

    }

    public function update(){
        $where = array(
            'pelanggan_id'   => $this->input->post('pelanggan_id')
        );
        $data = array(
            'pelanggan_nama'      => $this->input->post('pelanggan_nama'),
            'pelanggan_alamat'      => $this->input->post('pelanggan_alamat'),
            'pelanggan_telp'      => $this->input->post('pelanggan_telp')
        );
        $this->db->update('pelanggan',$data,$where);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Update Produk Berhasil
                </div>
            ');
        redirect('pelanggan');
    }
}
