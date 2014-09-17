<?php
  
  $directory = 'stylesheets';
  require "../application/third_party/scssphp/scss.inc.php";

  scss_server::serveFrom($directory);
