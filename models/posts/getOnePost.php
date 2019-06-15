<?php
header("Content-type: application/json");

if(isset($_POST['idPost'])){
    require "../../config/connection.php";
    require "functions.php";

    $idPost = $_POST['idPost'];
    try{
        $resenje = getOnePost($idPost);
        http_response_code(200);
        echo json_encode($resenje);
    } catch (PDOException $ex){
        http_response_code(500);
        echo json_encode(['greska', 'Problem'.$ex->getMessage()]);
        catchErrors("getOnePost.php ->".$ex->getMessage());

    }

}else{
    http_response_code(400);
}