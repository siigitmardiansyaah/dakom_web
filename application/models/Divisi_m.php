<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Divisi_m extends CI_Model {

    function getJam() {
        return $this->db->get('tbdivisi')->result();
    }

    function insert($data)
    {
      $this->db->trans_start();
      $this->db->insert("tbdivisi", $data);
      $query = $this->db->trans_complete();
      if($query) {
        return true;
      }else{
        return false;
      }      }

    function update($data,$id)
    {
        $this->db->set($data);
        $this->db->where('id_divisi', $id);
        $query = $this->db->update("tbdivisi");
        if($query) {
            return true;
          }else{
            return false;
          }      }

    function delete($id) {
        $this->db->where('id_divisi',$id);
        $query = $this->db->delete('tbdivisi');
        if($query) {
            return true;
          }else{
            return false;
          }      }

    function get($id) {
        $this->db->where('id_divisi',$id);
        return  $this->db->get('tbdivisi')->row();
    }

}