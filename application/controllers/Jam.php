<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jam extends CI_Controller{
    public function __construct(){
        parent::__construct();

        // Cek apakah terdapat session dengan nama authenticated
        if( ! $this->session->userdata('authenticated')) // Jika tidak ada
            redirect('auth'); // Redirect ke halaman login

        $this->load->model('jam_m');
    }

    function index() {
        $data['title'] = 'Jam Absensi';
        $data['jam'] = $this->jam_m->getJam();
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('jam',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function tambah() {
        $data['title'] = 'Jam Absensi';
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('add_jam',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function store(){
        $data = array(
            'nama_jam' => $this->input->post('nama'),
            'batas_awal' => $this->input->post('batas_awal'),
            'batas_akhir' => $this->input->post('batas_akhir')
        );
        $query = $this->jam_m->insert($data);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Menyimpan Jam Absen');
            redirect('jam');
        }else{
            $this->session->set_flashdata('error','Gagal Menyimpan Jam Absen');
            redirect('jam/add_jam');
        }
    }

    function edit($id) {
        $data['title'] = 'Jam Absensi';
        $data['jam'] = $this->jam_m->get($id);
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('edit_jam',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function update(){
        $id = $this->input->post('id');
        $data = array(
            'nama_jam' => $this->input->post('nama'),
            'batas_awal' => $this->input->post('batas_awal'),
            'batas_akhir' => $this->input->post('batas_akhir')
        );
        $query = $this->jam_m->update($data,$id);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Update Jam Absen');
            redirect('jam');
        }else{
            $this->session->set_flashdata('error','Gagal Update Jam Absen');
            redirect("jam/edit_jam/$id");
        }
    }

    function hapus($id) {
        $query = $this->jam_m->delete($id);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Hapus Jam Absen');
            redirect('jam');
        }else{
            $this->session->set_flashdata('error','Gagal Hapus Jam Absen');
            redirect("jam");
        }
    }


}