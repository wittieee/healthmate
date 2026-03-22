<?php
session_start();
include "connect.php";

$user_id = $_GET['user_id'] ?? null;
$doctor_id = $_SESSION['doctor_id'];

if(!$user_id){
    echo "No patient selected";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Add Medical Record</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="dashboard">

    <div class="sidebar">
        <h2>HealthMate</h2>
        <a href="doctor_home.php">Home</a>
        <a href="doctor_appointments.php">Appointments</a>
        <a href="add_record.php">Add Record</a>
        <a href="doctor_profile.php">Profile</a>
    </div>

    <div class="content">

        <div class="topbar">
            <h3>Add Medical Record</h3>

            <div class="topbar-right">
                <span>Dr. <?php echo $_SESSION['name']; ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>


        <div class="profile-card">

            <form action="save_record.php" method="POST">

                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">

                <textarea name="description" placeholder="Diagnosis" required></textarea>

                <textarea name="prescription" placeholder="Prescription" required></textarea>

                <input type="date" name="date" required>

                <button class="btn blue">Save</button>

            </form>

        </div>

    </div>

</div>

</body>
</html>