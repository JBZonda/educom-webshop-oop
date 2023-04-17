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
                $this->model->crud->readAverageRating();
                break;
            case "updateRating":
                $this->model->crud->readAverageRating();
                break;
            case "readAverageRating":
                $this->model->result = $this->model->crud->readAverageRating($this->model->product_id);
                break;
            case "readAverageRatingAll":
                $this->model->result = $this->model->crud->readAverageRatingAll();
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