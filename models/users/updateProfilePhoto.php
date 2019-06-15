<?php
session_start();
if(isset($_POST['endUpdateProfile'])){

    require_once "../../config/connection.php";
    require_once "functions.php";

    // FAJL

    // $fajl = $_FILES['slika'];
    // var_dump($fajl);

    $fajl_naziv = $_FILES['profilePhoto']['name'];
    $fajl_tmpLokacija = $_FILES['profilePhoto']['tmp_name'];
    $fajl_tip = $_FILES['profilePhoto']['type'];
    $fajl_velicina = $_FILES['profilePhoto']['size'];
    $idUser = $_POST['tbHidden4'];

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

        $sirinaProfile = 88;
        $visinaProfile = 88;

        $sirinaKomentar = 50;
        $visinaKomentar = 50;

        $sirinaNavigacija = 25;
        $visinaNavigacija = 25;


        $slikaProfile = imagecreatetruecolor($sirinaProfile, $visinaProfile);
        $slikaKomentar = imagecreatetruecolor($sirinaKomentar, $visinaKomentar);
        $slikaNavigacija = imagecreatetruecolor($sirinaNavigacija, $visinaNavigacija);



        imagecopyresampled($slikaProfile, $postojecaSlika, 0, 0, 0, 0, $sirinaProfile, $visinaProfile, $sirina, $visina);
        imagecopyresampled($slikaKomentar, $postojecaSlika, 0, 0, 0, 0, $sirinaKomentar, $visinaKomentar, $sirina, $visina);
        imagecopyresampled($slikaNavigacija, $postojecaSlika, 0, 0, 0, 0, $sirinaNavigacija, $visinaNavigacija, $sirina, $visina);


        $naziv = time().$fajl_naziv;
        $putanjaNovaProfilna = 'assets/img/users/novaProfilna_'.$naziv;
        $putanjaNovaKomentar = 'assets/img/users/novaKomentar_'.$naziv;
        $putanjaNovaNavigacija = 'assets/img/users/novaNavigacija_'.$naziv;

        switch($fajl_tip){
            case 'image/jpeg':
                imagejpeg($slikaProfile, '../../'.$putanjaNovaProfilna, 75);
                imagejpeg($slikaKomentar, '../../'.$putanjaNovaKomentar, 75);
                imagejpeg($slikaNavigacija, '../../'.$putanjaNovaNavigacija, 75);
                break;
            case 'image/png':
                imagepng($slikaProfile, '../../'.$putanjaNovaProfilna);
                imagepng($slikaKomentar, '../../'.$putanjaNovaKomentar);
                imagepng($slikaNavigacija, '../../'.$putanjaNovaNavigacija);
                break;
        }

        $putanjaOriginalnaSlika = 'assets/img/users/'.$naziv;
        if(move_uploaded_file($fajl_tmpLokacija, '../../'.$putanjaOriginalnaSlika)){
            //echo "Slika je upload-ovana na server!";
            try {
                $isInserted = updateProfilePhoto($putanjaOriginalnaSlika, $putanjaNovaProfilna, $putanjaNovaKomentar, $putanjaNovaNavigacija, $idUser);

                if($isInserted){
                    //echo "Putanja do slike je upisana u bazu!";
                    header("Location: ../../index.php?page=profilUser&user=$idUser");
                }

            } catch(PDOException $ex){
                header("Location: ../../index.php?page=profilUser&user=$idUser");
                echo $ex->getMessage();
                catchErrors("updateProfilePhoto.php ->".$ex->getMessage());
            }
        }


        imagedestroy($postojecaSlika);
        imagedestroy($slikaProfile);
        imagedestroy($slikaKomentar);
        imagedestroy($slikaNavigacija);

    } else {
        header("Location: ../../index.php?page=profilUser&user=$idUser");
        //var_dump($greske);
    }

}
