<?php
// models/User.php
require_once 'Database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class UserModel {
    public $nume;
    public $prenume;
    public $email;
    public $password;
    public $role;
    public $userId;

    public function save() {
        $db = Database::getConnection();

        $stmt = $db->prepare("INSERT INTO users (nume, prenume, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->nume, $this->prenume, $this->email, $this->password);

        try {
            $stmt->execute();
            $stmt->close();
            $db->close();
            return true;
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            $db->close();
            throw new Exception("E-mail-ul există deja.");
        }
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
    
        $stmt = $db->prepare("SELECT user_id, prenume, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId, $prenume, $hashedPassword);
        $stmt->fetch();
        $stmt->close();
    
        if ($hashedPassword && password_verify($password, $hashedPassword)) {
            return ['user_id' => $userId, 'prenume' => $prenume];
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
    
        $stmt = $db->prepare("SELECT COUNT(*) AS added_count FROM questions WHERE user_id = ?");
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

    public function getAddedProblems($userId) {
        $db = Database::getConnection();
    
        $stmt = $db->prepare("
            SELECT q.question_id, q.question_title, q.description
            FROM questions q
            WHERE q.user_id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $addedProblems = [];
        while ($row = $result->fetch_assoc()) {
            $addedProblems[] = $row;
        }
        $stmt->close();
    
        return $addedProblems;
    }
    
    public function getTopStudents($limit = 5) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT u.user_id, u.nume, u.prenume, COUNT(DISTINCT ua.question_id) AS solved_count
            FROM users u
            INNER JOIN User_Answers ua ON u.user_id = ua.user_id
            WHERE ua.is_correct = 1
            GROUP BY u.user_id
            ORDER BY solved_count DESC
            LIMIT ?
        ");
        $stmt->bind_param("i", $limitParam);
        $limitParam = $limit;
    
        if (!$stmt->execute()) {
            return ['error' => 'Error executing query'];
        }
    
        $result = $stmt->get_result();
    
        $topStudents = [];
        while ($row = $result->fetch_assoc()) {
            $topStudents[] = $row;
        }
    
        $stmt->close();
        return $topStudents;
    }
    

    public function deleteUserKeepProblems($userId) {
        $db = Database::getConnection();

        // Începe o tranzacție pentru a asigura integritatea datelor
        $db->begin_transaction();
    
        try {
        // Șterge toate răspunsurile utilizatorului
        $stmt = $db->prepare("DELETE FROM User_Answers WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();

         // Șterge toate răspunsurile utilizatorului
         $stmt = $db->prepare("DELETE FROM Comments WHERE user_id = ?");
         $stmt->bind_param("i", $userId);
         $stmt->execute();
         $stmt->close();
    
        // Șterge utilizatorul
        $stmt = $db->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();

        // Confirmă tranzacția
        $db->commit();
    } catch (Exception $e) {
        // Dacă există o eroare, anulează tranzacția
        $db->rollback();
        error_log("Eroare la ștergerea utilizatorului: " . $e->getMessage());
        throw $e; // Aruncă din nou excepția pentru a putea fi gestionată mai departe
    }
    }

    public function getUserRole($userId) {
        $db = Database::getConnection();
        
        $stmt = $db->prepare("
            SELECT role
            FROM Users
            WHERE user_id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $role = $result->fetch_assoc()['role'];
        $stmt->close();
        
        return $role;
    }

    public function getSolvedProblemsCountAndRole($userId) {
        $addedProblems = $this->getAddedProblems($userId);
        $solvedProblems = $this->getSolvedProblems($userId);
        $role = $this->getUserRole($userId);
        return [
            'solvedCount' => count($solvedProblems),
            'addedCount' => count($addedProblems),
            'role' => $role
        ];
    }
    
    public function changePassword($userId, $currentPassword, $newPassword) {
        $db = Database::getConnection();
    
        // Verifică dacă parola curentă este corectă
        $stmt = $db->prepare("SELECT password FROM users WHERE user_id = ?");
        if (!$stmt) {
            error_log("Eroare la pregătirea interogării: " . $db->error);
            throw new Exception("Eroare la pregătirea interogării.");
        }
        // Verifică dacă parola curentă este corectă
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();
    
        $hashedPass = password_hash($currentPassword, PASSWORD_BCRYPT);
        if (!password_verify($hashedPass, $hashedPassword)) {
            throw new Exception("Parola curentă este incorectă.");
        }
    
        // Hash-ează noua parolă
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    
        // Actualizează parola în baza de date
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        if (!$stmt) {
            error_log("Eroare la pregătirea interogării de actualizare: " . $db->error);
            throw new Exception("Eroare la pregătirea interogării de actualizare.");
        }
        $stmt->bind_param("si", $newHashedPassword, $userId);
        $stmt->execute();
        $stmt->close();
    
        return true;
    }
    
    
}
?>

