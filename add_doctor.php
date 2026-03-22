<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $specialty = $_POST['specialty'];
    $experience = $_POST['experience'];
    $phone = $_POST['phone'];

    $image = $_FILES['image']['name'];

    if($image){
        move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);
    }else{
        $image = "default.png";
    }

    $sql1 = "INSERT INTO doctors (name, specialty, experience, image)
             VALUES ('$name', '$specialty', '$experience', '$image')";
    mysqli_query($conn, $sql1);

    $doctor_id = mysqli_insert_id($conn);

    $sql2 = "INSERT INTO users (name, email, password, role, phone, image, doctor_id)
             VALUES ('$name', '$email', '$password', 'doctor', '$phone', '$image', '$doctor_id')";
    mysqli_query($conn, $sql2);

    header("Location: manage_doctors.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Add Doctor</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body class="admin-home">

<div class="dashboard">

    <div class="sidebar">
        <h2>HealthMate</h2>

        <a href="admin_home.php">Dashboard</a>
        <a href="manage_users.php">Users</a>
        <a href="manage_doctors.php" class="active">Doctors</a>
        <a href="admin_appointments.php">Appointments</a>
    </div>

    <div class="content">

        <div class="topbar">
            <h3>Add Doctor</h3>

            <div class="topbar-right">
                <span><?php echo $_SESSION['name']; ?></span>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>


        <div class="profile-card">

            <form method="POST" enctype="multipart/form-data">

                <input type="text" name="name" placeholder="Doctor Name" required>

                <input type="email" name="email" placeholder="Email" required>

                <input type="text" name="password" placeholder="Password" required>

                <input type="text" name="phone" placeholder="Phone">

                <input type="text" name="specialty" placeholder="Specialty" required>

                <input type="number" name="experience" placeholder="Experience (years)" required>

                <input type="file" name="image">

                <button type="submit" name="submit" class="btn green">Add Doctor</button>

            </form>

        </div>

    </div>

</div>

</body>
</html>