<?php
header("Content-type: application/json");

if(isset($_POST['idComm'])){
    require "../../config/connection.php";
    require "functions.php";

    $idComm = $_POST['idComm'];
    try{
        $resenje = getOneComm($idComm);
        http_response_code(200);
        echo json_encode($resenje);
    } catch (PDOException $ex){
        http_response_code(500);
        echo json_encode(['greska', 'Problem'.$ex->getMessage()]);
        catchErrors("getOneComment.php ->".$ex->getMessage());

    }

}else{
    http_response_code(400);
}