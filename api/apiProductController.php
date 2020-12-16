<?php
require_once './Model/commentModel.php';
require_once './api/apiController.php';

class apiProductController extends apiController {

  
    function __construct() {
        parent::__construct();
        $this->model = new commentModel();
        $this->view = new APIView();
    }

    
    public function getComment($params = null) {
        $id = $params[':ID'];
        $comment = $this->model->getComment($id);
        if (!empty($comment)) // verifica si el comentario existe
            $this->view->response($comment, 200);
        else
            $this->view->response("El comentario con el id=$id no existe", 404);
    }



    public function getCommentID($params = null) {
        $id = $params[':ID'];
        $comment = $this->model->getCommentID($id);
        $this->view->response($comment, 200);

    }


    public function insertComment($params = null){
        $body = $this->getData();

        $idcomment = $this->model->insertComment($body->comment, $body->score, $body->id_product);
        
        if (!empty($idcomment)) // verifica si el comentario existe
            $this->view->response( $this->model->getCommentID($idcomment), 201);
        else
            $this->view->response("el comentario no se pudo insertar", 404);
    }

    public function deleteComment($params = null) {
        $id = $params[':ID'];
        $comentario = $this->model->getComment($id);
        if (!empty($comentario)) {
            $this->model->deleteComment($id);
            $this->view->response("El comentario fue borrado con exito.", 200);
        } else
            $this->view->response("El comentario con el id={$id} no existe", 404);
    }
    

 
}