<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css" />
    <title>Landing Page</title>
</head>

<body>
    <?php
    require 'config.php';
    check_user_logged_out();
    ?>
    <header>
        <nav>
            <a href="./pages/login/Login.php">Login</a>
            <a href="./pages/register/Register.php">Register</a>
        </nav>
    </header>
    
    <main>
        <h1>Welcome to Our Platform</h1>
        <p>
            This is the landing page of our platform where you can register or log in to access exclusive features.
        </p>
        <p>
            Whether you're here to manage your account or explore new possibilities, we're excited to have you on board!
        </p>
        <p>
            Start by <a href="./pages/register/Register.php">registering</a> for an account or <a href="./pages/login/Login.php">logging in</a> if you already have one.
        </p>
    </main>
</body>

</html>
