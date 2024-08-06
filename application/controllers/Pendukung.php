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

      //add html for action
      $row[] = '
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pendukung(' . "'" . $pendukung->id_pen . "'" . ')"><i class="fa fa-edit fa-xs"></i> Edit</a>
        
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pendukung(' . "'" . $pendukung->id_pen . "'" . ')"><i class="fa fa-trash fa-xs"></i> Delete</a>';

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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $uploadDir = 'assets/uploads/pendukung/';
      $errors = [];
      $uploadedFiles = [];

      foreach ($_FILES['file']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['file']['name'][$key]);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($tmpName, $targetFilePath)) {
          $uploadedFiles[] = $fileName; // Collect uploaded file names
        } else {
          $errors[] = "Error uploading file: $fileName";
        }
      }

      if (empty($errors)) {
        echo json_encode(['status' => 'success', 'files' => $uploadedFiles]);
      } else {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
      }
    }
  }

  public function ajax_update()
  {
    $this->_validate();
    $data = array(
      'pendukung' => $this->input->post('pendukung'),
    );

    // Handle file input
    if (!empty($_FILES['file']['name'])) {
      $config['upload_path'] = './uploads/'; // Specify the upload directory
      $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|xls|doc|docx';
      $config['max_size'] = 2048; // Specify the maximum file size in kilobytes

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('file')) {
        $data['inputerror'][] = 'file';
        $data['error_string'][] = $this->upload->display_errors('', '');
        $data['status'] = FALSE;
      } else {
        $upload_data = $this->upload->data();
        $data['file'] = $upload_data['file_name'];
      }
    }

    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }

    $this->pendukung->update(array('id_pen' => $this->input->post('id_pen')), $data);
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
      $data['error_string'][] = 'Pendukung is required';
      $data['status'] = FALSE;
    }

    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }
  }
}
