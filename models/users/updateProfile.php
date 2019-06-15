<?php
session_start();
if(isset($_POST['btnUpdateProfile'])) {
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";

    $ime = $_POST['tbFirstName'];
    $prezime = $_POST['tbLastName'];
    $email = $_POST['tbMail'];
    $opis = $_POST['tbDescription'];
    $idUser = $_POST['tbHidden1'];

    $reImePrezime = "/^[A-Z][a-z]{2,15}$/";
    $reOpis = "/^(.|\s)*[a-zA-Z]+(.|\s)*$/";

    $greske = [];

    if (!preg_match($reImePrezime, $ime)) {
        $greske[] = "First Name is not in good format!";
    }
    if (!preg_match($reImePrezime, $prezime)) {
        $greske[] = "Last Name is not in good format!";
    }
    if (!preg_match($reOpis, $opis)) {
        $greske[] = "Opis is not in good format!";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $greske[] = "Mail is not in good format!";
    }

    $data = null;

    if(count($greske) > 0){
        http_response_code(422);
        $data = $greske;
    } else{

        try{
            $update = updateUserProfile($ime, $prezime, $email, $opis, $idUser);

                http_response_code(204);

        } catch (PDOException $ex){
            http_response_code(500);
            $data = ["Greska" =>"Update korisnika nije uspeo". $ex->getMessage()];
            catchErrors("updateProfile.php ->".$ex->getMessage());
        }
    }

    echo json_encode($data);

} else{
    http_response_code(400);
}