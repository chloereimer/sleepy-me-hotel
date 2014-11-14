<?php

class Customer extends CI_Model {

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function get_customers()
  {
    $query = $this->db->get('customers');
    return $query->result();
  }

  function get_customer($id)
  {
    $query = $this->db->get_where('customers', array('id' => $id) );
    return $query->row();
  }

}

?>
