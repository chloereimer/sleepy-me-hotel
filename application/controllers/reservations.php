<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservations extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->library('calendar', array( 'show_next_prev' => true, 'next_prev_url' => site_url() . '/reservations/calendar/' ));
  }

  public function index() {
    $this->template->show('reservations');
  }

  public function calendar() {
    $this->load->view('calendar');
  }

}
