<?php

class CRUD{
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
            $stmt -> setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $row = $stmt->fetch();
            #read it
            
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }
         return $row;

    }

    function readMultipleRows($sql){
        try{
            $conn = $this->connect();
            $stmt = $conn->prepare($sql);
            $stmt -> setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            $results = $stmt->fetchAll();
            
            
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        } finally {
            $conn = null;
        }

        return $results;
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