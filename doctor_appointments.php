<?php
session_start();
include "connect.php";

$doctor_id = $_SESSION['doctor_id'];

$sql = "SELECT appointments.*, users.name 
        FROM appointments
        JOIN users ON appointments.user_id = users.id
        WHERE appointments.doctor_id = '$doctor_id'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Doctor Appointments</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body class="doctor-appointments">

<div class="dashboard">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>HealthMate</h2>
        <a href="doctor_home.php">Home</a>
        <a href="doctor_appointments.php">Appointments</a>
        <a href="doctor_records.php">Medical Records</a> 
        <a href="doctor_profile.php">Profile</a>
    </div>

    <div class="content">

        <div class="topbar">
            <h3>Appointments</h3>

            <div class="topbar-right">
                <span>Dr. <?php echo $_SESSION['name']; ?></span>
                <a href="doctor_profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <div class="appointment-list">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="appointment-card">

                <h3><?php echo $row['name']; ?></h3>

                <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
                <p><strong>Time:</strong> <?php echo $row['time']; ?></p>
                <p><strong>Status:</strong> <?php echo $row['status']; ?></p>

                <?php if($row['status']=="pending"){ ?>
                    <div class="btn-group">
                        <a href="update_status.php?id=<?php echo $row['id']; ?>&status=confirmed" class="btn green">Confirm</a>

                        <a href="update_status.php?id=<?php echo $row['id']; ?>&status=cancelled" class="btn red">Reject</a>
                    </div>
                <?php } ?>
                
                <a href="add_record.php?user_id=<?php echo $row['user_id']; ?>" class="btn blue">Add Record</a>

            </div>

        <?php } ?>

        </div>

    </div>

</div>

</body>
</html>