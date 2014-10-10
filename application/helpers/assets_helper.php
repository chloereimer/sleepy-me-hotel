<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* modified slightly from the example on elearn in the following ways:
 *   - added additional functions specific to stylesheets, javascripts, and images
 *   - added the ability to pass a 'file', so that usage in views can look like:
 *       src="<?php echo images_url('kitten.jpg'); ?>"
 *     instead of:
 *       src="<?php echo images_url(); ?>kitten.jpg"
 */

if (!function_exists('assets_url'))
{   
  function assets_url($file = NULL)
  {
    $url = '';
    $ci =& get_instance();
    $url .= base_url() . $ci->config->item('assets_path');
    if( isset($file) ){
      $url .= $file;
    }
    return $url;
  }
}

if (!function_exists('stylesheets_url'))
{
  function stylesheets_url($file = NULL)
  {
    $url = '';
    $ci =& get_instance();
    $url .= assets_url() . $ci->config->item('stylesheets_path');
    if( isset($file) ){
      $url .= $file;
    }
    return $url;
  }
}

if (!function_exists('javascripts_url'))
{
  function javascripts_url($file = NULL)
  {
    $url = '';
    $ci =& get_instance();
    $url .= assets_url() . $ci->config->item('javascripts_path');
    if( isset($file) ){
      $url .= $file;
    }
    return $url;
  }
}

if (!function_exists('images_url'))
{
  function images_url($file = NULL)
  {
    $url = '';
    $ci =& get_instance();
    $url .= assets_url() . $ci->config->item('images_path');
    if( isset($file) ){
      $url .= $file;
    }
    return $url;
  }
}

if (!function_exists('uploads_url'))
{   
  function uploads_url($file = NULL)
  {
    $url = '';
    $ci =& get_instance();
    $url .= base_url() . $ci->config->item('uploads_path');
    if( isset($file) ){
      $url .= $file;
    }
    return $url;
  }
}
