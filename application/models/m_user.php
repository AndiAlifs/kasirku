<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

	function input_barang($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function user($username)
	{
		$hasil = $this->db->query("SELECT * FROM pegawai where username = '$username'")->row();
		return $hasil;
	}

	public function get_photo($user_id)
    {
        $this->db->select('image');

        return $this->db->get_where('pegawai', ['id_user' => $user_id])->row();
    }

	public function update_photo($user_id, $photo)
    {
        $this->db->update('pegawai', ['image' => $photo], ['id_user' => $user_id]);
    }

	function kelolauser(){
		$this->db->select('*');
		$this->db->from('pegawai');
		return $this->db->get()->num_rows();
	}

	function tampil_data()
    {
		return $this->db->get('pegawai')->result();
	}

	function input_data($data)
    {
        $this->db->insert('pegawai',$data);
    }

	public function hapusData($id_user){
		$this->db->where('id_user',$id_user);
        $this->db->delete('pegawai');
    }

	public function get_data($id_user){
		$this->db->where('id_user',$id_user);
        return $this->db->get('pegawai')->row();
    }

	public function update($data){
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('pegawai', $data);
    }
}
