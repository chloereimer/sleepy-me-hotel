<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('humanize'))
{

  function humanize($string = NULL)
  {

    $string = explode( "_", $string );
    $string = implode( " ", $string );
    $string = ucwords( $string );

    return $string;

  }

}
