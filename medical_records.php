<?php
session_start();
include "connect.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT medical_records.*, doctors.name AS doctor_name
        FROM medical_records
        JOIN doctors ON medical_records.doctor_id = doctors.id
        WHERE medical_records.user_id = '$user_id'
        ORDER BY date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Medical Records</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="dashboard">

    <div class="sidebar">
        <h2>HealthMate</h2>
        <a href="patient_home.php">Home</a>
        <a href="find_doctor.php">Find Doctor</a>
        <a href="my_appointments.php">Appointment</a>
        <a href="patient_schedule.php">Your Schedule</a>
        <a href="medical_records.php">Medical Record</a>
    </div>

    <div class="content">

        <div class="topbar">
            <h3>Medical Record</h3>
            <div class="topbar-right">
                <span>Welcome, <?php echo $_SESSION['name']; ?></span>
                <a href="profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

    <div class="record-list">

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="record-card">
        <h3><?php echo $row['doctor_name']; ?></h3>
        <p>Date: <?php echo $row['date']; ?></p>

        <p><strong>Diagnosis:</strong> <?php echo $row['description']; ?></p>

        <p><strong>Prescription:</strong> <?php echo $row['prescription']; ?></p>
    </div>

    <?php } ?>

    </div>

    </div>

    </div>

</body>
</html>