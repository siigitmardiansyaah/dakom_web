<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends CI_Controller{
    public function __construct(){
        parent::__construct();

        // Cek apakah terdapat session dengan nama authenticated
        if( ! $this->session->userdata('authenticated')) // Jika tidak ada
            redirect('auth'); // Redirect ke halaman login

        $this->load->model('karyawan_m');
    }

    function index() {
        $data['title'] = 'Karyawan';
        $data['jam'] = $this->karyawan_m->getJam();
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('karyawan',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function tambah() {
        $data['title'] = 'Karyawan';
        $data['divisi'] = $this->db->query("SELECT * FROM tbdivisi order by nama_divisi asc")->result();
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('add_karyawan',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function store(){
        $data = array(
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('nama'),
            'id_divisi' => $this->input->post('id_divisi')
        );
        $query = $this->karyawan_m->insert($data);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Menyimpan Karyawan');
            redirect('karyawan');
        }else{
            $this->session->set_flashdata('error','Gagal Menyimpan Karyawan');
            redirect('karyawan/tambah');
        }
    }

    function edit($id) {
        $data['title'] = 'Divisi';
        $data['jam'] = $this->karyawan_m->get($id);
        $data['divisi'] = $this->db->query("SELECT * FROM tbdivisi order by nama_divisi asc")->result();
        $this->load->view('layouts/header',$data);
        $this->load->view('layouts/sidebar');
        $this->load->view('layouts/navbar');
        $this->load->view('edit_karyawan',$data);
        $this->load->view('layouts/js');
        $this->load->view('js/all_js');
        $this->load->view('layouts/footer');
    }

    function update(){
        $id = $this->input->post('id');
        $data = array(
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('nama'),
            'id_divisi' => $this->input->post('id_divisi')
        );
        $query = $this->karyawan_m->update($data,$id);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Update Karyawan');
            redirect('karyawan');
        }else{
            $this->session->set_flashdata('error','Gagal Update Karyawan');
            redirect("karyawan/edit/$id");
        }
    }

    function hapus($id) {
        $query = $this->karyawan_m->delete($id);
        if($query) {
            $this->session->set_flashdata('success','Berhasil Hapus Karyawan');
            redirect('karyawan');
        }else{
            $this->session->set_flashdata('error','Gagal Hapus Karyawan');
            redirect("karyawan");
        }
    }


}