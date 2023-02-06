<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller{
    public function __construct(){
        parent::__construct();

        // Cek apakah terdapat session dengan nama authenticated
        if( ! $this->session->userdata('authenticated')) // Jika tidak ada
            redirect('auth'); // Redirect ke halaman login

        $this->load->model('profile_m');
    }

    function index() {
        $data['title'] = 'Profile';
        $id = $this->session->userdata('id_karyawan');
        $data['jam'] = $this->profile_m->getJam($id);
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('profile',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function update(){
        $id = $this->input->post('id');
        $pass = $this->input->post('password');
        $pass1 = $this->input->post('password1');
        $nama = $this->input->post('nama');
        if(strlen($pass) > 0) {
            if($pass == $pass1) {
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'password' => md5($this->input->post('password')),
                );
            }else{
                $this->session->set_flashdata('error','Password Tidak Sama');
                redirect('profile');
            }
        }else{
            $data = array(
                'nama' => $this->input->post('nama'),
            );
        }
        $query = $this->profile_m->update($data,$id);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Update Profile');
            redirect('profile');
        }else{
            $this->session->set_flashdata('error','Gagal Update Profile');
            redirect("profile");
        }
    }


}