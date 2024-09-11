<?php
session_start();
require 'config/config.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $teacher_id = $_POST['teacher_id'];

    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM survey_results 
        WHERE student_id = ? AND teacher_id = ?
    ");
    $stmt->execute([$student_id, $teacher_id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        header("Location: already_submitted.php");
        exit;
    } else {
        $_SESSION['student_id'] = $student_id;
        $_SESSION['teacher_id'] = $teacher_id;

        header("Location: teaching_quality.php");
        exit;
    }
}
?>
