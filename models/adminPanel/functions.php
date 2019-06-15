<?php
function pristumStranamaUprocentima(){
    $array = [];
    $ukupno = 0;
    $loginRegister = 0;
    $pocetna = 0;
    $profil = 0;
    $editProfil = 0;
    $editPost = 0;
    $comment = 0;
    $admin = 0;
    $autor = 0;

    $poslednja24h = strtotime("1 day ago");
    //var_dump($poslednja24h);
    @$file = file(LOG_FAJL);
    if(count($file)){
        foreach ($file as $f){
            //var_dump($f);
            $delovi = explode("\t", $f);
            $url = explode(".php", $delovi[0]);
            $page = explode("&", $url[1]);
            //var_dump($delovi);
            $time = trim(strtotime($delovi[1]));
            //var_dump($time);
            //print_r($delovi[3]);
            if($time >= $poslednja24h){
                switch ($page[0]){
                    case "":
                        $loginRegister++;$ukupno++;
                        break;
                    case "?page=pocetna":
                        $pocetna++;$ukupno++;
                        break;
                    case "?page=profilUser":
                        $profil++;$ukupno++;
                        break;
                    case "?page=editProfile":
                        $editProfil++;$ukupno++;
                        break;
                    case "?page=editPost":
                        $editPost++;$ukupno++;
                        break;
                    case "?page=comment":
                        $comment++;$ukupno++;
                        break;
                    case "?page=adminPanel":
                        $admin++;$ukupno++;
                        break;
                    case "?page=autor":
                        $autor++;$ukupno++;
                        break;
                    default:
                        $pocetna++;$ukupno++;
                        break;
                }
            }

        }

        if($ukupno >0){
            $array[] = round($loginRegister*100/$ukupno, 2);
            $array[] = round($pocetna*100/$ukupno, 2);
            $array[] = round($profil*100/$ukupno, 2);
            $array[] = round($editProfil*100/$ukupno, 2);
            $array[] = round($editPost*100/$ukupno, 2);
            $array[] = round($comment*100/$ukupno, 2);
            $array[] = round($admin*100/$ukupno, 2);
            $array[] = round($autor*100/$ukupno, 2);
        }
    }

    return $array;
}

function loggingCount($id){
    @$open = fopen(LOGGING_FAJL, "a");
    $unos = $id. "\n";
    @fwrite($open, $unos);
    @fclose($open);
}

function loggedCount(){
    return count(file(LOGGING_FAJL));
}

function deleteLoggingCount($id){
    $id = (int)$id;
    $unos = "";

    @$file = file(LOGGING_FAJL);

    if(count($file)){
        foreach ($file as $f){
            $fId = trim((int)$f);
            if($fId != $id){
                $unos .= $fId. "\n";
            }
        }
    }

    @$open = fopen(LOGGING_FAJL, "w");
    @fwrite($open, $unos);
    @fclose($open);
}

function nameUser($id){
    global $conn;
    $upit = "SELECT u.first_name, u.last_name, r.role_name FROM users u JOIN roles r ON u.id_role = r.id_role WHERE id_user = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$id]);

    return $priprema->fetch();
}

function autor(){
    global $conn;
    $upit = "SELECT * FROM autor WHERE id_autor = 1";
    $rezultat = $conn->query($upit);

    return $rezultat->fetch();
}
