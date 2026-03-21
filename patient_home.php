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
        <a href="medical_records.php">Medical Record</a>
    </div>

    <div class="content">

        <!-- Topbar -->
        <div class="topbar">
            <h3>Dashboard</h3>

            <div class="topbar-right">
                <span>Welcome, <?php echo $_SESSION['name']; ?></span>
                <a href="profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure to logout?')">Logout</a>
            </div>
        </div>

        <!-- Welcome -->
        <h2>Welcome, <?php echo $_SESSION['name']; ?></h2>
        <p>How are you feeling today?</p>

        <h3>Quick Menu</h3>

        <div class="menu-grid">

            <a href="find_doctor.php" class="menu-card">
                <img src="images/medical-team.png">
                <p>Find Doctor</p>
            </a>

            <a href="my_appointments.php" class="menu-card">
                <img src="images/schedule.png">
                <p>My Appointment</p>
            </a>

            <a href="medical_records.php" class="menu-card">
                <img src="images/health-report.png">
                <p>Medical Record</p>
            </a>

        </div>

        <h3>Hospital News</h3>

        <div class="news-grid">

            <div class="news-card">
                <img src="images/news1.jpg">
                <h4>Free Health Check</h4>
                <p>Get free health check this month</p>
            </div>

            <div class="news-card">
                <img src="images/news2.jpg">
                <h4>Flu Vaccine Promotion</h4>
                <p>Discount 20% for flu vaccine</p>
            </div>

        </div>

    </div>

</div>

</body>
</html>