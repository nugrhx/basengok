<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    Parent::__construct();
    $this->load->model('admin/Dtw_model', 'dtw');
    $this->load->model('admin/Amenitas_model', 'amenitas');
    $this->load->model('admin/Kategori_model', 'kategori');
  }

  public function index(string $page = 'home')
  {
    $data['active'] = 'active';

    $this->load->view('/layout/header');
    $this->load->view('/layout/nav', $data);
    $this->load->view('home/' . $page);
    $this->load->view('/layout/footer');
  }

  public function amenitas(string $page = 'home')
  {
    $data['active'] = 'active';

    $this->load->view('/layout/header');
    $this->load->view('/layout/nav', $data);
    $this->load->view('amenitas/' . $page);
    $this->load->view('/layout/footer');
  }

  public function pendukung(string $page = 'home')
  {
    $data['active'] = 'active';

    $this->load->view('/layout/header');
    $this->load->view('/layout/nav', $data);
    $this->load->view('pendukung/' . $page);
    $this->load->view('/layout/footer');
  }

  public function dtw(string $page = 'home')
  {
    $data['active'] = 'active';

    $this->db->where('soft_delete', 0);
    $query = $this->db->get('dtw');
    $list['dtw'] = $query->result();

    $this->load->view('/layout/header');
    $this->load->view('/layout/nav', $data);
    $this->load->view('dtw/' . $page, $list);
    $this->load->view('/layout/footer');
  }
}
