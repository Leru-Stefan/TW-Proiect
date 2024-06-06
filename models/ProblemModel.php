<?php
require_once 'Database.php';

class ProblemModel {
    private $connection;

    public function __construct() {
        $this->connection = Database::getConnection();
    }

    public function getAllProblems() {
        $sql = "SELECT * FROM questions";
        $result = $this->connection->query($sql);
        
        $problems = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $problems[] = $row;
            }
        }
        return $problems;
    }

    public function getProblemById($question_id) {
        $sql = "SELECT * FROM questions WHERE question_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }
}
?>


