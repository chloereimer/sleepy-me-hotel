<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  public function index()
  {

    $this->form_validation->set_rules( $this->validation_rules() );

    if( $this->form_validation->run() == false ){
      $this->template->show('contact');
    } else {
      $this->template->show('home');
    }

  }

  public function post()
  {

  }

  private function validation_rules()
  {
    $rules = array(
                   array(
                         'field' => 'username',
                         'label' => 'Username',
                         'rules' => 'callback_username_check',
                         ),
                   array(
                         'field' => 'first_name',
                         'label' => 'First Name',
                         'rules' => 'trim|required|min_length[3]|max_length[25]|xss_clean',
                         ),
                   array(
                         'field' => 'last_name',
                         'label' => 'Last Name',
                         'rules' => 'trim|required|xss_clean',
                         ),
                   array(
                         'field' => 'age',
                         'label' => 'Age',
                         'rules' => 'trim|required|integer|xss_clean',
                         ),
                   array(
                         'field' => 'program',
                         'label' => 'Program',
                         'rules' => 'required|xss_clean',
                         ),
                   );
    return $rules;
  }

  public function username_check($string)
  {

    $string = trim($string);

    if( empty($string) ){
      $this->form_validation->set_message('username_check', "%s field is required.");
      return false;
    } else if( preg_match('/^[a-zA-z0-9]{3,9}$/',$string) == false ) {
      $this->form_validation->set_message('username_check', "%s must be between 3 and 9 characters, and must only include letters and numbers."); 
      return false;
    } else {
      return true;
    }


  }

}
