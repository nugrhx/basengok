<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin/Login_model', 'Login_model');
  }

  public function index()
  {
    $session = $this->session->userdata('status');

    if ($session == '') {
      $this->load->view('admin/login');
    } else {
      redirect('admin');
    }
  }

  public function login()
  {
    $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == TRUE) {
      $username = trim($this->input->post('username'));
      $password = trim($this->input->post('password'));

      // Panggil fungsi login dari model
      $user = $this->Login_model->login($username, $password);

      if ($user == false) {
        $this->session->set_flashdata('error_msg', 'Username atau Password Anda Salah.');
        redirect('login');
      } else {
        // Buat session jika login berhasil
        $session = [
          'userdata' => $user,
          'status' => "Logged in"
        ];
        $this->session->set_userdata($session);
        redirect('admin');
      }
    } else {
      $this->session->set_flashdata('error_msg', validation_errors());
      redirect('login');
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
  }
}
