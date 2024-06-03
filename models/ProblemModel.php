<?php
error_reporting(E_ALL);
class ProblemModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProblems() {
        // Interogare pentru a obține problemele din baza de date
        $sql = "SELECT * FROM questions";
        $result = $this->db->query($sql);

        // Verificăm dacă interogarea a fost realizată cu succes
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
}
?>
