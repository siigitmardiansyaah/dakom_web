<?php
// extends class Model
class Profile_m extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // mengambil data mahasiswa
  public function the_mahasiswa($nis){
    if($nis == ''){
      $all = $this->db->get("tbsiswa")->result();
      $response['status']=200;
      $response['error']=false;
      $response['mahasiswa']=$all;
      return $response;
    }else{
      $where = array(
        "id_siswa"=>$nis
      );
      $this->db->where($where);
      $theid = $this->db->get("tbsiswa")->result();
      if($theid){
        $response['status']=200;
        $response['error']=false;
        $response['mahasiswa']=$theid;
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data mahasiswa gagal ditampilkan.';
        return $response;
      }
    }
  }

  // update password mahasiswa
  public function update_pegawai($nis,$nama, $password){
    if(empty($nis) || empty($password)){
      return $this->empty_response();
    }else{
      $where = array(
        "id_karyawan"=>$nis
      );
      if($nama != null && $password != null){
        $set = array(
          "nama" => $nama,
          "password"=>md5($password)
        );
      }else{
        $set = array(
          "password"=>md5($password)
        );
      }
      $this->db->where($where);
      $update = $this->db->update("tbkaryawan",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data Karyawan diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data Karyawan Gagal Diubah.';
        return $response;
      }
    }
  }

  function getJam($id) {
    $this->db->where('id_karyawan',$id);
    return $this->db->get('tbkaryawan')->row();
  }
  
  function update($data,$id)
      {
          $this->db->set($data);
          $this->db->where('id_karyawan', $id);
          $query = $this->db->update("tbkaryawan");
          if($query) {
            return true;
          }else{
            return false;
          }
      }
  
}



?>