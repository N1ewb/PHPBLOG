<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AddBlogPage.css">
    <title>Add Blog</title>
</head>

<body>
    <header>
        <?php include '../../components/Navbar/Navbar.php'; ?>
    </header>
    <main>
        <!-- Add Blog Form -->
        <?php
        session_start();
        if (isset($_SESSION['message'])) {
            echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>
        <h1>What's on your mind?</h1>
        <form action="../../blogs/AddBlog.php" method="POST" enctype="multipart/form-data">
            <div class="group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Title" required>
            </div>
            <div class="group">
                <label for="content">Content</label>
                <input type="text" name="content" id="content" placeholder="Content" required>
            </div>
            <div class="group">
                <label for="image_path">Blog Image</label>
                <input type="file" name="image_path" id="image_path" accept="image/*" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </main>
</body>

</html>
