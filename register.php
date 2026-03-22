<?php
include "connect.php";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        echo "<script>alert('Email already exists');</script>";
    }else{

        /*  หา patient_id ล่าสุด */
        $result = mysqli_query($conn, "SELECT patient_id FROM users 
                                      WHERE role='patient' AND patient_id IS NOT NULL
                                      ORDER BY id DESC LIMIT 1");

        $row = mysqli_fetch_assoc($result);

        if($row && $row['patient_id']){
            $last_number = (int) substr($row['patient_id'], 1);
            $new_number = $last_number + 1;
        }else{
            $new_number = 1;
        }

        /*  สร้าง patient_id ใหม่ */
        $patient_id = "P" . str_pad($new_number, 3, "0", STR_PAD_LEFT);

        $sql = "INSERT INTO users (name, email, password, role, patient_id)
                VALUES ('$name', '$email', '$password', 'patient', '$patient_id')";

        mysqli_query($conn, $sql);

        echo "<script>alert('Register successful'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="login-container">

    <h2>Create Account</h2>

    <form method="POST">

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register" class="btn green">Register</button>

    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>

</div>

</body>
</html>