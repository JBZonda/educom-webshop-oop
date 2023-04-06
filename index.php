<?php
include "html_build_functions.php";
include "validate_form_functions.php";
include "file_repository.php";
include "session_functions.php";
include "Product.php";
include "controllers/PageController.php";
session_start();
#create session variables on first load
session_initialize();

$controller = new PageController();
$controller->handle_request();

?>