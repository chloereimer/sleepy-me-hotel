<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('Room');
  }

  public function index()
  {
    $this->template->show('admin');
  }

  // rooms .....................................................................

  public function index_rooms()
  {
    $rooms = $this->Room->get_rooms();
    $this->template->show('admin/index_rooms', array( 'rooms' => $rooms ));
  }

  public function show_room()
  {
    $id = $this->uri->segment(3);
    $room = $this->Room->get_room($id);
    $this->template->show('admin/show_room', array( 'room' => $room ));
  }

  public function new_room()
  {
    $this->load_rooms_form();
    $this->template->show('admin/new_room');
  }

  public function edit_room()
  {
    $this->load_rooms_form();
    $id = $this->uri->segment(3);
    $room = $this->Room->get_room($id);
    $this->template->show('admin/edit_room', array( 'room' => $room ) );
  }

  public function save_room()
  {
    if( $this->Room->save_room( $this->input->post('id') ) ){
      $this->session->set_flashdata('messageType', 'success');
      $this->session->set_flashdata('message', "Room successfully saved.");
      redirect('/admin/index_rooms', 'refresh');
    }
  }

  public function delete_room()
  {
    $id = $this->uri->segment(3);
    if( $this->Room->delete_room($id) ){
      $this->session->set_flashdata('messageType', 'success');
      $this->session->set_flashdata('message', "Room successfully deleted." );
      redirect('/admin/index_rooms', 'refresh');
    }

  }

  // helper functions ..........................................................

  private function load_rooms_form()
  {
    $this->load->helper('form');
    $this->load->helper('foundation_form');
    $this->load->library('form_validation');
  }

}
