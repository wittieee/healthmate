<?php
include "connect.php";

$id = $_GET['id'];

$sql = "UPDATE appointments SET status='cancelled' WHERE id='$id'";

mysqli_query($conn, $sql);

header("Location: my_appointments.php");
?>