<?php
if(isset($_POST['idPost'])){
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";
    $idPost = $_POST['idPost'];
    try{
        $rezultat = deletePost($idPost);
        http_response_code(204);
        echo json_encode($rezultat);
    } catch (PDOException $ex){
        http_response_code(500);
        echo json_encode(["Greska", $ex->getMessage()]);
        catchErrors("deletePost.php ->".$ex->getMessage());
    }

}else{
    http_response_code(400);
}