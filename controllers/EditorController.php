<?php
require_once 'BaseController.php';
require_once 'models/ProblemModel.php';
require_once 'models/BD.php';

class EditorController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        
        if (!isset($_GET['id'])) {
            die("ID-ul problemei nu a fost specificat.");
        }

        $question_id = $_GET['id'];

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
    
            // Conectarea la baza de date și executarea interogărilor
            $db = BD::getConnection(); 
            $userResult = $db->query($query);
            $correctResult = $db->query($correctQuery);
    
            if (!$userResult || !$correctResult) {
                throw new Exception("Eroare la executarea interogărilor.");
            }
    
            // Compararea rezultatelor interogărilor
            $userRows = $userResult->fetch_all(MYSQLI_ASSOC);
            $correctRows = $correctResult->fetch_all(MYSQLI_ASSOC);
    
            if ($userRows == $correctRows) {
                echo json_encode(['correct' => true]);
            } else {
                echo json_encode(['correct' => false]);
            }
    
        
    }

    public function saveDifficultyAction() {
        // Verificăm dacă s-au primit date prin POST sub formă de JSON
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['difficulty']) && isset($_SESSION['question_id'])) {
            $difficulty = $data['difficulty'];
            $question_id = $_SESSION['question_id']; // Presupunând că aveți question_id disponibil în sesiune

            try {
                // Actualizăm tabela question_statistics
                $model = new ProblemModel();
                $success = $model->updateOrInsertDifficulty($question_id, $difficulty);

                if ($success) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['error' => 'Failed to update difficulty']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'Invalid request']);
        }
    }
    
    
}
?>
