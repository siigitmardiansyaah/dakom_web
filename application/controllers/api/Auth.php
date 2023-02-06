<?php
require APPPATH . 'libraries/REST_Controller.php';
header("Content-Type: application/json; charset=UTF-8");

class Auth extends REST_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_m');
    }

    // method index untuk menampilkan semua data mahasiswa dengan get
    function index_post()
    {
            $nip = $this->input->post('nip');
            $device = $this->input->post('device_id');
            $password = md5($this->input->post('password'));
            $response = $this->auth_m->login($nip,$password,$device);
            $this->response($response);
    }

    function register_post()
    {
            $nip = $this->input->post('nip');
            $device = $this->input->post('device_id');
            $password = md5($this->input->post('password'));
            $response = $this->auth_m->register($nip,$password,$device);
            $this->response($response);
    }

}
