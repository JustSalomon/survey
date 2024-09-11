<?php
$pdo = new PDO('mysql:host=localhost;dbname=survey_db', 'your_login', 'your_password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
