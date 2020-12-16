<?php
    require_once 'Controller/UserController.php';
    require_once 'Controller/ProductController.php';
    require_once 'Controller/CategoryController.php';
    require_once 'route.php';
    
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
    define("LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');
    define("LOGOUT", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/logout');




    $r = new Router();
    $r->addRoute("home", "GET", "ProductController", "Home");
    
    // rutas
    $r->addRoute("productos", "GET", "ProductController", "showProducts");
    //$r->addRoute("productos", "GET", "CategoryController", "showCategory");
    $r->addRoute("productos/:ID", "GET", "ProductController", "showProduct");
    $r->addRoute("category/:ID", "GET", "ProductController", "showProductCategory");
    $r->addRoute("login", "GET", "UserController", "Login");
    $r->addRoute("logout", "GET", "UserController", "Logout");
    $r->addRoute("users", "GET", "UserController", "showUsers");
    $r->addRoute("verifyUser", "POST", "UserController", "verifyUser");
    $r->addRoute("registro", "GET", "UserController", "showRegistro");
    $r->addRoute("insertUser", "POST", "UserController", "insertUser");
    $r->addRoute("updateUser/:ID", "POST", "UserController", "updateUser");
    
    $r->addRoute("searchPriceProducts", "POST", "ProductController", "searchPriceProducts");
    $r->addRoute("searchProducts", "POST", "ProductController", "searchProducts");
    $r->addRoute("pagina/:ID", "GET", "ProductController", "showProducts");

    //Esto lo veo en View
    $r->addRoute("insert", "POST", "ProductController", "insertProduct");
    $r->addRoute("insertCategory", "POST", "CategoryController", "insertCategory");
    $r->addRoute("insertuser", "POST", "UserController", "InsertUser");
    
   
    $r->addRoute("deleteUser/:ID", "GET", "UserController", "deleteUser");
    $r->addRoute("delete/:ID", "GET", "ProductController", "deleteProduct");
    $r->addRoute("deleteCategory/:ID", "GET", "CategoryController", "deleteCategory");

    $r->addRoute("update/:ID", "POST", "ProductController", "updateProduct");
    $r->addRoute("updateCategory/:ID", "POST", "CategoryController", "updateCategory");
    //Ruta por defecto.
    $r->setDefaultRoute("ProductController", "Home");



    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>
