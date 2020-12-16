<?php

require_once "./libs/Smarty/Smarty.class.php";


class ProductView{

    private $title;

    function __construct(){
    }
    function Home($logged){
        $smarty = new Smarty();
        $smarty->assign('logged', $logged);
        $smarty->display('./Template/home.tpl');
    }
    function showProducts($Products, $CantidadProductos, $Category, $logged){
        $smarty = new Smarty();
        $smarty->assign('Products', $Products);
        $smarty->assign('CantidadProductos', $CantidadProductos);
        $smarty->assign('Category', $Category);
        $smarty->assign('logged', $logged);
        $smarty->display('Template/products.tpl');
    }
    function showProductsCategory($Category, $logged){
        $smarty = new Smarty();
        $smarty->assign('Category', $Category);
        $smarty->assign('logged', $logged);
        $smarty->display('Template/productsCategory.tpl');
    }
    function showProductsSearched($Searching, $logged){
        $smarty = new Smarty();
        $smarty->assign('Searching', $Searching);
        $smarty->assign('logged', $logged);
        $smarty->display('Template/productSearch.tpl');
    }
    function showProduct($Product, $logged){
        $smarty = new Smarty();
        $smarty->assign('Product', $Product);
        $smarty->assign('logged', $logged);
        $smarty->display('./Template/product.tpl');
    }
    function showError(){
        $smarty = new Smarty();
        $smarty->display('./Template/error.tpl');
    }
    function ShowHomeLocation(){
       header("Location: ".BASE_URL."pagina/1");
    }
    
}

?>


