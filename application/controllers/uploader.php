<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploader extends CI_Controller {

  public function upload_image(){
    $this->load->view('upload_image');
  }

}
