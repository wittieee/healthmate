<?php
session_start();
include "connect.php";

$sql = "SELECT * FROM users WHERE role='patient'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="dashboard">

    <div class="sidebar">
        <h2>HealthMate</h2>
        <a href="doctor_home.php">Home</a>
        <a href="doctor_appointments.php">Appointments</a>
    </div>

    <div class="content">

    <div class="topbar">
        <h3>Doctor Dashboard</h3>

        <div class="topbar-right">
            <span>Dr. <?php echo $_SESSION['name']; ?></span>
            <a href="doctor_profile.php" class="profile-btn">Profile</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <h2>Patients</h2>

    <div class="doctor-list">

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="doctor-card">
        <h3><?php echo $row['name']; ?></h3>
        <a href="add_record.php?user_id=<?php echo $row['id']; ?>" class="btn green">Add Record</a>
    </div>

    <?php } ?>

    </div>

    </div>

    </div>

</body>

</html>