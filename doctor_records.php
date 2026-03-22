<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

$sql = "SELECT medical_records.*, users.name FROM medical_records
        JOIN users ON medical_records.user_id = users.id
        WHERE medical_records.doctor_id='$doctor_id'
        ORDER BY medical_records.date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
<title>Medical Records</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body class="doctor-records">

<div class="dashboard">

    <div class="sidebar">
        <h2>HealthMate</h2>
        <a href="doctor_home.php">Home</a>
        <a href="doctor_appointments.php">Appointments</a>
        <a href="doctor_records.php">Medical Records</a>
        <!-- <a href="doctor_profile.php">Profile</a> -->
    </div>

    <div class="content">

        <div class="topbar">
            <h3>Medical Records</h3>

            <div class="topbar-right">
                <span>Dr. <?php echo $_SESSION['name']; ?></span>
                <a href="doctor_profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <div class="record-list">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="record-card">

                <h3><?php echo $row['name']; ?></h3>

                <p><strong>Date:</strong> <?php echo $row['date']; ?></p>

                <p><strong>Diagnosis:</strong>
                <?php echo $row['description']; ?></p>

                <p><strong>Prescription:</strong>
                <?php echo $row['prescription']; ?></p>

            </div>

        <?php } ?>

        </div>

    </div>

</div>

</body>
</html>