<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT users.*, doctors.specialty, doctors.experience FROM users
        JOIN doctors ON users.doctor_id = doctors.id
        WHERE users.id='$user_id'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Doctor Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

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
            <h3>Edit Profile</h3>

            <div class="topbar-right">
                <span>Dr. <?php echo $_SESSION['name']; ?></span>
                <a href="doctor_profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>


        <form action="update_doctor_profile.php" method="POST" enctype="multipart/form-data" class="profile-card">

            <div class="profile-img">
                <img src="images/<?php echo $user['image'] ?? 'default.png'; ?>?v=<?php echo time(); ?>">
            </div>

            <input type="file" name="image">

            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

            <input type="text" name="phone" value="<?php echo $user['phone'] ?? ''; ?>" placeholder="Phone">

            <input type="text" name="specialty" value="<?php echo $user['specialty']; ?>" placeholder="Specialty">

            <input type="number" name="experience" value="<?php echo $user['experience']; ?>" placeholder="Experience">

            <button class="btn blue">Update</button>

        </form>

    </div>

</div>

</body>
</html>