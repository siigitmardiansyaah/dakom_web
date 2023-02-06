<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model('auth_m');
  }

  public function index(){
    if($this->session->userdata('authenticated')) // Jika user sudah login (Session authenticated ditemukan)
      redirect('dashboard'); // Redirect ke page welcome

    $this->load->view('login'); // Load view login.php
  }

  public function login(){
    $username = $this->input->post('nip'); // Ambil isi dari inputan username pada form login
    $password = md5($this->input->post('password')); // Ambil isi dari inputan password pada form login dan encrypt dengan md5

    $user = $this->auth_m->get($username); // Panggil fungsi get yang ada di UserModel.php

    if(empty($user)){ // Jika hasilnya kosong / user tidak ditemukan
      $this->session->set_flashdata('error', 'NIP tidak ditemukan'); // Buat session flashdata
      redirect('auth'); // Redirect ke halaman login
    }else{
      if(($user->kd_divisi == 'HRD') || ($user->kd_divisi == 'SU')) {
        if($password == $user->password) { // Jika password yang diinput sama dengan password yang didatabase
          $session = array(
            'authenticated'=>true, // Buat session authenticated dengan value true
            'nip'=>$user->nip,  // Buat session username
            'nama'=>$user->nama,
            'nama_divisi'=>$user->nama_divisi,
            'id_karyawan'=>$user->id_karyawan // Buat session authenticated
          );
          
          $this->session->set_userdata($session); // Buat session sesuai $session
          redirect('dashboard'); // Redirect ke halaman welcome
          }else{
          $this->session->set_flashdata('error', 'Password salah'); // Buat session flashdata
          redirect('auth'); // Redirect ke halaman login
          }
      }else{
        $this->session->set_flashdata('error', 'Anda Berbeda Divisi'); // Buat session flashdata
        redirect('auth'); // Redirect ke halaman login
      }
    }
  }

  public function logout(){
    $this->session->sess_destroy(); // Hapus semua session
    redirect('auth'); // Redirect ke halaman login
  }
}