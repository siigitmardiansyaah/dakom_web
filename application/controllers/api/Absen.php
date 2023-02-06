<?php
require APPPATH . 'libraries/REST_Controller.php';
class Absen extends REST_Controller{
  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('absen_m');
  }

  // method index untuk menampilkan semua data absen dengan get
  public function index_post(){
    $id_pegawai = $this->input->post('id_pegawai');
    $response = $this->absen_m->all_absen($id_pegawai);
    $this->response($response);
  }

  // untuk menambah absen menggunakan method post
  public function add_post(){
    $response = $this->absen_m->add_absen(
      $this->post('id_qr'),
      $this->post('id_pegawai'),
      $this->post('long_gps'),
      $this->post('lang_gps')
    );
  $this->response($response);
  }

}

?>