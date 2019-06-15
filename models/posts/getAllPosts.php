<?php
@session_start();
header("Content-type: application/json");
require "../../config/connection.php";
require "functions.php";
try {
    $br = $_POST['br'];
    if (isset($_SESSION['id_category'])) {
        $category = $_SESSION['id_category'];
        $posts = getAllPostsCategory($category, $br);
    } else {
        $posts = getAllPosts($br);
    }
    http_response_code(200);
    echo json_encode($posts);

}catch (PDOException $ex){
    http_response_code(500);
    catchErrors("getAllPosts.php ->".$ex->getMessage());
}

