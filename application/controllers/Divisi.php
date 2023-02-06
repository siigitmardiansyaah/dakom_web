<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisi extends CI_Controller{
    public function __construct(){
        parent::__construct();

        // Cek apakah terdapat session dengan nama authenticated
        if( ! $this->session->userdata('authenticated')) // Jika tidak ada
            redirect('auth'); // Redirect ke halaman login

        $this->load->model('divisi_m');
    }

    function index() {
        $data['title'] = 'Divisi';
        $data['jam'] = $this->divisi_m->getJam();
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('divisi',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function tambah() {
        $data['title'] = 'Divisi';
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('add_divisi',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function store(){
        $data = array(
            'kd_divisi' => $this->input->post('kd_div'),
            'nama_divisi' => $this->input->post('nama'),
        );
        $query = $this->divisi_m->insert($data);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Menyimpan Divisi');
            redirect('divisi');
        }else{
            $this->session->set_flashdata('error','Gagal Menyimpan Divisi');
            redirect('divisi/tambah');
        }
    }

    function edit($id) {
        $data['title'] = 'Divisi';
        $data['jam'] = $this->divisi_m->get($id);
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('edit_divisi',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function update(){
        $id = $this->input->post('id');
        $data = array(
            'kd_divisi' => $this->input->post('kd_div'),
            'nama_divisi' => $this->input->post('nama'),
        );
        $query = $this->divisi_m->update($data,$id);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Update Divisi');
            redirect('divisi');
        }else{
            $this->session->set_flashdata('error','Gagal Update Divisi');
            redirect("divisi/edit/$id");
        }
    }

    function hapus($id) {
        $query = $this->divisi_m->delete($id);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Hapus Divisi');
            redirect('divisi');
        }else{
            $this->session->set_flashdata('error','Gagal Hapus Divisi');
            redirect("divisi");
        }
    }


}