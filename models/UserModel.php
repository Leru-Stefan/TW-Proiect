<?php
// models/User.php
require_once 'Database.php';

class UserModel {
    public $fullname;
    public $email;
    public $password;
    public $role;

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
            return true;
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
}
?>

