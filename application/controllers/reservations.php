<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservations extends CI_Controller {

  public function index()
  {
    $this->template->show('reservations');
  }

}
