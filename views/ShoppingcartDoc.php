<?php

class ShoppingcartDoc extends FormsDoc{

    function show_cart_start() {
        echo '<div class="shoppingcart">
        <h1>Producten in winkelwaken:</h1><br>';
    }

    function show_cart_end(){
        echo '</div>';
    }

    function show_empty_cart(){
        echo '<h2>winkelwaken is leeg</h2>';
    }

    function show_order_button() {
        $this->show_form_start("button","order_button", $this->data);
        $this->show_form_end("Afrekenen","shoppingcart");
    }
    
    function show_total_price($data){
        echo '<div class="total_price_cart">
        <span>Totale prijs</span>
        <span class="total_price_value" >'. $data["total_price"].'</span>
        </div>'
        ;
    }
    
    function show_products($data){
        $products = $data['products'];
        foreach( $products as $product){
            echo '<div class="shoppingcart_item">
            <a href="index.php?page=webshop&id='.$product->get_id().'">'
            .$product->get_name() .'</a>
            <span class="cart_price">'.$product->get_price().'</span>
            </div>
            <br>'
            ;
        }
    }

    function show_content() {
    
        $this->show_cart_start();

        if (array_key_exists("products", $this->data)) {
            $this->show_products($this->data);
            $this->show_total_price($this->data);
            $this->show_order_button($this->data);
            
        } else {
            $this->show_empty_cart();
        }
        $this->show_cart_end();
        echo '</div>';
    }
}

?>