<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])) {
    header("Location: admin_users.php");
    exit();
}

$user_id = $_GET['id'];

$stmt = $conn->prepare("SELECT id, name, username, email, role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if(!$user) {
    header("Location: admin_users.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if(empty($name) || empty($username) || empty($email) || empty($role)) {
        $error = "Please fill in all required fields.";
    } elseif(!empty($newPassword) && $newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        if(empty($newPassword)) {
            $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ?, role = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $name, $username, $email, $role, $user_id);
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ?, role = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssssi", $name, $username, $email, $role, $hashedPassword, $user_id);
        }

        if($stmt->execute()) {
            $success = "User updated successfully!";
        } else {
            $error = "An error occurred while updating the user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Plantify</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Plantify Admin</h1>
        <nav>
            <a href="dashboard.php">User View</a>
            <a href="admin_dashboard.php">Admin Panel</a>
            <a href="admin_users.php">User Management</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="admin-form-container">
        <h2>Edit User: <?= $user['name'] ?></h2>
        <?php if(isset($error)): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        <?php if(isset($success)): ?>
            <div class="success-message"><?= $success ?></div>
        <?php endif; ?>
        <form action="edit_user.php?id=<?= $user['id'] ?>" method="POST" id="editUserForm">
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
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm New Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword">
            </div>
            <button type="submit">Update User</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Plantify. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
