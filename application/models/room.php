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

  function get_available_rooms($startDate, $endDate){

    // reformat dates
    $startDate = new DateTime( $startDate );
    $endDate = new DateTime( $endDate );

    $this->load->model('Reservation');
    $available_rooms = array();

    $rooms = $this->get_rooms();
    foreach ($rooms as $room) {

      $isAvailable = true;

      $reservations = $this->Reservation->get_reservations_by_room_id($room->id);

      if( empty($reservations) ){

        // if there are no results, room has no reservations at all and is therefore available

      } else {

        // there are reservations; room is not necessarily available

        foreach ($reservations as $reservation) {

          $reservationStartDate = new DateTime( $reservation->start_date);
          $reservationEndDate = new DateTime( $reservation->end_date);

          // dates overlap if:
          //   reservation date starts or ends on the start/end date of an existing reservation
          //   reservation starts between the start/end date of an existing reservation
          //   reservation ends between the start/end of an existing reservation
          //   reservation starts before an existing reservation starts, and ends after an existing reservation ends

          $datesOverlap = (
                            ( $startDate == $reservationStartDate || $startDate == $reservationEndDate) ||
                            ( $endDate == $reservationStartDate || $endDate == $reservationEndDate ) ||
                            ( $startDate > $reservationStartDate && $startDate < $reservationEndDate ) ||
                            ( $endDate > $reservationStartDate && $endDate < $reservationEndDate ) ||
                            ( $startDate < $reservationStartDate && $endDate > $reservationEndDate )
                          );

          if( $datesOverlap ){
            $isAvailable = false;
          }
        }
      }

      if( $isAvailable == true ){
        $available_rooms[] = $room;
      }

    }

    return $available_rooms;

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
    if( !empty( $old_image ) && file_exists( './uploads/' . $old_image ) ){
      unlink( './uploads/' . $old_image );
    }

    // set the new image
    $this->db->where('id', $room->id );
    return $this->db->update('rooms', array( 'image' => $file_name ) );
  }

}

?>
