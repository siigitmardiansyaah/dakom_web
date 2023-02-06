<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Dashboard_m extends CI_Model {

    function getKaryawan() {
        return $this->db->get('tbkaryawan')->num_rows();
    }

    function getQrCode() {
        return $this->db->get('tbqr')->num_rows();
    }

    function getDivisi() {
        return $this->db->get('tbdivisi')->num_rows();
    }

    function getAbsen() {
        $date = date('Y-m-d');
        $this->db->where("DATE_FORMAT(waktu_absen,'%Y-%m-%d')",$date);
        $this->db->where('id_jam',1);
        return $this->db->get('tbabsen')->num_rows();
    }
}