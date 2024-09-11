<?php
include 'header.php';
require 'config/config.php';
//include 'survey_status.php';

$students = $pdo->query("SELECT id, name FROM students")->fetchAll(PDO::FETCH_ASSOC);
$teachers = $pdo->query("SELECT id, name FROM teachers")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Выбор студента и преподавателя</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher:wght@400;700&display=swap">
</head>
<body class="index-page">
<div class="index-container">
    <h1 class="index-heading">Выберите студента и преподавателя</h1>
    <p class="anonymous-note">Этот опрос анонимный. Ваши ответы не будут связаны с вашей личностью.</p>
<!--    --><?php //if (isset($survey_due) && $survey_due): ?>
<!--        <p class="reminder-note">Пожалуйста, заполните опрос. Последний опрос был более двух месяцев назад.</p>-->
<!--    --><?php //endif; ?>
    <form action="survey.php" method="post" class="index-form">
        <label for="student_id" class="index-label">Выберите студента:</label>
        <select name="student_id" id="student_id" class="index-select">
            <?php foreach ($students as $student): ?>
                <option value="<?= htmlspecialchars($student['id']) ?>"><?= htmlspecialchars($student['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="teacher_id" class="index-label">Выберите преподавателя:</label>
        <select name="teacher_id" id="teacher_id" class="index-select">
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= htmlspecialchars($teacher['id']) ?>"><?= htmlspecialchars($teacher['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Начать опрос" class="index-submit">
    </form>
</div>
</body>
</html>