<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("rest/dao/PhotographyAppDao.class.php");

$dao = new PhotographyAppDao();

$op = $_REQUEST['op'];

switch ($op) {
  case 'insert':
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $registered = $_REQUEST['registered'];
    $speciality = $_REQUEST['speciality'];
    $dao->add($name, $age, $registered, $speciality);
    break;

  case 'delete':
    $id = $_REQUEST['id'];
    $dao->delete($id);
    echo "DELETED $id";
    break;

  case 'update':
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $registered = $_REQUEST['registered'];
    $speciality = $_REQUEST['speciality'];
    $dao->update($id, $name, $age, $registered, $speciality);
    echo "UPDATED $id";
    break;

  case 'get':
  default:
    $results = $dao->get_all();
    print_r($results);
    break;
}
?>
