<?php
session_start();
require 'config/config.php';
require 'functions.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['student_id'];
    $teacher_id = $_SESSION['teacher_id'];
    $overall_feedback = $_POST['overall_feedback'];


    $stmt = $pdo->prepare("
        INSERT INTO survey_results (student_id, teacher_id, overall_feedback)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE
        overall_feedback = VALUES(overall_feedback)
    ");
    $stmt->execute([$student_id, $teacher_id, $overall_feedback]);

    // Вычисление и сохранение средних значений
    updateAverageRatings($pdo, $student_id, $teacher_id);


    unset($_SESSION['student_id']);
    unset($_SESSION['teacher_id']);

    echo "<h1>Спасибо за ваш отзыв!</h1>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Обратная связь</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher:wght@400;700&display=swap">
</head>
<body class="final-page">
<div class="final-container">
    <h1 class="final-heading">Оставьте общий отзыв и благодарности</h1>
    <form action="final_feedback.php" method="post" class="final-form">
        <label for="overall_feedback" class="final-label">Комментарий:</label>
        <textarea name="overall_feedback" id="overall_feedback" rows="6" cols="50" class="final-textarea"></textarea>

        <input type="submit" value="Отправить отзыв" class="final-submit">
    </form>
</div>
</body>
</html>
