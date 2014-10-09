<?php

class Room extends CI_Model {

  function __construct()
  {

    parent::__construct();
    $this->load->database();

  }

  function get_rooms()
  {

    $query = $this->db->query("SELECT * FROM rooms");
    return $query->result();

  }

}

?>
