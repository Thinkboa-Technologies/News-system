<?php
// Database connection settings
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'news-system';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch posts from the database
$sql = "SELECT  title, image_url, content, created_at FROM news_posts ORDER BY created_at DESC";
$result = $conn->query($sql);

$posts = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Blog Posts</h1>
        <a href="index.php" class="btn btn-primary mb-2">back to home</a>
        <?php
        if (empty($posts)) {
            echo '<div class="alert alert-info">No posts available.</div>';
        } else {
            echo '<div class="row row-cols-1 row-cols-md-2 g-4">';
            foreach ($posts as $post) {
                echo '<div class="col">';
                echo '  <div class="card h-100">';
                echo '    <div class="card-body">';
                echo '<img src="' . htmlspecialchars($post['image_url']) . '" class="img-fluid mb-3" alt="Post Image" style="max-height: 200px; object-fit: cover;">';
                echo '      <h5 class="card-title">' . htmlspecialchars($post['title']) . '</h5>';
                echo '      <p class="card-text">' . nl2br(htmlspecialchars($post['content'])) . '</p>';
                echo '      <a href="" class="btn btn-sm btn-outline-primary mt-2">Read More</a>';
                echo '    </div>';
                echo '    <div class="card-footer">';
                echo '      <small class="text-muted">Posted on ' . htmlspecialchars($post['created_at']) . '</small>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreButtons = document.querySelectorAll('.btn-outline-primary');
        readMoreButtons.forEach((button) => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const cardText = button.closest('.card').querySelector('.card-text');
                if (button.textContent === 'Read More') {
                    cardText.style.maxHeight = 'none';
                    cardText.style.overflow = 'visible';
                    button.textContent = 'See Less';
                } else {
                    cardText.style.maxHeight = '100px';
                    cardText.style.overflow = 'hidden';
                    button.textContent = 'Read More';
                }
            });
        });

        // Set initial state for truncation
        document.querySelectorAll('.card-text').forEach((el) => {
            if (el.scrollHeight > 100) {
                el.style.maxHeight = '100px';
                el.style.overflow = 'hidden';
            }
        });
    });
</script>

</html>