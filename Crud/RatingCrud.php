<?php
class RatingCrud{

    private $crud;

    function __construct($crud){
        $this->crud = $crud;
    }

    function createRating($user_id, $product_id, $rating){
        $sql = "INSERT INTO ratings(user_id, product_id, rating) VALUES (:user_id,:product_id,:rating)";
        $values = array(":user_id"=>$user_id, ":product_id"=>$product_id, ":rating"=>$rating);
        $this->crud->createRow($sql, $values);
    }

    function updateRating($user_id, $product_id, $rating){
        $sql = "UPDATE ratings SET rating = :rating WHERE user_id = :user_id AND product_id = :product_id;";
        $values = array(":user_id"=>$user_id, ":product_id"=>$product_id, ":rating"=>$rating);
        $this->crud->updateRow($sql, $values);
    }

    function readAverageRating($product_id){
        $sql = "SELECT product_id, AVG(rating) as avg FROM ratings WHERE product_id=:product_id";
        $values = array(":product_id"=>$product_id);
        $result = $this->crud->readOneRow($sql, $values);
        return $result;
    }

    function readAverageRatingAll(){
        $sql = "SELECT product_id, AVG(rating) as avg FROM ratings GROUP BY product_id; ";

        $result = $this->crud->readMultipleRows($sql);
        return $result;
    }

}
?>