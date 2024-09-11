<?php
session_start();
require 'config/config.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['student_id'];
    $teacher_id = $_SESSION['teacher_id'];
    $material_relevance = $_POST['material_relevance'];
    $material_relevance_rating = $_POST['material_relevance_rating'];


    $stmt = $pdo->prepare("
        INSERT INTO survey_results (student_id, teacher_id, material_relevance, material_relevance_rating)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        material_relevance = VALUES(material_relevance),
        material_relevance_rating = VALUES(material_relevance_rating)
    ");
    $stmt->execute([$student_id, $teacher_id, $material_relevance, $material_relevance_rating]);

    header("Location: group_interaction.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Оцените актуальность учебного материала</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher:wght@400;700&display=swap">
</head>
<body class="material-page">
<div class="material-container">
    <h1 class="material-heading">Оцените актуальность учебного материала</h1>
    <form action="material_relevance.php" method="post" class="material-form">
        <label for="material_relevance" class="material-label">Комментарий:</label>
        <textarea name="material_relevance" id="material_relevance" rows="4" cols="50" class="material-textarea"></textarea>

        <label for="material_relevance_rating" class="material-label">Оценка:</label>
        <select name="material_relevance_rating" id="material_relevance_rating" class="material-select">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <input type="submit" value="Далее" class="material-submit">
    </form>
</div>
</body>
</html>