<?php
require_once 'BaseController.php';
require_once 'models/ProblemModel.php';

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
}
?>
