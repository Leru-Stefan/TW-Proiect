<?php
require_once 'Database.php';
require_once 'UserModel.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ProblemModel {
    public $user_id;
    public $question_title;
    public $description;
    public $correct_query;
    public $difficulty;
    public $chapter;

    public function save() {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO questions (user_id, question_title, description, correct_query, difficulty, chapter) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $this->user_id, $this->question_title, $this->description, $this->correct_query,$this->difficulty, $this->chapter);

        try {
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            throw new Exception("Failed to save problem: " . $e->getMessage());
        }
    }

    public function getAllProblems() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT q.question_id, q.question_title, q.description,  COUNT(ua.answer_id) AS num_attempts
        FROM questions q
        LEFT JOIN User_Answers ua ON q.question_id = ua.question_id
        GROUP BY q.question_id, q.question_title
        ORDER BY num_attempts ASC;
        ");
        $stmt->execute();
        $result = $stmt->get_result();

        $problems = [];
        while ($row = $result->fetch_assoc()) {
            $problems[] = $row;
        }
        $stmt->close();

        return $problems;
    }

    public function getProblemById($question_id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM questions WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $problem = $result->fetch_assoc();
        $stmt->close();

        return $problem;
    }

    public function saveProblem($question_title, $description, $correct_query) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO questions (question_title, description, correct_query) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $question_title, $description, $correct_query);

        try {
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            throw new Exception("Failed to save problem: " . $e->getMessage());
        }
    }

    public function saveWithUser($userId, $addedBy) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO questions (question_title, description, correct_query) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->question_title, $this->description, $this->correct_query);

        try {
            $stmt->execute();
            $questionId = $stmt->insert_id;
            $stmt->close();

            $stmt = $db->prepare("INSERT INTO user_questions (user_id, question_id, added_by) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $userId, $questionId, $addedBy);
            $stmt->execute();
            $stmt->close();

            return true;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            throw new Exception("Failed to save problem with user: " . $e->getMessage());
        }
    }

    public function getFilteredProblems($chapter, $difficulty) {
        $db = Database::getConnection();
        $query = "SELECT q.question_id, q.question_title, q.description, COUNT(ua.answer_id) AS num_attempts
                  FROM questions q
                  LEFT JOIN User_Answers ua ON q.question_id = ua.question_id";
    
        $conditions = [];
        $params = [];
    
        if (!empty($chapter)) {
            $conditions[] = "q.chapter = ?";
            $params[] = $chapter;
        }
    
        if (!empty($difficulty)) {
            $conditions[] = "q.difficulty = ?";
            $params[] = $difficulty;
        }
    
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
    
        $query .= " GROUP BY q.question_id, q.question_title
                   ORDER BY num_attempts ASC";
    
        $stmt = $db->prepare($query);
    
        if (!empty($params)) {
            $stmt->bind_param(str_repeat("s", count($params)), ...$params);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        $problems = [];
        while ($row = $result->fetch_assoc()) {
            $problems[] = $row;
        }
        $stmt->close();
    
        return $problems;
    }

    public function updateOrInsertDifficulty($question_id, $difficulty) {
        $db = Database::getConnection();
    
        // Obțineți datele actuale din baza de date
        $stmt = $db->prepare("SELECT difficulty_votes FROM question_statistics WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
    
        if ($result) {
            // Dacă există deja un rând, actualizați-l
            $difficulty_votes = json_decode($result, true);
            $difficulty_votes[] = $difficulty;
            $difficulty_votes_json = json_encode($difficulty_votes);
    
            $updateQuery = $db->prepare("UPDATE question_statistics SET difficulty_votes = ? WHERE question_id = ?");
            $updateQuery->bind_param("si", $difficulty_votes_json, $question_id);
            $success = $updateQuery->execute();
        } else {
            // Dacă nu există un rând, inserați unul nou
            $difficulty_votes = [$difficulty]; // Inițializăm array-ul cu dificultatea curentă
            $difficulty_votes_json = json_encode($difficulty_votes);
    
            $insertQuery = $db->prepare("INSERT INTO question_statistics (question_id, difficulty_votes) VALUES (?, ?)");
            $insertQuery->bind_param("is", $question_id, $difficulty_votes_json);
            $success = $insertQuery->execute();
        }
    
        if ($success) {
            $this->updateQuestionDifficulty($question_id);
        }
    
        return $success;
    }
    
    public function updateQuestionDifficulty($question_id) {
        $db = Database::getConnection();
    
        // Obțineți datele actuale din baza de date
        $stmt = $db->prepare("SELECT difficulty_votes FROM question_statistics WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $stmt->bind_result($difficulty_votes_json);
        $stmt->fetch();
        $stmt->close();
    
        if ($difficulty_votes_json) {
            $difficulty_votes = json_decode($difficulty_votes_json, true);
    
            // Calculați dificultatea predominantă
            $difficulty_count = array_count_values($difficulty_votes);
            arsort($difficulty_count);
            $predominant_difficulty = array_key_first($difficulty_count);
    
            // Maparea dificultății din română în engleză
            $difficultyMap = [
                'usor' => 'easy',
                'mediu' => 'medium',
                'greu' => 'hard'
            ];
            $mapped_difficulty = isset($difficultyMap[$predominant_difficulty]) ? $difficultyMap[$predominant_difficulty] : $predominant_difficulty;
    
            // Verifică dacă dificultatea predominantă este una validă
            $valid_difficulties = ['easy', 'medium', 'hard'];
            if (in_array($mapped_difficulty, $valid_difficulties)) {
                // Actualizați câmpul difficulty în tabela questions
                $updateQuery = $db->prepare("UPDATE questions SET difficulty = ? WHERE question_id = ?");
                $updateQuery->bind_param("si", $mapped_difficulty, $question_id);
                $updateQuery->execute();
                $updateQuery->close();
            } else {
                throw new Exception("Dificultatea calculată nu este validă: $predominant_difficulty");
            }
        }
    }

    public function deleteProblem($problemId) {
        $db = Database::getConnection();

        // Șterge mai întâi rândurile din question_statistics care depind de problem_id
        $sql = "DELETE FROM question_statistics WHERE question_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $problemId);
        $stmt->execute();
        $stmt->close();

        $sql = "DELETE FROM user_answers WHERE question_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $problemId);
        $stmt->execute();
        $stmt->close();

        // Acum poți șterge rândul din questions
        $sql = "DELETE FROM questions WHERE question_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $problemId);

        try {
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            throw new Exception("Failed to delete problem: " . $e->getMessage());
        }
    }
}
?>
