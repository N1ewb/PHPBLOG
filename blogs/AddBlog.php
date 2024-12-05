<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../config.php';

    // Sanitize inputs
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

    // Check if user is logged in
    if (isset($_SESSION['email'])) {
        $author = $_SESSION['email'];
    } else {
        $_SESSION['message'] = "You must be logged in to add a blog.";
        header("Location: ../pages/login/Login.php");
        exit;
    }

    // Check if all data exist
    if (empty($title) || empty($content) || empty($author) || !isset($_FILES['image_path']['name'])) {
        $_SESSION['message'] = "All fields are required!";
        header("Location: ../pages/blogs/AddBlogPage.php");
        exit;
    }

    // Handle image upload
    $upload_dir = '../uploads/';
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

    $upload_dir = '../uploads/';
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true); // Create the uploads directory if it doesn't exist
    }

    $image_name = basename($_FILES['image_path']['name']);
    $image_tmp_path = $_FILES['image_path']['tmp_name'];
    $image_type = $_FILES['image_path']['type'];
    $image_size = $_FILES['image_path']['size'];
    $image_path = "$upload_dir . $image_name";


    // Validate image type and size (e.g., max 5MB)
    if (!in_array($image_type, $allowed_types)) {
        $_SESSION['message'] = "Invalid image type. Only JPG, PNG, and GIF are allowed.";
        header("Location: ../pages/blogs/AddBlogPage.php");
        exit;
    }

    if ($image_size > 5 * 1024 * 1024) {
        $_SESSION['message'] = "Image size exceeds 5MB.";
        header("Location: ../pages/blogs/AddBlogPage.php");
        exit;
    }


    // Move the uploaded image to the uploads directory
    if (!move_uploaded_file($image_tmp_path, $image_path)) {
        $_SESSION['message'] = "Failed to upload image.";
        header("Location: ../pages/blogs/AddBlogPage.php");
        exit;
    }

    // Save blog data to the database
    $stmt = $conn->prepare("INSERT INTO blogs (title, content, author, image_path) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $title, $content, $author, $image_path);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Created blog successfully!";
            header("Location: ../pages/blogs/AddBlogPage.php");
            exit;
        } else {
            $_SESSION['message'] = "Error occurred while saving the blog.";
            header("Location: ../pages/blogs/AddBlogPage.php");
            exit;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the statement.";
    }

    $conn->close();
}
?>