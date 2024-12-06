<?php
require '../../config.php';
$blog_id = $_GET['id'];

$sql = "SELECT * FROM blogs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="BlogInfoPage.css">
    <title><?php echo htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8'); ?></title>
</head>

<body>

<?php
    require '../../config.php';
    include '../../components/Navbar/Navbar.php';
    check_user_logged_out();
    ?>  

    <div class="blog-detail-container">
        <button class="back-button" onclick="history.back()">← Back</button>
        <h1><?php echo htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <div class="author-date">
            <p><?php echo htmlspecialchars($blog['author'], ENT_QUOTES, 'UTF-8'); ?></h1>
            </p>
           <span>Posted <?php
            $timeAgo = calculateTimeAgo($blog['created_at']);
             echo htmlspecialchars($timeAgo)
            ?></span>
        </div>
        <div class="blog-content">
            <?php echo nl2br(htmlspecialchars($blog['content'], ENT_QUOTES, 'UTF-8')); ?>
        </div>
        <?php if (!empty($blog['image_path'])): ?>
            <img src="../../uploads/<?php echo htmlspecialchars($blog['image_path'], ENT_QUOTES, 'UTF-8'); ?>"
                alt="blog-image" class="blog-image">
        <?php endif; ?>
    </div>
</body>

</html>