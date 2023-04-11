<?php
class FormModel extends PageModel{
    public $products;

    public function __construct($parent){
        $this->session_handler = new SessionFunctions();
        $this->is_POST = $parent->is_POST;
        $this->page = $parent->page;
        $this->menu = $parent->menu;
        $this->logged_in = $parent->logged_in;
        $this->errors = $parent->errors;
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

}
?>