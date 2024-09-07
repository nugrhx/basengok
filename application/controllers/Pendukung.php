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
      $row[] = $pendukung->nama;

      // Cek apakah file adalah gambar
      $file_extension = pathinfo($pendukung->file, PATHINFO_EXTENSION);
      $image_extensions = array('jpg', 'jpeg', 'png', 'gif');

      if (in_array(strtolower($file_extension), $image_extensions)) {
        // Jika file adalah gambar, tampilkan pratinjau
        $row[] = '<img src="' . base_url('assets/upload/pendukung/' . $pendukung->file) . '" alt="' . $pendukung->nama . '" height="50">';
      } else {
        // Jika bukan gambar, tambahkan onclick untuk mengunduh file
        $row[] = '<a href="' . base_url('assets/upload/pendukung/' . $pendukung->file) . '" target="_blank">' . $pendukung->file . '</a>';
      }

      // Tambahkan HTML untuk tombol aksi
      $row[] = '
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pendukung(' . "'" . $pendukung->id_pen . "'" . ')"><i class="fa fa-edit fa-xs"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_pendukung(' . "'" . $pendukung->id_pen . "'" . ')"><i class="fa fa-trash fa-xs"></i> Delete</a>';

      // Cek status soft_delete
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
    // Output dalam format JSON
    echo json_encode($output);
  }


  public function ajax_edit($id)
  {
    $data = $this->pendukung->get_by_id($id);
    echo json_encode($data);
  }

  public function ajax_add()
  {
    // Konfigurasi untuk upload file
    $config['upload_path'] = "assets/upload/pendukung";
    $config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|xls|doc|docx';
    $config['encrypt_name'] = FALSE; // Jangan enkripsi nama file agar bisa kita atur sendiri

    // Memuat library upload dengan konfigurasi yang sudah disiapkan
    $this->load->library('upload', $config);

    // Lakukan validasi terlebih dahulu
    $this->_validate();

    // Variabel untuk menyimpan nama file yang diupload
    $file = '';

    // Cek apakah upload file berhasil
    if (!empty($_FILES['file']['name'])) {
      // Dapatkan nama pengguna dari input
      $nama = $this->input->post('nama');
      // Ganti spasi pada nama dengan underscore (opsional)
      $nama_clean = str_replace(' ', '_', $nama);

      // Dapatkan ekstensi file
      $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      // Tentukan nama baru file
      $new_filename = 'pendukung_' . $nama_clean . '.' . $file_extension;

      // Set nama file baru dalam konfigurasi upload
      $config['file_name'] = $new_filename;
      $this->upload->initialize($config);

      // Upload file
      if ($this->upload->do_upload('file')) {
        $uploadData = $this->upload->data();
        $file = $uploadData['file_name']; // Mendapatkan nama file yang baru
      } else {
        // Jika upload gagal, tampilkan pesan error
        $data['inputerror'][] = 'file';
        $data['error_string'][] = $this->upload->display_errors('', '');
        $data['status'] = FALSE;
        echo json_encode($data);
        exit();
      }
    }

    // Jika upload berhasil, simpan data ke database
    $data = array(
      'nama'      => $this->input->post('nama'),
      'file'      => $file, // Simpan nama file yang diupload
    );

    $insert = $this->pendukung->save($data);
    echo json_encode(array("status" => TRUE));
  }


  public function ajax_update()
  {
    // Konfigurasi untuk upload file
    $config['upload_path'] = "assets/upload/pendukung";
    $config['allowed_types'] = 'jpg|png|pdf|xlsx|xls|doc|docx'; // Perubahan tipe file
    $config['encrypt_name'] = TRUE;

    // Memuat library upload dengan konfigurasi yang sudah disiapkan
    $this->load->library('upload', $config);

    // Lakukan validasi terlebih dahulu
    $this->_validate();

    // Ambil data lama untuk mendapatkan nama file yang sudah ada
    $old_data = $this->pendukung->get_by_id($this->input->post('id_pen'));
    $file = $old_data->file;

    // Cek apakah ada file baru yang diupload
    if (!empty($_FILES['file']['name'])) {
      if ($this->upload->do_upload('file')) {
        // Jika upload berhasil, hapus file lama
        if (file_exists("assets/upload/pendukung/" . $file) && $file != '') {
          unlink("assets/upload/pendukung/" . $file);
        }
        // Simpan nama file baru yang telah diupload
        $uploadData = $this->upload->data();
        $file = $uploadData['file_name'];
      } else {
        // Jika upload gagal, tampilkan pesan error
        $data['inputerror'][] = 'file';
        $data['error_string'][] = $this->upload->display_errors('', '');
        $data['status'] = FALSE;
        echo json_encode($data);
        exit();
      }
    }

    // Jika tidak ada file baru yang diupload, gunakan nama file yang lama
    $data = array(
      'nama'      => $this->input->post('nama'),
      'file'      => $file, // Simpan nama file
    );

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

    if ($this->input->post('nama') == '') {
      $data['inputerror'][] = 'nama';
      $data['error_string'][] = 'nama is required';
      $data['status'] = FALSE;
    }

    if (empty($_FILES['file']['name'])) {
      $data['inputerror'][] = 'file';
      $data['error_string'][] = 'file is required';
      $data['status'] = FALSE;
    } else {
      $allowed_types = array('jpg', 'jpeg', 'png', 'pdf', 'xlsx', 'xls', 'doc', 'docx',);
      $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      if (!in_array(strtolower($ext), $allowed_types)) {
        $data['inputerror'][] = 'file';
        $data['error_string'][] = 'Invalid file type. Only JPG, JPEG, PNG, PDF, XLSX, XLS, DOCX and DOC are allowed';
        $data['status'] = FALSE;
      }
    }

    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }
  }
}
