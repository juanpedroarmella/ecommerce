<?php

require_once "./libs/smarty/Smarty.class.php";

class UserView{

    private $title;
    

    function __construct(){
    }

    function ShowLogin(){

        $smarty = new Smarty();
        $smarty->display('./Template/products.tpl'); // muestro el template 
    }
    function showRegistro($logged){
        $smarty = new Smarty();
        $smarty->assign('logged', $logged);
        $smarty->display('./Template/registro.tpl');
    }
    function showUsers($logged, $users){
        $smarty = new Smarty();
        $smarty->assign('users', $users);
        $smarty->assign('logged', $logged);
        $smarty->display('./Template/users.tpl');
    }
    function showhomeLocation(){
        header("Location: ".BASE_URL."users");
    }

}


?>
