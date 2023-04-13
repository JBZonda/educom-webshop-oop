<?php

class CRUD{
    public $servername = "localhost";
    public $username = "jeroens_webshop_user";
    public $password = "p@TL!Cz7m2qes7V!";
    public $database = "jeroens_webshop";

    private function bind_values($stmt, $values){
        if ($values != NULL){
            foreach ($values as $key => $value){
                $stmt->bindValue($key,$value);
            }
        }
        return $stmt;
    }

    function connect(){
        $conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    
    function prep_bind_ex($sql, $values, $conn){
            $stmt = $conn->prepare($sql);
            $stmt = $this->bind_values($stmt, $values);
            $stmt -> setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;
    }

    function createRow($sql, $values){
        try{
            $conn = $this->connect();
            $stmt = $this->prep_bind_ex($sql, $values, $conn);
            $id = $conn->lastInsertId();

        } catch(PDOException $e){
            throw new Exception($e->getMessage());
        } finally {
            $conn = null;
        }
        return $id;
    }

    function readOneRow($sql,$values=NULL){
        try{
            $conn = $this->connect();
            $stmt = $this->prep_bind_ex($sql, $values, $conn);
            $row = $stmt->fetch();
            
        } catch(PDOException $e){
            throw new Exception($e->getMessage());
        } finally {
            $conn = null;
        }
         return $row;

    }

    function readMultipleRows($sql,$values=NULL){
        try{
            $conn = $this->connect();
            $stmt = $this->prep_bind_ex($sql, $values, $conn);

            $results = $stmt->fetchAll();
            
        } catch(PDOException $e){
            throw new Exception($e->getMessage());
        } finally {
            $conn = null;
        }

        return $results;
    }

    function updateRow($sql, $values=NULL){
        try{
            $conn = $this->connect();
            $stmt = $this->prep_bind_ex($sql, $values, $conn);

        } catch(PDOException $e){
            throw new Exception($e->getMessage());
        } finally {
            $conn = null;
        }
    }

    function deleteRow($sql,$values=NULL){
        if (!str_contains($sql,"WHERE")){
            throw new Exception("Deleting all rows");
        }
        try{
            $conn = $this->connect();
            $stmt = $this->prep_bind_ex($sql, $values, $conn);

        
        } catch(PDOException $e){
            throw new Exception($e->getMessage());
        } finally {
            $conn = null;
        }
    }
}


?>