<?php

include "CRUD.php";

$table = "users";
$columns = array("name", "email", "password");
#$sql = "INSERT INTO $table (". implode(", ", $columns) .") VALUES (:name,:email,:password);";

$values = array(":name"=>"jaap", ":email"=>"jaap.@here.nl", ":password"=>"asdfgbvcdrtgbvcxdfghbvfgfghgfvhhbghjbghjhghhygcfg");

$sql = "SELECT * FROM users WHERE id=2";

$crud = new CRUD();
#$id = $crud->createRow($sql, $values);
#$crud->deleteRow($sql);
#$sql = "SELECT * FROM users WHERE id=2";
#$row = $crud->readOneRow($sql);
#var_dump($row);
#$sql = "SELECT * FROM users";
#$results = $crud->readMultipleRows($sql);
#var_dump($results[0]->id);
?>