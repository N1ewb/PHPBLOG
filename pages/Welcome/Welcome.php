<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /WS101/pages/login/Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Welcome.css" />
    <link rel="stylesheet" href="../blogs/BlogList.css" />
    <title>Homepage</title>
</head>

<body>

    <?php
    require '../../config.php';
    include '../../components/Navbar/Navbar.php'; 
    ?>

    <main>
        <h1>Welcome <?php echo $_SESSION['email']; ?>!</h1>
        <button><a href="../blogs/AddBlogPage.php">Create Blog </a></button>
        <?php include '../../pages/blogs/BlogList.php'; ?>
    </main>
</body>

</html>