<?php
session_start();
include "connect.php";

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM users WHERE id='$id'");

header("Location: manage_users.php");
exit();
?>