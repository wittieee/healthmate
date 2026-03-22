<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$doctor_id = $_SESSION['doctor_id'];

$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';


$specialty = $_POST['specialty'] ?? '';
$experience = $_POST['experience'] ?? '';


$image = $_FILES['image']['name'] ?? '';

if(!empty($image)){

    move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);

    $img_sql_user = ", image='$image'";
    $img_sql_doc = ", image='$image'";
}else{
    $img_sql_user = "";
    $img_sql_doc = "";
}

/*  UPDATE USERS */
$sql1 = "UPDATE users SET
name='$name',
phone='$phone'
$img_sql_user
WHERE id='$user_id'";

mysqli_query($conn, $sql1);


/* UPDATE DOCTORS */
$update_doc = "";

if(!empty($specialty)){
    $update_doc .= ", specialty='$specialty'";
}

if(!empty($experience)){
    $update_doc .= ", experience='$experience'";
}

$update_doc .= $img_sql_doc;

if(!empty($update_doc)){

    $sql2 = "UPDATE doctors SET
    id=id
    $update_doc
    WHERE id='$doctor_id'";

    mysqli_query($conn, $sql2);
}


$_SESSION['name'] = $name;

header("Location: doctor_profile.php");
exit();
?>