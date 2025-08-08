<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$database = "news-system";
 
$conn = new mysqli($servername, $username, $password, $database);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = intval($_POST['post_id']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
 
    // Simple validation
    if (!empty($_FILES['image_url']['name'])) {
        $imageName = basename($_FILES['image_url']['name']);
        $targetDir = "uploads/";
        $targetFile = $targetDir . time() . "_" . $imageName;
 
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFile)) {
            // Optional: delete old image from server
 
           
            $imagePath = $targetFile;
       
        }
    }
 
    $stmt = $conn->prepare("UPDATE news_posts SET title = ?, content = ?, image_url = ? WHERE post_id = ?");
 
    $stmt->bind_param("sssi",  $title, $content, $imagePath, $post_id);
 
    if ($stmt->execute()) {
 
        echo "<script>alert('User updated successfully!'); window.location.href='message.php';</script>";
    } else {
 
        echo "Error updating record: " . $conn->error;
    }
 
    $stmt->close();
} else {
 
    echo "Invalid request method.";
}
 
$conn->close();