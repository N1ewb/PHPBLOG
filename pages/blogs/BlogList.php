<div class="blogs-list-container">
<?php

while ($row = $result->fetch_assoc()) {
    $image_path = htmlspecialchars(str_replace('../uploads/', '', $row['image_path']), ENT_QUOTES, 'UTF-8');
    $blog_id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
    include 'BlogListCard.php';

}
?>