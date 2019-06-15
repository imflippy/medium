<?php

function getCategories(){
    return executeQuery("SELECT * FROM categories");

}

function insertNewPost($naslov, $opis, $putanja, $novaPutanja, $putanjaMala, $datumKreiranja, $idCategory, $idUser){
    global $conn;
    $upit = "INSERT INTO posts (id_post, title, post_description, real_photo_path, photo_path, photo_mala_path, post_created_at, id_category, id_user) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$naslov, $opis, $putanja, $novaPutanja, $putanjaMala, $datumKreiranja, $idCategory, $idUser]);

    return $priprema;
}

function getAllPosts($br){
    return executeQuery("SELECT * FROM user_photo up JOIN users u ON up.id_user = u.id_user JOIN posts p ON u.id_user = p.id_user JOIN categories c ON p.id_category = c.id_category ORDER BY p.post_created_at DESC LIMIT $br");
}

function getAllPostsCategory($category, $br){
    return executeQuery("SELECT * FROM user_photo up JOIN users u ON up.id_user = u.id_user JOIN posts p ON u.id_user = p.id_user JOIN categories c ON p.id_category = c.id_category WHERE c.id_category = $category ORDER BY p.post_created_at DESC LIMIT $br");
}
//function getAllPostsUser($idUser){
//    global $conn;
//    $upit = "SELECT * FROM posts p JOIN users u ON p.id_user = u.id_user JOIN user_photo up ON u.id_user = up.id_user WHERE p.id_user = ? ORDER BY p.post_created_at DESC";
//    $priprema = $conn->prepare($upit);
//    $priprema->execute([$idUser]);
//    $rezultat = $priprema->fetchAll();
//
//    return $rezultat;
//}


function getAllPostsUser($idUser, $br2){
    return executeQuery("SELECT * FROM user_photo up JOIN users u ON up.id_user = u.id_user JOIN posts p ON u.id_user = p.id_user JOIN categories c ON p.id_category = c.id_category WHERE p.id_user = $idUser ORDER BY p.post_created_at DESC LIMIT $br2");
}

function searchPosts($title){
    global $conn;
    $upit = "SELECT * FROM posts p JOIN users u ON p.id_user = u.id_user JOIN user_photo up ON u.id_user = up.id_user WHERE LOWER(p.title) LIKE ? OR LOWER(p.post_description) LIKE ? OR LOWER(u.first_name) LIKE ? ORDER BY p.post_created_at DESC";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$title, $title, $title]);
    $rezultat = $priprema->fetchAll();

    return $rezultat;
}

function getAllPostsProfile($idUser){
    global $conn;
    $upit = "SELECT * FROM posts p JOIN categories c ON p.id_category = c.id_category WHERE p.id_user = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idUser]);
    $rezultat = $priprema->fetchAll();

    return $rezultat;

}

function getOnePost($idPost){
    global $conn;
    $upit = "SELECT * FROM posts WHERE id_post = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idPost]);
    $rezultat = $priprema->fetch();

    return $rezultat;
}

function updatePost($title, $desc, $realPhotoPath, $photoPath, $malaPath, $updated, $idCat, $idUser){
    global $conn;
    $upit = "UPDATE posts SET title = ?, post_description = ?, real_photo_path = ?, photo_path = ?, photo_mala_path = ?, updated_at = ?, id_category = ? WHERE id_post = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$title, $desc, $realPhotoPath, $photoPath, $malaPath, $updated, $idCat, $idUser]);

    return $priprema;
}

function deletePost($idPost){
    global $conn;
    $upit = "DELETE FROM posts WHERE id_post = ?";
    $priprema = $conn->prepare($upit);
    $priprema->execute([$idPost]);

    return $priprema;
}

