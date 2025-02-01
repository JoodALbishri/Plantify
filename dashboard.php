<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$search = '';
$plants = [];
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM plants WHERE PlantName LIKE ?");
    $searchTerm = "%$search%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()) {
        $plants[] = $row;
    }
} else {
    $result = $conn->query("SELECT * FROM plants");
    while($row = $result->fetch_assoc()) {
        $plants[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Plantify</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Plantify</h1>
        <nav>
            <a href="dashboard.php">Home</a>
            <a href="profile.php">Profile</a>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="admin_dashboard.php">Admin Panel</a>
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="dashboard-container">
        <h2>Welcome, <?= isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest' ?>!</h2>
        <div class="search-container">
            <form action="dashboard.php" method="GET">
                <input type="text" name="search" placeholder="Search for plants..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="plant-grid">
            <?php if(count($plants) > 0): ?>
                <?php foreach($plants as $plant): ?>
                    <div class="plant-card" onclick="window.location.href='plant_details.php?id=<?= $plant['PlantID'] ?>'">
                        <?php if(!empty($plant['ImagePath'])): ?>
                            <img src="<?= htmlspecialchars($plant['ImagePath']) ?>" alt="<?= htmlspecialchars($plant['PlantName']) ?>" class="plant-image">
                        <?php else: ?>
                            <img src="images/default-plant.jpg" alt="Default Plant Image" class="plant-image">
                        <?php endif; ?>
                        <h3><?= $plant['PlantName'] ?></h3>
                        <p><strong>Classification:</strong> <?= $plant['Classification'] ?></p>
                        <p><strong>Region:</strong> <?= $plant['Region'] ?></p>
                        <p><?= substr($plant['Description'], 0, 100) ?>...</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>No plants found matching your search.</p>
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