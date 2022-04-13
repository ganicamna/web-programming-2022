<?php
require_once __DIR__.'/BaseDao.class.php';

class UserDao extends BaseDao{
  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("users");
  }

  public function get_users_by_note_id($note_id){
    return $this->query("SELECT * FROM users WHERE note_id = :note_id", ['note_id' => $note_id]);
  }
}

?>
