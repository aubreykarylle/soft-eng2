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
  <style>
    /* Modal Styles */
    .modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      display: flex;
      justify-content: center;
      align-items: center;
      visibility: hidden;
      opacity: 0;
      transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .modal.active {
      visibility: visible;
      opacity: 1;
    }
    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 8px;
      max-width: 600px;
      width: 90%;
      text-align: left;
      overflow-y: auto;
      max-height: 80vh;
    }
    .modal-header {
      font-size: 18px;
      margin-bottom: 15px;
    }
    .modal-body {
      font-size: 14px;
      line-height: 1.5;
    }
    .modal-footer {
      margin-top: 15px;
      text-align: right;
    }
    button {
      padding: 10px 20px;
      font-size: 14px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
    }
    .btn-primary {
      background-color: #007bff;
      color: white;
    }
    .btn-secondary {
      background-color: #ccc;
      color: black;
    }
    .btn-primary:disabled {
      background-color: #aaa;
      cursor: not-allowed;
    }
  </style>
</head>

<body>
  <!-- Terms and Conditions Modal -->
  <div id="termsModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>TraveLoca Terms and Conditions</h3>
      </div>
      <div class="modal-body">
      <p><strong>1. Eligibility:</strong> This is for legit owner of a establishment of transient,lodge, and pension here in Puerto Princesa.</p>
        <p><strong>2. Service Scope:</strong> Traveloca connects you with accommodations in Puerto Princesa City. Listings and prices depend on providers.</p>
        <p><strong>3. User Responsibilities:</strong> Safeguard your account credentials and follow accommodation rules.</p>
        <p><strong>4. Privacy Policy:</strong> Your personal data will be used securely in accordance with our Privacy Policy.</p>
        <p><strong>5. Changes to Terms:</strong> Continued use of Traveloca means acceptance of updated terms.</p>

        <p>For inquiries: <strong>support@TraveLoca.com</strong></p>
      </div>
      <div class="modal-footer">
        <input type="checkbox" id="agree">
        <label for="agree">I agree to the Terms and Conditions</label>
        <button class="btn-primary" id="acceptButton" disabled>Accept</button>
        <button class="btn-secondary" onclick="closeModal()">Cancel</button>
      </div>
    </div>
  </div>

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
      <h2>Register</h2>
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="Email">
      </div>
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="Business Name">
      </div>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" placeholder="Password">
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" placeholder="Confirm Password">
      </div>
      <button class="btn">Register</button>
      <p class="toggle-text">Already have an account? <a href="#" class="toggle">Login Now</a></p>
    </div>
  </div>

  <script>
    // Elements
    const modal = document.getElementById('termsModal');
    const agreeCheckbox = document.getElementById('agree');
    const acceptButton = document.getElementById('acceptButton');
    const wrapper = document.querySelector('.wrapper');

    // Show the modal when the page loads
    window.onload = function () {
      modal.classList.add('active');
    };

    // Close the modal
    function closeModal() {
      modal.classList.remove('active');
    }

    // Enable the "Accept" button only if the checkbox is checked
    agreeCheckbox.addEventListener('change', function () {
      acceptButton.disabled = !this.checked;
    });

    // Accept the terms and enable access to the forms
    acceptButton.addEventListener('click', function () {
      closeModal();
      wrapper.style.visibility = 'visible';
    });

    // Prevent access to forms until terms are accepted
    wrapper.style.visibility = 'hidden';

    // Toggle between Login and Register
    document.querySelectorAll('.toggle').forEach(toggle => {
      toggle.addEventListener('click', () => {
        document.querySelector('.wrapper').classList.toggle('flip');
      });
    });
  </script>
</body>

</html>

