<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rooms extends CI_Controller {

  function __construct()
  {

    parent::__construct();

  }

  public function index()
  {

    $this->load->model('Room');

    $rooms = $this->Room->get_rooms();

    $rooms_arr = array();
    foreach ($rooms as $room) {
      $rooms_arr[] = array(
                           'number' => $room->number,
                           'name' => $room->name,
                           'rate' => $room->rate,
                           'description' => $room->description,
                           'image' => $room->image
                           );
    }

    $this->template->show('rooms', array( 'rooms' => $rooms_arr ) );

  }

}
