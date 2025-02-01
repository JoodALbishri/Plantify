<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$plant_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM plants WHERE PlantID = ?");
$stmt->bind_param("i", $plant_id);
$stmt->execute();
$plant = $stmt->get_result()->fetch_assoc();

if(!$plant) {
    header("Location: admin_dashboard.php");
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

    $imagePath = $plant['ImagePath']; 
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
        $stmt = $conn->prepare("UPDATE plants SET PlantName = ?, Classification = ?, Region = ?, Description = ?, Benefits = ?, UsageMethods = ?, Warnings = ?, ImagePath = ? WHERE PlantID = ?");
        
        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }

        $stmt->bind_param("ssssssssi", $plantName, $classification, $region, $description, $benefits, $usageMethods, $warnings, $imagePath, $plant_id);
        if($stmt->execute()) {
            $success = "Plant updated successfully!";
        } else {
            $error = "An error occurred while updating the plant.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Plant - Plantify</title>
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
        <h2>Edit Plant: <?= $plant['PlantName'] ?></h2>
        <?php if(isset($error)): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        <?php if(isset($success)): ?>
            <div class="success-message"><?= $success ?></div>
        <?php endif; ?>
        <form action="edit_plant.php?id=<?= $plant['PlantID'] ?>" method="POST" enctype="multipart/form-data" id="editPlantForm">
            <div class="form-group">
                <label for="plantName">Plant Name:</label>
                <input type="text" id="plantName" name="plantName" value="<?= $plant['PlantName'] ?>" required>
            </div>
            <div class="form-group">
                <label for="classification">Classification:</label>
                <input type="text" id="classification" name="classification" value="<?= $plant['Classification'] ?>" required>
            </div>
            <div class="form-group">
                <label for="region">Region:</label>
                <input type="text" id="region" name="region" value="<?= $plant['Region'] ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?= $plant['Description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="benefits">Benefits:</label>
                <textarea id="benefits" name="benefits" required><?= $plant['Benefits'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="usageMethods">Usage Methods:</label>
                <textarea id="usageMethods" name="usageMethods" required><?= $plant['UsageMethods'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="warnings">Warnings:</label>
                <textarea id="warnings" name="warnings" required><?= $plant['Warnings'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="plantImage">Plant Image:</label>
                <input type="file" id="plantImage" name="plantImage" accept="image/*">
                <?php if($plant['ImagePath']): ?>
                    <p>Current Image: <a href="<?= $plant['ImagePath'] ?>" target="_blank">View Image</a></p>
                <?php endif; ?>
            </div>
            <button type="submit">Update Plant</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Plantify. All rights reserved.</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>