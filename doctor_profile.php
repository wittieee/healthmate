<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT users.*, doctors.specialty, doctors.experience, doctors.image AS doctor_image
        FROM users
        JOIN doctors ON users.doctor_id = doctors.id
        WHERE users.id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
<title>Doctor Profile</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="dashboard">

<!-- Sidebar -->
<div class="sidebar">
    <h2>HealthMate</h2>
    <a href="doctor_home.php">Home</a>
</div>

<!-- Content -->
<div class="content">

<div class="topbar">
    <h3>Doctor Profile</h3>

    <div class="topbar-right">
        <span>Dr. <?php echo $_SESSION['name']; ?></span>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="profile-card">

    <div class="profile-img">
        <img src="images/<?php echo $user['doctor_image'] ?? 'default.png'; ?>">
    </div>

    <h2>Dr. <?php echo $user['name']; ?></h2>

    <div class="profile-info">

        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $user['phone'] ?? '-'; ?></p>

        <p><strong>Specialty:</strong> <?php echo $user['specialty'] ?? '-'; ?></p>
        <p><strong>Experience:</strong> <?php echo $user['experience'] ?? '-'; ?> years</p>

    </div>

    <a href="edit_doctor_profile.php" class="btn green">Edit Profile</a>

</div>

</div>

</div>

</body>
</html>