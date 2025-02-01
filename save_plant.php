<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access");
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["plant_image"]["name"]);
move_uploaded_file($_FILES["plant_image"]["tmp_name"], $target_file);

$stmt = $conn->prepare("INSERT INTO plants 
    (name_en, name_ar, description_en, benefits_en, side_effects_en, image_path)
    VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", 
    $_POST['name_en'],
    $_POST['name_ar'],
    $_POST['description_en'],
    $_POST['benefits_en'],
    $_POST['side_effects_en'],
    $target_file
);

$stmt->execute();
header("Location: admin_dashboard.php");
?>