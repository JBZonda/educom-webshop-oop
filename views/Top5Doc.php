<?php

class Top5Doc extends ProductDoc{
    function show_top5(){
        echo "<h1>Top 5 bestelde producten in de laatste week:</h1>";
        
        foreach( $this->model->products as $product){
            $this->show_product_in_overview($product);
        }
    }

    function show_content(){
        $this->show_top5();
    }
}
?>