<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('home');
        }
    }
	public function index(){
        $this->db->from('user');
        $user = $this->db->get()->result_array();

		$data = array(
            'judul_halaman' => 'Kasir | User',
            'user'        => $user,
        );
		$this->template->load('template_admin','user',$data);
	}

    public function simpan(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'level' => $this->input->post('level')

        );
        $this->db->insert('user',$data);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Tambah User Berhasil
                </div>
            ');
        redirect('user');
    }

    
    public function delete_data($id)
    {
        $where = array('user_id' => $id);
        $this->db->delete('user', $where);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Hapus User Berhasil
                </div>
            ');
        redirect('user');

    }

    public function update(){
        $where = array(
            'user_id'   => $this->input->post('user_id')
        );
        $data = array(
            'nama'      => $this->input->post('nama'),
            'username'      => $this->input->post('username'),
            'level'      => $this->input->post('level')
        );
        $this->db->update('user',$data,$where);
        $this->session->set_flashdata('notifikasi','
                <div class="alert alert-success alert-dismissible" role="alert">
                    Update User Berhasil
                </div>
            ');
        redirect('user');
    }
}
