<?php

class RatingModel extends PageModel{
    public $function;
    public $product_id;
    public $user_id;
    public $rating;
    public $result;

    function __construct($crud){
        parent::__construct($crud);
        $this->set_values("function");
        $this->set_values("product_id");
        $this->set_values("user_id");
        $this->set_values("rating");
    }

    function set_values($name){
        if (key_exists($name,$_GET)){
            switch($name){
                case "function":
                    $this->function = $_GET["function"];
                    break;
                case "product_id":
                    $this->product_id = $_GET["product_id"];
                    break;
                case "user_id":
                    $this->user_id = $_GET["user_id"];
                    break;
                case "rating":
                    $this->rating = $_GET["rating"];
                    break;
            }
        }
    }

}


?>