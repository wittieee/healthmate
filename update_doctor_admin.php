<?php
session_start();
include "connect.php";

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$doctor_id = $_POST['doctor_id'];
$user_id = $_POST['user_id'];

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


$sql1 = "UPDATE doctors SET name='$name',specialty='$specialty',experience='$experience'
$img_sql WHERE id='$doctor_id'";

mysqli_query($conn, $sql1);

$sql2 = "UPDATE users SET name='$name',phone='$phone'
$img_sql WHERE id='$user_id'";

mysqli_query($conn, $sql2);

header("Location: manage_doctors.php");
exit();
?>