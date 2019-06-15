<?php
session_start();
header("Content-type: application/json");

if(isset($_POST['btnComment'])){
    require "../../config/connection.php";
    require "functions.php";

    $idPost = $_POST['idPost'];
    $comment = $_POST['textOpis'];
    $idUser = $_SESSION['id_user'];
    $vremeComm = date("Y-m-d H-i-s", time());

    $reIdPost = "/^\d*$/";
    $reComment = "/^(.|\s)*[a-zA-Z]+(.|\s)*$/";

    $greske = [];

    if(!preg_match($reIdPost, $idPost)){
        $greske[] = "Id mora biti unet";
    }
    if(!preg_match($reComment, $comment)){
        $greske[] = "Text komentara";
    }

    if(count($greske) > 0){
        http_response_code(422);
        echo json_encode($greske);
    }else{
        try{
            $insert = insertComment($comment, $vremeComm, $idUser, $idPost);
            http_response_code(204);
            echo json_encode($insert);
        }catch (PDOException $ex){
            http_response_code(500);
            echo json_encode(['Greska', $ex->getMessage()]);
            catchErrors("insertComment.php ->".$ex->getMessage());
        }
    }
}else{
    http_response_code(400);
}
