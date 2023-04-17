<?php

class AJAXDoc{
    public $model;
    private $json;

    public function __construct($model){
        $this->model = $model;
    }

    public function show(){
        switch ($this->model->function){
            case "createRating":
                
                break;
            case "updateRating":
                
                break;
            case "readAverageRating":
                $this->json = json_encode($this->model->result);
                break;
            case "readAverageRatingAll":
                $this->json = json_encode($this->model->result);
                break;
            case "readUserRating":
                $this->json = json_encode($this->model->result);
                break;
        }

        echo $this->json;
    }
}

?>