<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<?php
include "connect.php";

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}

$sql = "SELECT * FROM doctors 
        WHERE name LIKE '%$search%' 
        OR specialty LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
<title>Find Doctor</title>
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
        <a href="#">Medical Record</a>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Topbar -->
        <div class="topbar">
            <h3>Find Doctor</h3>

            <div class="topbar-right">
                <span>Welcome, <?php echo $_SESSION['name']; ?></span>
                <a href="profile.php" class="profile-btn">Profile</a>
                <a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure to logout?')">Logout</a>
            </div>
        </div>

        <!--  Search -->
        <form method="GET">
            <input type="text" name="search" class="search" placeholder="Search by name or specialty..." value="<?php echo $search; ?>">
            <button class="btn blue">Search</button>
        </form>

        <!-- Doctor List -->
        <div class="doctor-list">

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="doctor-card">
                <img src="images/<?php echo $row['image']; ?>">

                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['specialty']; ?></p>
                <p><?php echo $row['experience']; ?> Years Experience</p>

                <a href="appointment.php?doctor_id=<?php echo $row['id']; ?>" class="btn green"> Book </a>
            </div>

            <?php } ?>

        </div>

        <!-- ถ้าไม่เจอ -->
        <?php
        if(mysqli_num_rows($result) == 0){
            echo "<p>No doctor found</p>";
        }
        ?>

    </div>

</div>

</body>
</html>