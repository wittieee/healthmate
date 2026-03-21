<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$name = $_POST['name'];
$phone = $_POST['phone'];


$image = $_FILES['image']['name'];

if($image){
    $image = time() . "_" . $image;

    move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);

    $img_sql = ", image='$image'";
}else{
    $img_sql = "";
}


$sql = "UPDATE users SET 
name='$name',
phone='$phone'
$img_sql
WHERE id='$user_id'";

mysqli_query($conn, $sql);

if($_SESSION['role'] == 'patient'){

    $gender = $_POST['gender'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $height = $_POST['height'] ?? '';
    $blood_group = $_POST['blood_group'] ?? '';
    $allergy = $_POST['allergy'] ?? '';
    $disease = $_POST['disease'] ?? '';
    $hospital = $_POST['hospital'] ?? '';
    $address = $_POST['address'] ?? '';

    $sql2 = "UPDATE users SET
    gender='$gender',
    dob='$dob',
    weight='$weight',
    height='$height',
    blood_group='$blood_group',
    allergy='$allergy',
    disease='$disease',
    hospital='$hospital',
    address='$address'
    WHERE id='$user_id'";

    mysqli_query($conn, $sql2);
}


if($_SESSION['role'] == 'doctor'){

    $doctor_id = $_SESSION['doctor_id'];

    $specialty = $_POST['specialty'] ?? '';
    $experience = $_POST['experience'] ?? '';

    $sql3 = "UPDATE doctors SET
    specialty='$specialty',
    experience='$experience'
    WHERE id='$doctor_id'";

    mysqli_query($conn, $sql3);
}


$_SESSION['name'] = $name;


header("Location: profile.php");
exit();
?>