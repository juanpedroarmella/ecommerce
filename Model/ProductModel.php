<?php

class ProductModel{

    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=store;charset=utf8', 'root', '');
    }
    
    function getProducts(){
        $sentencia = $this->db->prepare("SELECT product.*, category.* FROM product INNER JOIN category ON product.id_category = category.id_category");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    function getProductsLimit($desde, $por_pagina){ 
        $sentencia = $this->db->prepare("SELECT product.*, category.* FROM product INNER JOIN category ON product.id_category = category.id_category LIMIT $desde, $por_pagina"); 
        $sentencia->execute(array($desde, $por_pagina)); 
        return $sentencia->fetchAll(PDO::FETCH_OBJ); 
    }

    function getSearchedProducts($namefield){
        $sentencia = $this->db->prepare("SELECT product.*, category.* FROM product INNER JOIN category ON product.id_category = category.id_category WHERE nombre LIKE '%$namefield%'");
        $sentencia->execute(array($namefield));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    
    function getProduct($id){
        $sentencia = $this->db->prepare("SELECT product.*, category.*
        FROM product JOIN category ON product.id_product = ? AND product.id_category = category.id_category ");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }  

    function getProductCategory($id_category){
        $sentencia = $this->db->prepare("SELECT product.*, category.*
         FROM product JOIN category ON product.id_category = ? AND category.id_category = product.id_category ");
        $sentencia->execute(array($id_category));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);

    }
    
    function insertProduct($name, $price, $stock, $description,$imagen = null, $id_category){
        $pathImg = null;
            if ($imagen){
                $pathImg = $this->uploadImage($imagen);
            }
        $sentencia = $this->db->prepare("INSERT INTO product(nombre, price, stock, descripcion ,imagen, id_category) VALUES (?,?,?,?,?,?)");
        $sentencia->execute(array($name, $price, $stock, $description,$pathImg, $id_category));
    }
    private function uploadImage($image){
        $target = 'img/' . uniqid() . '.jpg';
        move_uploaded_file($image, $target);
        return $target;
    }
    function deleteProduct($id_product){
        $sentencia = $this->db->prepare("DELETE FROM product WHERE id_product = ?");
        $sentencia-> execute(array($id_product));
    }
    function deleteProductCategory($id_category){
        $sentencia = $this->db->prepare("DELETE FROM product WHERE id_category = ?");
        $sentencia-> execute(array($id_category));
    }
    function updateProduct($id_product, $nombre, $price, $stock, $descripcion, $id_category, $imagen = null){
        $pathImg = null;
            if ($imagen){
                $pathImg = $this->uploadImage($imagen);
                $sentencia = $this->db->prepare("UPDATE product SET nombre=?, price=?, stock=?, descripcion=?, imagen=?, id_category=? WHERE id_product = ?");
                $sentencia->execute(array($nombre, $price, $stock, $descripcion,$pathImg, $id_category, $id_product));
            }else{
                $sentencia = $this->db->prepare("UPDATE product SET nombre=?, price=?, stock=?, descripcion=?, id_category=? WHERE id_product = ?");
                $sentencia->execute(array($nombre, $price, $stock, $descripcion, $id_category, $id_product));
            }
    }
    function searchPriceProducts($minPrice, $maxPrice){
        $sentencia = $this->db->prepare("SELECT product.*, category.* FROM product INNER JOIN category ON product.id_category = category.id_category WHERE price BETWEEN $minPrice AND $maxPrice");
        $sentencia-> execute(array($minPrice, $maxPrice));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
}


?>