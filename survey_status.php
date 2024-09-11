<!--need test-->


<?php
//
//require 'config/config.php';
//
//
//$student_id = $_SESSION['student_id'] ?? null;
//
//if ($student_id === null) {
//    echo "<p class='error-note'>Ошибка: не удалось определить идентификатор студента.</p>";
//    exit;
//}
//
//$stmt = $pdo->prepare("
//    SELECT last_survey_date
//    FROM students
//    WHERE id = ?
//");
//$stmt->execute([$student_id]);
//$last_survey_date = $stmt->fetchColumn();
//
//$two_months_ago = (new DateTime())->sub(new DateInterval('P2M'))->format('Y-m-d');
//
//$survey_due = $last_survey_date === false || $last_survey_date < $two_months_ago;
//?>
<!---->
<?php //if ($survey_due): ?>
<!--    <p class="reminder-note">Пожалуйста, заполните опрос. Последний опрос был более двух месяцев назад.</p>-->
<?php //endif; ?>


