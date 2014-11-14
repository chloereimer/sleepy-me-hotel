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
    $this->load_rooms_form();

    $config = array( 'upload_path' => './uploads/', 'allowed_types' => 'jpg|jpeg|png', 'file_name' => md5(uniqid(mt_rand())) );
    $this->load->library('upload', $config );

    if( $this->form_validation->run() == false ){

      $id = $this->input->post('id');

      if ( !empty( $id ) )  {
        $this->template->show('admin/edit_room/' . $this->input->post('id') );
      } else {
        $this->template->show('admin/new_room');
      }

    } else {

      if( $this->Room->save_room( $this->input->post('id') ) ){

        // upload the featured image
        if( $this->upload->do_upload('image') ){
          $data = $this->upload->data();
          $file_name = $data['file_name'];
          $this->Room->set_featured_image( $this->input->post('id') , $file_name );
        }

        $this->session->set_flashdata('messageType', 'success');
        $this->session->set_flashdata('message', "Room successfully saved.");
        redirect('/admin/index_rooms', 'refresh');

      } else {

        // todo: destroy the featured image

        $this->session->set_flashdata('messageType', 'error');
        $this->session->set_flashdata('message', "Room could not be saved.");
        redirect('/admin/index_rooms', 'refresh');

      }

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

  public function reset_database(){

    $this->template->show('reset_database');

  }

  public function reset_database_for_real(){

    $sql = $this->database_reset_sql();

    foreach ( explode(";\n", $sql) as $sql){

      $sql = trim($sql);

      if( $sql ){
        $success = $this->db->query( $sql . ";" );
      }

      if( !$success ){
        break;
      }

    }

    if( $success ){

      $this->session->set_flashdata('messageType', 'success');
      $this->session->set_flashdata('message', "Database should be reset." );

    } else {

      $this->session->set_flashdata('messageType', 'alert');
      $this->session->set_flashdata('message', "Database could not be reset." );

    }

    redirect('/admin/index', 'refresh');

  }

  // helper functions ..........................................................

  private function load_rooms_form()
  {
    $this->load->helper('form');
    $this->load->helper('foundation_form');
    $this->load->library('form_validation');

    $rules = array(
                   array(
                         'field' => 'number',
                         'label' => 'Number',
                         'rules' => 'trim|required',
                         ),
                   array(
                         'field' => 'name',
                         'label' => 'Name',
                         'rules' => 'trim|required',
                         ),
                   array(
                         'field' => 'rate',
                         'label' => 'Rate',
                         'rules' => 'trim|required',
                         ),
                   array(
                         'field' => 'description',
                         'label' => 'Description',
                         'rules' => 'trim|required',
                         ),
                   );

    $this->form_validation->set_rules( $rules );
  }

  private function database_reset_sql(){

return <<<EOT

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `development` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `development`;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
`id` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `phone`) VALUES
(1, 'Danny', 'Torrence', 'danny.torrence@example.com', '666-666-6666'),
(2, 'Lionel', 'Mandrake', 'lionel.mandrake@example.com', '777-777-7777'),
(3, 'Alex', 'DeLarge', 'alex.delarge@example.com', '333-333-3333');

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
`id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

INSERT INTO `reservations` (`id`, `room_id`, `start_date`, `end_date`, `customer_id`) VALUES
(1, 1, '2014-11-17', '2014-11-18', 1),
(2, 2, '2014-11-18', '2014-11-19', 2),
(3, 3, '2014-11-19', '2014-11-20', 3),
(4, 1, '2014-11-21', '2014-11-21', 1),
(5, 2, '2014-11-21', '2014-11-21', 2),
(6, 3, '2014-11-21', '2014-11-21', 3),
(7, 1, '2014-11-24', '2014-11-24', 1),
(8, 1, '2014-11-26', '2014-11-26', 1),
(9, 1, '2014-11-28', '2014-11-28', 1),
(10, 2, '2014-11-25', '2014-11-25', 2),
(11, 2, '2014-11-27', '2014-11-27', 2),
(12, 2, '2014-11-29', '2014-11-29', 2),
(13, 3, '2014-11-23', '2014-11-24', 3),
(14, 3, '2014-11-25', '2014-11-26', 3),
(15, 3, '2014-11-27', '2014-11-28', 3);

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
`id` int(11) NOT NULL,
  `number` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `rate` float NOT NULL,
  `description` varchar(1024) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

INSERT INTO `rooms` (`id`, `number`, `name`, `rate`, `description`, `image`) VALUES
(1, '237', 'Red Rum Suite', 150, '<p>You&#39;ll wish you could stay here forever, and ever, and ever.</p>', '5d070adc7ea5509effa589e626ebf679.jpg'),
(2, '93', 'The War Room', 250, '<p>You can&#39;t fight in here! This is the war room!</p>', 'a3c21b4e32b710e87b90716472559c3d.png'),
(3, '9', 'The Ludwig', 120, '<p>Give your wonderful evening a perfect ending with a bit of the old Ludwig van.</p>', '916c9734b30742a843461ae1621e032b.jpg');


ALTER TABLE `customers`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `reservations`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `rooms`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `customers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `reservations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
ALTER TABLE `rooms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;

EOT;

  }

}
