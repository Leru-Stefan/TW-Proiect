<?php
require_once 'Database.php';

class ProblemModel {
    private $connection;
    public $title;
    public $content;
    public $correct_answer;

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

    public function saveProblem($title, $content, $correct_answer) {
        $sql = "INSERT INTO questions (question_title, description, correct_query) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sss", $title, $content, $correct_answer);
        $stmt->execute();
        $stmt->close();
    }

    public function save($userId, $addedBy) {
        $sql = "INSERT INTO questions (question_title, description, correct_query) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sss", $this->title, $this->content, $this->correct_answer);
        $stmt->execute();
        $questionId = $stmt->insert_id;
        $stmt->close();

        $sql = "INSERT INTO user_questions (user_id, question_id, added_by) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("iis", $userId, $questionId, $addedBy);
        $stmt->execute();
        $stmt->close();
    }
}
?>
