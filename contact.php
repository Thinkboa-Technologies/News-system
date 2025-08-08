<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "news_system";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $email = $message = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Server-side validation
    if (empty($_POST["name"])) {
        $errors['name'] = "Name is required.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    if (empty($_POST["email"])) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    if (empty($_POST["message"])) {
        $errors['message'] = "Message is required.";
    } else {
        $message = htmlspecialchars(trim($_POST["message"]));
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            $success = "Thank you for contacting us!";
            $name = $email = $message = "";
        } else {
            $errors['db'] = "Database error. Please try again.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Contact Us</h2>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <?php if (!empty($errors['db'])): ?>
        <div class="alert alert-danger"><?= $errors['db'] ?></div>
    <?php endif; ?>
    <form id="contactForm" method="post" novalidate>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($name) ?>">
            <div class="invalid-feedback"><?= $errors['name'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($email) ?>">
            <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>"><?= htmlspecialchars($message) ?></textarea>
            <div class="invalid-feedback"><?= $errors['message'] ?? '' ?></div>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    let valid = true;
    // Name validation
    const name = this.name.value.trim();
    if (!name) {
        this.name.classList.add('is-invalid');
        this.name.nextElementSibling.textContent = "Name is required.";
        valid = false;
    } else {
        this.name.classList.remove('is-invalid');
        this.name.nextElementSibling.textContent = "";
    }
    // Email validation
    const email = this.email.value.trim();
    const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
    if (!email) {
        this.email.classList.add('is-invalid');
        this.email.nextElementSibling.textContent = "Email is required.";
        valid = false;
    } else if (!emailPattern.test(email)) {
        this.email.classList.add('is-invalid');
        this.email.nextElementSibling.textContent = "Invalid email format.";
        valid = false;
    } else {
        this.email.classList.remove('is-invalid');
        this.email.nextElementSibling.textContent = "";
    }
    // Message validation
    const message = this.message.value.trim();
    if (!message) {
        this.message.classList.add('is-invalid');
        this.message.nextElementSibling.textContent = "Message is required.";
        valid = false;
    } else {
        this.message.classList.remove('is-invalid');
        this.message.nextElementSibling.textContent = "";
    }
    if (!valid) e.preventDefault();
});
</script>
</body>
</html>