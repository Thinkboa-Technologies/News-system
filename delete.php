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

// Handle delete request
if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);
    $stmt = $conn->prepare("DELETE FROM news_posts WHERE post_id = ?");
    $stmt->bind_param("i", $post_id);
    if ($stmt->execute()) {
        echo "<script>alert('Message deleted successfully'); window.location.href='delete.php';</script>";
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all posts
$result = $conn->query("SELECT * FROM news_posts ORDER BY post_id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All News Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

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

                <div class="container mt-4">
                    <h1 class="text-center mb-4">All News Messages</h1>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Post ID</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['post_id']) ?></td>
                                        <td><?= htmlspecialchars($row['title']) ?></td>
                                        <td><?= htmlspecialchars($row['content']) ?></td>
                                        <td>
                                            <a href="delete.php?post_id=<?= $row['post_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-info text-center">No news posts found.</div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
<?php $conn->close(); ?>