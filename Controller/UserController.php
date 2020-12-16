<?php

require_once "./View/UserView.php";
require_once "./View/ProductView.php";
require_once "./Model/UserModel.php";

class UserController{

    private $view;
    private $viewProducts;
    private $model;
    private $modelUser;

    function __construct(){
        $this->view = new UserView();
        $this->viewProducts = new ProductView();
        $this->model = new UserModel();


    }
    function getAccess(){
        session_start();
        if(isset($_SESSION['ID_USER'])){
            $loged = $this->model->getUser($_SESSION['ID_USER']);
            return $loged->access;
        }else{
            return 0;
        }
    }
    function home(){
        $user = $this->model->getUser();
        $this->view->showHome($user);
    }
    function Login(){
        $this->view->ShowLogin();
    }
    function Logout(){
        session_start();
        session_destroy();
        header("Location: ".BASE_URL);

    }
    function showRegistro(){
        $logged = $this->getAccess();
        $this->view->showRegistro($logged);
    }
    function showUsers(){
        $logged = $this->getAccess();
        $users = $this->model->getUsers();
        $this->view->showUsers($logged, $users);
    }
    public function verifyUser(){
       $user = $_POST['user'];
       $pass = $_POST['pass']; 
       $username = $this->model->getPassword($user);
       
       if(!empty($user) && !empty($pass)&& !(empty($username))){    
        if(password_verify($pass, $username->pass)){
           session_start();
           $_SESSION['ID_USER'] = $username->id_user;
           $_SESSION['USERNAME'] = $username->user;
           $_SESSION['LAST_ACTIVITY'] = time();
        $this->viewProducts->showHomeLocation();
       }else{
           $this->viewProducts->Home(0);
       }
    }else{
        $this->viewProducts->showError();
    }
    }
    function loggin($user){
        $username = $this->model->getPassword($user);
        session_start();
        $_SESSION['ID_USER'] = $username->id_user;
        $_SESSION['USERNAME'] = $username->user;
    }
    function insertUser(){
        $user = $_POST['usuario'];
        $password = $_POST['contrasenia'];
        if(!empty($user) && !empty($password)){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $this->model->insertUser($user,$hash);
                $this->loggin($user);
                $this->viewProducts->showHomeLocation();
        }else{
            $this->viewProducts->showError();
        }
    }

    function deleteUser($params = null){
        $user = $params[':ID'];
        $this->model->deleteUser($user);
        $this->view->ShowHomeLocation();
    }
    // Cambiar contraseña? 
   function updateUser($params = null){
        $user = $params[':ID'];
        $access = $_POST['permisos'];
        $this->model->updateUser($user, $access);
        $this->view->ShowHomeLocation();
    }
}


?>
