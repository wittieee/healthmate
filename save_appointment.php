
<?php
include "connect.php";

session_start();
$user_id = $_SESSION['user_id'];

$doctor_id = $_POST['doctor_id'];
$patient_name = $_POST['patient_name'];
$date = $_POST['date'];
$time = $_POST['time'];

$sql = "INSERT INTO appointments 
(doctor_id, patient_name, date, time, status, user_id)
VALUES ('$doctor_id','$patient_name','$date','$time','pending','$user_id')";

mysqli_query($conn, $sql);

header("Location: patient_home.php");
?>