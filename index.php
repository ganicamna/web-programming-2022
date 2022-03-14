<?php
require 'vendor/autoload.php';

Flight::route('/', function(){
  echo <marquee>'Vtp zimga'</marquee>;
});

Flight::start();
?>
