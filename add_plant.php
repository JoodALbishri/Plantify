<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $plantName = $_POST['plantName'];
    $classification = $_POST['classification'];
    $region = $_POST['region'];
    $description = $_POST['description'];
    $benefits = $_POST['benefits'];
    $usageMethods = $_POST['usageMethods'];
    $warnings = $_POST['warnings'];

    $imagePath = '';
    if(isset($_FILES['plantImage']) && $_FILES['plantImage']['error'] == 0) {
        $targetDir = "uploads/plants/";
        if(!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
        }
        $targetFile = $targetDir . basename($_FILES['plantImage']['name']);
        if(move_uploaded_file($_FILES['plantImage']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            $error = "Error uploading image.";
        }
    }

    if(empty($plantName) || empty($classification) || empty($region) || empty($description) || empty($benefits) || empty($usageMethods) || empty($warnings)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO plants (PlantName, Classification, Region, Description, Benefits, UsageMethods, Warnings, ImagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }

        $stmt->bind_param("ssssssss", $plantName, $classification, $region, $description, $benefits, $usageMethods, $warnings, $imagePath);
        if($stmt->execute()) {
            $success = "Plant added successfully!";
        } else {
            $error = "An error occurred while adding the plant.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Plant - Plantify</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Plantify Admin</h1>
        <nav>
            <a href="dashboard.php">User View</a>
            <a href="admin_dashboard.php">Admin Panel</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="admin-form-container">
        <h2>Add New Plant</h2>
        <?php if(isset($error)): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        <?php if(isset($success)): ?>
            <div class="success-message"><?= $success ?></div>
        <?php endif; ?>
        <form action="add_plant.php" method="POST" enctype="multipart/form-data" id="addPlantForm">
            <div class="form-group">
                <label for="plantName">Plant Name:</label>
                <input type="text" id="plantName" name="plantName" required>
            </div>
            <div class="form-group">
                <label for="classification">Classification:</label>
                <input type="text" id="classification" name="classification" required>
            </div>
            <div class="form-group">
                <label for="region">Region:</label>
                <input type="text" id="region" name="region" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="benefits">Benefits:</label>
                <textarea id="benefits" name="benefits" required></textarea>
            </div>
            <div class="form-group">
                <label for="usageMethods">Usage Methods:</label>
                <textarea id="usageMethods" name="usageMethods" required></textarea>
            </div>
            <div class="form-group">
                <label for="warnings">Warnings:</label>
                <textarea id="warnings" name="warnings" required></textarea>
            </div>
            <div class="form-group">
                <label for="plantImage">Plant Image:</label>
                <input type="file" id="plantImage" name="plantImage" accept="image/*" required>
            </div>
            <button type="submit">Add Plant</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Plantify. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>