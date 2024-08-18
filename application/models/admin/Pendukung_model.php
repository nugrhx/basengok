<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendukung_model extends CI_Model
{
  var $table = 'pendukung';
  var $column_order = array('nama', 'file',  null); //set column field database for datatable orderable
  var $column_search = array('nama', 'file',); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('id_pen' => 'asc'); // default order 

  public function __construct()
  {
    parent::__construct();
  }

  private function _get_datatables_query()
  {

    $this->db->from($this->table);

    $i = 0;

    foreach ($this->column_search as $item) // loop column 
    {
      if ($_POST['search']['value']) // if datatable send POST for search
      {

        if ($i === 0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables()
  {
    $this->_get_datatables_query();
    if ($_POST['length'] != -1)
      $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function get_by_id($id)
  {
    $this->db->from($this->table);
    $this->db->where('id_pen', $id);
    $query = $this->db->get();

    return $query->row();
  }

  // public function save($data)
  // {
  //   $this->db->insert($this->table, $data);
  //   return $this->db->insert_id();
  // }

  function save_upload($nama, $file)
  {
    $data = array(
      'nama' => $nama,
      'file' => $file
    );
    $result = $this->db->insert('pendukung', $data);
    return $result;
  }


  public function update($where, $data)
  {
    $this->db->where($where);
    $this->db->set($data); //array of new data
    $this->db->update($this->table);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id_pen', $id);
    $this->db->set('soft_delete', 1);
    $this->db->where('id_pen', $id);
    $this->db->update($this->table);
  }

  public function add_batch($data)
  {
    return $this->db->insert_batch($this->table, $data);
  }
}
