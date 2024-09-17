<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin/Login_model', 'Login_model');
  }

  public function index()
  {
    $this->load->view('admin/register'); // Memuat tampilan form register
  }

  public function register_user()
  {
    // Validasi form untuk input username dan password
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');

    if ($this->form_validation->run() == TRUE) {
      // Ambil input dari form
      $username = trim($this->input->post('username'));
      $password = trim($this->input->post('password'));
      $nama = trim($this->input->post('nama'));

      // Hash password sebelum menyimpannya ke database
      $password_hash = password_hash($password, PASSWORD_DEFAULT);

      // Panggil model untuk menyimpan data pengguna baru
      $data = [
        'username' => $username,
        'password' => $password_hash,  // Simpan password yang sudah di-hash
        'nama' => $nama,
        'createdAt' => date('Y-m-d H:i:s'), // Waktu pendaftaran
      ];

      // Simpan data ke database
      $this->Login_model->register($data);

      // Redirect ke halaman login atau halaman lain setelah sukses register
      $this->session->set_flashdata('success_msg', 'Registrasi berhasil. Silakan login.');
      redirect('login');
    } else {
      $this->session->set_flashdata('error_msg', validation_errors());
      $this->load->view('admin/register');
    }
  }
}
