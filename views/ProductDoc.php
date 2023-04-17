<?php
abstract class ProductDoc extends FormsDoc{

    function show_product_in_overview($product){
        echo '<a class="product_link" href="index.php?page=detail&id='. $product->id .'">
        <div class="product">
        <p >'. $product->name . '</p>
        <img src="Images/'. $product->image_location.'" alt="image of '. $product->id .'">
        <div class="rating">';
        
        $this->show_rating_stars("rating_star_product_" .$product->id . "_");
        
        echo '</div>
        <p>Prijs:'. $product->price.'</p>';
        if ($this->model->logged_in){
            if (array_key_exists($product->id, $this->model->values["cart"])){
                $this->cart_button($product->id, "overview", "remove");
            } else {
                $this->cart_button($product->id, "overview", "add");
            }
        }
        echo '</div>
        </a>';
    }
    
    function show_product_in_detail($product){
        echo 
        '<h1>'. $product->name . '</h1>
        <div class="product">
        
        <img src="Images/'. $product->image_location.'" alt="image of product id:  '. $product->id .'">
        <div class="rating">
        <p >Rating:</p>';
        $this->show_rating_stars("rating_star_");
        
        if ($this->model->logged_in){
            echo '</div>
            <div class="user_rating">
            <p >Persoonlijke rating:</p>';
            $this->show_rating_stars("rating_star_user_");
        }
        echo '</div>
        <p>Prijs:'. $product->price.'</p>';
        if ($this->model->logged_in){
            if (array_key_exists($product->id,$this->model->values["cart"])){
                $this->cart_button($product->id, "detail", "remove");	
            } else {
                $this->cart_button($product->id, "detail", "add");
            }
        }
        echo '<p>Beschrijving:<br>'. $product->discription.'</p>
        </div>';
    }

    function show_rating_stars($id_name){
        $number = 1;
        while ($number <= 5){
            echo '<span class="rating_star" id="'. $id_name. $number .'" >☆</span>';
            $number += 1;
        }

    }


}
?>