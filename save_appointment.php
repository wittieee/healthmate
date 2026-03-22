<?php
include "connect.php";

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$doctor_id = $_POST['doctor_id'];
$date = $_POST['date'];
$time = $_POST['time'];

/* เช็คเวลาซ้ำ */
$check = mysqli_query($conn, "SELECT * FROM appointments WHERE doctor_id='$doctor_id' 
                             AND date='$date' AND time='$time' AND status!='cancelled'");

if(mysqli_num_rows($check) > 0){
    echo "<script>alert('This time is already booked. Please choose another time.'); window.history.back();</script>";
    exit();
}

/* ✅ insert */
$sql = "INSERT INTO appointments 
        (doctor_id, date, time, status, user_id)
        VALUES ('$doctor_id','$date','$time','pending','$user_id')";

mysqli_query($conn, $sql);

header("Location: patient_home.php");
exit();
?>