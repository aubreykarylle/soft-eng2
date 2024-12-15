<?php
session_start();
include("db.php");

// Process Login
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM form WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $stored_hashed_password = $user_data['password'];

            if (password_verify($password, $stored_hashed_password)) {
                $_SESSION['user_data'] = $user_data['id'];
                header("Location: index.php");
                exit();
            } else {
                echo "<script type='text/javascript'>alert('Invalid password.');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('No user found with this email.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script type='text/javascript'>alert('Please enter valid credentials.');</script>";
    }
}

// Process Signup
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script type='text/javascript'>alert('Passwords do not match!');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if (!empty($email) && !empty($password) && !is_numeric($email)) {
            $stmt = $conn->prepare("INSERT INTO form (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashed_password);

            if ($stmt->execute()) {
                header("Location: landingpage.html");
                exit();
            } else {
                echo "<script type='text/javascript'>alert('Error: " . $conn->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script type='text/javascript'>alert('Please enter valid information');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login / Register - Puerto Princesa Traveloca</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
<div class="wrapper">
<div class="card login-size">
      <!-- Login Form -->
  <div class="login-form"> 
    <h2>Login</h2>
    <div class="input-group">
      <i class="fas fa-envelope"></i>
      <input type="email" placeholder="Email">
    </div>
    <div class="input-group">
      <i class="fas fa-lock"></i>
      <input type="password" placeholder="Password">
    </div>
    <a href="#" class="forgot-password">Forgot Password?</a>
    <button class="btn btn-login">Login</button>
    <p class="toggle-text">Don't have an account? <a href="#" class="toggle">Register Now</a></p>
  </div>
</div>

    <div class="content">
      <!-- Registration Form -->
      <h2>Registration</h2>
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="First Name">
      </div>
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="Last Name">
      </div>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" placeholder="Email">
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" placeholder="Password">
      </div>
      <button class="btn">Register</button>
      <p class="toggle-text">Already have an account? <a href="#" class="toggle">Login Now</a></p>
    </div>
  </div>
</body>

</html>

<script> 
document.querySelectorAll('.toggle').forEach(toggle => {
   toggle.addEventListener('click', () => {
      document.querySelector('.wrapper').classList.toggle('flip');
   });
});

</script>
</body>

</html>
