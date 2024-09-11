<?php
function updateAverageRatings($pdo, $student_id, $teacher_id) {
    // Вычисление средних значений для данного студента и преподавателя
    $stmt = $pdo->prepare("
        SELECT AVG(teaching_quality_rating) AS avg_teaching_quality,
               AVG(availability_rating) AS avg_availability,
               AVG(material_relevance_rating) AS avg_material_relevance,
               AVG(group_interaction_rating) AS avg_group_interaction
        FROM survey_results
        WHERE student_id = ? AND teacher_id = ?
    ");
    $stmt->execute([$student_id, $teacher_id]);
    $student_ratings = $stmt->fetch(PDO::FETCH_ASSOC);

    // Вычисление средних значений для всех студентов
    $stmt = $pdo->prepare("
        SELECT AVG(teaching_quality_rating) AS avg_teaching_quality,
               AVG(availability_rating) AS avg_availability,
               AVG(material_relevance_rating) AS avg_material_relevance,
               AVG(group_interaction_rating) AS avg_group_interaction
        FROM survey_results
        WHERE teacher_id = ?
    ");
    $stmt->execute([$teacher_id]);
    $overall_ratings = $stmt->fetch(PDO::FETCH_ASSOC);

    // Сохранение средних значений в таблицу average_ratings
    $stmt = $pdo->prepare("
        INSERT INTO average_ratings (teacher_id, student_id, avg_teaching_quality, avg_availability, avg_material_relevance, avg_group_interaction, avg_teaching_quality_all, avg_availability_all, avg_material_relevance_all, avg_group_interaction_all)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
            avg_teaching_quality = VALUES(avg_teaching_quality),
            avg_availability = VALUES(avg_availability),
            avg_material_relevance = VALUES(avg_material_relevance),
            avg_group_interaction = VALUES(avg_group_interaction),
            avg_teaching_quality_all = VALUES(avg_teaching_quality_all),
            avg_availability_all = VALUES(avg_availability_all),
            avg_material_relevance_all = VALUES(avg_material_relevance_all),
            avg_group_interaction_all = VALUES(avg_group_interaction_all)
    ");
    $stmt->execute([
        $teacher_id,
        $student_id,
        round($student_ratings['avg_teaching_quality'], 2),
        round($student_ratings['avg_availability'], 2),
        round($student_ratings['avg_material_relevance'], 2),
        round($student_ratings['avg_group_interaction'], 2),
        round($overall_ratings['avg_teaching_quality'], 2),
        round($overall_ratings['avg_availability'], 2),
        round($overall_ratings['avg_material_relevance'], 2),
        round($overall_ratings['avg_group_interaction'], 2)
    ]);
}
?>
