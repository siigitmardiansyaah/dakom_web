<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();

        // Cek apakah terdapat session dengan nama authenticated
        if( ! $this->session->userdata('authenticated')) // Jika tidak ada
            redirect('auth'); // Redirect ke halaman login

        $this->load->model('dashboard_m');
    }

    function index() {
        $data['title'] = 'Dashboard';
        $data['total1'] = $this->dashboard_m->getKaryawan();
        $data['total3'] = $this->dashboard_m->getQrCode();
        $data['total2'] = $this->dashboard_m->getDivisi();
        $data['total4'] = $this->dashboard_m->getAbsen();
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('dashboard',$data);
        $this->load->view('layouts/js');
        $this->load->view('layouts/footer');
    }


}