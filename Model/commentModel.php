<?php

class commentModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=store;charset=utf8', 'root', '');
    }
    function getComment($id){
        $sentencia = $this->db->prepare("SELECT * FROM comment WHERE id_comment = ?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    
    function getCommentID($id){
        $sentencia = $this->db->prepare("SELECT * FROM comment WHERE id_product = ?");
        $sentencia->execute(array($id));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    function insertComment($comment, $score, $id){
        $sentencia = $this->db->prepare("INSERT INTO comment(comment, score, id_product) VALUES (?,?,?)");
        $sentencia->execute(array($comment, $score, $id));
        return $this->db->lastInsertId();
    }

    function deleteComment($id){
        $sentencia = $this->db->prepare("DELETE FROM comment WHERE id_comment=?");
        $sentencia->execute(array($id));
    }
    function deleteCommentForProduct($id){
        $sentencia = $this->db->prepare("DELETE FROM comment WHERE id_product = ?");
        $sentencia->execute(array($id));
    }

}
