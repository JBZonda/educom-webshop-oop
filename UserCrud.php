<?php
include "CRUD.php";
class UserCrud{

    private $crud;

    function __construct($crud){
        $this->crud = new CRUD;#$crud;
    }


    function get_user_by_email($conn ,$email){
        $email = mysqli_real_escape_string($conn, $email);
        $sql ="SELECT * FROM users WHERE email='". $email ."'";
        $result = $this->crud->readOneRow($sql);
        return $result;
        
    }

    function save_user($email,$name,$password){
        $conn = connect_database();
        $email = mysqli_real_escape_string($conn, $email);
        $name = mysqli_real_escape_string($conn, $name);
        $password = mysqli_real_escape_string($conn, $password);
        $sql = "INSERT INTO users(email, name, password) VALUES (:name,:email,:password)";
        $values = array(":name"=>$name, ":email"=>$email, ":password"=>$password);
        $id = $this->crud->createRow($sql, $values);
    }

    function does_email_exist($email){
        $conn = connect_database();
        try{
            $result = get_user_by_email($conn, $email);
            $exists = mysqli_num_rows($result) > 0;
            return $exists;
            
        } finally {
            disconnect_database($conn);
        } 
    }

    function get_user_data_from_email($email){
        $conn = connect_database();
        
        try{
            $result = get_user_by_email($conn, $email);
            if (!$result){
                throw new Exception("get_user_data_from_email: error:" . mysqli_error($conn));
            }
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
    
        } finally {
            disconnect_database($conn);
        }
        
    }
}

?>