<?php

class WebshopDoc extends ProductDoc{

    function show_webshop($data){
        echo "<h1>Webshop</h1>";
        
        foreach( $data["products"] as $product){
            $this->show_product_in_overview($product, $data);
        }
    }

    function show_content(){
        $this->show_webshop($this->data);
    }
}

?>