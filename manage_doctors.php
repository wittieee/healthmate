<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM doctors";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
<title>Manage Doctors</title>
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
            <h3>Manage Doctors</h3>

            <div class="topbar-right">
                <span><?php echo $_SESSION['name']; ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <a href="add_doctor.php" class="btn green" style="margin-bottom:15px; display:inline-block;">
            + Add Doctor
        </a>

        <div class="doctor-list">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="doctor-card">

                <img src="images/<?php echo $row['image']; ?>" class="doctor-img">

                <h3><?php echo $row['name']; ?></h3>

                <p><strong>Specialty:</strong> <?php echo $row['specialty']; ?></p>
                <p><strong>Experience:</strong> <?php echo $row['experience']; ?> years</p>

                <div class="btn-group">
                    <a href="edit_doctor.php?id=<?php echo $row['id']; ?>" class="btn blue">Edit</a>
                    <a href="delete_doctor.php?id=<?php echo $row['id']; ?>"class="btn red"onclick="return confirm('Delete this doctor?')">Delete</a>
                </div>

            </div>

        <?php } ?>

        </div>

    </div>

</div>

</body>
</html>