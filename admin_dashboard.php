<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$totalUsers = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$totalAdmins = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'admin'")->fetch_assoc()['total'];
$totalRegularUsers = $totalUsers - $totalAdmins;

$totalPlants = $conn->query("SELECT COUNT(*) as total FROM plants")->fetch_assoc()['total'];
$plantsByClassification = $conn->query("SELECT Classification, COUNT(*) as total FROM plants GROUP BY Classification");

if (!$plantsByClassification) {
    die("Error in SQL query: " . $conn->error);
}

$plants = [];
$result = $conn->query("SELECT * FROM plants");
while($row = $result->fetch_assoc()) {
    $plants[] = $row;
}

if(isset($_GET['delete'])) {
    $plant_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM plants WHERE PlantID = ?");
    $stmt->bind_param("i", $plant_id);
    $stmt->execute();
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Plantify</title>
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
        <h2>Admin Dashboard</h2>

        <div class="stats-container">
            <h3>User Statistics</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>Total Users</h4>
                    <p><?= $totalUsers ?></p>
                </div>
                <div class="stat-card">
                    <h4>Admins</h4>
                    <p><?= $totalAdmins ?></p>
                </div>
                <div class="stat-card">
                    <h4>Regular Users</h4>
                    <p><?= $totalRegularUsers ?></p>
                </div>
            </div>
        </div>

        <div class="stats-container">
            <h3>Plant Statistics</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>Total Plants</h4>
                    <p><?= $totalPlants ?></p>
                </div>
                <?php while($row = $plantsByClassification->fetch_assoc()): ?>
                    <div class="stat-card">
                        <h4><?= $row['Classification'] ?></h4>
                        <p><?= $row['total'] ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="quick-links">
            <h3>Quick Links</h3>
            <div class="links-grid">
                <a href="add_plant.php" class="link-card">Add New Plant</a>
                <a href="admin_users.php" class="link-card">Manage Users</a>
            </div>
        </div>

        <h3>Manage Plants</h3>
        <div class="plant-grid">
            <?php if(count($plants) > 0): ?>
                <?php foreach($plants as $plant): ?>
                    <div class="plant-card">
                        <?php if($plant['ImagePath']): ?>
                            <img src="<?= $plant['ImagePath'] ?>" alt="<?= $plant['PlantName'] ?>" class="plant-image">
                        <?php endif; ?>
                        <h4><?= $plant['PlantName'] ?></h4>
                        <p><strong>Classification:</strong> <?= $plant['Classification'] ?></p>
                        <p><strong>Region:</strong> <?= $plant['Region'] ?></p>
                        <div class="actions">
                            <a href="edit_plant.php?id=<?= $plant['PlantID'] ?>">Edit</a>
                            <a href="admin_dashboard.php?delete=<?= $plant['PlantID'] ?>" onclick="return confirm('Are you sure you want to delete this plant?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>No plants found.</p>
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