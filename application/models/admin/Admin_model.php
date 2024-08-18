<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  public function update($data, $id_user)
  {
    $this->db->where("id_user", $id_user);
    $this->db->set($data); //array of new data
    $this->db->update($this->table);
    return $this->db->affected_rows();
  }

  public function select($id_user = '')
  {
    if ($id_user != '') {
      $this->db->where('id_user', $id_user);
    }

    $data = $this->db->get('user');

    return $data->row();
  }
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */