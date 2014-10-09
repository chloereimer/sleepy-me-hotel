<?php

class Room extends CI_Model {

  var $number       = '';
  var $name         = '';
  var $rate         = '';
  var $description  = '';
  var $image        = '';

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function get_rooms()
  {
    $query = $this->db->get('rooms');
    return $query->result();
  }

  function get_room($id)
  {
    $query = $this->db->get_where('rooms', array('id' => $id) );
    return $query->row();
  }

  function save_room($id = null)
  {

    $data = array(
      'number' => $this->input->post('number'),
      'name' => $this->input->post('name'),
      'rate' => $this->input->post('rate'),
      'description' => $this->input->post('description'),
    );

    if( isset($id) ){
      $data['id'] = $id;
    }
    
    if ($id == null) {
    
      return $this->db->insert('rooms', $data);
    
    }
    else {
    
      $this->db->where('id', $id);
      return $this->db->update('rooms', $data);
    
    }

  }

  function delete_room($id)
  {
    return $this->db->delete('rooms', array('id' => $id) );
  }

  function set_featured_image($id, $file_name)
  {
    $room = $this->get_room($id);
    $old_image = $room->image;

    // delete the old image if it exists
    if( file_exists( './uploads/' . $old_image ) ){
      unlink( './uploads/' . $old_image );
    }

    // set the new image
    $this->db->where('id', $id);
    return $this->db->update('rooms', array( 'image' => $file_name ) );
  }

}

?>
