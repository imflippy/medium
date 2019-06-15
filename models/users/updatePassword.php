<?php

session_start();
if (isset($_POST['btnUpdatePassword'])) {
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";

    $sifra = $_POST['tbPassword'];
    $idUser = $_POST['tbHidden2'];

    $greske = [];

    if (strlen($sifra) < 6) {
        $greske[] = "Password length must be over 6";
    }

    $data = null;
    if(count($greske) > 0){
        http_response_code(422);
        $data = $greske;
    } else{
        $md5Sifra = md5($sifra);
        try{
            $update = updateUserPassword($md5Sifra, $idUser);
            if($update){
                http_response_code(204);
                $data = $update;
            }
        } catch (PDOException $ex){
            http_response_code(500);
            $data = ['Greska' => 'Greska sa bazom'. $ex->getMessage()];
            catchErrors("updatePassword.php ->".$ex->getMessage());
        }
    }

    echo json_encode($data);
} else{
    http_response_code(400);
}
