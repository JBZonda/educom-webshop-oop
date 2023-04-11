<?php

include "GeneralCRUD.php";

$table = "users";
$columns = array("name", "email", "password");
#$sql = "INSERT INTO $table (". implode(", ", $columns) .") VALUES (:name,:email,:password);";

$values = array(":name"=>"jaap", ":email"=>"jaap.@here.nl", ":password"=>"asdfgbvcdrtgbvcxdfghbvfgfghgfvhhbghjbghjhghhygcfg");

$sql = "DELETE FROM users WHERE `users`.`id` = 5";

$crud = new GeneralCRUD();
#$crud->createRow($sql, $values);
$crud->deleteRow($sql);
?>