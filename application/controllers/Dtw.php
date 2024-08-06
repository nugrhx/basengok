<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dtw extends AUTH_Controller
{
  public function __construct()
  {
    Parent::__construct();
    $this->load->model('admin/Dtw_model', 'dtw');

    // if (($this->userdata->id_role != 1) && ($this->userdata->id_role != 2)) { // check for admin session and methos is login
    //   echo "<script>alert('Anda bukan Admin! Anda tidak berhak mengakses halaman ini!');
    //   window.location.href='home';
    //   </script>";
    // }
  }

  public function index()
  {
    $pagedata['page']             = "dtw";
    $pagedata['judul']            = "Data DTW";
    $pagedata['deskripsi']        = "Manage Data DTW";
    $pagedata['title']            = "DTW";

    $this->admintemplate->views('admin/dtw/home', $pagedata);
  }

  public function ajax_list()
  {

    $list = $this->dtw->get_datatables();
    $no = $_POST['start'] + 1;
    $data = array();
    foreach ($list as $dtw) {
      $row = array();
      $row[] = $no++;
      $row[] = $dtw->nama;
      $row[] = $dtw->deskripsi;
      $row[] = $dtw->lokasi;
      $row[] = $dtw->kategori;

      //add html for action
      $row[] = '
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_dtw(' . "'" . $dtw->id_dtw . "'" . ')"><i class="fa fa-edit fa-xs"></i> Edit</a>
        
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_dtw(' . "'" . $dtw->id_dtw . "'" . ')"><i class="fa fa-trash fa-xs"></i> Delete</a>';

      // check if soft_delete status is 0
      if ($dtw->soft_delete == 0) {
        $data[] = $row;
      }
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->dtw->count_all(),
      "recordsFiltered" => $this->dtw->count_filtered(),
      "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }

  public function ajax_edit($id)
  {
    $data = $this->dtw->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_add()
  {
    $this->_validate();
    $data = array(
      'nama'      => $this->input->post('nama'),
      'deskripsi' => $this->input->post('deskripsi'),
      'lokasi'    => $this->input->post('lokasi'),
      'kategori'  => $this->input->post('kategori'),
    );
    $insert = $this->dtw->save($data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_update()
  {
    $this->_validate();
    $data = array(
      'nama' => $this->input->post('nama'),
      'deskripsi' => $this->input->post('deskripsi'),
      'lokasi' => $this->input->post('lokasi'),
      'kategori' => $this->input->post('kategori'),
    );
    $this->dtw->update(array('id_dtw' => $this->input->post('id_dtw')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
    $this->dtw->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
  }

  private function _validate()
  {
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if ($this->input->post('nama') == '') {
      $data['inputerror'][] = 'nama';
      $data['error_string'][] = 'Nama DTW is required';
      $data['status'] = FALSE;
    }

    if ($this->input->post('deskripsi') == '') {
      $data['inputerror'][] = 'deskripsi';
      $data['error_string'][] = 'deskripsi is required';
      $data['status'] = FALSE;
    }

    if ($this->input->post('lokasi') == '') {
      $data['inputerror'][] = 'lokasi';
      $data['error_string'][] = 'lokasi is required';
      $data['status'] = FALSE;
    }

    if ($this->input->post('kategori') == '') {
      $data['inputerror'][] = 'kategori';
      $data['error_string'][] = 'kategori is required';
      $data['status'] = FALSE;
    }

    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }
  }
}
