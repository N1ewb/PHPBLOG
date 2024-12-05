<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Login.css">
  <title>Login</title>
</head>

<body>
  <form action="../../auth/Login.php" method="POST">
    
    <div class="container">
    <h1>Login to your account</h1>
    <p>Please fill in this form to login to your account.</p>
      <?php
      require '../../config.php';
      
      if (isset($_SESSION['message'])) {
        echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
      }
      check_user_logged_out();

      ?>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
      <span class="psw">Dont have an account? <a href="../../pages/register/Register.php">Register</a></span>
    </div>
  </form>
</body>

</html>