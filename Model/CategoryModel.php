<?php

class CategoryModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=store;charset=utf8', 'root', '');
    }
         
      function getCategories(){
          $sentencia = $this->db->prepare("SELECT * FROM category");
          $sentencia->execute();
          return $sentencia->fetchAll(PDO::FETCH_OBJ);
      }
      function getCategory($id){
        
        $sentencia = $this->db->prepare("SELECT * FROM category WHERE category.id_category = ?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }



    //ADMIN
    function insertCategory($category){
        $sentencia = $this->db->prepare("INSERT INTO category(category) VALUES (?)");
        $sentencia->execute(array($category));
      }

       function deleteCategory($id_category){
           $sentencia = $this->db->prepare("DELETE FROM category WHERE id_category=?");
           $sentencia->execute(array($id_category));
      }

       function updateCategory($id_category,$name){
           $sentencia = $this->db->prepare("UPDATE category SET category=? WHERE id_category=?");
           $sentencia->execute(array($name,$id_category));
       }
    }
       
?> 