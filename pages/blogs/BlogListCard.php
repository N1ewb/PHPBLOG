<?php echo 
"<div class='card' onclick=\"location.href='../../pages/blogs/BlogInfoPage.php?id=$blog_id'\"> 
    <div class='blog-header'>
    <p>" . htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8') . "</p>
    <p>" . htmlspecialchars(date('F j, Y', strtotime($row['created_at'])), ENT_QUOTES, 'UTF-8') . "</p>
    </div>
    <div class='blog-body'>
        <p>" . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . "</p>
        <p>" . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . "</p>
        <div class='blog-image'><img class='image_path' src='../../uploads/$image_path' alt='blog-image' /></div>
    </div>
</div>"
?>