<?php

function userRregister($ime, $prezime, $mail, $password, $created_at){
    global $conn;
    $upitRegister = "INSERT INTO users (id_user, first_name, last_name, email, password, created_at, id_role) values (NULL, ?, ?, ?, ?, ?, 2)";
    $priprema = $conn->prepare($upitRegister);
    $priprema->execute([$ime, $prezime, $mail, $password, $created_at]);

    $lastInsertedIdUser = $conn->lastInsertId();
    userPhotoAddReister($lastInsertedIdUser);

    return $priprema;
}

function userPhotoAddReister($lastUserId){
    global $conn;
    $upit = "INSERT INTO user_photo VALUES (NULL, 'assets/img/users/1559432200profilna.jpg', 'assets/img/users/novaProfilna_1559432200profilna.jpg', 'assets/img/users/novaKomentar_1559432200profilna.jpg', 'assets/img/users/novaNavigacija_1559432200profilna.jpg', 'assets/img/usersBackground/1559432191backgoiund.jpg', 'assets/img/usersBackground/nova_1559432191backgoiund.jpg', ?)";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$lastUserId]);

    return $priprema;
}



function getMailUser($mail){
    global $conn;
    $upitMail = "SELECT * FROM users WHERE email = ?";
    $priprema = $conn->prepare($upitMail);
    $priprema->execute([$mail]);


    return $priprema;
}

function userLogin($email, $sifra){
    global $conn;
    $upit = "SELECT * FROM users WHERE email = ? AND password = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$email, $sifra]);

    return $priprema;
}

function userLoginMailer($email, $sifra){
    global $conn;
    $upit = "SELECT * FROM users WHERE email = ? AND password <> ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$email, $sifra]);
    $priprema->fetch();

    return $priprema;
}

function updateBackgroundPhoto($putanjaOriginalna, $putanjaNovaSlika, $idUser){
    global $conn;
    $upit = "UPDATE user_photo SET real_background_path = ?, background_path = ? WHERE id_user = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$putanjaOriginalna, $putanjaNovaSlika, $idUser]);

    return $priprema;
}

function updateProfilePhoto($putanjaOriginalna, $putanjaProfilna, $putanjaKomentar, $putanjaNavigacija, $idUser){
  global $conn;
  $upit = "UPDATE user_photo SET real_profile_path = ?, profile_path = ?, 	comment_path = ?, 	nav_path = ? WHERE id_user = ?";
  $priprema = $conn->prepare($upit);
  $priprema->execute([$putanjaOriginalna, $putanjaProfilna, $putanjaKomentar, $putanjaNavigacija, $idUser]);

  return $priprema;
}

function getUser ($idUser){
    global $conn;
    $upit = "SELECT * FROM users WHERE id_user = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idUser]);

    return $priprema->fetch();

}

function getAllUsers(){
    return executeQuery("SELECT * FROM users u JOIN roles r ON u.id_role = r.id_role");
}

function getUserPhoto($idUser){
    global $conn;
    $upit = "SELECT * FROM user_photo WHERE id_user = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idUser]);

    return $priprema->fetch();
}

function updateUserProfile($ime, $prezime, $email, $description, $idUser){
    global $conn;
    $upit = "UPDATE users SET first_name = ?, last_name = ?, email = ?, description = ? WHERE id_user = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$ime, $prezime, $email, $description, $idUser]);

    return $priprema;
}

function updateUserPassword($password, $idUser){
    global $conn;
    $upit = "UPDATE users SET password = ? WHERE id_user = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$password, $idUser]);

    return $priprema;
}

function searchUser($user){
    global $conn;
    $upit = "SELECT * FROM users u JOIN user_photo up ON u.id_user = up.id_user WHERE LOWER(u.last_name) LIKE ? OR LOWER(u.first_name) LIKE ? ORDER BY u.created_at ASC LIMIT 7 ";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$user, $user]);
    $rezultat = $priprema->fetchAll();

    return $rezultat;
}

function deleteUser($idUser){
    global $conn;
    $upit = "DELETE FROM users WHERE id_user = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idUser]);

    return $priprema;
}

function getRoles(){
    return executeQuery("SELECT * FROM roles");
}

function updateRole($role, $idUser){
    global $conn;
    $upit = "UPDATE users SET id_role = ? WHERE id_user = ?";
    $piprema = $conn->prepare($upit);
    $piprema->execute([$role, $idUser]);

    return $piprema;
}

function userRole($idUser){
    global $conn;
    $upit = "SELECT r.role_name FROM roles r JOIN users u ON r.id_role = u.id_role WHERE id_user = ?";
    $piprema = $conn->prepare($upit);
    $piprema->execute([$idUser]);

    return $piprema->fetch();
}