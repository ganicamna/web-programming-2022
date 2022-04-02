<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/UserDao.class.php';
require_once '../vendor/autoload.php';

Flight::register('userDao', 'UserDao'); //?

// CRUD operations for users entity

/**
* List all users
*/
Flight::route('GET /users', function(){
  Flight::json(Flight::userDao()->get_all());
});

/**
* List invidiual user
*/
Flight::route('GET /users/@id', function($id){
  Flight::json(Flight::todoDao()->get_by_id($id));
});

/**
* add user
*/
Flight::route('POST /users', function(){
  Flight::json(Flight::userDao()->add(Flight::request()->data->getData()));
});

/**
* update user
*/
Flight::route('PUT /users/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::userDao()->update($data));
});

/**
* delete user
*/
Flight::route('DELETE /users/@id', function($id){
  Flight::userDao()->delete($id);
  Flight::json(["message" => "deleted"]);
});

Flight::start();
?>
