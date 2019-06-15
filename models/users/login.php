<?php
@session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['btnLogin'])){
    header("Content-type: application/json");
    ob_start();
    require "../../config/connection.php";
    require "../adminPanel/functions.php";
    require "functions.php";
    // Ucitavanje mailera
    require ABSOLUTE_PATH.'/PHPMailer/src/PHPMailer.php';
    require ABSOLUTE_PATH.'/PHPMailer/src/SMTP.php';
    require ABSOLUTE_PATH.'/PHPMailer/src/Exception.php';




    $email = $_POST['loginMail'];
    $sifra = $_POST['loginPassword'];


    $greske = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $greske[] = "Mail is not in good format!";
    }
    if (strlen($sifra) < 6) {
        $greske[] = "Password length must be over 6";
    }

    if(count($greske) > 0){
        http_response_code(422);
        echo json_encode($greske);
        header("Location:../../index.php");
    } else{
        $siframd5 = md5($sifra);

        try{
            $login = userLogin($email, $siframd5);

            if($login->rowCount() == 1){
                $user = $login->fetch();
                http_response_code(200);
                echo json_encode($user);

                $_SESSION['id_user'] = $user->id_user;
                loggingCount($_SESSION['id_user']);
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $user->id_role;
                header("Location:../../index.php?page=pocetna");
            } else{


                $loginMailer = userLoginMailer($email, $siframd5);

                if($loginMailer){
                    $mail = new PHPMailer(true);


                    $mail->SMTPDebug = 0;

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';

                    $mail->SMTPAuth = true;
                    $mail->Username = 'auditorne.php@gmail.com';
                    $mail->Password = 'Sifra123';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('mediumteam44@gmail.com', 'Atention');
                    $mail->addAddress($email);

                    $mail->isHTML(true);

                    $mail->Subject= "Atention";


                    $mail->Body = "Someone has tried to login in your account, please change password";

                    $mail->send();
                    header("Location:../../index.php?page=pocetna");
                }else{
                    echo json_encode(["Greska" => "Wrong Mail AND Password"]);
                    http_response_code(409);
                    header("Location:../../index.php?page=pocetna");
                }

            }
        } catch (PDOException $ex){
            http_response_code(500);
            echo json_encode(['Greska' => "Greska". $ex->getMessage()]);
            catchErrors("login.php ->".$ex->getMessage());
        }
    }
} else{
    http_response_code(403);
    echo json_encode("Sta da radim sad!");
}