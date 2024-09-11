-- Создание базы данных
CREATE DATABASE IF NOT EXISTS survey_db;
USE survey_db;

-- Создание таблицы students
CREATE TABLE IF NOT EXISTS students (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        name VARCHAR(255) NOT NULL,
                                        last_survey_date DATE
);

-- Создание таблицы teachers
CREATE TABLE IF NOT EXISTS teachers (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        name VARCHAR(255) NOT NULL
);

-- Создание таблицы survey_results
CREATE TABLE IF NOT EXISTS survey_results (
                                              id INT AUTO_INCREMENT PRIMARY KEY,
                                              student_id INT NOT NULL,
                                              teacher_id INT NOT NULL,
                                              teaching_quality VARCHAR(1000),
                                              teaching_quality_rating TINYINT(1),
                                              availability VARCHAR(1000),
                                              availability_rating TINYINT(1),
                                              material_relevance VARCHAR(1000),
                                              material_relevance_rating TINYINT(1),
                                              group_interaction VARCHAR(1000),
                                              group_interaction_rating TINYINT(1),
                                              overall_feedback VARCHAR(1000),
                                              FOREIGN KEY (student_id) REFERENCES students(id),
                                              FOREIGN KEY (teacher_id) REFERENCES teachers(id)
);

-- Создание таблицы average_ratings
CREATE TABLE IF NOT EXISTS average_ratings (
                                               id INT AUTO_INCREMENT PRIMARY KEY,
                                               teacher_id INT UNIQUE NOT NULL,
                                               avg_teaching_quality DECIMAL(3,2),
                                               avg_availability DECIMAL(3,2),
                                               avg_material_relevance DECIMAL(3,2),
                                               avg_group_interaction DECIMAL(3,2),
                                               FOREIGN KEY (teacher_id) REFERENCES teachers(id)
);
