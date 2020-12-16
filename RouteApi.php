<?php
require_once 'route.php';
require_once 'api/apiProductController.php';

// instacio el router
$router = new Router();

// armo la tabla de ruteo de la API REST

//comentario/:ID pertenece al id producto?
$router->addRoute('comentario/:ID', 'GET', 'apiProductController', 'getComment');
$router->addRoute('producto/:ID', 'GET', 'apiProductController', 'getCommentID');
$router->addRoute('producto/', 'POST', 'apiProductController', 'insertComment');
$router->addRoute('comentario/:ID', 'DELETE', 'apiProductController', 'deleteComment');

 //run
 $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 
