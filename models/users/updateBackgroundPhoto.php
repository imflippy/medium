<?php
session_start();
if(isset($_POST['endUpdateBackground'])){

    require_once "../../config/connection.php";
    require_once "functions.php";


    $fajl_naziv = $_FILES['backgroundPhoto']['name'];
    $fajl_tmpLokacija = $_FILES['backgroundPhoto']['tmp_name'];
    $fajl_tip = $_FILES['backgroundPhoto']['type'];
    $fajl_velicina = $_FILES['backgroundPhoto']['size'];
    $idUser = $idUser = $_POST['tbHidden3'];

    $greske = [];

    $dozvoljeni_tipovi = ['image/jpg', 'image/jpeg', 'image/png'];

    if(!in_array($fajl_tip, $dozvoljeni_tipovi)){
        array_push($greske, "Pogresan tip fajla. - Profil slika");
    }
    if($fajl_velicina > 3000000){
        array_push($greske, "Maksimalna velicina fajla je 3MB. - Profil slika");
    }


    if(count($greske) == 0){
        list($sirina, $visina) = getimagesize($fajl_tmpLokacija);


        $postojecaSlika = null;
        switch($fajl_tip){
            case 'image/jpeg':
                $postojecaSlika = imagecreatefromjpeg($fajl_tmpLokacija);
                break;
            case 'image/png':
                $postojecaSlika = imagecreatefrompng($fajl_tmpLokacija);
                break;
        }

        $novaVisina = 400;

        $novaSirina = ($novaVisina/$visina) * $sirina;


        $novaSlika = imagecreatetruecolor($novaSirina, $novaVisina);


        imagecopyresampled($novaSlika, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);


        $naziv = time().$fajl_naziv;
        $putanjaNovaSlika = 'assets/img/usersBackground/nova_'.$naziv;

        switch($fajl_tip){
        case 'image/jpeg':
        imagejpeg($novaSlika, '../../'.$putanjaNovaSlika, 75);
        break;
        case 'image/png':
        imagepng($novaSlika, '../../'.$putanjaNovaSlika);
        break;
        }

        $putanjaOriginalnaSlika = 'assets/img/usersBackground/'.$naziv;

        if(move_uploaded_file($fajl_tmpLokacija, '../../'.$putanjaOriginalnaSlika)){
            //echo "Slika je upload-ovana na server!";

        try {
            $isInserted = updateBackgroundPhoto($putanjaOriginalnaSlika, $putanjaNovaSlika, $idUser);

        if($isInserted){
            //echo "Putanja do slike je upisana u bazu!";
            header("Location: ../../index.php?page=profilUser&user=$idUser");
        }

        } catch(PDOException $ex){
            header("Location: ../../index.php?page=profilUser&user=$idUser");
            echo $ex->getMessage();
            catchErrors("updateBackgroundPhoto.php ->".$ex->getMessage());
        }
        }


        imagedestroy($postojecaSlika);
        imagedestroy($novaSlika);

    } else {
        header("Location: ../../index.php?page=profilUser&user=$idUser");
    }

}