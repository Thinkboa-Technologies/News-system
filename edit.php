<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "news-system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['post_id']) || !is_numeric($_GET['post_id'])) {
    echo "Invalid request.";
    exit;
}

$post_id = intval($_GET['post_id']);

$sql = "SELECT * FROM news_posts WHERE post_id = $post_id";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "User not found.";
    exit;
}

$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Edit User Data</h2>

        <form action="update.php" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded shadow">
            <input type="hidden" name="post_id" value="<?= $user['post_id'] ?>">

            <div class="mb-3">
                <label class="form-label">News Heading</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($user['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">image</label>
                <input type="file" name="image_url" class="form-control" value="<?= htmlspecialchars($user['image_url']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">News</label>
                <input type="text" name="content" class="form-control" value="<?= htmlspecialchars($user['content']) ?>" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="insert.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</body>

</html>

<?php $conn->close(); ?>