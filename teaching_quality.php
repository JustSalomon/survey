<?php
session_start();
require 'config/config.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['student_id'];
    $teacher_id = $_SESSION['teacher_id'];
    $teaching_quality = $_POST['teaching_quality'];
    $teaching_quality_rating = $_POST['teaching_quality_rating'];


    $stmt = $pdo->prepare("
        INSERT INTO survey_results (student_id, teacher_id, teaching_quality, teaching_quality_rating)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        teaching_quality = VALUES(teaching_quality),
        teaching_quality_rating = VALUES(teaching_quality_rating)
    ");
    $stmt->execute([$student_id, $teacher_id, $teaching_quality, $teaching_quality_rating]);

    header("Location: availability.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Оцените качество преподавания</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher:wght@400;700&display=swap">
</head>
<body class="teaching-quality-page">
<div class="teaching-container">
    <h1 class="teaching-heading">Оцените качество преподавания</h1>
    <form action="teaching_quality.php" method="post" class="teaching-form">
        <label for="teaching_quality" class="teaching-label">Комментарий:</label>
        <textarea name="teaching_quality" id="teaching_quality" rows="4" class="teaching-textarea"></textarea>

        <label for="teaching_quality_rating" class="teaching-label">Оценка:</label>
        <select name="teaching_quality_rating" id="teaching_quality_rating" class="teaching-select">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <input type="submit" value="Далее" class="teaching-submit">
    </form>
</div>
</body>
</html>