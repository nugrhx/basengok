<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
  public function register($data)
  {
    // Simpan data pengguna baru ke dalam tabel 'admin'
    $this->db->insert('admin', $data);
  }

  public function login($username, $password)
  {
    // Ambil data pengguna berdasarkan username
    $this->db->select('*');
    $this->db->from('admin');
    $this->db->where('username', $username);

    $data = $this->db->get();

    // Periksa apakah pengguna ditemukan
    if ($data->num_rows() == 1) {
      $user = $data->row();

      // Verifikasi password dengan password terenkripsi di database
      if (password_verify($password, $user->password)) {
        return $user; // Password cocok, kembalikan data pengguna
      } else {
        return false; // Password tidak cocok
      }
    } else {
      return false; // Username tidak ditemukan
    }
  }
}
