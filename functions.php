<?php
function updateAverageRatings($pdo, $teacher_id) {
    // Проверяем, что передаем правильный teacher_id
    if (!$teacher_id) {
        throw new Exception("teacher_id is missing or invalid.");
    }

    // Вычисление средних значений для всех студентов по данному преподавателю
    $stmt = $pdo->prepare("
        SELECT AVG(teaching_quality_rating) AS avg_teaching_quality,
               AVG(availability_rating) AS avg_availability,
               AVG(material_relevance_rating) AS avg_material_relevance,
               AVG(group_interaction_rating) AS avg_group_interaction
        FROM survey_results
        WHERE teacher_id = ?
    ");
    $stmt->execute([$teacher_id]);
    $ratings = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверяем, что у нас есть данные для этого teacher_id
    if ($ratings === false || empty($ratings)) {
        throw new Exception("No ratings found for the specified teacher_id.");
    }

    // Проверяем, что все средние значения корректны
    $ratings['avg_teaching_quality'] = $ratings['avg_teaching_quality'] ?? 0.00;
    $ratings['avg_availability'] = $ratings['avg_availability'] ?? 0.00;
    $ratings['avg_material_relevance'] = $ratings['avg_material_relevance'] ?? 0.00;
    $ratings['avg_group_interaction'] = $ratings['avg_group_interaction'] ?? 0.00;

    // Обновление или вставка средних значений в таблицу average_ratings
    $stmt = $pdo->prepare("
        INSERT INTO average_ratings (teacher_id, avg_teaching_quality, avg_availability, avg_material_relevance, avg_group_interaction)
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
            avg_teaching_quality = VALUES(avg_teaching_quality),
            avg_availability = VALUES(avg_availability),
            avg_material_relevance = VALUES(avg_material_relevance),
            avg_group_interaction = VALUES(avg_group_interaction)
    ");
    $stmt->execute([
        $teacher_id,
        round($ratings['avg_teaching_quality'], 2),
        round($ratings['avg_availability'], 2),
        round($ratings['avg_material_relevance'], 2),
        round($ratings['avg_group_interaction'], 2)
    ]);
}
?>
