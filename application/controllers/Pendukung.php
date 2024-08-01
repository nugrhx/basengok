<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendukung extends AUTH_Controller
{
  public function __construct()
  {
    Parent::__construct();
    $this->load->model('admin/Pendukung_model', 'pendukung');

    // if (($this->userdata->id_role != 1) && ($this->userdata->id_role != 2)) { // check for admin session and methos is login
    //   echo "<script>alert('Anda bukan Admin! Anda tidak berhak mengakses halaman ini!');
    //   window.location.href='home';
    //   </script>";
    // }
  }

  public function index()
  {
    $pagedata['page']             = "pendukung";
    $pagedata['judul']            = "Data pendukung";
    $pagedata['deskripsi']        = "Manage Data pendukung";
    $pagedata['title']            = "pendukung";

    $this->admintemplate->views('admin/pendukung/home', $pagedata);
  }

  public function ajax_list()
  {

    $list = $this->pendukung->get_datatables();
    $no = $_POST['start'] + 1;
    $data = array();
    foreach ($list as $pendukung) {
      $row = array();
      $row[] = $no++;
      $row[] = $pendukung->pendukung;
      $row[] = $pendukung->tipe;

      //add html for action
      $row[] = '
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pendukung(' . "'" . $pendukung->id_kat . "'" . ')"><i class="fa fa-edit fa-xs"></i> Edit</a>
        
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pendukung(' . "'" . $pendukung->id_kat . "'" . ')"><i class="fa fa-trash fa-xs"></i> Delete</a>';

      // check if soft_delete status is 0
      if ($pendukung->soft_delete == 0) {
        $data[] = $row;
      }
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->pendukung->count_all(),
      "recordsFiltered" => $this->pendukung->count_filtered(),
      "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }

  public function ajax_edit($id)
  {
    $data = $this->pendukung->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_add()
  {
    $this->_validate();
    $data = array(
      'pendukung'      => $this->input->post('pendukung'),
      'tipe' => $this->input->post('tipe'),
    );
    $insert = $this->pendukung->save($data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_update()
  {
    $this->_validate();
    $data = array(
      'pendukung' => $this->input->post('pendukung'),
      'tipe' => $this->input->post('tipe'),
    );
    $this->pendukung->update(array('id_kat' => $this->input->post('id_kat')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
    $this->pendukung->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
  }

  private function _validate()
  {
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if ($this->input->post('pendukung') == '') {
      $data['inputerror'][] = 'pendukung';
      $data['error_string'][] = 'pendukung is required';
      $data['status'] = FALSE;
    }

    if ($this->input->post('tipe') == '') {
      $data['inputerror'][] = 'tipe';
      $data['error_string'][] = 'Tipe is required';
      $data['status'] = FALSE;
    }

    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }
  }
}
