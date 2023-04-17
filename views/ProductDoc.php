<?php
abstract class ProductDoc extends FormsDoc{

    function show_product_in_overview($product){
        echo '<a class="product_link" href="index.php?page=detail&id='. $product->id .'">
        <div class="product">
        <p >'. $product->name . '</p>
        <img src="Images/'. $product->image_location.'" alt="image of '. $product->id .'">
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
        <span class="rating_star" id="rating_star_1" >☆</span>
        <span class="rating_star" id="rating_star_2" >☆</span>
        <span class="rating_star" id="rating_star_3" >☆</span>
        <span class="rating_star" id="rating_star_4" >☆</span>
        <span class="rating_star" id="rating_star_5" >☆</span>
        
        </div>
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
}
?>