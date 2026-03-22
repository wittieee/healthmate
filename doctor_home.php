<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];
?>

<!DOCTYPE html>
<html>

<head>
<title>Doctor Dashboard</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body class="doctor-home">

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
            <h3>Dashboard</h3>

            <div class="topbar-right">
                <span>Dr. <?php echo $_SESSION['name']; ?></span>
                <a href="doctor_profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <h2>Welcome, Dr. <?php echo $_SESSION['name']; ?></h2>
        <p>Here is your schedule today</p>


        <h3>Pending Appointments</h3>

        <div class="appointment-list">

        <?php
        $sql = "SELECT appointments.*, users.name FROM appointments
                JOIN users ON appointments.user_id = users.id
                WHERE appointments.doctor_id='$doctor_id'
                AND status='pending'";

        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
        ?>

        <div class="appointment-card">
            <h4><?php echo $row['name']; ?></h4>
            <p><?php echo $row['date']; ?> - <?php echo $row['time']; ?></p>

            <div class="btn-group">
                <a href="update_status.php?id=<?php echo $row['id']; ?>&status=confirmed" class="btn green">Confirm</a>

                <a href="update_status.php?id=<?php echo $row['id']; ?>&status=cancelled" class="btn red">Reject</a>
            </div>
        </div>

        <?php } ?>

        </div>

        <h3>Today's Appointments</h3>

        <div class="appointment-list">

        <?php
        $today = date('Y-m-d');

        $sql = "SELECT appointments.*, users.name FROM appointments
                JOIN users ON appointments.user_id = users.id
                WHERE appointments.doctor_id='$doctor_id'
                AND date='$today'";

        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
        ?>

        <div class="appointment-card">
            <h4><?php echo $row['name']; ?></h4>
            <p><?php echo $row['time']; ?></p>
            <p>Status: <?php echo $row['status']; ?></p>
        </div>

        <?php } ?>

        </div>

        <div class="menu-grid">

            <a href="doctor_appointments.php" class="menu-card">
                <img src="images/schedule.png">
                <p>View Appointments</p>
            </a>


        </div>

    </div>

</div>

</body>
</html> 