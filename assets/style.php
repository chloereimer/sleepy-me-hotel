<?php
  
  $directory = 'stylesheets';
  require "../application/third_party/scssphp/scss.inc.php";

  scss_server::serveFrom($directory);

  // $scss = new scssc();
  // echo $scss->compile('@import "stylesheets/master"');
