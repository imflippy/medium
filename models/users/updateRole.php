<?php

if(isset($_POST['updateRole'])) {
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";

    $role = $_POST['ddlRole'];
    $idUser = $_POST['hiddenIdUser'];

    $reId = "/^\d*$/";

    $greske = [];
    if($role == 0){
        $greske[] = "Role is not in good format!";
    }
    if (!preg_match($reId, $idUser)) {
        $greske[] = "User id is not in good format!";
    }

    $data = null;

    if(count($greske) > 0){
        http_response_code(422);
        $data = $greske;
        header("Location: ../../index.php?page=profilUser&user=$idUser");
    } else{

        try{
            $update = updateRole($role, $idUser);

            http_response_code(204);
            header("Location: ../../index.php?page=profilUser&user=$idUser");
        } catch (PDOException $ex){
            http_response_code(500);
            $data = ["Greska" =>"Update korisnikove uloge nije uspeo". $ex->getMessage()];
            catchErrors("UpdateRole.php ->".$ex->getMessage());
            header("Location: ../../index.php?page=profilUser&user=$idUser");
        }
    }

    echo json_encode($data);

} else{
    http_response_code(400);
    header("Location: ../../index.php?page=profilUser&user=$idUser");
}
