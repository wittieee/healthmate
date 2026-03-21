<?php
session_start();
include "connect.php";

$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$phone = $_POST['phone'];
$specialty = $_POST['specialty'];
$experience = $_POST['experience'];

$image = $_FILES['image']['name'];

if($image){
    move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);
    $img_sql = ", image='$image'";
}else{
    $img_sql = "";
}

$sql = "UPDATE users SET
name='$name',
phone='$phone',
specialty='$specialty',
experience='$experience'
$img_sql
WHERE id='$user_id'";

mysqli_query($conn, $sql);

$_SESSION['name'] = $name;

header("Location: doctor_profile.php");
?>