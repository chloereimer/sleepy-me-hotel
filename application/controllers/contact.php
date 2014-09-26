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
      $this->email->message('Username: ' . set_value('username') . '; Name: ' . set_value('first_name') . ' ' . set_value('last_name') . '; Age: ' . set_value('age') . '; Program: ' . set_value('program') . '; Date: ' . unix_to_human( gmt_to_local( now() , 'UM5' , true ) ) );

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
