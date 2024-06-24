<?php
require_once 'Database.php';
require_once 'UserModel.php';

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

        // Verificăm dacă există deja o înregistrare pentru această problemă în question_statistics
        $stmt = $db->prepare("SELECT * FROM question_statistics WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            // Dacă există, actualizăm înregistrarea existentă
            $stmt = $db->prepare("UPDATE question_statistics SET times_attempted = times_attempted + 1, difficulty_votes = difficulty_votes + 1 WHERE question_id = ?");
            $stmt->bind_param("i", $question_id);
            $stmt->execute();
            $stmt->close();
        } else {
            // Dacă nu există, inserăm o nouă înregistrare
            $stmt = $db->prepare("INSERT INTO question_statistics (question_id, times_attempted, difficulty_votes) VALUES (?, 1, 1)");
            $stmt->bind_param("i", $question_id);
            $stmt->execute();
            $stmt->close();
        }

        return true; // Întoarcem true dacă operația a avut succes
    }
    
   
}
?>
