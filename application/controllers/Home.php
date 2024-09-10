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

    $this->db->where('soft_delete', 0);
    $query = $this->db->get('amenitas');
    $list['amenitas'] = $query->result();

    $this->load->view('/layout/header');
    $this->load->view('/layout/nav', $data);
    $this->load->view('amenitas/' . $page, $list);
    $this->load->view('/layout/footer');
  }

  public function pendukung_get_data()
  {
    $this->db->where('soft_delete', 0);
    $query = $this->db->get('pendukung');
    $data = $query->result();

    $result = array();
    $no = 1;

    foreach ($data as $row) {
      $result[] = array(
        'no' => $no++, // Berikan no urut
        'nama' => $row->nama,
        'file' => base_url('assets/upload/pendukung/' . $row->file)
      );
    }

    // Pastikan respons JSON dikirim dengan benar
    header('Content-Type: application/json');
    echo json_encode(array('data' => $result));
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

  public function dtw_detail($id_dtw)
  {
    $this->db->where('id_dtw', $id_dtw);
    $this->db->where('soft_delete', 0);
    $query = $this->db->get('dtw');
    $data = $query->row();

    echo json_encode($data);
  }
}
