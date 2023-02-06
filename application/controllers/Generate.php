<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate extends CI_Controller{
    public function __construct(){
        parent::__construct();

        // Cek apakah terdapat session dengan nama authenticated
        if( ! $this->session->userdata('authenticated')) // Jika tidak ada
            redirect('auth'); // Redirect ke halaman login
            $this->load->library('ciqrcode');
            $this->load->model('qr_m');

    }

    function index() {
        if (!empty($this->session->userdata('file'))) {
			// unlink($_SERVER['DOCUMENT_ROOT'].'/smapres/assets/qrimg/'.$this->session->userdata('file'));
			$this->session->unset_userdata('file');

		}
        $data['title'] = 'Generated';
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('generated',$data);
        $this->load->view('layouts/js');
        $this->load->view('layouts/footer');
    }

    public function generated(){
        $data['title'] = 'Generated Absen';
            $date = date('Y-m-d');
			$this->db->trans_start();			

			$maxIDQR = $this->db->query("SELECT * FROM tbqr order by id_qr DESC")->row();
            $cekQR = $this->db->query("SELECT * FROM tbqr where DATE_FORMAT(waktu_buat,'%Y-%m-%d') = '$date' order by id_qr DESC")->row();
            if(empty($cekQR)) {
                if(empty($maxIDQR)) {
                    $id_qrnew = 1;
                }else{
                    $id_qrnew = $maxIDQR->id_qr + 1;
                }
            
                  $datainsert = array(
                    "qr"  => $qrRaw = $id_qrnew

                  );
                $this->db->trans_complete();						
    
                $lokasiFileQr = $_SERVER['DOCUMENT_ROOT'].'/smapres/assets/qrimg/';
                $file_name = $qrRaw.".png";
                $tempdir = $lokasiFileQr.$file_name;
                QRcode::png($qrRaw,$tempdir,QR_ECLEVEL_H,15,0);
                $this->qr_m->generateQr($datainsert);
                $infoQr = array(
                    "fileQr"	=> $file_name,
                    "qr"		=> $qrRaw,
                );	
                $this->session->set_userdata('file', $file_name);
                $this->load->view('layouts/header',$data);
                $this->load->view('layouts/sidebar');
                $this->load->view('layouts/navbar');					
                $this->load->view('generated_view', $infoQr);
                $this->load->view('layouts/js');
            $this->load->view('layouts/footer');
            } else {
                $this->session->set_flashdata('error','Hanya Bisa Generated Absen QR 1 Kali Saja Dalam Sehari');
                redirect('generate');
            }
	}

    function history() {
        $data['title'] = 'Generated History';
        $data['data'] = $this->db->query("SELECT * FROM tbqr order by id_qr")->result();
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('history',$data);
        $this->load->view('layouts/js');
        $this->load->view('layouts/footer');
    }


}