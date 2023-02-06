<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Karyawan_m extends CI_Model {

    function getJam() {
        $this->db->join('tbdivisi b','a.id_divisi = b.id_divisi');
        return $this->db->get('tbkaryawan a')->result();
    }

    function insert($data)
    {
      $this->db->trans_start();
      
      $query = $this->db->insert("tbkaryawan", $data);
      $this->db->trans_complete();
      if($query) {
        return true;
      }else{
        return false;
      }
    }

    function update($data,$id)
    {
        $this->db->set($data);
        $this->db->where('id_karyawan', $id);
        $this->db->update("tbkaryawan");
        $query = $this->db->trans_complete();
        if($query) {
          return true;
        }else{
          return false;
        }    
    }

    function delete($id) {
        $this->db->where('id_karyawan',$id);
        $query = $this->db->delete('tbkaryawan');
        if($query) {
            return true;
          }else{
            return false;
          }      }

    function get($id) {
        $this->db->where('id_karyawan',$id);
        return  $this->db->get('tbkaryawan')->row();
    }

}