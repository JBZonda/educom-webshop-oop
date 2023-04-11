<?php

class WebshopDoc extends ProductDoc{

    function show_webshop(){
        echo "<h1>Webshop</h1>";
        
        foreach( $this->model->products as $product){
            $this->show_product_in_overview($product);
        }
    }

    function show_content(){
        $this->show_webshop();
    }
}

?>