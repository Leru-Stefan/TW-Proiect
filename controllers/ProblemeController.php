<?php
// controllers/ProblemeController.php
require_once 'BaseController.php';
require_once 'models/ProblemModel.php';

class ProblemeController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        $model = new ProblemModel();
        $problems = $model->getAllProblems();
        $this->render('probleme', ['problems' => $problems]);
    }
}
?>