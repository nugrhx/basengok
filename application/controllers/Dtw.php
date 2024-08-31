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

      // Pratinjau foto
      if (!empty($dtw->foto)) {
        $row[] = '<img src="' . base_url('assets/upload/image/dtw/' . $dtw->foto) . '" class="img-thumbnail" style="max-width: 100px; max-height: 100px;" />';
      } else {
        $row[] = 'No Image';
      }

      // Tambahkan HTML untuk aksi
      $row[] = '
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_dtw(' . "'" . $dtw->id_dtw . "'" . ')"><i class="fa fa-edit fa-xs"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_dtw(' . "'" . $dtw->id_dtw . "'" . ')"><i class="fa fa-trash fa-xs"></i> Delete</a>';

      // Tambahkan baris jika status soft_delete adalah 0
      if ($dtw->soft_delete == 0) {
        $data[] = $row;
      }
    }

    // Kirim data ke DataTables
    echo json_encode(array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->dtw->count_all(),
      "recordsFiltered" => $this->dtw->count_filtered(),
      "data" => $data,
    ));
  }


  public function ajax_edit($id)
  {
    $data = $this->dtw->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_add()
  {
    // Konfigurasi untuk upload file
    $config['upload_path'] = "assets/upload/image/dtw";
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

    // Jika upload berhasil, simpan data ke database
    $data = array(
      'nama'      => $this->input->post('nama'),
      'deskripsi' => $this->input->post('deskripsi'),
      'lokasi'    => $this->input->post('lokasi'),
      'kategori'  => $this->input->post('kategori'),
      'foto'      => $foto, // Simpan nama file foto yang diupload
    );

    $insert = $this->dtw->save($data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_update()
  {
    // Konfigurasi untuk upload file
    $config['upload_path'] = "assets/upload/image/dtw";
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['encrypt_name'] = TRUE;

    // Memuat library upload dengan konfigurasi yang sudah disiapkan
    $this->load->library('upload', $config);

    // Lakukan validasi terlebih dahulu
    $this->_validate();

    // Ambil data lama untuk mendapatkan nama file foto yang sudah ada
    $old_data = $this->dtw->get_by_id($this->input->post('id_dtw'));
    $foto = $old_data->foto;

    // Cek apakah ada file foto baru yang diupload
    if (!empty($_FILES['foto']['name'])) {
      if ($this->upload->do_upload('foto')) {
        // Jika upload berhasil, hapus file foto lama
        if (file_exists("assets/upload/image/dtw/" . $foto) && $foto != '') {
          unlink("assets/upload/image/dtw/" . $foto);
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

    // Jika tidak ada file baru yang diupload, gunakan nama file yang lama
    $data = array(
      'nama'      => $this->input->post('nama'),
      'deskripsi' => $this->input->post('deskripsi'),
      'lokasi'    => $this->input->post('lokasi'),
      'kategori'  => $this->input->post('kategori'),
      'foto'      => $foto, // Simpan nama file foto
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
