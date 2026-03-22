<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$sql = "SELECT appointments.*, users.name AS patient_name, doctors.name AS doctor_name
        FROM appointments LEFT JOIN users ON appointments.user_id = users.id
        LEFT JOIN doctors ON appointments.doctor_id = doctors.id
        ORDER BY appointments.date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Appointments</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="admin-home">

    <div class="dashboard">

        <div class="sidebar">
            <h2>HealthMate</h2>

            <a href="admin_home.php">Dashboard</a>
            <a href="manage_users.php">Users</a>
            <a href="manage_doctors.php">Doctors</a>
            <a href="admin_appointments.php">Appointments</a>
        </div>

        <div class="content">

            <div class="topbar">
                <h3>All Appointments</h3>

                <div class="topbar-right">
                    <span><?php echo $_SESSION['name']; ?></span>
                    <a href="logout.php" class="logout-btn">Logout</a>
                </div>
            </div>

            <div class="appointment-list">

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <div class="appointment-card">

                    <h3><?php echo $row['patient_name'] ?? 'Unknown'; ?></h3>

                    <p><strong>Doctor:</strong> <?php echo $row['doctor_name'] ?? '-'; ?></p>

                    <p><strong>Date:</strong> <?php echo $row['date']; ?></p>

                    <p><strong>Time:</strong> <?php echo $row['time']; ?></p>

                    <p><strong>Status:</strong> 
                        <span class="status <?php echo $row['status']; ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </p>

                </div>

            <?php } ?>

            </div>

        </div>

    </div>

</body>
</html>