<?php

class UserModel{

    private $db;

    function __construct(){
     $this->db = new PDO('mysql:host=localhost;'.'dbname=store;charset=utf8', 'root', '');
    }
    function getUser($id){
        $sentencia = $this->db->prepare("SELECT * FROM user WHERE id_user = ?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
  }
  function getUsers(){
    $sentencia = $this->db->prepare("SELECT * FROM user");
    $sentencia->execute();
    return $sentencia->fetchAll(PDO::FETCH_OBJ);
}
  function getPassword($user){
    $sentencia = $this->db->prepare("SELECT * FROM user WHERE user = ?");
    $sentencia->execute(array($user));
    return $sentencia->fetch(PDO::FETCH_OBJ);
}
    function insertUser($user, $password){
      $sentencia = $this->db->prepare("INSERT INTO user(user, pass, access) VALUES (?,?,?)");
      $sentencia->execute(array($user, $password, 1));
    }

   function deleteUser($id_user){
        $sentencia = $this->db->prepare("DELETE FROM user WHERE id_user = ?");
        $sentencia-> execute(array($id_user));
    }

   function updateUser($id_user, $access){
    $sentencia = $this->db->prepare("UPDATE user SET access=? WHERE id_user = ?");
    $sentencia->execute(array($access, $id_user));
}

}
?>