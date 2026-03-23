<?php
session_start();
include "connect.php";

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM doctors WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$doctor = mysqli_fetch_assoc($result);


$sql2 = "SELECT * FROM users WHERE doctor_id='$id'";
$result2 = mysqli_query($conn, $sql2);
$user = mysqli_fetch_assoc($result2);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Doctor</title>
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
        <h3>Edit Doctor</h3>

        <div class="topbar-right">
            <span><?php echo $_SESSION['name']; ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="profile-card">

    <form action="update_doctor_admin.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="doctor_id" value="<?php echo $id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

        <input type="text" name="name" value="<?php echo $doctor['name']; ?>" required>

        <input type="text" name="phone" value="<?php echo $user['phone']; ?>">

        <input type="text" name="specialty" value="<?php echo $doctor['specialty']; ?>" required>

        <input type="number" name="experience" value="<?php echo $doctor['experience']; ?>" required>

        <input type="file" name="image">

        <button class="btn blue">Update</button>

    </form>

    </div>

    </div>

    </div>

</body>
</html>