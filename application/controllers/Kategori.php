<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends AUTH_Controller
{
  public function __construct()
  {
    Parent::__construct();
    $this->load->model('admin/Kategori_model', 'kategori');

    // if (($this->userdata->id_role != 1) && ($this->userdata->id_role != 2)) { // check for admin session and methos is login
    //   echo "<script>alert('Anda bukan Admin! Anda tidak berhak mengakses halaman ini!');
    //   window.location.href='home';
    //   </script>";
    // }
  }

  public function index()
  {
    $pagedata['page']             = "kategori";
    $pagedata['judul']            = "Data kategori";
    $pagedata['deskripsi']        = "Manage Data kategori";
    $pagedata['title']            = "kategori";

    $this->admintemplate->views('admin/kategori/home', $pagedata);
  }

  public function ajax_list()
  {

    $list = $this->kategori->get_datatables();
    $no = $_POST['start'];
    $data = array();
    foreach ($list as $kategori) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $kategori->kategori;
      $row[] = $kategori->tipe;

      //add html for action
      $row[] = '
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kategori(' . "'" . $kategori->id_kat . "'" . ')"><i class="fa fa-edit fa-xs"></i> Edit</a>
        
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kategori(' . "'" . $kategori->id_kat . "'" . ')"><i class="fa fa-trash fa-xs"></i> Delete</a>';

      // check if soft_delete status is 0
      if ($kategori->soft_delete == 0) {
        $data[] = $row;
      }
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->kategori->count_all(),
      "recordsFiltered" => $this->kategori->count_filtered(),
      "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }

  public function ajax_edit($id)
  {
    $data = $this->kategori->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_add()
  {
    $this->_validate();
    $data = array(
      'kategori'      => $this->input->post('kategori'),
      'tipe' => $this->input->post('tipe'),
    );
    $insert = $this->kategori->save($data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_update()
  {
    $this->_validate();
    $data = array(
      'kategori' => $this->input->post('kategori'),
      'tipe'     => $this->input->post('tipe'),
    );
    $this->kategori->update(array('id_kat' => $this->input->post('id_kat')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
    $this->kategori->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
  }

  private function _validate()
  {
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if ($this->input->post('kategori') == '') {
      $data['inputerror'][] = 'kategori';
      $data['error_string'][] = 'Kategori is required';
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
