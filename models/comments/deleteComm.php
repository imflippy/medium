<?php
session_start();
if(isset($_POST['idComm'])){
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";

    $idComm = $_POST['idComm'];
    try{
        $rezultat = deleteComm($idComm);
        http_response_code(204);
        echo json_encode($rezultat);
    } catch (PDOException $ex){
        http_response_code(500);
        echo json_encode(["Greska", $ex->getMessage()]);
        catchErrors("deleteComm.php ->".$ex->getMessage());
    }


}else{
    http_response_code(400);
}