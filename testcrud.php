<?php

include "Crud/CRUD.php";
include "models/ModelFactory.php";

$crud = new Crud();
$model_factory = new ModelFactory($crud);

$crud = $model_factory->createCrud("rating");

#$crud->createRating(1,4,4);
#$crud->updateRating(1,4,4);
var_dump($crud->readAverageRating(4));echo "<br>";
var_dump($crud->readAverageRatingAll());echo "<br>";
var_dump($crud->readAverageRatingAll()[3]->avg);
?>