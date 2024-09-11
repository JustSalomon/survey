<?php
session_start();
require 'config/config.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Отзыв оставлен</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher:wght@400;700&display=swap">
</head>
<body>
<div class="already-container">
    <h1 class="already-heading">Спасибо!</h1>
    <p class="already-text">Вы уже оставили отзыв для этого преподавателя.</p>
    <a href="index.php" class="button-main">Вернуться на главную</a>
</div>
</body>
</html>
