<?php
// controllers/ProblemeController.php
require_once 'BaseController.php';
require_once './models/ProblemModel.php';

class ProblemeController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        $model = new ProblemModel();
        $problems = $model->getAllProblems();
        $this->render('probleme', ['problems' => $problems]);
    }

    public function addAction() {
        $this->checkAuthentication();
        $this->render('add_problem');
    }

    public function addOrImportAction() {
        $this->checkAuthentication();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->addFromForm();
            } catch (Exception $e) {
                error_log("Error adding from form: " . $e->getMessage());
                $_SESSION['errors'] = ['A apărut o eroare la adăugarea întrebării.'];
                header("Location: index.php?page=probleme");
                exit;
            }
        }
    }
    
    private function addFromForm() {
        $question_title = $_POST['question_title'];
        $description = $_POST['description'];
        $correct_query = $_POST['correct_query'];
        $user_id = $_SESSION['user_id'];
        $chapter = $_POST['chapter'];
        $difficulty = $_POST['difficulty'];

        $questionModel = new ProblemModel();
        $questionModel->user_id = $user_id;
        $questionModel->question_title = $question_title;
        $questionModel->description = $description;
        $questionModel->correct_query = $correct_query;
        $questionModel->chapter = $chapter;
        $questionModel->difficulty = $difficulty;


        if ($questionModel->save()) {
            header("Location: index.php?page=probleme");
        } else {
            $_SESSION['errors'] = ['A apărut o eroare la adăugarea întrebării.'];
            header("Location: index.php?page=probleme&action=add");
        }
        exit;
    }
}
?>