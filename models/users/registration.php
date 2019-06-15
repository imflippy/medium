<?php

if(isset($_POST['btnRegister'])) {
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";

    $ime = $_POST['first_name'];
    $prezime = $_POST['last_name'];
    $email = $_POST['tbMail'];
    $sifra = $_POST['tbPassword'];


    $reImePrezime = "/^[A-Z][a-z]{2,15}$/";


    $greske = [];

    if (!preg_match($reImePrezime, $ime)) {
        $greske[] = "First Name is not in good format!";
    }
    if (!preg_match($reImePrezime, $prezime)) {
        $greske[] = "Last Name is not in good format!";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $greske[] = "Mail is not in good format!";
    }
    if (strlen($sifra) < 6) {
        $greske[] = "Password length must be over 6";
    }

    if(count($greske) > 0){
        http_response_code(422);
        echo json_encode($greske);
    } else{

        $proveraMail = getMailUser($email);
//// provera maila mi nije potrebna zato sto sam to zastitio preko baze
        if($proveraMail->rowCount() > 0){
            http_response_code(409);
            echo json_encode("Email vec postoji");
        } else{
            $siframd5 = md5($sifra);
            $vremeRegistracije = date("Y-m-d H-i-s", time());
            try{
                $register = userRregister($ime, $prezime, $email, $siframd5,$vremeRegistracije );


                    http_response_code(201);
                    echo json_encode($register);
            } catch (PDOException $ex){
                /*http_response_code(409);*/
                http_response_code(500);
                echo json_encode(['Greska' => "BAZA". $ex->getMessage()]);
                catchErrors("registration.php ->".$ex->getMessage());
            }
        }


    }
} else{
    http_response_code(403);
}
