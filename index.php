<?php
require 'vendor/autoload.php';

Flight::route('/', function(){
  echo 'Vtp zimga';
});

Flight::start();
?>
