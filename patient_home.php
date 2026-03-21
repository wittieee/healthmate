<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Patient Dashboard</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="dashboard">

    <div class="sidebar">
        <h2>HealthMate</h2>
        <a href="patient_home.php">Home</a>
        <a href="find_doctor.php">Find Doctor</a>
        <a href="my_appointments.php">Appointment</a>
        <a href="#">Medical Record</a>
    </div>

    <div class="content">
        <div class="topbar">

            <h3>Dashboard</h3>

            <div class="topbar-right">
                <span>Welcome, <?php echo $_SESSION['name']; ?></span>
                <a href="profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure to logout?')">Logout</a>
            </div>

        </div>
        <h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
        <p>This is your dashboard</p>

    </div>

</div>

</body>
</html>