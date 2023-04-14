<?php
include_once "CRUD.php";
class UserCrud{

    private $crud;

    function __construct($crud){
        $this->crud = $crud;
    }

    function read_user_by_email($email){
        $sql ="SELECT * FROM users WHERE email=:email";
        $values = array(":email"=>$email);
        $result = $this->crud->readOneRow($sql, $values);
        return $result;
    }

    function create_user($email,$name,$password){
        $sql = "INSERT INTO users(email, name, password) VALUES (:name,:email,:password)";
        $values = array(":name"=>$name, ":email"=>$email, ":password"=>$password);
        $id = $this->crud->createRow($sql, $values);
    }

    function update_password($email, $password){
        $sql ="UPDATE users SET password = :new_password WHERE email=:email";
        $values = array(":new_password"=>$password, ":email"=>$email);
        $this->crud->updateRow($sql, $values);
    }
}

?>