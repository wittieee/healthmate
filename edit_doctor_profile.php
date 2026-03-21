<?php
session_start();
include "connect.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT users.*, doctors.specialty, doctors.experience
        FROM users
        JOIN doctors ON users.doctor_id = doctors.id
        WHERE users.id='$user_id'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
<title>Edit Doctor Profile</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="dashboard">

<div class="content">

<div class="topbar">
    <h3>Edit Profile</h3>
</div>

<form action="update_doctor_profile.php" method="POST" enctype="multipart/form-data" class="profile-card">

    <div class="profile-img">
        <img src="images/<?php echo $user['image'] ?? 'default.png'; ?>?v=<?php echo time(); ?>">
    </div>

    <input type="file" name="image">

    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

    <input type="text" name="phone" value="<?php echo $user['phone'] ?? ''; ?>" placeholder="Phone">

    <input type="text" name="specialty" value="<?php echo $user['specialty'] ?? ''; ?>" placeholder="Specialty">

    <input type="number" name="experience" value="<?php echo $user['experience'] ?? ''; ?>" placeholder="Experience">

    <button class="btn blue">Update</button>

</form>

</div>

</div>

</body>
</html>