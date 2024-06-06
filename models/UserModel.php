<?php
// models/User.php
require_once 'Database.php';

class UserModel {
    public $fullname;
    public $email;
    public $password;

    public function save() {
        $db = Database::getConnection();

        $stmt = $db->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->fullname, $this->email, $this->password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
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

    public function findByEmail($email) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT id, fullname, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}
?>

