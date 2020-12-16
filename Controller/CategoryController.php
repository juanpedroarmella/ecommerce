<?php

require_once "./View/CategoryView.php";
require_once "./View/ProductView.php";
require_once "./Model/CategoryModel.php";
require_once "./Model/ProductModel.php";

class CategoryController{

    private $view;
    private $model;
    private $viewProduct;
    private $modelProduct;

    function __construct(){
        $this->view = new CategoryView();
        $this->viewProduct = new ProductView();
        $this->model = new CategoryModel();
        $this->modelProduct = new ProductModel();

    }
    function getAccess(){
        session_start();
        if(isset($_SESSION['ID_USER'])){
            $loged = $this->modelUser->getUser($_SESSION['ID_USER']);
            return $loged->access;
        }else{
            return 0;
        }
        
    function showCategory(){
        $Category = $this->model->getCategory();
        $logged = $this->getAccess();
        $this->view->showCategorys($Category, $logged);
    }

    }
    function insertCategory(){
        $category = $_POST['nameCategory'];
        if(!empty($category)){
            $this->model->insertCategory($category);
            $this->viewProduct->ShowHomeLocation();
        }else{
            $this->viewProduct->showError();
        }
    }

    function deleteCategory($params = null){
        $category_id = $params[':ID'];
        $this->modelProduct->deleteProductCategory($category_id);
        $this->model->deleteCategory($category_id);        
        $this->viewProduct->ShowHomeLocation();
    }

    function updateCategory($params = null){
        $category_id = $params[':ID'];
        $nombre= $_POST['nombreUpdateCategory'];
        if(!empty($category_id) && !empty($nombre)){
            $this->model->updateCategory($category_id,$nombre);
            $this->viewProduct->ShowHomeLocation();
        }else{
            $this->viewProduct->showError();
        }
    }
}


?>
