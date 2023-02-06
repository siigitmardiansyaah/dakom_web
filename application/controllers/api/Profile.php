<?php
require APPPATH . 'libraries/REST_Controller.php';
class Profile extends REST_Controller{
  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('profile_m');
  }

  // hapus data mahasiswa menggunakan method delete
  public function index_post(){
    $response = $this->profile_m->the_mahasiswa(
        $this->post('id_siswa')
      );
    $this->response($response);
  }

  // update data mahasiswa menggunakan method put
  public function index_put(){
    $response = $this->profile_m->update_pegawai(
        $this->put('id_pegawai'),
        $this->put('nama'),
        $this->put('password')
      );
    $this->response($response);
  }

}

?>