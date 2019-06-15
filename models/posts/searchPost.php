<?php
if(isset($_POST['post'])){
    header("Content-type: application/json");
    require "../../config/connection.php";
    require "functions.php";

    $post ="%".strtolower($_POST['post'])."%";
try{
    $posts = searchPosts($post);
    http_response_code(200);
    echo json_encode($posts);
}catch (PDOException $ex){
    http_response_code(500);
    catchErrors("searchPost.php ->".$ex->getMessage());
}

} else{
    http_response_code(400);
}