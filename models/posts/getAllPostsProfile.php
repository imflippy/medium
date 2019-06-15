<?php
session_start();
header("Content-type: application/json");
require "../../config/connection.php";
require "functions.php";
try {
    $idUser = $_SESSION['userStrana'];
    $postovi = getAllPostsProfile($idUser);

    echo json_encode($postovi);
}catch (PDOException $ex){
    http_response_code(500);
    catchErrors("getAllPostsProfile.php ->".$ex->getMessage());
}