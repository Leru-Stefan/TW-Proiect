<?php
require_once 'BaseController.php';
require_once 'models/UserModel.php';


class AdminController extends BaseController {
    public function indexAction() {
        $this->checkAuthentication();
        // Obținem ID-ul utilizatorului autentificat
        $userModel = new UserModel();
        $userId = $userModel->getIdByEmail($_SESSION['user']);

        // Obținem numărul de probleme rezolvate de utilizator
        $solvedProblemsCount = $userModel->getSolvedProblemsCount($userId);

        // Obținem numărul de probleme adăugate de utilizator
        $addedProblemsCount = $userModel->getAddedProblemsCount($userId);

        // Obținem accuratetea utilizatorului
        $accuarcy = $userModel->getAccuracy($userId);

          // Obținem problemele rezolvate de utilizator
          $solvedProblems = $userModel->getSolvedProblems($userId);

        // Rendăm pagina de profil și transmitem datele pentru afișare
        $this->render('admin', ['solvedProblemsCount' => $solvedProblemsCount, 'addedProblemsCount' => $addedProblemsCount, 'accuracy' => $accuarcy, 'solvedProblems' => $solvedProblems]);

    }
}
?>