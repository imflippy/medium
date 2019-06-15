<?php
session_start();
if(isset($_POST['deleteUser'])){
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";

    $idUserDelete = $_SESSION['idUserDelete'];
    try{
        $delete = deleteUser($idUserDelete);
        http_response_code(204);
        header("Location:../../index.php?page=pocetna");
    }catch (PDOException $ex){
        http_response_code(500);
        echo json_encode(['Nije obrsian user', $ex->getMessage()]);
        catchErrors("deleteUser.php ->".$ex->getMessage());
        header("Location:../../index.php?page=pocetna");
    }

} else{
    http_response_code(400);
    header("Location:../../index.php?page=pocetna");
}
unset($idUserDelete);