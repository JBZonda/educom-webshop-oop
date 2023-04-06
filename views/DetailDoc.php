<?php

class DetailDoc extends ProductDoc{
    function show_content(){
        $this->show_product_in_detail($this->data);
    }
}

?>