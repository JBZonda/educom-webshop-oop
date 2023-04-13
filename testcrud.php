<?php

include "CRUD.php";
include "UserCrud.php";
include "ShopCrud.php";
$table = "users";
$columns = array("name", "email", "password");
$sql = "INSERT INTO $table (". implode(", ", $columns) .") VALUES (:name,:email,:password);";

$values = array(":name"=>"jaap", ":email"=>"jaap.@here.nl", ":password"=>"asdfgbvcdrtgbvcxdfghbvfgfghgfvhhbghjbghjhghhygcfg");

#$sql = "SELECT * FROM users WHERE id=2";

$crud = new CRUD();
$id = $crud->createRow($sql, $values);
echo $id;
#$crud->deleteRow($sql);

#$sql ="SELECT * FROM users WHERE email=:email";
#$values = array(":email"=>"aaa@a.com");
#$row = $crud->readOneRow($sql, $values);
#var_dump($row);
#echo "<br>";
#$sql = "SELECT * FROM users";
#$results = $crud->readMultipleRows($sql);
#var_dump($results);


?>