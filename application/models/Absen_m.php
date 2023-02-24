<?php
date_default_timezone_set("Asia/Jakarta");
// extends class Model
class Absen_m extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tbabsen
  public function add_absen($id_qr, $id_pegawai,$long_gps,$lan_gps){

   
    $radius_bumi = 6371;
    // LOKASI USER
      $lat_user =  ($lan_gps * 3.14) / 180;
      $long_user = ($long_gps * 3.14) / 180;
    // LOKASI USER

    // LOKASI SEKOLAH
      $lat_sekolah = (-6.256720 * 3.14) / 180;
      $long_sekolah = (107.040841 * 3.14) / 180;
    // LOKASI SEKOLAH

    // RUMUS HARVERSINE
      $lat = $lat_sekolah - ($lat_user);
      $long = $long_sekolah - $long_user;
      $a = (sin($lat / 2) * sin($lat / 2))  + cos($lat_user) * cos($lat_sekolah) * (sin($long/2) * sin($long/2));
      $c = 2 * asin(sqrt($a));
      $jarak = $radius_bumi * 2 * $c;
      $banding = floor($jarak * 1000);
    // RUMUS HARVERSINE

    if($banding > 50)
    {
      $response['status']=502;
      $response['error']=true;
      $response['message']="Jarak anda $banding Meter,terlalu jauh untuk absen";
      return $response;
    }else{
        $hari_ini = date('Y-m-d');
        $jam_sekarang = date('H:i');
        $cekQR = $this->db->query("SELECT * FROM tbabsen where id_karyawan = '$id_pegawai' AND DATE_FORMAT(waktu_absen, '%Y-%m-%d') = '$hari_ini' ")->num_rows();
        $cekJamDatang = $this->db->query("SELECT * from tbabsen where id_karyawan = '$id_pegawai' AND id_jam = 1 AND DATE_FORMAT(waktu_absen, '%Y-%m-%d') = '$hari_ini'")->num_rows();
        $cekJamPulang = $this->db->query("SELECT * from tbabsen where id_karyawan = '$id_pegawai' AND id_jam = 2 AND DATE_FORMAT(waktu_absen, '%Y-%m-%d') = '$hari_ini'")->num_rows();
        $queryJamDatang = $this->db->query("SELECT * FROM tbjam where id_jam = 1")->row();
        $queryJamPulang = $this->db->query("SELECT * FROM tbjam where id_jam = 2")->row();
        if($cekQR <= 2) {
          if($cekJamDatang < 1 && $cekJamPulang < 1) {
            if($jam_sekarang >= date('H:i',strtotime($queryJamDatang->batas_awal)) && $jam_sekarang <= date('H:i',strtotime($queryJamDatang->batas_akhir))) {
                $data = array(
                  "id_qr"=>$id_qr,
                  "id_karyawan"=>$id_pegawai,
                  "waktu_absen" =>date('Y-m-d H:i:s'),
                  "id_jam" => 1,
                );
                $insert = $this->db->insert("tbabsen", $data);
                if($insert) {
                  $response['status']=200;
                  $response['error']=false;
                  $response['message']='Data absen ditambahkan.';
                  return $response;
                }else{
                  $response['status']=502;
                  $response['error']=true;
                  $response['message']='Data absen gagal ditambahkan.';
                  return $response;
                }
            }else{
              $response['status']=502;
              $response['error']=true;
              $response['message']='Anda Sudah Melewati Jam Absen Datang';
              return $response;
            }

          }else if($cekJamDatang == 1 && $cekJamPulang < 1) {
            if($jam_sekarang >= date('H:i',strtotime($queryJamPulang->batas_awal)) && $jam_sekarang < date('H:i',strtotime($queryJamPulang->batas_akhir))) {
              $data = array(
                  "id_qr"=>$id_qr,
                  "id_karyawan"=>$id_pegawai,
                  "waktu_absen" =>date('Y-m-d h:i:s'),
                  "id_jam" => 2,
                );
                $insert = $this->db->insert("tbabsen", $data);
                if($insert) {
                  $response['status']=200;
                  $response['error']=false;
                  $response['message']='Data absen ditambahkan.';
                  return $response;
                }else{
                  $response['status']=502;
                  $response['error']=true;
                  $response['message']='Data absen gagal ditambahkan.';
                  return $response;
                }
              }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']='Sudah Melewati Jam Absen Pulang.';
                return $response;
              }
          }else{
              $response['status']=502;
                $response['error']=true;
                $response['message']='Anda Sudah Absen untuk Hari ini';
                return $response;
          }
        } else {
          $response['status']=502;
          $response['error']=true;
          $response['message']='Anda Sudah Absen untuk Hari ini';
          return $response;
        }

    }
  }

  // mengambil semua data absen
  public function all_absen($id_pegawai){
    $this->db->select("b.nama_jam as keterangan, DATE_FORMAT(a.waktu_absen, '%W, %d-%m-%Y, %H:%i') as waktu_absen");
    $this->db->join("tbjam b",'a.id_jam = b.id_jam');
    $this->db->where("a.id_karyawan",$id_pegawai);
    $all = $this->db->get("tbabsen a")->result();
    $response['status']=200;
    $response['error']=false;
    $response['absen']=$all;
    return $response;
  }
}

?>
