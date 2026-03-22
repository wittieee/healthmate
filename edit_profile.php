<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="dashboard">

    <div class="sidebar">
        <h2>HealthMate</h2>

        <?php if($_SESSION['role']=="patient"){ ?>
        <a href="patient_home.php">Home</a>
        <a href="find_doctor.php">Find Doctor</a>
        <a href="my_appointments.php">Appointment</a>
        <a href="patient_schedule.php">Your Schedule</a>
        <a href="medical_records.php">Medical Record</a>
        <?php } else { ?>
            <a href="doctor_home.php">Home</a>
        <?php } ?>
    </div>

    <div class="content">

    <div class="topbar">
        <h3>Edit Profile</h3>
        <div class="topbar-right">
            <span>Welcome, <?php echo $_SESSION['name']; ?></span>
            <a href="profile.php" class="profile-btn">Profile</a>
            <a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure to logout?')">Logout</a>
        </div>
    </div>

    <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="profile-card">

        <h2>Edit Profile</h2>

        <div class="profile-img">
            <img src="images/<?php echo $user['image'] ?? 'default.png'; ?>">
        </div>

        <input type="file" name="image">

        <input type="text" name="name" value="<?php echo $user['name']; ?>" placeholder="Name" required>

        <input type="text" name="phone" value="<?php echo $user['phone'] ?? ''; ?>" placeholder="Phone">

        <?php if($_SESSION['role']=="patient"){ ?>

            <p><strong>Patient ID:</strong> <?php echo $user['patient_id']; ?></p>

            <input type="text" name="gender" value="<?php echo $user['gender'] ?? ''; ?>" placeholder="Gender">

            <input type="date" name="dob" value="<?php echo $user['dob'] ?? ''; ?>">

            <input type="number" name="weight" value="<?php echo $user['weight'] ?? ''; ?>" placeholder="Weight">

            <input type="number" name="height" value="<?php echo $user['height'] ?? ''; ?>" placeholder="Height">

            <input type="text" name="blood_group" value="<?php echo $user['blood_group'] ?? ''; ?>" placeholder="Blood Group">

            <textarea name="allergy" placeholder="Allergy"><?php echo $user['allergy'] ?? ''; ?></textarea>

            <textarea name="disease" placeholder="Disease"><?php echo $user['disease'] ?? ''; ?></textarea>

            <input type="text" name="hospital" value="<?php echo $user['hospital'] ?? ''; ?>" placeholder="Hospital">

            <textarea name="address" placeholder="Address"><?php echo $user['address'] ?? ''; ?></textarea>

        <?php } ?>

        <?php if($_SESSION['role']=="doctor"){ ?>

            <input type="text" name="specialty" value="<?php echo $user['specialty'] ?? ''; ?>" placeholder="Specialty">

        <?php } ?>

        <button class="btn blue">Update</button>

    </form>

    </div>

    </div>

</body>
</html>