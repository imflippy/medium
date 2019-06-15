<?php
function getAllComments($idPost){
    global $conn;
    $upit = "SELECT * FROM comments c JOIN users u ON c.id_user = u.id_user JOIN user_photo up ON u.id_user = up.id_user WHERE c.id_post = ? ORDER BY c.comment_created_at DESC";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idPost]);
    $rezultat = $priprema->fetchAll();

    return $rezultat;
}

function insertComment($comment, $vremeComm, $idUser, $idPost){
    global $conn;
    $upit = "INSERT INTO comments (id_comment, text, comment_created_at, id_user, id_post) VALUES(NULL,?, ?, ?, ?)";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$comment, $vremeComm, $idUser, $idPost]);

    return $priprema;
}

function deleteComm($idComm){
    global $conn;
    $upit = "DELETE FROM comments WHERE id_comment = ?";
    $priprema = $conn->prepare($upit);
    $priprema-> execute([$idComm]);

    return $priprema;
}


function getOneComm($idComm){
    global $conn;
    $upit = "SELECT * FROM comments WHERE id_comment = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idComm]);

    return $priprema->fetch();
}

function updateComm($comment, $vremeComm, $idComm, $idPost){
    global $conn;
    $upit = "UPDATE comments SET text = ?, comment_updated_at = ? WHERE id_comment = ? AND id_post = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$comment, $vremeComm, $idComm, $idPost]);

    return $priprema;

}