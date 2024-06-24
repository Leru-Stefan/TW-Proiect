<?php
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'BaseController.php';
require_once 'models/ProblemModel.php';
require_once 'models/BD.php';
require_once 'models/Database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class EditorController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        
        if (!isset($_GET['id'])) {
            die("ID-ul problemei nu a fost specificat.");
        }

        $question_id = $_GET['id'];
        $_SESSION['question_id'] = $question_id; // Set session variable

        $model = new ProblemModel();
        $problem = $model->getProblemById($question_id);

        if (!$problem) {
            die("Problema nu a fost găsită.");
        }

        $this->render('editor', ['problem' => $problem]);
    }

    public function verifyQueryAction() {
        $this->checkAuthentication();
        
        header('Content-Type: application/json'); // Asigură-te că răspunsul este JSON
        
        try {
            if (!isset($_POST['query']) || !isset($_POST['question_id'])) {
                throw new Exception("Query-ul sau ID-ul problemei nu a fost specificat.");
            }
    
            $query = $_POST['query'];
            $question_id = $_POST['question_id'];
    
            $model = new ProblemModel();
            $problem = $model->getProblemById($question_id);
            
            if (!$problem) {
                throw new Exception("Problema nu a fost găsită.");
            }
    
            $correctQuery = $problem['correct_query'];
    
            // Conectarea la baza de date principală și executarea interogărilor
            $db = BD::getConnection(); 
            $userResult = $db->query($query);
            $correctResult = $db->query($correctQuery);
    
            if (!$userResult || !$correctResult) {
                throw new Exception("Eroare la executarea interogărilor.");
            }
    
            // Compararea rezultatelor interogărilor
            $userRows = $userResult->fetch_all(MYSQLI_ASSOC);
            $correctRows = $correctResult->fetch_all(MYSQLI_ASSOC);
            
            $isCorrect = ($userRows == $correctRows);
    
            // Conectarea la o altă bază de date
            $db2 = Database::getConnection();
    
            // Pregătirea și executarea interogării de inserare
            $stmt = $db2->prepare("INSERT INTO user_answers (user_id, question_id, submitted_query, is_correct) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('iisi', $_SESSION["user_id"], $question_id, $query, $isCorrect);
            
            if (!$stmt->execute()) {
                throw new Exception("Eroare la inserarea datelor: " . $stmt->error);
            }
    
            // Închiderea conexiunii la baza de date secundară
            $stmt->close();
            $db2->close();
    
            echo json_encode(['correct' => $isCorrect]);
    
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    
    public function saveDifficultyAction() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON input');
            }
    
            if (!isset($data['difficulty']) || !isset($_SESSION['question_id'])) {
                throw new Exception('Invalid request');
            }
    
            $difficulty = $data['difficulty'];
            $question_id = $_SESSION['question_id'];
    
            $model = new ProblemModel();
            $success = $model->updateOrInsertDifficulty($question_id, $difficulty);
    
            if ($success) {
                echo json_encode(['success' => true]);
            } else {
                throw new Exception('Failed to update difficulty');
            }
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
}
?>
