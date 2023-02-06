<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap extends CI_Controller{
    public function __construct(){
        parent::__construct();

        // Cek apakah terdapat session dengan nama authenticated
        if( ! $this->session->userdata('authenticated')) // Jika tidak ada
            redirect('auth'); // Redirect ke halaman login
    }

    function index() {
        $data['title'] = 'Rekap Absen';
        $date = date('Y-m-d');
        $data['rekap'] = $this->db->query("select a.*, b.*,c.*,d.* from tbabsen a join tbkaryawan b on a.id_karyawan = b.id_karyawan join tbdivisi c on b.id_divisi = c.id_divisi join tbjam d on a.id_jam = d.id_jam where DATE_FORMAT(a.waktu_absen,'%Y-%m-%d') = '$date'")->result();
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('rekap',$data);
        $this->load->view('layouts/js');
        $this->load->view('layouts/footer');
    }

    public function filter(){
            $data['title'] = 'Print Rekap';
            $awal = $this->input->post('awal');
            $akhir = $this->input->post('akhir');
            $data['rekap'] = $this->db->query("select a.*, b.*,c.*,d.* from tbabsen a join tbkaryawan b on a.id_karyawan = b.id_karyawan join tbdivisi c on b.id_divisi = c.id_divisi join tbjam d on a.id_jam = d.id_jam where a.waktu_absen between '$awal' AND '$akhir'")->result();
			$this->load->view('print', $data);
	}


}