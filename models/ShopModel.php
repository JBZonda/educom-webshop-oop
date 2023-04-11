<?php
include "models/FormModel.php";
class ShopModel extends FormModel{

    function get_total_price($products, $cart){
        $total_price = 0;
        foreach ($products as $product){
            $total_price += $product->get_price() * $cart[$product->get_id()];
        }
        return $total_price;
    }

/*-------------------------cart button--------------------------------*/
    function handle_cart_action(){
        switch ($this->values["action"]){
            case "add":
                $this->session_handler->add_to_cart($this->values["id_in_cart"], $this->values["amount"]);
                break;
            case "remove":
                $this->session_handler->remove_from_cart($this->values["id_in_cart"]);	
                break;
        }
    }

/*-----------------------------------image upload-----------------------------------------------*/
    function upload_product_image(){
        $target_dir = "Images/";
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            
        } else {
            throw new Exception ("File is not a valid image");
            
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            throw new Exception ("File already exists");
        }
    
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            throw new Exception ("File is too large");
        }
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp" ) {
            throw new Exception ("Invalid image file type");
        }
       
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            return $file_name;
        } else {
            return false;
        }
    }

}
?>