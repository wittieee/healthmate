<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT appointments.*, doctors.name AS doctor_name 
        FROM appointments
        JOIN doctors ON appointments.doctor_id = doctors.id
        WHERE appointments.user_id='$user_id'
        ORDER BY date ASC, time ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Your Schedule</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="dashboard">

        <div class="sidebar">
            <h2>HealthMate</h2>
            <a href="patient_home.php">Home</a>
            <a href="find_doctor.php">Find Doctor</a>
            <a href="my_appointments.php">Appointment</a>
            <a href="patient_schedule.php">Your Schedule</a>
            <a href="medical_records.php">Medical Record</a>
        </div>

        <div class="content">

            <div class="topbar">
                <h3>Your Schedule</h3>

                <div class="topbar-right">
                    <span>Welcome, <?php echo $_SESSION['name']; ?></span>
                    <a href="profile.php" class="profile-btn">Profile</a>
                    <a href="logout.php" class="logout-btn">Logout</a>
                </div>
            </div>

            <?php
            $current_date = "";

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){

                    // วันไม่เหมือนเดิม //
                    if($current_date != $row['date']){
                        $current_date = $row['date'];

                        echo "<h3 style='margin-top:20px;'>" . date("d F Y", strtotime($current_date)) . "</h3>";
                    }
                    $status = $row['status'];

                    echo "
                    <div class='appointment-card'>
                        <strong>{$row['time']}</strong> - {$row['doctor_name']}
                        <br>
                        <span class='status $status'>$status</span>
                    </div>
                    ";
                }
            }else{
                echo "<p>No appointments yet</p>";
            }
            ?>

        </div>

    </div>

</body>
</html>