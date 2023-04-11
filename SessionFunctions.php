<?php

class SessionFunctions {
    function session_initialize(){
        if ($_SESSION == array()){
            $_SESSION["user_id"] = NULL;
            $_SESSION["user_name"] = NULL;
            $_SESSION["user_email"] = NULL;
            $_SESSION["cart"] = array();
        }
    }
    function login_user($id,$email,$name){
        $_SESSION["user_id"] = $id;
        $_SESSION["user_email"] = $email;
        $_SESSION["user_name"] = $name;
        $_SESSION["cart"] = array();
    }
    
    function get_user_id(){
        return $_SESSION["user_id"];
    }
    
    function get_current_user_name() {
        return $_SESSION["user_name"];
    }
    
    function get_current_user_data() {
        return get_user_data_from_email($_SESSION["user_email"]);
    }
    
    function logout_user(){
        session_unset();
        session_initialize();
        
    }
    
    function is_user_logged_in(){
        return ($_SESSION["user_name"] != NULL);
    }
    
    function add_to_cart($product_id, $amount){
        $_SESSION["cart"][$product_id] = $amount;
    }
    
    function remove_from_cart($product_id){
        unset($_SESSION["cart"][$product_id]);
    }
    
    function get_cart(){
        return $_SESSION["cart"];
    }
    
    function get_product_id_from_cart(){
        return  array_keys($_SESSION["cart"]);
    }
    
    function empty_cart(){
        $_SESSION["cart"] = array();
    }
}

?>