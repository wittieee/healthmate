<!DOCTYPE html>
<html>

<head>

<title>Login</title>
<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="login-box">

<h2>Login</h2>

<form action="check_login.php" method="POST">

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Password" minlength="4" required>

    <button class="btn blue">Login</button>
    <p>Don't have an account? <a href="register.php">Register</a></p>

</form>

</div>

</body>

</html>