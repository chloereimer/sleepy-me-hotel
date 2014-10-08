<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('foundation_form_input'))
{   
  function foundation_form_input( $name , $args = array() )
  {

    $isValid = ( form_error($name) ? false : true );
    
    $node  = "<label>" . humanize($name);

    if( !empty( $args['as'] ) ){

      switch ($args['as']) {

        case 'collection':

          if( !empty($args['collection']) ){
            if( $args['allow_blank'] ){
              $args['collection'] = array_merge( array(" " => " "), $args['collection']);
            }
            $node .= form_dropdown( $name, $args['collection'], set_value($name) );
          }

          break;

        case 'text':

          $node .= form_textarea( $name, set_value($name) );

          break;
        
        default:
          # ...
          break;

      }

    } else {

      $node .= form_input( $name, set_value($name) );

    }

    $node .= form_error( $name , '<div class="error">', '</div>');

    $node .= "</label>";

    return $node;

  }
}
