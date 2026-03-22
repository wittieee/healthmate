<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM users WHERE role!='admin'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
<title>Manage Users</title>
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
            <h3>Manage Users</h3>

            <div class="topbar-right">
                <span><?php echo $_SESSION['name']; ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

        <div class="user-list">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="user-card">

                <h3><?php echo $row['name']; ?></h3>

                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>Role:</strong> <?php echo $row['role']; ?></p>

                <div class="btn-group">

                    <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                       class="btn red"
                       onclick="return confirm('Delete this user?')">
                       Delete
                    </a>

                </div>

            </div>

        <?php } ?>

        </div>

    </div>

</div>

</body>
</html>