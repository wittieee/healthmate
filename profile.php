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

$age = "";
if(!empty($user['dob'])){
    $age = date_diff(date_create($user['dob']), date_create('today'))->y;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="dashboard">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>HealthMate</h2>

        <?php if($_SESSION['role']=="patient"){ ?>
            <a href="patient_home.php">Home</a>
            <a href="find_doctor.php">Find Doctor</a>
            <a href="my_appointments.php">My Appointment</a>
            <a href="medical_records.php">Medical Record</a>
        <?php } else { ?>
            <a href="doctor_home.php">Home</a>
        <?php } ?>
    </div>

    <!-- Content -->
    <div class="content">

    <!-- Topbar -->
    <div class="topbar">
        <h3>Profile</h3>

        <div class="topbar-right">
            <span>Welcome, <?php echo $_SESSION['name']; ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="profile-card">

        <div class="profile-img">
            <img src="images/<?php echo $user['image'] ?? 'default.png'; ?>">
        </div>

        <h2><?php echo $user['name']; ?></h2>

        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

        <?php if($_SESSION['role']=="patient"){ ?>

            <hr>

            <div class="profile-info">

            <p><strong>Patient ID:</strong> <?php echo $user['patient_id'] ?? '-'; ?></p>
            <p><strong>Gender:</strong> <?php echo $user['gender'] ?? '-'; ?></p>

            <p><strong>Date of Birth:</strong> <?php echo $user['dob'] ?? '-'; ?></p>
            <p><strong>Age:</strong> <?php echo $age; ?></p>

            <p><strong>Weight:</strong> <?php echo $user['weight'] ?? '-'; ?> kg</p>
            <p><strong>Height:</strong> <?php echo $user['height'] ?? '-'; ?> cm</p>

            <p><strong>Blood Group:</strong> <?php echo $user['blood_group'] ?? '-'; ?></p>
            <p><strong>Phone:</strong> <?php echo $user['phone'] ?? '-'; ?></p>

            <p><strong>Hospital:</strong> <?php echo $user['hospital'] ?? '-'; ?></p>
            <p><strong>Address:</strong> <?php echo $user['address'] ?? '-'; ?></p>

            <p><strong>Allergy:</strong> <?php echo $user['allergy'] ?? '-'; ?></p>
            <p><strong>Disease:</strong> <?php echo $user['disease'] ?? '-'; ?></p>

            </div>

        <?php } ?>

        <?php if($_SESSION['role']=="doctor"){ ?>

            <hr>

            <p><strong>Specialty:</strong> <?php echo $user['specialty']; ?></p>
            <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>

        <?php } ?>

 <a href="edit_profile.php" class="btn green" style="margin-top:15px; display:inline-block;">Edit Profile</a>
    </div>

    </div>
       

    </div>

</body>
</html>