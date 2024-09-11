<?php
session_start();
require 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['student_id'];
    $teacher_id = $_SESSION['teacher_id'];
    $availability = $_POST['availability'];
    $availability_rating = $_POST['availability_rating'];

    // Подготовка и выполнение запроса
    $stmt = $pdo->prepare("
        INSERT INTO survey_results (student_id, teacher_id, availability, availability_rating)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        availability = VALUES(availability),
        availability_rating = VALUES(availability_rating)
    ");
    $stmt->execute([$student_id, $teacher_id, $availability, $availability_rating]);

    header("Location: material_relevance.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Оцените доступность преподавателя</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher:wght@400;700&display=swap">
</head>
<body class="availability-page">
<div class="availability-container">
    <h1 class="availability-heading">Оцените доступность преподавателя</h1>
    <form action="availability.php" method="post" class="availability-form">
        <label for="availability" class="availability-label">Комментарий:</label>
        <textarea name="availability" id="availability" rows="4" cols="50" class="availability-textarea"></textarea>

        <label for="availability_rating" class="availability-label">Оценка (1-5):</label>
        <select name="availability_rating" id="availability_rating" class="availability-select">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <input type="submit" value="Далее" class="availability-submit">
    </form>
</div>
</body>
</html>