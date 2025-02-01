<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if(empty($name) || empty($username) || empty($email)) {
        $error = "Please fill in all required fields.";
    } elseif(!empty($newPassword) && $newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        if(empty($newPassword)) {
            $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $username, $email, $user_id);
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $name, $username, $email, $hashedPassword, $user_id);
        }

        if($stmt->execute()) {
            $success = "Profile updated successfully!";
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
        } else {
            $error = "An error occurred while updating your profile.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Plantify</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Plantify</h1>
        <nav>
            <a href="dashboard.php">Home</a>
            <a href="profile.php">Profile</a>
            <?php if($_SESSION['role'] === 'admin'): ?>
                <a href="admin_dashboard.php">Admin Panel</a>
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="profile-container">
        <h2>Profile</h2>
        <?php if(isset($error)): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        <?php if(isset($success)): ?>
            <div class="success-message"><?= $success ?></div>
        <?php endif; ?>
        <form action="profile.php" method="POST" id="profileForm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= $user['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= $user['username'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm New Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword">
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Plantify. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>