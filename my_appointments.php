<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<?php
include "connect.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT appointments.*, doctors.name AS doctor_name, doctors.specialty 
        FROM appointments
        JOIN doctors ON appointments.doctor_id = doctors.id
        WHERE appointments.user_id = '$user_id'
        ORDER BY date DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
<title>My Appointments</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="dashboard">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>HealthMate</h2>

        <a href="patient_home.php">Home</a>
        <a href="find_doctor.php">Find Doctor</a>
        <a href="my_appointments.php">My Appointment</a>
        <a href="#">Medical Record</a>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Topbar -->
        <div class="topbar">
            <h3>My Appointments</h3>

            <div class="topbar-right">
                <span>Welcome, <?php echo $_SESSION['name']; ?></span>
                <a href="profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure to logout?')">Logout</a>
            </div>
        </div>

        <!-- Appointment List -->
        <div class="appointment-list">

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="appointment-card">
                <h3><?php echo $row['doctor_name']; ?></h3>
                <p><?php echo $row['specialty']; ?></p>

                <p>Date: <?php echo $row['date']; ?></p>
                <p>Time: <?php echo $row['time']; ?></p>

                <p class="
                    <?php 
                    if($row['status']=='cancelled'){
                        echo 'status-cancelled';
                    }else{
                        echo 'status-pending';
                    }
                    ?>
                    ">
                    Status: <?php echo $row['status']; ?>
                </p>

                <!-- Cancel -->
                <?php if($row['status'] != 'cancelled'){ ?>
                    <a href="cancel_appointment.php?id=<?php echo $row['id']; ?>" class="btn red" onclick="return confirm('Are you sure to cancel?')"> Cancel </a>
                <?php } ?>
            </div>
            <?php } ?>

        </div>

        <?php
        if(mysqli_num_rows($result) == 0){
            echo "<p>No appointments yet</p>";
        }
        ?>

    </div>

</div>

</body>
</html>