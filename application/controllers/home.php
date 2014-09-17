<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  /* I realize we're supposed to load the assets helper HERE rather than autoloading
   * it, but I make use of the helper in my header/footer, so I'd prefer not to have
   * to load it in every controller. For that reason, I've added it to config/autoload.
   * To demonstrate that I do know how to load helpers from within a controller, here's
   * what I'd do if I didn't autoload the helper (I tested it to make sure it worked):
   *
   *   function __construct() {
   *     parent::__construct();
   *     $this->load->helper('assets');
   *   }
   */

  public function index()
  {
    $this->template->show('home');
  }

}
