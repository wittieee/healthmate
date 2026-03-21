<?php
session_start();  

include "connect.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

$result = mysqli_query($conn,$sql);

$user = mysqli_fetch_assoc($result);

if($user){

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['role'] = $user['role'];

    if($user['role']=="patient"){
        header("Location: patient_home.php");
    }
    else if($user['role']=="doctor"){
        header("Location: doctor_home.php");
    }
    else{
        header("Location: admin_home.php");
    }
}
else{
    echo "Login failed";
}
?>