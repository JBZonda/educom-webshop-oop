<?php
class UserModel extends PageModel{
    public $products;

    public function __construct($parent){
        $this->session_handler = new SessionFunctions();
        $this->is_POST = $parent->is_POST;
        $this->page = $parent->page;
        $this->menu = $parent->menu;
        $this->logged_in = $parent->logged_in;
        $this->errors = $parent->errors;
    }
    
    function update_logged_in(){
        $this->logged_in = $this->session_handler->is_user_logged_in();
    }

    function get_total_price($products, $cart){
        $total_price = 0;
        foreach ($products as $product){
            $total_price += $product->get_price() * $cart[$product->get_id()];
        }
        return $total_price;
    }

    /*-------------general validate functions-------------------*/

    function is_valid(){
        $valid = TRUE;

        foreach( $this->errors as $key => $error) {
            if ($error != ""){
                $valid = False;
                break;
            }
        }
        return $valid;
    }

    function validate_input_fields($fields){
        foreach ($fields as $key => $field){
            $this->validate_specific_response($field, $this->clean_and_check_input($field));
        } 
    }

    function clean_and_check_input($variable_name) {
        # give errors to the missing variables
        if (empty($_POST[$variable_name])){
            $emty_error = "is verplicht";
            $this->values[$variable_name]= "";
            $this->errors[$variable_name] = $emty_error;
        } else {
            #trim the data to protect against malicious input
            $input = $_POST[$variable_name];
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            $this->values[$variable_name]= $input;
            $this->errors[$variable_name] = "";
        }
    }


    function validate_specific_response($variable_name) {
        if ($variable_name == "phone_number") {
            #check if the input is a correct phonenumber by checking for letters, special signs are allowed
            if (preg_match("/[a-z]/i", $this->values["phone_number"])){
                $this->errors[$variable_name] = "Incorrect telefoonnummer";
            }
        }
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