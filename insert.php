<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "news-system";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title      = $_POST['title'];
    $content    = $_POST['content'];
    $image_url  = $_FILES['image_url'];
    $author_id  = $_POST['author_id'];
    $category   = $_POST['category'];
    $tags       = $_POST['tags'];
    $status     = $_POST['status'];

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir);
    }
    $imageName = basename($image_url["name"]);

    $targetFile = $targetDir . time() . "_" . $imageName;

    $imageType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageType, $allowedTypes)) {
        die("Only JPG, PNG, JPEG, and GIF are allowed.");
    }
    if (move_uploaded_file($image_url["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO news_posts (title, content, image_url, author_id, category, tags, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssss", $title, $content, $targetFile, $author_id, $category, $tags, $status);

        if ($stmt->execute()) {
            echo "<script>alert('Upload successful!'); window.location.href='message.php';</script>";
        } else {
            echo "Error in uploadng file";
        }

        $stmt->close();
    }
}
$conn->close();
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <title>Insert News Post</title>
</head>

<body>
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div class="container mt-5">
            <h2 class="mb-4">New Blog Post</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content:</label>
                    <textarea name="content" rows="5" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image URL:</label>
                    <input type="file" name="image_url" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Author ID:</label>
                    <input type="number" name="author_id" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category:</label>
                    <input type="text" name="category" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tags (comma-separated):</label>
                    <input type="text" name="tags" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status:</label>
                    <select name="status" class="form-select">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" name="Post">Insert Post</button>
            </form>
        </div>
        <!-- Bootstrap CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</body>

</html>