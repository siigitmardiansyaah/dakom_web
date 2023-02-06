<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Qr_m extends CI_Model {

    function getJam() {
        return $this->db->get('tbqr')->result();
    }

    function generateQr($data)
    {
      $this->db->trans_start();
      $this->db->insert("tbqr", $data);
      $this->db->trans_complete();
      return true;
    }

    

}