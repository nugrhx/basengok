<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Amenitas extends AUTH_Controller
{
  public function __construct()
  {
    Parent::__construct();
    $this->load->model('admin/Amenitas_model', 'amenitas');


    // if (($this->userdata->id_role != 1) && ($this->userdata->id_role != 2)) { // check for admin session and methos is login
    //   echo "<script>alert('Anda bukan Admin! Anda tidak berhak mengakses halaman ini!');
    //   window.location.href='home';
    //   </script>";
    // }
  }

  public function index()
  {
    $pagedata['page']             = "amenitas";
    $pagedata['judul']            = "Data Amenitas";
    $pagedata['deskripsi']        = "Manage Data Amenitas";
    $pagedata['title']            = "amenitas";

    $this->admintemplate->views('admin/amenitas/home', $pagedata);
  }

  public function ajax_list()
  {
    $list = $this->amenitas->get_datatables();
    $no = $_POST['start'] + 1;
    $data = array();
    foreach ($list as $amenitas) {
      $row = array();
      $row[] = $no++;
      $row[] = $amenitas->nama;
      $row[] = $amenitas->lokasi;
      $row[] = $amenitas->kategori;
      $row[] = $amenitas->kontak;
      $row[] = $amenitas->maps;

      // Pratinjau foto
      if (!empty($amenitas->foto)) {
        $row[] = '<img src="' . base_url('assets/upload/image/amenitas/' . $amenitas->foto) . '" class="img-thumbnail" style="max-width: 100px; max-height: 100px;" />';
      } else {
        $row[] = 'No Image';
      }

      //add html for action
      $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_amenitas(' . "'" . $amenitas->id_amn . "'" .
        ')"><i class="fa fa-edit fa-xs"></i> Edit</a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_amenitas(' . "'" . $amenitas->id_amn . "'" . ')"><i class="fa fa-trash fa-xs"></i> Delete</a>';

      // Tambahkan baris jika status soft_delete adalah 0
      if ($amenitas->soft_delete == 0) {
        $data[] = $row;
      }
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->amenitas->count_all(),
      "recordsFiltered" => $this->amenitas->count_filtered(),
      "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }

  public function ajax_edit($id)
  {
    $data = $this->amenitas->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_add()
  { // Konfigurasi untuk upload file
    $config['upload_path'] = "assets/upload/image/amenitas";
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['encrypt_name'] = TRUE;

    // Memuat library upload dengan konfigurasi yang sudah disiapkan
    $this->load->library('upload', $config);

    // Lakukan validasi terlebih dahulu
    $this->_validate();

    // Variabel untuk menyimpan nama file yang diupload
    $foto = '';

    // Cek apakah upload file berhasil
    if ($this->upload->do_upload('foto')) {
      $uploadData = $this->upload->data();
      $foto = $uploadData['file_name']; // Mendapatkan nama file yang telah dienkripsi
    } else {
      // Jika upload gagal, tampilkan pesan error
      $data['inputerror'][] = 'foto';
      $data['error_string'][] = $this->upload->display_errors('', '');
      $data['status'] = FALSE;
      echo json_encode($data);
      exit();
    }

    $data = array(
      'nama' => $this->input->post('nama'),
      'lokasi' => $this->input->post('lokasi'),
      'kategori' => $this->input->post('kategori'),
      'kontak' => $this->input->post('kontak'),
      'maps' => $this->input->post('maps'),
      'foto'      => $foto, // Simpan nama file foto yang diupload
    );

    $insert = $this->amenitas->save($data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_update()
  { // Konfigurasi untuk upload file
    $config['upload_path'] = "assets/upload/image/amenitas";
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['encrypt_name'] = TRUE;

    // Memuat library upload dengan konfigurasi yang sudah disiapkan
    $this->load->library('upload', $config);

    // Lakukan validasi terlebih dahulu
    $this->_validate();

    // Ambil data lama untuk mendapatkan nama file foto yang sudah ada
    $old_data = $this->amenitas->get_by_id($this->input->post('id_amn'));
    $foto = $old_data->foto;

    // Cek apakah ada file foto baru yang diupload
    if (!empty($_FILES['foto']['name'])) {
      if ($this->upload->do_upload('foto')) {
        // Jika upload berhasil, hapus file foto lama
        if (file_exists("assets/upload/image/amenitas/" . $foto) && $foto != '') {
          unlink("assets/upload/image/amenitas/" . $foto);
        }
        // Simpan nama file baru yang telah diupload
        $uploadData = $this->upload->data();
        $foto = $uploadData['file_name'];
      } else {
        // Jika upload gagal, tampilkan pesan error
        $data['inputerror'][] = 'foto';
        $data['error_string'][] = $this->upload->display_errors('', '');
        $data['status'] = FALSE;
        echo json_encode($data);
        exit();
      }
    }

    $data = array(
      'nama' => $this->input->post('nama'),
      'lokasi' => $this->input->post('lokasi'),
      'kategori' => $this->input->post('kategori'),
      'kontak' => $this->input->post('kontak'),
      'maps' => $this->input->post('maps'),
      'foto'      => $foto, // Simpan nama file foto
    );
    $this->amenitas->update(array('id_amn' => $this->input->post('id_amn')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id)
  {
    $this->amenitas->delete_by_id($id);
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
      $data['error_string'][] = 'nama is required';
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

    if ($this->input->post('kontak') == '') {
      $data['inputerror'][] = 'kontak';
      $data['error_string'][] = 'kontak is required';
      $data['status'] = FALSE;
    }

    if ($this->input->post('maps') == '') {
      $data['inputerror'][] = 'maps';
      $data['error_string'][] = 'maps is required';
      $data['status'] = FALSE;
    }

    if (empty($_FILES['foto']['name'])) {
      $data['inputerror'][] = 'foto';
      $data['error_string'][] = 'Foto is required';
      $data['status'] = FALSE;
    } else {
      $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
      $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

      if (!in_array(strtolower($ext), $allowed_types)) {
        $data['inputerror'][] = 'foto';
        $data['error_string'][] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed';
        $data['status'] = FALSE;
      }

      if ($_FILES['foto']['size'] > 2048000) { // 2MB limit
        $data['inputerror'][] = 'foto';
        $data['error_string'][] = 'File size exceeds 2MB';
        $data['status'] = FALSE;
      }
    }

    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }
  }
}
