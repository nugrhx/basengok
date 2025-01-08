<?php
defined('BASEPATH') or exit('No direct script access allowed');

class adminHome_model extends CI_Model
{
  public function j_Dtw()
  {
    $jDtw_base = $this->db->query("SELECT * FROM dtw WHERE soft_delete = 0")->result();
    $j_dtw = count($jDtw_base);
    $jDtw = json_encode($jDtw_base);

    return $j_dtw;
    return $jDtw;
  }

  public function j_Amn()
  {
    $jAmn_base = $this->db->query("SELECT * FROM amenitas WHERE soft_delete = 0")->result();
    $j_amenitas = count($jAmn_base);
    $jAmn = json_encode($jAmn_base);

    return $j_amenitas;
    return $jAmn;
  }


  public function j_Kat()
  {
    $jKat_base = $this->db->query("SELECT * FROM kategori WHERE soft_delete = 0")->result();
    $j_kategori = count($jKat_base);
    $jKat = json_encode($jKat_base);

    return $j_kategori;
    return $jKat;
  }

  public function j_Pen()
  {
    $jPen_base = $this->db->query("SELECT * FROM pendukung WHERE soft_delete = 0")->result();
    $j_pendukung = count($jPen_base);
    $jPen = json_encode($jPen_base);

    return $j_pendukung;
    return $jPen;
  }

  public function jumlah_dtw()
  {
    $jDtw_base = $this->db->query("SELECT * FROM dtw")->result();

    return $jDtw_base;
  }

  public function jumlah_amenitas()
  {
    $jAmn_base = $this->db->query("SELECT * FROM amenitas ")->result();

    return $jAmn_base;
  }
}
