<?php
// models/User.php
require_once 'Database.php';

class UserModel {
    public $fullname;
    public $email;
    public $password;
    public $role;
    public $userId;

    public function save() {
        $db = Database::getConnection();

        $stmt = $db->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, 'student')");
        $stmt->bind_param("sss", $this->fullname, $this->email, $this->password);

        return $stmt->execute();
    }

    public function emailExists($email) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }
    
    public function authenticate($email, $password) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();

        if ($hashedPassword && password_verify($password, $hashedPassword)) {
            return ['user_id' => $userId, 'fullname' => $fullname];
        } else {
            return false;
        }
    }

    public function getRole($email) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($role);
        $stmt->fetch();
        $stmt->close();

        return $role;
    }

    public function getIdByEmail($email) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId);
        $stmt->fetch();

        return $userId;
    }

    public function getSolvedProblemsCount($userId) {
        $db = Database::getConnection();
    
        $stmt = $db->prepare("SELECT COUNT(DISTINCT question_id) AS solved_count FROM User_Answers WHERE user_id = ? AND is_correct = 1");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($solvedCount);
        $stmt->fetch();
    
        return $solvedCount;
    }
    

    public function getAddedProblemsCount($userId) {
        $db = Database::getConnection();
    
        $stmt = $db->prepare("SELECT COUNT(*) AS added_count FROM User_Uploaded_Questions WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($addedCount);
        $stmt->fetch();
    
        return $addedCount;
    }

    public function getAccuracy($userId) {
        $db = Database::getConnection();
    
        // Obținem numărul de întrebări corect rezolvate
        $stmt = $db->prepare("SELECT COUNT(DISTINCT question_id) AS solved_count FROM User_Answers WHERE user_id = ? AND is_correct = 1");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($solvedCount);
        $stmt->fetch();
        $stmt->close();
    
        // Obținem numărul total de întrebări încercate
        $stmt = $db->prepare("SELECT COUNT(DISTINCT question_id) AS solved_total_count FROM User_Answers WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($solvedTotalCount);
        $stmt->fetch();
        $stmt->close();
    
        $accuracy = 0;
    
        if ($solvedTotalCount != 0) {
            $accuracy = ($solvedCount / $solvedTotalCount) * 100;
        }
    
        return $accuracy;
    }

    public function getSolvedProblems($userId) {
        $db = Database::getConnection();
    
        $stmt = $db->prepare("
            SELECT q.question_id, q.description
            FROM Questions q
            INNER JOIN User_Answers ua ON q.question_id = ua.question_id
            WHERE ua.user_id = ? AND ua.is_correct = 1
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $solvedProblems = [];
        while ($row = $result->fetch_assoc()) {
            $solvedProblems[] = $row;
        }
        $stmt->close();
    
        return $solvedProblems;
    }
    
}
?>

