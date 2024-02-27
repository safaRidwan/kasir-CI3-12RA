<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
	public function index(){

		$this->load->view('login');
	}

    public function login(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->from('user');
        $this->db->where('username',$username);
        $cek = $this->db->get()->row();
        if($cek==NULL){
            $this->session->set_flashdata('notifikasi','
                <div class="alert alert-warning alert-dismissible" role="alert">
                        Username tidak ada TOLOL !
                </div>
                ');
                redirect('auth');
        }elseif($password==$cek->password){
            $data = array(
                'user_id' => $cek->user_id,
                'nama' => $cek->nama,
                'username' => $cek->username,
                'level' => $cek->level
            );
            $this->session->set_userdata($data);
                redirect('home');
        }else{
            $this->session->set_flashdata('notifikasi','
            <div class="alert alert-danger alert-dismissible" role="alert">
                    Password Salah minnnn!
            </div>
            ');
            redirect('auth');
        }
	}
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }

}
