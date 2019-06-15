<?php
session_start();
require "../adminPanel/functions.php";
require "../../config/connection.php";
if(isset($_SESSION['user'])){
    deleteLoggingCount($_SESSION['id_user']);
    unset($_SESSION['user']);
    header("Location: ../../index.php");
}