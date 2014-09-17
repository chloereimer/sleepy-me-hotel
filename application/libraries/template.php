<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/* modified from the example on eLearn and http://goo.gl/JdGM9M */

class Template {

    var $ci;

    function __construct() {
      $this->ci =& get_instance();
    }

    function show($view, $args = NULL) {

      $this->ci->load->view('header');
      $this->ci->load->view($view, $args);
      $this->ci->load->view('footer');
      
    } 
}
