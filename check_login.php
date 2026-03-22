<?php
session_start();
include "connect.php";

$email = $_POST['email'];
$password = $_POST['password'];

/* ดึง user  */
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);

/* เช็ค password */
if($user && password_verify($password, $user['password'])){

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['doctor_id'] = $user['doctor_id'];

    if($user['role']=="patient"){
        header("Location: patient_home.php");
    }
    else if($user['role']=="doctor"){
        header("Location: doctor_home.php");
    }
    else{
        header("Location: admin_home.php");
    }

}else{
    echo "Login failed";
}
?>