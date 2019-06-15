<?php
if(isset($_POST['user'])){
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";
try {
    $user = "%" . strtolower($_POST['user']) . "%";

    $users = searchUser($user);
    http_response_code(200);
    echo json_encode($users);
}catch (PDOException $ex){
    http_response_code(500);
    catchErrors("searchUser.php ->".$ex->getMessage());
}
} else{
    http_response_code(400);
}