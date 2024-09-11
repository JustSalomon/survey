<?php
session_start();
require 'config/config.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['student_id'];
    $teacher_id = $_SESSION['teacher_id'];
    $group_interaction = $_POST['group_interaction'];
    $group_interaction_rating = $_POST['group_interaction_rating'];


    $stmt = $pdo->prepare("
        INSERT INTO survey_results (student_id, teacher_id, group_interaction, group_interaction_rating)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        group_interaction = VALUES(group_interaction),
        group_interaction_rating = VALUES(group_interaction_rating)
    ");
    $stmt->execute([$student_id, $teacher_id, $group_interaction, $group_interaction_rating]);

    header("Location: final_feedback.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Оцените взаимодействие с группой</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher:wght@400;700&display=swap">
</head>
<body class="group-page">
<div class="group-container">
    <h1 class="group-heading">Оцените взаимодействие с группой</h1>
    <form action="group_interaction.php" method="post" class="group-form">
        <label for="group_interaction" class="group-label">Комментарий:</label>
        <textarea name="group_interaction" id="group_interaction" rows="4" cols="50" class="group-textarea"></textarea>

        <label for="group_interaction_rating" class="group-label">Оценка (1-5):</label>
        <select name="group_interaction_rating" id="group_interaction_rating" class="group-select">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <input type="submit" value="Далее" class="group-submit">
    </form>
</div>
</body>
</html>