<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$doctor_id = $_SESSION['doctor_id'];

/* ========================= */
/* รับค่าพื้นฐาน */
/* ========================= */
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';

/* ========================= */
/* รับค่าหมอ */
/* ========================= */
$specialty = $_POST['specialty'] ?? '';
$experience = $_POST['experience'] ?? '';

/* ========================= */
/* 📸 Upload Image */
/* ========================= */
$image = $_FILES['image']['name'] ?? '';

if(!empty($image)){
    // ใช้ชื่อเดิม (ง่าย)
    move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);

    $img_sql_user = ", image='$image'";
    $img_sql_doc = ", image='$image'";
}else{
    $img_sql_user = "";
    $img_sql_doc = "";
}

/* ========================= */
/* 🔵 UPDATE USERS */
/* ========================= */
$sql1 = "UPDATE users SET
name='$name',
phone='$phone'
$img_sql_user
WHERE id='$user_id'";

mysqli_query($conn, $sql1);

/* ========================= */
/* 🔴 UPDATE DOCTORS */
/* ========================= */
$update_doc = "";

/* อัปเดตเฉพาะที่มีค่า */
if(!empty($specialty)){
    $update_doc .= ", specialty='$specialty'";
}

if(!empty($experience)){
    $update_doc .= ", experience='$experience'";
}

/* รวม image */
$update_doc .= $img_sql_doc;

/* ถ้ามีอะไรให้ update ค่อยยิง SQL */
if(!empty($update_doc)){

    $sql2 = "UPDATE doctors SET
    id=id
    $update_doc
    WHERE id='$doctor_id'";

    mysqli_query($conn, $sql2);
}

/* ========================= */
/* 🔁 UPDATE SESSION */
/* ========================= */
$_SESSION['name'] = $name;

/* ========================= */
/* 🔁 REDIRECT */
/* ========================= */
header("Location: doctor_profile.php");
exit();
?>