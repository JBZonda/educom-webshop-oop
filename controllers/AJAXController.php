<?php
include_once "models/PageModel.php";

class AJAXController{
    public $model;
    public $model_factory;

    function __construct($model_factory){
        $this->model_factory = $model_factory;
        $this->model = $this->model_factory->createModel("rating");

    }

    function handle_action(){
        switch($this->model->function){
            case "createRating":
                $user_id = $this->model->session_handler->get_user_id();
                $this->model->crud->createRating($user_id, $this->model->product_id, $this->model->rating);
                break;
            case "updateRating":
                $user_id = $this->model->session_handler->get_user_id();
                $this->model->crud->updateRating($user_id, $this->model->product_id, $this->model->rating);
                break;
            case "readAverageRating":
                $this->model->result = $this->model->crud->readAverageRating($this->model->product_id);
                break;
            case "readAverageRatingAll":
                $this->model->result = $this->model->crud->readAverageRatingAll();
                break;
            
            case "readUserRating":
                $user_id = $this->model->session_handler->get_user_id();
                $this->model->result = $this->model->crud->readUserRating($user_id, $this->model->product_id);
                break;

        }

        $this->show_response();
    }

    function show_response(){
        include "views/AJAXDoc.php";
        $view = new AJAXDoc($this->model);
        $view->show();

    }

}
?>