<?php

class Top5Doc extends ProductDoc{
    function show_top5($data){
        echo "<h1>Top 5 bestelde producten in de laatste week:</h1>";
        
        foreach( $data["products"] as $product){
            $this->show_product_in_overview($product, $data);
        }
    }

    function show_content(){
        $this->show_top5($this->data);
    }
}
?>