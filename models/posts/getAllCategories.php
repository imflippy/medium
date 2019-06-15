<?php
header("Content-type: application/json");
require "../../config/connection.php";
require "functions.php";

try {
    $categories = getCategories();
    http_response_code(200);
    echo json_encode($categories);
}catch (PDOException $ex){
    http_response_code(500);
    catchErrors("getAllCategories.php ->".$ex->getMessage());
}