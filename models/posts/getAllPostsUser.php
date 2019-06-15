<?php
session_start();

header("Content-type: application/json");
require "../../config/connection.php";
require "functions.php";
try {
    $idUserSession = $_SESSION['userStrana'];
    $br2 = $_POST['brojac'];
    $posts = getAllPostsUser($idUserSession, $br2);
    unset($idUserSession);
    http_response_code(200);
    echo json_encode($posts);

} catch (PDOException $ex){
    http_response_code(500);
    catchErrors("getAllPostsUser.php ->".$ex->getMessage());
}