<?php
abstract class ProductDoc extends FormsDoc{
    function show_product_in_overview($product, $data){
        echo '<a class="product_link" href="index.php?page=detail&id='. $product->get_id() .'">
        <div class="product">
        <p >'. $product->get_name() . '</p>
        <img src="Images/'. $product->get_image_location().'" alt="image of '. $product->get_id() .'">
        <p>Prijs:'. $product->get_price().'</p>';
        if ($data["loggedin"]){
            if (array_key_exists($product->get_id(), $data["cart"])){
                $this->cart_button($product->get_id(), "overview", "remove", $data);
            } else {
                $this->cart_button($product->get_id(), "overview", "add", $data);
            }
        }
        echo '</div>
        </a>';
    }
    
    function show_product_in_detail($data){
        $product = $data["products"][0];
        echo 
        '<h1>'. $product->get_name() . '</h1>
        <div class="product">
        
        <img src="Images/'. $product->get_image_location().'" alt="image of product id:  '. $product->get_id() .'">
        <p>Prijs:'. $product->get_price().'</p>';
        if ($data["loggedin"]){
            if (array_key_exists($product->get_id(), $data["cart"])){
                $this->cart_button($product->get_id(), "detail", "remove", $data);	
            } else {
                $this->cart_button($product->get_id(), "detail", "add", $data);
            }
        }
        echo '<p>Beschrijving:<br>'. $product->get_discription().'</p>
        </div>';
    }
}
?>