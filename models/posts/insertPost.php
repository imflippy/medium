<?php
session_start();
if(isset($_POST['btnPost'])) {
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";

    $fajl_naziv = $_FILES['postPhoto']['name'];
    $fajl_tmpLokacija = $_FILES['postPhoto']['tmp_name'];
    $fajl_tip = $_FILES['postPhoto']['type'];
    $fajl_velicina = $_FILES['postPhoto']['size'];
    $naslov = $_POST['tbTitle'];
    $opis = $_POST['textOpis'];
    $category = $_POST['ddlCategories'];


    $greske = [];

    $dozvoljeni_tipovi = ['image/jpg', 'image/jpeg', 'image/png'];

    if(!in_array($fajl_tip, $dozvoljeni_tipovi)){
        array_push($greske, "Pogresan tip fajla. - Profil slika");
    }
    if($fajl_velicina > 3000000){
        array_push($greske, "Maksimalna velicina fajla je 3MB. - Profil slika");
    }
    if(strlen($opis) == 0){
        array_push($greske, "Mora se neki opis napisati");
    }
    if(strlen($naslov) == 0){
        array_push($greske, "Mora se neki opis napisati");
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

        $novaVisina = 303;
        $novaSirina = ($novaVisina/$visina) * $sirina;

        $novaMalaVisina = 50;
        $novaMalaSirina = 50;

        $novaSlika = imagecreatetruecolor($novaSirina, $novaVisina);
        $novaSlikaMala = imagecreatetruecolor($novaMalaSirina, $novaMalaVisina);

        imagecopyresampled($novaSlika, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
        imagecopyresampled($novaSlikaMala, $postojecaSlika, 0, 0, 0, 0, $novaMalaSirina, $novaMalaVisina, $sirina, $visina);

        $naziv = time().$fajl_naziv;
        $putanjaNovaSlika = 'assets/img/posts/nova_'.$naziv;
        $putanjaNovaSlikaMala = 'assets/img/posts/novaMala_'.$naziv;

        switch($fajl_tip){
            case 'image/jpeg':
                imagejpeg($novaSlika, '../../'.$putanjaNovaSlika, 75);
                imagejpeg($novaSlikaMala, '../../'.$putanjaNovaSlikaMala, 75);
                break;
            case 'image/png':
                imagepng($novaSlika, '../../'.$putanjaNovaSlika);
                imagepng($novaSlikaMala, '../../'.$putanjaNovaSlikaMala);
                break;
        }

        $putanjaOriginalnaSlika = 'assets/img/posts/'.$naziv;

        if(move_uploaded_file($fajl_tmpLokacija, '../../'.$putanjaOriginalnaSlika)){

            $idUser = $_SESSION['id_user'];
            $vremeUnosa = date("Y-m-d H-i-s", time());
            try {
                $isInserted = insertNewPost($naslov, $opis, $putanjaOriginalnaSlika, $putanjaNovaSlika, $putanjaNovaSlikaMala, $vremeUnosa, $category, $idUser);

                    header("Location: ../../index.php?page=pocetna");


            } catch(PDOException $ex){
                header("Location: ../../index.php?page=pocetna");
                echo $ex->getMessage();
                catchErrors("isertPost.php ->".$ex->getMessage());
            }
        }


        imagedestroy($postojecaSlika);
        imagedestroy($novaSlika);
        imagedestroy($novaSlikaMala);

    } else {
        header("Location: ../../index.php?page=pocetna");
    }
}