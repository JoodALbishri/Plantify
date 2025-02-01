<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$users = [];
$result = $conn->query("SELECT id, name, username, email, role FROM users");
while($row = $result->fetch_assoc()) {
    $users[] = $row;
}

if(isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    header("Location: admin_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Plantify</title>
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

    <div class="admin-container">
        <h2>User Management</h2>

        <div class="user-grid">
            <?php if(count($users) > 0): ?>
                <?php foreach($users as $user): ?>
                    <div class="user-card">
                        <h3><?= $user['name'] ?></h3>
                        <p><strong>Username:</strong> <?= $user['username'] ?></p>
                        <p><strong>Email:</strong> <?= $user['email'] ?></p>
                        <p><strong>Role:</strong> <?= $user['role'] ?></p>
                        <div class="actions">
                            <a href="edit_user.php?id=<?= $user['id'] ?>">Edit</a>
                            <a href="admin_users.php?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>No users found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Plantify. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
