<?php
header("Content-type: application/json");
if(isset($_POST['idPost'])){
    require "../../config/connection.php";
    require "functions.php";

    $idComment = $_POST['idPost'];

    try{
        $select = getAllComments($idComment);

        http_response_code(200);
        echo json_encode($select);
    } catch (PDOException $ex){
        http_response_code(500);
        echo json_encode(['greska'], $ex->getMessage());
        catchErrors("getComments.php ->".$ex->getMessage());
    }
}else{
    http_response_code(400);
}