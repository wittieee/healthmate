<?php
include "connect.php";

$user_id = $_POST['user_id'];
$doctor_id = $_POST['doctor_id'];
$description = $_POST['description'];
$prescription = $_POST['prescription'];
$date = $_POST['date'];

$sql = "INSERT INTO medical_records
(user_id, doctor_id, description, prescription, date)
VALUES ('$user_id','$doctor_id','$description','$prescription','$date')";

mysqli_query($conn, $sql);

header("Location: doctor_home.php");
?>