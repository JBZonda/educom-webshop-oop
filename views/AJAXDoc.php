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
                break;
        }

        echo $this->json;
    }


    /* not used found json_encode instead*/
    function build_json($result){
        $json = "{";
        foreach ($result as $key => $value){
            $json = $json . '"'.$key . '":' . $value .',';
        }

        $json[-1] = "}";

        $this->json = $json;

    }

}

?>