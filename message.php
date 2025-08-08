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
$sql = "SELECT  post_id, title, image_url, content, created_at FROM news_posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="d-flex justify-content-center">
                    <div class="w-75">
                        <h1 class="text-center ">All news message</h1>

                        <?php if ($result->num_rows > 1): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>


                                <div class="card mb-3">
                                    <div class="card-header">
                                        <img class="card-img-top" src="<?= $row['image_url'] ?>" alt="image">
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">
                                            <?= htmlspecialchars($row["title"]) ?> <br>
                                        </h5>
                                        <p class="card-text"><?= htmlspecialchars($row['content']) ?></p>
                                    </div>
                                    <div class="text-center">
                                        <a href="edit.php?post_id=<?= $row['post_id'] ?>" class="btn btn-warning">Edit</a>
                                        <a href="delete.php?post_id=<?= $row['post_id'] ?>" class="btn  btn-primary">Delete</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>

                            <div class="text-center">
                                <a href="insert.php" class="btn btn-primary">Insert New Post</a>
                                <a href="post.php" class="btn btn-secondary">View All Posts</a>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info text-center">No user records found.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>