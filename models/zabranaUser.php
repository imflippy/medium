<?php
ob_start();
@session_start();

$rolee = $_SESSION['user']->id_role; //id uloge korisnika koji je ulogovan
$idUserStranaa = $_SESSION['idUserDelete'];
$idUserr = $_SESSION['id_user'];


if($idUserr != $idUserStranaa){
    if($rolee != 1){
    header("Location:index.php?page=pocetna");
    }
}
