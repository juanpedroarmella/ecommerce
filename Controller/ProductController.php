<?php

require_once "./View/ProductView.php";
require_once "./View/CategoryView.php";
require_once  "./Model/ProductModel.php";
require_once  "./Model/CategoryModel.php";
require_once  "./Model/UserModel.php";
require_once  "./Model/commentModel.php";

class ProductController{

    private $view;
    private $model;
    private $viewCategory;
    private $modelCategory;
    private $modelUser;

    function __construct(){
        $this->view = new ProductView();
        $this->viewCategory = new CategoryView();
        $this->model = new ProductModel();
        $this->modelCategory = new CategoryModel();
        $this->modelUser = new UserModel();
        $this->modelComment = new commentModel();

    }
    private function checkLoggedIn(){
        session_start();
        
        if(!isset($_SESSION["USERNAME"])){
            header("Location: ". BASE_URL);
            die();
        }else{
            if ( isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300000)) { 
                header("Location: ". LOGOUT);
                die();
            } 
        
            $_SESSION['LAST_ACTIVITY'] = time();
        }
    }

    function Home(){
        $logged = $this->getAccess();;
        $this->view->Home($logged);
    }
    function getAccess(){
        session_start();
        if(isset($_SESSION['ID_USER'])){
            $loged = $this->modelUser->getUser($_SESSION['ID_USER']);
            return $loged->access;
        }else{
            return 0;
        }
    }
    function showProducts($params = null){
        $id = $params[':ID'];
        $Products = $this->model->getProducts();
        $Category = $this->modelCategory->getCategories();
        $CantidadProductos = count($Products);
        $logged = $this->getAccess();
        $por_pagina = 2;
        if(empty($id)){
            $pagina = 1;
        }else{
            $pagina = $id;
        }
        $desde = (($pagina-1) * $por_pagina);
        $total_paginas = ceil($CantidadProductos / $por_pagina);//ceil() redondea un número HACIA ARRIBA al entero más cercano.
        $showProduct = $this->model->getProductsLimit($desde, $por_pagina);
        $this->view->showProducts($showProduct,$total_paginas, $Category, $logged);
    }

    
    function showProduct($params = null){
        $id = $params[':ID'];
        $Product = $this->model->getProduct($id); 
        $logged = $this->getAccess();   
        $this->view->showProduct($Product, $logged);
    }
    function showProductCategory($params = null){
        $id = $params[':ID'];
        $logged = $this->getAccess();  
        $category = $this->model->getProductCategory($id);
        $this->view->showProductsCategory($category, $logged);
    }

    function insertProduct(){
        $this->checkLoggedIn();
            $nombre= $_POST['nombre'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $descripcion = $_POST['descripcion'];
            $id_category = $_POST['category'];
            if(!empty($nombre) && !empty($price) && !empty($stock) && !empty($descripcion) && !empty($id_category)){
                if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" 
                    || $_FILES['input_name']['type'] == "image/png" ) {
                $this->model->insertProduct($nombre, $price, $stock, $descripcion, $_FILES['input_name']['tmp_name'], $id_category);   
                $this->view->ShowHomeLocation();
                }else{
                    $this->view->showError();
                }
            }

    }
    function searchProducts($params = null){
        $logged = $this->getAccess();
        $namefield = $_POST['inputBuscar'];
        $Searching = $this->model->getSearchedProducts($namefield);
        $this->view->showProductsSearched($Searching, $logged);
    }
    function deleteProduct($params = null){
        $this->checkLoggedIn();
        $id = $params[':ID'];
        $this->modelComment->deleteCommentForProduct($id);
        $this->model->deleteProduct($id);
        $this->view->ShowHomeLocation();
    }
    
    function updateProduct($params = null){
        $this->checkLoggedIn();
        $id = $params[':ID'];
        $nombre= $_POST['nombreUpdate'];
        $price = $_POST['priceUpdate'];
        $stock = $_POST['stockUpdate'];
        $descripcion = $_POST['descripcionUpdate'];
        $id_category = $_POST['categoryUpdate'];
        $imagenNueva = $_FILES['imagen']['tmp_name']; 
        //pregunto por imagen nueva 
        if(empty($imagenNueva)){
                $this->model->updateProduct($id, $nombre, $price, $stock, $descripcion, $id_category);
                $this->view->ShowHomeLocation();
        }else{
            $this->model->updateProduct($id, $nombre, $price, $stock, $descripcion, $id_category, $imagenNueva);
            $this->view->ShowHomeLocation();
        }
    }
    function searchPriceProducts(){
        $logged = $this->getAccess();
        $minPrice = $_POST['minPrice'];
        $maxPrice = $_POST['maxPrice'];
        if(empty($minPrice)){
            $minPrice = 0;
        }
        if(empty($maxPrice)){
            $maxPrice = 999999;
        }
        $Searching = $this->model->searchPriceProducts($minPrice, $maxPrice);
        $this->view->showProductsSearched($Searching, $logged);
    }
}
//UPDATE:problema que si no le pasa una foto, no realiza la funcion.


?>
