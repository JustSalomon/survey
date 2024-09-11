<?php
session_start();
require 'config/config.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Спасибо за ваш отзыв!</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Philosopher:wght@400;700&display=swap">
</head>
<body>
<div class="thank-container">
    <h1 class="thank-heading">Спасибо за ваш отзыв!</h1>
    <p class="thank-text">Ваш отзыв был успешно отправлен. Мы ценим ваше мнение!</p>
    <a href="index.php" class="button-main">Вернуться на главную</a>
</div>
</body>
</html>
