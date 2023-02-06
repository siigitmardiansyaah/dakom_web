<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_m extends CI_Model {

    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
      }
    
      // API
        function login($nip,$password,$device) 
        {
            if(empty($nip) || empty($password))
            {
                return $this->empty_response();
            }else{
                $this->db->where('nip',$nip);
                $query = $this->db->get('tbkaryawan')->row();
                if($password != $query->password)
                {
                    $response['status']=502;
                    $response['error']=true;
                    $response['message']='Password Tidak Sama';
                    return $response;
                }else if($device != $query->device_id)
                {
                    $response['status']=502;
                    $response['error']=true;
                    $response['message']='Anda Login Di Device Yang Berbeda, Silahkan hubungi Admin untuk memperbarui data Device';
                    return $response;
                }else{
                    $this->db->join("tbdivisi b","a.id_divisi = b.id_divisi");
                    $this->db->where('a.nip',$nip);
                    $query1 = $this->db->get('tbkaryawan a')->row();
                    if($query1){
                        $response['status']=200;
                        $response['error']=false;
                        $response['message']='Data Pegawai.';
                        $response['login']=[
                            'id_pegawai' => $query1->id_karyawan,
                            'nip' => $query1->nip,
                            'nama' => $query1->nama,
                            'kd_div' =>$query1->kd_divisi,
                        ];
                        return $response;
                    }else{
                        $response['status']=502;
                        $response['error']=true;
                        $response['message']='Data Pegawai gagal ditampilkan.';
                        return $response;
                    }
                    }
                }
        }

        function register($nip, $password, $device){
            if(empty($nip) || empty($password))
            {
                return $this->empty_response();
            } else {
                $this->db->where('nip',$nip);
                $query = $this->db->get('tbkaryawan')->row();
                if(($query->password == null || $query->password == '' )  && ($query->device_id == null || $query->device_id == ''))
                {
                    $data = array(
                        'device_id' => $device,
                        'password'  => $password,
                    );
                    $this->db->where('nip',$nip);
                    $query1 = $this->db->update('tbkaryawan', $data);
                    if($query1)
                    {
                        $response['status']=200;
                        $response['error']=false;
                        $response['message']="Anda Berhasil Register";
                        return $response;
                    }else{
                        $response['status']=502;
                        $response['error']=true;
                        $response['message']="Anda Gagal Register";
                        return $response;
                    }
                }else{
                    $response['status']=502;
                    $response['error']=true;
                    $response['message']="Anda Telah Register Sebelumnya, Jika ingin Login berbeda device silahkan hubungi Admin terlebih dahulu";
                    return $response;
                }
            }
        }
    // API

    // WEB
    public function get($username){
        $this->db->join('tbdivisi b','a.id_divisi = b.id_divisi');
        $this->db->where('a.nip', $username); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('tbkaryawan a')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }
    // WEB
}