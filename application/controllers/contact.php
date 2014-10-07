<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

  function __construct(){

    parent::__construct();

    $this->load->helper('form');
    $this->load->helper('foundation_form');
    $this->load->library('form_validation');

    $this->load->library('email'); 

    $this->load->helper('date');

  }

  public function index()
  {

    $this->template->show('contact');

  }

  public function mail()
  {
    $this->form_validation->set_rules( $this->validation_rules() );

    if( $this->form_validation->run() == false ){

      $this->template->show('contact');

    } else {

      $this->email->from('000280557@csu.mohawkcollege.ca', 'Chloe Reimer'); 
      $this->email->to('000280557@csu.mohawkcollege.ca, jasonhm@csu.mohawkcollege.ca'); 
       
      $this->email->subject('Here\'s Johnny!'); 
      $this->email->message('Username: ' . set_value('username') . '; Name: ' . set_value('first_name') . ' ' . set_value('last_name') . '; Age: ' . set_value('age') . '; Program: ' . set_value('program') . '; Date: ' . mdate( "%Y/%m/%d" , time() ) );

      if( $this->email->send() == false ){
        $this->session->set_flashdata('messageType', 'alert');
        $this->session->set_flashdata('message', 'Email not sent.');
      } else {
        $this->session->set_flashdata('messageType', 'success');
        $this->session->set_flashdata('message', $this->email->print_debugger() );
      }

      $this->template->show('contact');

    }

  }

  private function validation_rules()
  {

    $rules = array(
                   array(
                         'field' => 'name',
                         'label' => 'Name',
                         'rules' => 'trim|required|callback_validate_name',
                         ),
                   array(
                         'field' => 'address',
                         'label' => 'Address',
                         'rules' => 'trim|required',
                        ),
                   array(
                         'field' => 'postal_code',
                         'label' => 'Postal Code',
                         'rules' => 'trim|required|callback_validate_postal_code',
                        ),
                   array(
                         'field' => 'phone',
                         'label' => 'Phone',
                         'rules' => 'trim|required|callback_validate_phone',
                        ),
                   array(
                         'field' => 'email',
                         'label' => 'Email',
                         'rules' => 'trim|required|callback_validate_email',
                        ),
                   array(
                         'field' => 'comment',
                         'label' => 'Comment',
                         'rules' => 'trim|required|xss_clean',
                        ),
                   );
    return $rules;
  }
  public function validate_name($string)
  {
    if ( str_word_count($string) < 2 ) {
      $this->form_validation->set_message('validate_name', "The %s field is invalid. Provide your full name.");
      return false;
    } else {
      return true;
    }
  }

  public function validate_postal_code($string)
  {
    if ( preg_match( '/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/' , $string ) != 1 ) {
      $this->form_validation->set_message('validate_postal_code', "The %s field is invalid.");
      return false;
    } else {
      return true;
    }
  }

  public function validate_phone($string)
  {
    if ( preg_match( '/^\(?\d{3}\)? ?\d{3}( |-)?\d{4}$/' , $string ) != 1 ) {
      $this->form_validation->set_message('validate_phone', "The %s field is invalid.");
      return false;
    } else {
      return true;
    }
  }

  public function validate_email($string)
  {
    if ( preg_match( '/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/' , $string ) != 1 ) {
      $this->form_validation->set_message('validate_phone', "The %s field is invalid.");
      return false;
    } else {
      return true;
    }
  }

}
