<?php
include "connect.php";

$doctor_id = $_GET['doctor_id'];

$sql = "SELECT * FROM doctors WHERE id='$doctor_id'";
$result = mysqli_query($conn, $sql);
$doctor = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
<title>Appointment</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="dashboard">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>HealthMate</h2>
        <a href="patient_home.php">Home</a>
        <a href="find_doctor.php">Find Doctor</a>
        <a href="my_appointments.php">Appointment</a>
        <a href="medical_records.php">Medical Record</a>
    </div>

    <!-- Content -->
    <div class="content">

        <div class="topbar">
            <h3>Book Appointment</h3>
        </div>

        <!-- Doctor Info -->
        <div class="doctor-card">
            <h3><?php echo $doctor['name']; ?></h3>
            <p><?php echo $doctor['specialty']; ?></p>
        </div>

        <!-- Form -->
        <form action="save_appointment.php" method="POST">

            <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">

            <input type="text" name="patient_name" placeholder="Your Name" required>

            <input type="date" name="date" required>

            <input type="time" name="time" required>

            <button class="btn blue">Confirm Booking</button>

        </form>

    </div>

</div>

</body>
</html>