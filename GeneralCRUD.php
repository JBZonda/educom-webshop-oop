<?php

class GeneralCRUD{
    public $servername = "localhost";
    public $username = "jeroens_webshop_user";
    public $password = "p@TL!Cz7m2qes7V!";
    public $database = "jeroens_webshop";

    function connect(){
        $conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    
    function createRow($sql, $values){
        try{
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            foreach ($values as $key => $value){
                $stmt->bindValue($key,$value);
            }
            $stmt->execute();
            $id = $conn->lastInsertId();

        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
        return $id;
    }

    function readOneRow($sql){
        try{
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            #read it
            
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
        # return obj or class 

    }

    function readMultipleRows($sql){
        try{
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            #read it
            
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
        # return obj or class 
    }

    function deleteRow($sql){
        try{
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
    }
}


?>