<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$plant_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM plants WHERE PlantID = ?");
$stmt->bind_param("i", $plant_id);
$stmt->execute();
$plant = $stmt->get_result()->fetch_assoc();

if (!$plant) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $plant['PlantName'] ?> - Plantify</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Plantify</h1>
        <nav>
            <a href="dashboard.php">Home</a>
            <a href="profile.php">Profile</a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="admin_dashboard.php">Admin Panel</a>
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="plant-details">
        <?php if (!empty($plant['ImagePath'])): ?>
            <img src="<?= htmlspecialchars($plant['ImagePath']) ?>"style="max-width: 100%; height: 50%;" alt="<?= htmlspecialchars($plant['PlantName']) ?>" class="plant-image">
        <?php else: ?>
            <img src="images/default-plant.jpg" alt="Default Plant Image" class="plant-image">
        <?php endif; ?>

        <h2><?= $plant['PlantName'] ?></h2>
        <p><strong>Classification:</strong> <?= $plant['Classification'] ?></p>
        <p><strong>Region:</strong> <?= $plant['Region'] ?></p>

        <div class="tabs">
            <button class="tab active" data-tab="description">Description</button>
            <button class="tab" data-tab="benefits">Benefits</button>
            <button class="tab" data-tab="usage">Usage Methods</button>
            <button class="tab" data-tab="warnings">Warnings</button>
        </div>

        <div class="tab-content active" id="description">
            <p><?= $plant['Description'] ?></p>
        </div>

        <div class="tab-content" id="benefits">
            <p><?= $plant['Benefits'] ?></p>
        </div>

        <div class="tab-content" id="usage">
            <p><?= $plant['UsageMethods'] ?></p>
        </div>

        <div class="tab-content" id="warnings">
            <p><?= $plant['Warnings'] ?></p>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Plantify. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>

</html>