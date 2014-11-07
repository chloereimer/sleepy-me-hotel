<?php

class Reservation extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function get_reservations()
  {
    $query = $this->db->get('reservations');
    return $query->result();
  }

  function get_reservation($id)
  {
    $query = $this->db->get_where('reservation', array('id' => $id) );
    return $query->row();
  }

  function save_reservation($id = null)
  {

    $data = array();

    if( isset($id) ){
      $data['id'] = $id;
    }

    if ($id == null) {
      return $this->db->insert('reservations', $data);
    }
    else {
      $this->db->where('id', $id);
      return $this->db->update('reservations', $data);
    }

  }

  function delete_reservation($id)
  {
    return $this->db->delete('reservations', array('id' => $id) );
  }

}

?>
